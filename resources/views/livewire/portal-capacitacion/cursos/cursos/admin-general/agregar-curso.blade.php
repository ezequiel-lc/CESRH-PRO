<div class="font-sans to-blue-100 min-h-screen flex justify-center items-center p-6">
    <div class="relative w-full sm:w-3/4 md:w-2/3 lg:w-1/2">
        <!-- Contenedor principal con bordes suavizados y sombras -->
        <div class="relative bg-white p-6 rounded-xl shadow-xl transition-all transform hover:scale-105 hover:shadow-2xl duration-300 ease-in-out">
            <!-- Botón de cierre con efecto hover -->
            <div class="flex justify-end">
                <button onclick="window.location.href='{{ route('verCursos') }}'"
                    class="text-gray-600 hover:text-red-500 transition-all transform hover:scale-110 hover:rotate-12 duration-300">
                    <i class="fa-solid fa-circle-xmark text-2xl"></i>
                </button>
            </div>

            <!-- Título con degradado y animación -->
            <h1 class="text-xl sm:text-2xl font-extrabold text-gray-800 text-center uppercase tracking-wider
                bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 text-transparent bg-clip-text pb-3 border-b-2 border-blue-400 animate-pulse">
                Agregar Cursos
            </h1>

            <form class="mt-5 space-y-6" wire:submit.prevent="agregarCurso">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <!-- Selección de Empresa con animación de cambio -->
                    <div>
                        <label class="block text-gray-700 font-medium">Empresa</label>
                        <select wire:model.live="empresa_id"
                            class="mt-1 block w-full h-12 rounded-lg shadow-sm px-4 focus:ring-2 focus:ring-blue-500 transition duration-300 ease-in-out transform hover:scale-105">
                            <option value="">Seleccione</option>
                            @foreach($empresas as $empresa)
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
                            class="mt-1 block w-full h-12 rounded-lg shadow-sm px-4 focus:ring-2 focus:ring-blue-500 transition duration-300 ease-in-out transform hover:scale-105">
                            <option value="">Seleccione</option>
                            @foreach($sucursales as $sucursal)
                                <option value="{{ $sucursal->id }}">{{ $sucursal->nombre_sucursal }}</option>
                            @endforeach
                        </select>
                        @error('sucursal_id')
                            <span class="text-red-500 text-sm">{{ $message }}</span> 
                        @enderror
                    </div>

                    <!-- Nombre del Curso -->
                    <div class="col-span-2">
                        <label class="block text-gray-700 font-medium">Nombre del Curso</label>
                        <input type="text" wire:model="curso.nombre"
                            placeholder="Nombre del curso"
                            class="mt-1 block w-full h-12 rounded-lg shadow-sm px-4 focus:ring-2 focus:ring-blue-500 transition duration-300 ease-in-out transform hover:scale-105">
                        @error('curso.nombre')
                            <span class="text-red-500 text-sm">{{ $message }}</span> 
                        @enderror
                    </div>

                    <!-- Horas -->
                    <div>
                        <label class="block text-gray-700 font-medium">Horas</label>
                        <input type="text" wire:model="curso.horas"
                            placeholder="Horas"
                            class="mt-1 block w-full h-12 rounded-lg shadow-sm px-4 focus:ring-2 focus:ring-blue-500 transition duration-300 ease-in-out transform hover:scale-105">
                        @error('curso.horas')
                            <span class="text-red-500 text-sm">{{ $message }}</span> 
                        @enderror
                    </div>

                    <!-- Precio -->
                    <div>
                        <label class="block text-gray-700 font-medium">Precio</label>
                        <input type="text" wire:model="curso.precio"
                            placeholder="Precio"
                            class="mt-1 block w-full h-12 rounded-lg shadow-sm px-4 focus:ring-2 focus:ring-blue-500 transition duration-300 ease-in-out transform hover:scale-105">
                        @error('curso.precio')
                            <span class="text-red-500 text-sm">{{ $message }}</span> 
                        @enderror
                    </div>

                    <!-- Status -->
                    <div>
                        <label class="block text-gray-700 font-medium">Status</label>
                        <select wire:model="curso.tipoestatus"
                            class="mt-1 block w-full h-12 rounded-lg shadow-sm px-4 focus:ring-2 focus:ring-blue-500 transition duration-300 ease-in-out transform hover:scale-105">
                            <option value="">Seleccione</option>
                            <option value="activo">Activo</option>
                            <option value="inactivo">Inactivo</option>
                        </select>
                        @error('curso.tipoestatus')
                            <span class="text-red-500 text-sm">{{ $message }}</span> 
                        @enderror
                    </div>

                    <!-- Temática -->
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
                        <select wire:model.live="curso.modalidad" 
                            class="mt-1 block w-full h-12 rounded-lg shadow-sm px-4 focus:ring-2 focus:ring-blue-500 transition duration-300 ease-in-out transform hover:scale-105">
                            <option value="">Seleccione</option>
                            <option value="Presencial">Presencial</option>
                            <option value="Virtual">Virtual</option>
                            <option value="Mixta">Mixta</option>
                        </select>
                        @error('curso.modalidad')
                            <span class="text-red-500 text-sm">{{ $message }}</span> 
                        @enderror
                    </div>
                    
                </div>

                <!-- Botón Guardar con animación -->
                <div class="pt-6">
                    <button type="submit"
                        class="bg-blue-500 w-full py-3 rounded-lg text-white font-semibold shadow-md 
                        hover:bg-blue-600 focus:outline-none transition duration-300 transform hover:scale-110">
                        Guardar
                    </button>
                </div>
            </form>
        </div>
    </div>

    
</div>
