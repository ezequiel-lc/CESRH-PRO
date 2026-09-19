<div class="font-sans bg-gray-200 min-h-screen flex justify-center items-center p-4">
    <div class="relative w-full sm:w-3/4 md:w-2/3 lg:w-1/2">
        <!-- Contenedor principal sin rotación excesiva -->
        <div class="relative bg-white p-6 rounded-lg shadow-lg">
            <!-- Botón de cierre -->
            <div class="flex justify-end">
                <button onclick="window.location.href='{{ route('verCursos') }}'"
                    class="text-gray-600 hover:text-red-500 transition-transform transform hover:scale-110">
                    <i class="fa-solid fa-circle-xmark text-2xl"></i>
                </button>
            </div>

            <!-- Título -->
            <h1 class="text-xl sm:text-2xl font-extrabold text-gray-800 text-center uppercase tracking-wide
                bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 text-transparent bg-clip-text pb-3 border-b-2 border-blue-400">
                Editar Curso
            </h1>

            <form class="mt-5 space-y-4" wire:submit.prevent="store">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <!-- Selección de Empresa -->
                    <div>
                        <label class="block text-gray-700 font-medium">Empresa</label>
                        <select wire:model.live="empresa_id"
                            class="mt-1 block w-full h-10 rounded-lg shadow-sm px-3 focus:ring-2 focus:ring-blue-400">
                            <option value="">Seleccione</option>
                            @foreach($empresas as $empresa)
                                <option value="{{ $empresa->id }}">{{ $empresa->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Selección de Sucursal -->
                    <div>
                        <label class="block text-gray-700 font-medium">Sucursal</label>
                        <select wire:model.live="sucursal_id"
                            class="mt-1 block w-full h-10 rounded-lg shadow-sm px-3 focus:ring-2 focus:ring-blue-400">
                            <option value="">Seleccione</option>
                            @foreach($sucursales as $sucursal)
                                <option value="{{ $sucursal->id }}">{{ $sucursal->nombre_sucursal }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Nombre de la Función -->
                    <div class="col-span-2">
                        <label class="block text-gray-700 font-medium">Nombre del Curso</label>
                        <input type="text" wire:model="nombre"
                            placeholder="Nombre del curso"
                            class="mt-1 block w-full h-10 rounded-lg shadow-sm px-3 focus:ring-2 focus:ring-blue-400">
                    </div>

                    <!-- Horas -->
                    <div>
                        <label class="block text-gray-700 font-medium">Horas</label>
                        <input type="text" wire:model="horas"
                            placeholder="Horas"
                            class="mt-1 block w-full h-10 rounded-lg shadow-sm px-3 focus:ring-2 focus:ring-blue-400">
                    </div>

                    <!-- Precio -->
                    <div>
                        <label class="block text-gray-700 font-medium">Precio</label>
                        <input type="text" wire:model="precio"
                            placeholder="Precio"
                            class="mt-1 block w-full h-10 rounded-lg shadow-sm px-3 focus:ring-2 focus:ring-blue-400">
                    </div>

                    <!-- Status -->
                    <div>
                        <label class="block text-gray-700 font-medium">Status</label>
                        <select wire:model="tipoestatus"
                            class="mt-1 block w-full h-10 rounded-lg shadow-sm px-3 focus:ring-2 focus:ring-blue-400">
                            <option value="">Seleccione</option>
                            <option value="activo">Activo</option>
                            <option value="inactivo">Inactivo</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium">Temática</label>
                        <select wire:model.live="tematicas_id"
                            class="mt-1 block w-full h-12 rounded-lg shadow-sm px-4 focus:ring-2 focus:ring-blue-500 transition duration-300 ease-in-out transform hover:scale-105">
                            <option value="">Seleccione</option>
                            @foreach($tematicas as $tematica)
                                <option value="{{ $tematica->id }}">{{ $tematica->nombre }}</option>
                            @endforeach
                        </select>
                        @error('tematica_id')
                            <span class="text-red-500 text-sm">{{ $message }}</span> 
                        @enderror
                    </div>

                    <!-- Modalidad -->
                    <div class="col-span-2">
                        <label class="block text-gray-700 font-medium">Modalidad</label>
                        <select wire:model="modalidad" 
                            class="mt-1 block w-full h-10 rounded-lg shadow-sm px-3 focus:ring-2 focus:ring-blue-400">
                            <option value="">Seleccione</option>
                            <option value="Presencial">Presencial</option>
                            <option value="Virtual">Virtual</option>
                            <option value="Mixta">Mixta</option>
                            <option value="Otro">Otro</option>
                        </select>
                    </div>
                    
                </div>

                <!-- Botón Guardar -->
                <div class="pt-4">
                    <button type="submit"
                        class="bg-blue-500 w-full py-3 rounded-lg text-white font-semibold shadow-md 
                        hover:bg-blue-600 focus:outline-none transition duration-300 transform hover:scale-105">
                        Guardar
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Notificación de éxito -->
    @if (session()->has('message'))
        <div class="fixed top-5 right-5 bg-green-600 text-white text-lg px-6 py-3 rounded-lg shadow-lg transition-opacity duration-500"
            style="z-index: 1000;"
            x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show">
            ✅ {{ session('message') }}
        </div>
    @endif
</div>
