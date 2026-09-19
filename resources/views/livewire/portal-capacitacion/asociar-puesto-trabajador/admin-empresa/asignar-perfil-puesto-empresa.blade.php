<div class="max-w-lg mx-auto bg-white shadow-xl rounded-2xl p-8 mt-12">
    <h2 class="text-3xl font-bold text-center text-gray-800 mb-6">Asignar Perfil de Puesto</h2>

    <!-- Datos del Usuario -->
    <div class="flex flex-col items-center mb-6">
        <img src="https://ui-avatars.com/api/?name={{ urlencode($usuario->name ?? 'Usuario') }}&background=random" 
             alt="Foto de {{ $usuario->name ?? 'Usuario' }}" 
             class="w-24 h-24 rounded-full shadow-md">
        <p class="text-lg font-semibold mt-3 text-gray-800">{{ $usuario->name ?? 'Sin nombre' }}</p>
        <p class="text-gray-500 text-sm">{{ $usuario->email ?? 'Sin email' }}</p>
    </div>

    <!-- Selector de Perfiles -->
    <label class="block text-gray-700 font-semibold mb-2">Selecciona Perfil(es):</label>
    <select wire:model="perfilSeleccionado" 
            class="w-full px-4 py-2 border border-gray-300 rounded-lg text-gray-700 bg-white shadow-sm focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition">
        <option value="">Selecciona un Perfil de Puesto</option>
        @foreach($perfiles as $perfil)
            <option value="{{ $perfil->id }}">{{ $perfil->nombre_puesto }}</option>
        @endforeach
    </select>

    <!-- Selector de Estado -->
    <label class="block text-gray-700 font-semibold mt-4">Estado:</label>
    <select wire:model="status" 
            class="w-full px-4 py-2 border border-gray-300 rounded-lg text-gray-700 bg-white shadow-sm focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition">
        <option value="">Selecciona un estado</option>    
        <option value="1">Activo</option>
        <option value="0">Inactivo</option>
    </select>

    <!-- Fechas -->
    <label class="block text-gray-700 font-semibold mt-4">Fecha de Inicio:</label>
    <input type="date" wire:model="fecha_inicio" 
           class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition">

    <label class="block text-gray-700 font-semibold mt-4">Fecha de Fin:</label>
    <input type="date" wire:model="fecha_final" 
           class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition">

    <!-- Motivo de Cambio -->
    <label class="block text-gray-700 font-semibold mt-4">Motivo de Cambio:</label>
    <input type="text" wire:model="motivo_cambio" 
           class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition">
    
    <!-- Botones de Acción -->
    <div class="mt-6 flex justify-between">
        <button wire:click="asignarPerfil"
                class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg transition transform hover:scale-105">
            Asignar
        </button>
        <button onclick="window.history.back()"
                class="bg-gray-400 hover:bg-gray-500 text-white font-bold py-2 px-6 rounded-lg transition transform hover:scale-105">
            Cancelar
        </button>
    </div>

    @if (session()->has('success') || session()->has('error'))
    <div class="fixed top-5 right-5 bg-green-600 text-white text-lg px-6 py-3 rounded-lg shadow-lg transition-opacity duration-500"
        style="z-index: 1000;"
        x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show">

        @if (session()->has('success'))
            ✅ {{ session('success') }}
        @endif

        @if (session()->has('error'))
            ❌ {{ session('error') }}
        @endif
    </div>
    @endif
</div>
