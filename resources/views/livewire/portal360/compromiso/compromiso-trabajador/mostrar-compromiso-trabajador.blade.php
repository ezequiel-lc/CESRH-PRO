<div>
    <div class="p-6">
        <div class="bg-white shadow-lg rounded-lg p-6">
            <!-- Header with Title -->
            <div class="border-b border-gray-300 pb-4 mb-4">
                <h2 class="text-xl font-bold text-gray-900">Compromisos</h2>
            </div>
            <div class="absolute right-20">
                <button wire:click="redirigirCompromisosTrabajador()"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg shadow flex items-center gap-2 transition duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"></path>
                    </svg>
                    Agregar Compromisos
                </button>
            </div>
            <!-- Table Container -->
            <div class="overflow-x-auto rounded-md mt-16"> <!-- Aumenta el valor de 'mt-8' si lo quieres más abajo -->
                <livewire:portal360.compromiso.compromisotrabajador.compromiso-trabajador-table class="table-borderless" />
            </div>

        </div>
    </div>
</div>