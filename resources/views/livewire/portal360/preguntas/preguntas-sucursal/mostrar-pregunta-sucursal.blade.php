<div>
    <div class="p-6">
        <div class="bg-white shadow-lg rounded-lg p-6">
            <div class="flex justify-between items-center border-b border-gray-300 pb-4">
                <h2 class="text-xl font-bold text-gray-900">Gestión de Preguntas</h2>
            </div>
            <div class="relative">
                <button wire:click="redirigirpreguntaSucursal()" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg shadow mb-4 absolute top-3 left-10"> Agregar Preguntas
                </button>
            </div>
            <div class="overflow-x-auto rounded-md">
                <livewire:portal360.preguntas.preguntassucursal.preguntas-sucursal-table class="table-borderless" />
            </div>
        </div>
    </div>
</div>

<!-- Scripts para SweetAlert2 -->
<script>
    // Script para la confirmación de eliminación
    document.addEventListener('livewire:initialized', function() {
        Livewire.on('confirmarEliminarPreguntaSucursal', (data) => {
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
                    Livewire.dispatch('eliminarPreguntaSucursal', {
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