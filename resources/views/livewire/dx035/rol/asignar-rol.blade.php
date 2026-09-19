<div class="p-6">
    <h1 class="text-2xl font-bold mb-6">Asignar Roles a {{ $user->name }}</h1>

    <form wire:submit.prevent="asignarRoles">
        <div class="mb-4">
            <label class="block text-gray-700">Selecciona los roles</label>
            @foreach ($roles as $role)
                <label class="block">
                    <input type="checkbox" wire:model="selectedRoles" value="{{ $role->id }}">
                    {{ $role->name }}
                </label>
            @endforeach
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg">Guardar</button>
    </form>

    @if (session()->has('message'))
        <div class="mt-4 text-green-500">
            {{ session('message') }}
        </div>
    @endif
</div>