<div class="p-6">
    <h1 class="text-2xl font-bold mb-6">Asignar Rol a {{ $name }}</h1>

    <form wire:submit.prevent="AgregarRol">
        <div class="mb-4">
            <label class="block text-gray-700">Selecciona un rol</label>
            <select wire:model="rol" class="w-full px-4 py-2 border rounded-lg">
                <option value="">Selecciona un rol</option>
                @foreach ($roles as $role)
                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg">Guardar</button>
    </form>

    @if (session()->has('message'))
        <div class="mt-4 text-green-500">
            {{ session('message') }}
        </div>
    @endif
</div>