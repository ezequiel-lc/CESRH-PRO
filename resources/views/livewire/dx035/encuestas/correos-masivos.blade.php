<div class="bg-white shadow-lg rounded-lg p-8">
    <h1 class="text-2xl font-semibold text-gray-800 mb-6">Correos Masivos</h1>

    <!-- Mensaje de éxito -->
    @if (session()->has('message'))
        <div class="bg-green-100 text-green-700 px-4 py-3 rounded mb-6">
            {{ session('message') }}
        </div>
    @endif

    <!-- Formulario para agregar correos -->
    <form wire:submit.prevent="agregarCorreo" class="mb-6">
        <div class="flex items-center space-x-4">
            <input type="email" wire:model="correo" placeholder="Ingrese un correo electrónico" required
                   class="flex-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                Agregar
            </button>
        </div>
        @error('correo') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
    </form>

    <!-- Tabla de correos -->
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-200">
            <thead>
                <tr>
                    <th class="px-4 py-2 border-b">Correo Electrónico</th>
                    <th class="px-4 py-2 border-b">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($correos as $correo)
                    <tr>
                        <td class="px-4 py-2 border-b">{{ $correo->correo }}</td>
                        <td class="px-4 py-2 border-b">
                            <button wire:click="eliminarCorreo({{ $correo->id }})" class="text-red-500 hover:text-red-700">
                                Eliminar
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Paginación -->
    <div class="mt-6">
        {{ $correos->links() }}
    </div>
</div><div class="bg-white shadow-lg rounded-lg p-8">
    <h1 class="text-2xl font-semibold text-gray-800 mb-6">Correos Masivos</h1>

    <!-- Mensaje de éxito -->
    @if (session()->has('message'))
        <div class="bg-green-100 text-green-700 px-4 py-3 rounded mb-6">
            {{ session('message') }}
        </div>
    @endif

    <!-- Formulario para agregar correos -->
    <form wire:submit.prevent="agregarCorreo" class="mb-6">
        <div class="flex items-center space-x-4">
            <input type="email" wire:model="correo" placeholder="Ingrese un correo electrónico" required
                   class="flex-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                Agregar
            </button>
        </div>
        @error('correo') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
    </form>

    <!-- Tabla de correos -->
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-200">
            <thead>
                <tr>
                    <th class="px-4 py-2 border-b">Correo Electrónico</th>
                    <th class="px-4 py-2 border-b">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($correos as $correo)
                    <tr>
                        <td class="px-4 py-2 border-b">{{ $correo->correo }}</td>
                        <td class="px-4 py-2 border-b">
                            <button wire:click="eliminarCorreo({{ $correo->id }})" class="text-red-500 hover:text-red-700">
                                Eliminar
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Paginación -->
    <div class="mt-6">
        {{ $correos->links() }}
    </div>
</div>
