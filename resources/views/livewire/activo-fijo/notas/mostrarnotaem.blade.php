<div>
    <!-- Título con fondo degradado y sombra -->
    <div class="bg-gradient-to-r from-[#1763A6] to-[#1EA4D9] text-white font-bold text-xl py-4 px-6 rounded-t-lg shadow-lg flex items-center justify-between">
        <span>Notas</span>
        <div class="flex items-center space-x-4">
            <!-- Botón Agregar -->
            <button onclick="Livewire.dispatch('openModal', { component: 'activo-fijo.modales.agregarnotaem' })"
                class="text-white font-bold p-2 rounded-md flex items-center justify-center hover:bg-[#1763A6] transition duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
            </button>
        </div>
    </div>

    <!-- Contenedor de la tabla con fondo blanco y sombras -->
    <div class="bg-white rounded-b-lg shadow-2xl p-6 mt-2">
        <livewire:nota-table /> <!-- Renderiza el PowerGrid -->
    </div>
</div>