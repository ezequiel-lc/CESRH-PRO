<div>
    <div class="p-6">
        <h2 class="text-lg font-semibold text-gray-900 text-center">¿Estás seguro de que deseas dar de baja este activo?</h2>
        <p class="text-sm text-gray-700 mt-2 text-center">Esta acción no se puede deshacer.</p>
    
        <div class="mt-4 flex justify-center space-x-4">
            <button wire:click="closeModal" class="px-4 py-2 bg-[#1763A6] rounded text-white">Cancelar</button>
            <button wire:click="baja" class="px-4 py-2 bg-red-600 text-white rounded">Aceptar</button>
        </div>
    </div>
</div>
