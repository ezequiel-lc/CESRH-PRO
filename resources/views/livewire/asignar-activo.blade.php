<div class="p-4">
    <h2 class="text-lg font-bold mb-4">Asignar Activo</h2>

    <div class="mb-4">
        <label for="usuario" class="block text-sm font-medium text-gray-700">Seleccionar Usuario</label>
        <select wire:model="usuarioId" id="usuario" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
            <option value="">Seleccione un usuario</option>
            @foreach($usuarios as $usuario)
                <option value="{{ $usuario->id }}">{{ $usuario->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="flex justify-end space-x-2">
        <button wire:click="$closeModal" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md">Cancelar</button>
        <button wire:click="asignar" class="px-4 py-2 bg-blue-600 text-white rounded-md">Asignar</button>
    </div>
</div>
