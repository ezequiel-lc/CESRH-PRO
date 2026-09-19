<div class="font-sans bg-gray-200 min-h-screen flex justify-center items-center p-4">
    <!-- Tarjetas azules de fondo -->
    <div class="relative w-full sm:w-3/4 md:w-2/3 lg:w-1/2">
        <div class="absolute inset-0 transform -rotate-6 bg-blue-200 shadow-lg rounded-2xl"></div>
        <div class="absolute inset-0 transform rotate-6 bg-blue-600 shadow-lg rounded-2xl"></div>

        <div class="relative bg-white p-8 rounded-2xl shadow-lg flex flex-col items-center">
            <!-- Botón de cierre -->
            <div class="self-end">
                <button onclick="window.location.href='{{ route('mostrarRelacionesInternas') }}'"
                    class="text-gray-700 hover:text-red-500 transition-all duration-300 transform hover:scale-110">
                    <i class="fa-solid fa-circle-xmark text-3xl"></i>
                </button>
            </div>

            <!-- Título -->
            <h1 class="text-2xl mt-2 sm:text-3xl font-extrabold text-gray-800 text-center uppercase tracking-wide
                bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 text-transparent bg-clip-text drop-shadow-md pb-4 border-b-4 border-blue-400">
                Agregar Relaciones Internas
            </h1>
            <div class="w-full mt-6">
                <div class="relative p-6 rounded-2xl shadow-md w-full">
                    <form class="space-y-5" wire:submit.prevent="agregarInterna">
                        <!-- Selección de Empresa -->
                        <div>
                            <label class="block text-gray-700 font-medium">Empresa</label>
                            <select wire:model.live="empresa_id"
                                class="mt-1 block w-full h-12 rounded-xl shadow-md px-4 focus:ring-2 focus:ring-blue-400">
                                <option value="">Seleccione una empresa</option>
                                @foreach ($empresas as $empresa)
                                    <option value="{{ $empresa->id }}">{{ $empresa->nombre }}</option>
                                @endforeach
                            </select>
                            @error('empresa_id')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Selección de Sucursal -->
                        <div>
                            <label class="block text-gray-700 font-medium">Sucursal</label>
                            <select wire:model.live="sucursal_id"
                                class="mt-1 block w-full h-12 rounded-xl shadow-md px-4 focus:ring-2 focus:ring-blue-400">
                                <option value="">Seleccione una sucursal</option>
                                @foreach ($sucursales as $sucursal)
                                    <option value="{{ $sucursal->id }}">{{ $sucursal->nombre_sucursal }}</option>
                                @endforeach
                            </select>
                            @error('sucursal_id')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Puesto -->
                        <div>
                            <label class="block text-gray-700 font-medium">Puesto</label>
                            <input type="text" wire:model="interna.puesto"
                                class="mt-1 block w-full h-12 rounded-xl shadow-md px-4 focus:ring-2 focus:ring-blue-400">
                            @error('interna.puesto')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Razón o Motivo -->
                        <div>
                            <label class="block text-gray-700 font-medium">Razón o Motivo</label>
                            <textarea wire:model="interna.razon_motivo"
                                class="mt-1 block w-full h-24 rounded-xl shadow-md px-4 py-2 focus:ring-2 focus:ring-blue-400 resize-none"></textarea>
                            @error('interna.razon_motivo')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Nivel -->
                        <div>
                            <label class="block text-gray-700 font-medium">Nivel</label>
                            <select wire:model="interna.frecuencia"
                                class="w-full px-4 py-3 rounded-xl shadow-md text-gray-700 focus:ring-2 focus:ring-blue-500">
                                <option value="">Seleccionar</option>
                                <option value="Alta">Alta</option>
                                <option value="Media">Media</option>
                                <option value="Baja">Baja</option>
                            </select>
                            @error('interna.frecuencia')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="pt-4">
                            <button type="submit"
                                class="bg-blue-500 w-full py-3 rounded-xl text-white font-semibold shadow-md 
                                hover:bg-blue-600 focus:outline-none transition duration-300 transform hover:scale-105">
                                Guardar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @if (session()->has('message'))
        <div class="fixed top-5 right-5 bg-green-600 text-white text-lg px-6 py-3 rounded-lg shadow-lg transition-opacity duration-500"
            style="z-index: 1000;" x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show">
            ✅ {{ session('message') }}
        </div>
    @endif
</div>
