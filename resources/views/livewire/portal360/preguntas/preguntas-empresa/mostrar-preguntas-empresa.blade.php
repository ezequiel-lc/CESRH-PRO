<div>
    <div class="p-6">
        <div class="bg-white shadow-lg rounded-lg p-6">
            <!-- Header with Title -->
            <div class="border-b border-gray-300 pb-4 mb-4">
                <h2 class="text-xl font-bold text-gray-900">Gestión de Preguntas</h2>
            </div>
            <div class="absolute right-20">
                <button wire:click="redirigirpreguntaEmpresa()"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg shadow flex items-center gap-2 transition duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"></path>
                    </svg>
                    Agregar Preguntas
                </button>
            </div>
            <!-- Table Container -->
            <div class="overflow-x-auto rounded-md mt-16"> <!-- Aumenta el valor de 'mt-8' si lo quieres más abajo -->
            <livewire:portal360.preguntas.preguntasempresa.preguntas-empresa-table class="table-borderless" />
            </div>

        </div>
    </div>
</div>


<!-- Scripts para SweetAlert2 -->
<script>
    // Script para la confirmación de eliminación
    document.addEventListener('livewire:initialized', function() {
        Livewire.on('confirmarEliminarPreguntaEmpresa', (data) => {
            Swal.fire({
                title: "¿Está seguro?",
                text: "¡No podrás revertir esto!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "¡Sí, bórralo!",
                cancelButtonText: "Cancelar"
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.dispatch('eliminarPreguntaEmpresa', {
                        id: data.id
                    });
                }
            });
        });
    });

    // Scripts para mostrar mensajes de éxito o error
    document.addEventListener('livewire:initialized', function() {
        Livewire.on('swal-success', (data) => {
            Swal.fire({
                title: "¡Éxito!",
                text: data.message,
                icon: "success",
                timer: 2000,
                showConfirmButton: false
            });
        });

        Livewire.on('swal-error', (data) => {
            Swal.fire({
                title: "Error",
                text: data.message,
                icon: "error",
                confirmButtonText: "Aceptar"
            });
        });
    });
</script>