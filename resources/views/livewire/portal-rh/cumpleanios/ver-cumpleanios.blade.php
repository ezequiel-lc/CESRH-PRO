<div class="mt-8 border-2 border-gray-300 rounded-lg p-5 bg-gray-100 shadow-sm">
    <h3 class="text-gray-600 font-bold md:text-2xl text-xl text-center">Calendario de Cumpleaños</h3>

    <!-- Selector de mes -->
    <div class="flex justify-center mt-3">
        <button id="prevMonth" class="px-3 py-1 bg-gray-300 rounded-md mx-2">◀</button>
        <h3 id="calendarTitle" class="text-lg font-bold text-gray-700"></h3>
        <button id="nextMonth" class="px-3 py-1 bg-gray-300 rounded-md mx-2">▶</button>
    </div>

    <!-- Contenedor del Calendario -->
    <div id="calendarContainer" class="mt-5"></div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Datos de cumpleaños desde Laravel
        const cumpleanios = @json($eventosCalendario);

        let currentDate = new Date();
        let currentMonth = currentDate.getMonth();
        let currentYear = currentDate.getFullYear();

        function generateCalendar(month, year) {
            const calendarContainer = document.getElementById("calendarContainer");
            const calendarTitle = document.getElementById("calendarTitle");

            const monthNames = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
            calendarTitle.textContent = `${monthNames[month]} ${year}`;

            let firstDay = new Date(year, month, 1).getDay();
            let daysInMonth = new Date(year, month + 1, 0).getDate();

            let calendarHTML = `<table class="w-full border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="border border-gray-300 py-2">Dom</th>
                        <th class="border border-gray-300 py-2">Lun</th>
                        <th class="border border-gray-300 py-2">Mar</th>
                        <th class="border border-gray-300 py-2">Mié</th>
                        <th class="border border-gray-300 py-2">Jue</th>
                        <th class="border border-gray-300 py-2">Vie</th>
                        <th class="border border-gray-300 py-2">Sáb</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>`;

            let date = 1;
            for (let i = 0; i < 6; i++) { // Máximo 6 filas
                for (let j = 0; j < 7; j++) {
                    if (i === 0 && j < firstDay) {
                        calendarHTML += `<td class="border border-gray-300 py-2"></td>`;
                    } else if (date > daysInMonth) {
                        break;
                    } else {
                        let formattedDate = `${year}-${(month + 1).toString().padStart(2, "0")}-${date.toString().padStart(2, "0")}`;
                        let cumple = cumpleanios.find(event => event.start === formattedDate);

                        let cellClass = "border border-gray-300 py-2 text-center";
                        let bgColor = "";
                        let tooltip = "";

                        if (cumple) {
                            bgColor = `style="background-color: ${cumple.color}; color: black; font-weight: bold;"`;
                            tooltip = `title="🎂 ${cumple.name}"`;
                        }

                        calendarHTML += `<td class="${cellClass}" ${bgColor} ${tooltip}>${date}</td>`;
                        date++;
                    }
                }

                if (date > daysInMonth) break;
                calendarHTML += `</tr><tr>`;
            }

            calendarHTML += `</tr></tbody></table>`;
            calendarContainer.innerHTML = calendarHTML;
        }

        // Mostrar el calendario actual
        generateCalendar(currentMonth, currentYear);

        // Navegación de mes
        document.getElementById("prevMonth").addEventListener("click", function () {
            currentMonth--;
            if (currentMonth < 0) {
                currentMonth = 11;
                currentYear--;
            }
            generateCalendar(currentMonth, currentYear);
        });

        document.getElementById("nextMonth").addEventListener("click", function () {
            currentMonth++;
            if (currentMonth > 11) {
                currentMonth = 0;
                currentYear++;
            }
            generateCalendar(currentMonth, currentYear);
        });
    });
</script>
