<link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.3.5/dist/tailwind.min.css" rel="stylesheet">

<div class="flex min-h-screen items-start justify-center pt-6">
    <div class="grid bg-white rounded-lg shadow-xl w-full"> <br>

        <div class="flex justify-center">
            <div class="flex">
                <h1 class="text-gray-600 font-bold md:text-2xl text-xl">Mis Incidencias</h1>
            </div>
        </div>

        <div class="mt-5 mx-7">
            @if ($incidencias->isEmpty())
                <div class="p-6 text-center text-gray-600">
                    <p>Sin incidencias actualmente</p>
                </div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 p-6">
                    @foreach ($incidencias as $incidencia)
                        <div class="w-full mx-auto bg-white shadow-xl rounded-lg text-gray-900 p-4">
                            <div class="rounded-t-lg h-32 overflow-hidden">
                                <img class="object-cover object-top w-full" src="{{ asset('img/cesrh.jpeg') }}"
                                    alt="Background">
                            </div>

                            <div class="text-center mt-2">
                                <h2><strong>Usuario:</strong>
                                    {{ $incidencia->users->first() ? $incidencia->users->first()->name : 'Sin asignar' }}
                                </h2>
                                <p><strong>Tipo de incidencia:</strong> {{ $incidencia->tipo_incidencia }}</p>
                                <p><strong>Fecha inicio:</strong> {{ $incidencia->fecha_inicio }}</p>
                                <p><strong>Fecha final:</strong> {{ $incidencia->fecha_final }}</p>
                            </div>

                            <div class="flex gap-4 mt-4">
                                <!-- Aquí pueden ir botones o acciones -->
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <div class="mt-5 mx-7 border-2 border-gray-300 rounded-lg p-5 bg-gray-50 shadow-sm">
            <div class="flex justify-center border-b-2 border-gray-300 pb-2 mb-4">
                <h3 class="text-gray-600 font-bold md:text-2xl text-xl">Calendario de Incidencias</h3>
            </div> 
            <div class="flex justify-center border-b-2 border-gray-300 pb-2 mb-4">
                <h3 class="text-gray-600 font-bold md:text-2xl text-xl">Tabla de referencia</h3>
            </div>            

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 w-full">
                <!-- Incidencias de Asistencia y Puntualidad (Amarillo) -->
                <label class="inline-flex items-center">
                    <input type="checkbox" class="peer hidden" checked disabled>
                    <div class="w-4 h-4 rounded-md border border-gray-500 peer-checked:bg-purple-200"></div>
                    <span class="ml-2">Falta injustificada</span>
                </label>

                <label class="inline-flex items-center">
                    <input type="checkbox" class="peer hidden" checked disabled>
                    <div class="w-4 h-4 rounded-md border border-gray-500 peer-checked:bg-purple-400"></div>
                    <span class="ml-2">Salida anticipada sin permiso</span>
                </label>

                <label class="inline-flex items-center">
                    <input type="checkbox" class="peer hidden" checked disabled>
                    <div class="w-4 h-4 rounded-md border border-gray-500 peer-checked:bg-purple-600"></div>
                    <span class="ml-2">Olvido de marcar entrada/salida</span>
                </label>

                <label class="inline-flex items-center">
                    <input type="checkbox" class="peer hidden" checked disabled>
                    <div class="w-4 h-4 rounded-md border border-gray-500 peer-checked:bg-purple-800"></div>
                    <span class="ml-2">Intento de marcar asistencia por otro trabajador</span>
                </label>

                <!-- Incidencias de Desempeño y Productividad (Azul) -->
                <label class="inline-flex items-center">
                    <input type="checkbox" class="peer hidden" checked disabled>
                    <div class="w-4 h-4 rounded-md border border-gray-500 peer-checked:bg-blue-200"></div>
                    <span class="ml-2">Bajo rendimiento laboral</span>
                </label>
                <label class="inline-flex items-center">
                    <input type="checkbox" class="peer hidden" checked disabled>
                    <div class="w-4 h-4 rounded-md border border-gray-500 peer-checked:bg-blue-400"></div>
                    <span class="ml-2">Incumplimiento de metas u objetivos</span>
                </label>
                <label class="inline-flex items-center">
                    <input type="checkbox" class="peer hidden" checked disabled>
                    <div class="w-4 h-4 rounded-md border border-gray-500 peer-checked:bg-blue-600"></div>
                    <span class="ml-2">Errores recurrentes en tareas asignadas</span>
                </label>
                <label class="inline-flex items-center">
                    <input type="checkbox" class="peer hidden" checked disabled>
                    <div class="w-4 h-4 rounded-md border border-gray-500 peer-checked:bg-blue-800"></div>
                    <span class="ml-2">Retrasos constantes en la entrega de trabajos</span>
                </label>

                <!-- Incidencias Relacionadas con Salud (Verde) -->
                <label class="inline-flex items-center">
                    <input type="checkbox" class="peer hidden" checked disabled>
                    <div class="w-4 h-4 rounded-md border border-gray-500 peer-checked:bg-lime-200"></div>
                    <span class="ml-2">Falsificación de justificantes médicos</span>
                </label>
                <label class="inline-flex items-center">
                    <input type="checkbox" class="peer hidden" checked disabled>
                    <div class="w-4 h-4 rounded-md border border-gray-500 peer-checked:bg-lime-400"></div>
                    <span class="ml-2">Enfermedad contagiosa sin aviso previo</span>
                </label>

                <!-- Incidencias Disciplinarias (Naranja) -->
                <label class="inline-flex items-center">
                    <input type="checkbox" class="peer hidden" checked disabled>
                    <div class="w-4 h-4 rounded-md border border-gray-500 peer-checked:bg-lime-600"></div>
                    <span class="ml-2">Uso inadecuado de recursos o herramientas  de la empresa</span>
                </label>
                <label class="inline-flex items-center">
                    <input type="checkbox" class="peer hidden" checked disabled>
                    <div class="w-4 h-4 rounded-md border border-gray-500 peer-checked:bg-lime-800"></div>
                    <span class="ml-2">Desobediencia a instrucciones superiores</span>
                </label>
                <label class="inline-flex items-center">
                    <input type="checkbox" class="peer hidden" checked disabled>
                    <div class="w-4 h-4 rounded-md border border-gray-500 peer-checked:bg-orange-200"></div>
                    <span class="ml-2">Falta de respeto a compañeros o superiores</span>
                </label>
                <label class="inline-flex items-center">
                    <input type="checkbox" class="peer hidden" checked disabled>
                    <div class="w-4 h-4 rounded-md border border-gray-500 peer-checked:bg-orange-400"></div>
                    <span class="ml-2">Uso indebido del tiempo laboral (uso de redes sociales, celular, etc.)</span>
                </label>
                <label class="inline-flex items-center">
                    <input type="checkbox" class="peer hidden" checked disabled>
                    <div class="w-4 h-4 rounded-md border border-gray-500 peer-checked:bg-orange-600"></div>
                    <span class="ml-2">Realización de actividades personales en horario laboral</span>
                </label>
                <label class="inline-flex items-center">
                    <input type="checkbox" class="peer hidden" checked disabled>
                    <div class="w-4 h-4 rounded-md border border-gray-500 peer-checked:bg-orange-800"></div>
                    <span class="ml-2">Uso de lenguaje ofensivo o agresivo</span>
                </label>

                <!-- Incidencias Graves (Rojo) -->
                <label class="inline-flex items-center">
                    <input type="checkbox" class="peer hidden" checked disabled>
                    <div class="w-4 h-4 rounded-md border border-gray-500 peer-checked:bg-teal-200"></div>
                    <span class="ml-2">Divulgación de información confidencial</span>
                </label>
                <label class="inline-flex items-center">
                    <input type="checkbox" class="peer hidden" checked disabled>
                    <div class="w-4 h-4 rounded-md border border-gray-500 peer-checked:bg-teal-400"></div>
                    <span class="ml-2">Hurto o robo dentro de la empresa</span>
                </label>
                <label class="inline-flex items-center">
                    <input type="checkbox" class="peer hidden" checked disabled>
                    <div class="w-4 h-4 rounded-md border border-gray-500 peer-checked:bg-teal-600"></div>
                    <span class="ml-2">Fraude o alteración de documentos</span>
                </label>
                <label class="inline-flex items-center">
                    <input type="checkbox" class="peer hidden" checked disabled>
                    <div class="w-4 h-4 rounded-md border border-gray-500 peer-checked:bg-teal-800"></div>
                    <span class="ml-2">Violencia física o amenazas en el trabajo</span>
                </label>
                <label class="inline-flex items-center">
                    <input type="checkbox" class="peer hidden" checked disabled>
                    <div class="w-4 h-4 rounded-md border border-gray-500 peer-checked:bg-red-200"></div>
                    <span class="ml-2">Consumo de alcohol o drogas en horario laboral</span>
                </label>
                <label class="inline-flex items-center">
                    <input type="checkbox" class="peer hidden" checked disabled>
                    <div class="w-4 h-4 rounded-md border border-gray-500 peer-checked:bg-red-400"></div>
                    <span class="ml-2">Acoso sexual o discriminación</span>
                </label>
                <label class="inline-flex items-center">
                    <input type="checkbox" class="peer hidden" checked disabled>
                    <div class="w-4 h-4 rounded-md border border-gray-500 peer-checked:bg-red-600"></div>
                    <span class="ml-2">Uso indebido de credenciales o accesos restringidos</span>
                </label>
            </div>

            <div class="mt-8 border-2 border-gray-300 rounded-lg p-5 bg-gray-100 shadow-sm">
                <h3 class="text-gray-600 font-bold md:text-2xl text-xl text-center">Calendario de Incidencias</h3>
            
                <!-- Selector de mes -->
                <div class="flex justify-center mt-3">
                    <button id="prevMonth" class="px-3 py-1 bg-gray-300 rounded-md mx-2">◀</button>
                    <h3 id="calendarTitle" class="text-lg font-bold text-gray-700"></h3>
                    <button id="nextMonth" class="px-3 py-1 bg-gray-300 rounded-md mx-2">▶</button>
                </div>
            
                <!-- Contenedor del Calendario -->
                <div id="calendarContainer" class="mt-5">
                    <!-- Aquí se insertará el calendario dinámico -->
                </div>
            </div>
        </div>

        <!-- Botones -->
        <div class="flex items-center justify-center md:gap-8 gap-4 pt-5 pb-5">
            <button type="button" onclick="window.history.back()"
                class="w-auto bg-green-500 hover:bg-green-700 rounded-lg shadow-xl font-medium text-white px-4 py-2">
                Volver
            </button>
        </div>
    </div>
</div>

<!-- FullCalendar -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Datos de incidencias desde Laravel
        const incidencias = @json($eventosCalendario);

        // Variables para manejar el mes actual
        let currentDate = new Date();
        let currentMonth = currentDate.getMonth();
        let currentYear = currentDate.getFullYear();

        function generateCalendar(month, year) {
            const calendarContainer = document.getElementById("calendarContainer");
            const calendarTitle = document.getElementById("calendarTitle");

            // Nombres de los meses
            const monthNames = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
            calendarTitle.textContent = `${monthNames[month]} ${year}`;

            // Crear estructura de calendario
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
                        let incidencia = incidencias.find(event => event.start <= formattedDate && event.end >= formattedDate);

                        let cellClass = "border border-gray-300 py-2 text-center";
                        let bgColor = "";

                        if (incidencia) {
                            bgColor = `style="background-color: ${incidencia.color}; color: white; font-weight: bold;"`;
                        }

                        calendarHTML += `<td class="${cellClass}" ${bgColor}>${date}</td>`;
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
