<div class="p-6">
    <h2 class="text-lg font-semibold text-gray-900">¿Estás seguro de que deseas eliminar este elemento?</h2>
    <p class="text-sm text-gray-700 mt-2">Esta acción no se puede deshacer.</p>

    <div class="mt-4 flex justify-end space-x-2">
        <button wire:click="closeModal" class="px-4 py-2 bg-[#1763A6] rounded text-white">Cancelar</button>
        <button wire:click="delete()" class="px-4 py-2 bg-red-600 text-white rounded">Eliminar</button>
    </div>
</div>
