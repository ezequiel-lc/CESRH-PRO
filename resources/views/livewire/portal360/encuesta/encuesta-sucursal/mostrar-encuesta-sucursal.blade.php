<div>
    <div class="p-6">
        <div class="bg-white shadow-lg rounded-lg p-6">
            <div class="flex justify-between items-center border-b border-gray-300 pb-4">
                <h2 class="text-xl font-bold text-gray-900">Gestión de Encuesta</h2>
            </div>
            <div class="relative">
                <button wire:click="redirigirencuestaSucursal()" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg shadow mb-4 absolute top-3 left-10"> Agregar Encuesta
                </button>
            </div>
            <div class="overflow-x-auto rounded-md">
            <livewire:portal360.encuesta.encuestasucursal.encuesta-sucursal-table class="table-borderless" />
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        Livewire.on('confirmarEliminarEncuestaSucursal', (data) => {
            Swal.fire({
                title: "¿Está seguro?",
                text: "Esta acción no se puede deshacer.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Sí, eliminar",
                cancelButtonText: "Cancelar"
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.dispatch('eliminarEncuestaSucursal', { id: data.id });
                }
            });
        });
    });
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
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
                icon: "error"
            });
        });
    });
</script>


