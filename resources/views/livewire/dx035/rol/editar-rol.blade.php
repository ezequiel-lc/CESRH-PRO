<div class="p-6">
    <h1 class="text-2xl font-bold mb-6">Editar Rol</h1>

    <form wire:submit.prevent="actualizarRol">
        <div class="mb-4">
            <label class="block text-gray-700">Nombre del Rol</label>
            <input type="text" wire:model="name" class="w-full px-4 py-2 border rounded-lg">
            @error('name') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Permisos</label>
            @foreach ($permissions as $permission)
                <label class="block">
                    <input type="checkbox" wire:model="selectedPermissions" value="{{ $permission->id }}">
                    {{ $permission->name }}
                </label>
            @endforeach
            @error('selectedPermissions') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg">Guardar</button>
    </form>
</div>