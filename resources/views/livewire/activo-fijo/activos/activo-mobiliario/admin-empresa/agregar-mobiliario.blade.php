@section('css')
<!--Select2-->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    .select2-container--default .select2-selection--single {
        border: 4px solid rgb(3, 168, 221);
        height: 47px;
        line-height: 28px;
        border-radius: 10px; /* Mejor ajuste */
    }

    .select2 {
        width: 100%;
    }
</style>
@endsection

@section('js')
<!-- Asegúrate de cargar primero jQuery y luego Select2 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Inicializa Select2 en los selects
        $('#sucursall').select2({
            width: '100%' // Asegúrate de que ocupe todo el ancho
        });

        // Cambios en el select
        $('#sucursall').on('change', function() {
            @this.set('activo.sucursal_id', this.value);
        });
    });
</script>
@endsection
<div class="h-screen overflow-y-auto">
    <div class="my-5">
        <!-- Título con degradado y sombra más pronunciada -->
        <div class="bg-gradient-to-r from-[#1763A6] to-[#1EA4D9] text-white font-bold text-xl py-4 px-6 rounded-t-lg shadow-lg">
            <h1 class="text-center text-2xl sm:text-3xl font-bold text-white">Registrar Mobiliario</h1>
        </div>

        <!-- Formulario con fondo blanco y sombra más pronunciada -->
        <div class="bg-white rounded-b-lg shadow-2xl p-6">
            <div class="my-2">
                <div class="py-2 my-2">
                    <label for="nombre" class="text-gray-700 font-bold text-xl">Sucursal</label>
                </div>
                <div wire:ignore>
                    <select id="sucursall" class="select2" wire:model="activo.sucursal_id">
                        <option>Selecciona la sucursal</option>
                        @foreach ($sucursales as $su)
                            <option value="{{ $su->id }}">{{ $su->nombre_sucursal }}</option>
                        @endforeach
                    </select>
                </div>
                <x-input-error for="activo.sucursal_id" />
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <!-- Nombre del Producto -->
                <div class="my-2">
                    <label for="nombre" class="text-gray-700 font-bold text-xl">Nombre del Producto</label>
                    <input type="text" wire:model="activo.nombre" class="block w-full border-2 px-2 py-2 text-sm sm:text-md rounded-md my-2 text-black" id="nombre" placeholder="Ingresa el nombre del activo">
                    @error('tipos.nombre') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
                
                <!-- Número de Serie -->
                <div class="my-2">
                    <label for="num_serie" class="text-gray-700 font-bold text-xl">Número de Serie</label>
                    <input type="text" wire:model="activo.num_serie" class="block w-full border-2 px-2 py-2 text-sm sm:text-md rounded-md my-2 text-black" id="num_serie" placeholder="Ingresa el número de serie">
                    @error('activo.num_serie') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
                
                <!-- Número de Activo -->
                <div class="my-2">
                    <label for="num_activo" class="text-gray-700 font-bold text-xl">Número de Activo</label>
                    <input type="text" wire:model="activo.num_activo" class="block w-full border-2 px-2 py-2 text-sm sm:text-md rounded-md my-2 text-black" id="num_activo" placeholder="Ingresa el número de activo">
                    @error('activo.num_activo') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
                
                <!-- Ubicación Física -->
                <div class="my-2">
                    <label for="ubicacion_fisica" class="text-gray-700 font-bold text-xl">Ubicación Física</label>
                    <input type="text" wire:model="activo.ubicacion_fisica" class="block w-full border-2 px-2 py-2 text-sm sm:text-md rounded-md my-2 text-black" id="ubicacion_fisica" placeholder="Ingresa la ubicación física">
                    @error('activo.ubicacion_fisica') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
                
                <!-- Fecha de Adquisición -->
                <div class="my-2">
                    <label for="fecha_adquisicion" class="text-gray-700 font-bold text-xl">Fecha de Adquisición</label>
                    <input type="date" wire:model="activo.fecha_adquisicion" class="block w-full border-2 px-2 py-2 text-sm sm:text-md rounded-md my-2 text-gray-500" id="fecha_adquisicion">
                    @error('activo.fecha_adquisicion') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
                
                <!-- Año estimado -->
                <div class="my-2">
                    <label for="anio" class="text-gray-700 font-bold text-xl">Año estimado</label>
                    <select wire:model="activo.aniosestimado_id" class="block w-full border-2 px-2 py-2 text-sm sm:text-md rounded-md my-2 text-gray-500" id="tipo">
                        <option value="">Seleccione el año estimado</option>
                        @foreach ($anios as $id => $nombre)
                            <option value="{{ $id }}">{{ $nombre }}</option>
                        @endforeach
                    </select>
                    @error('activo.aniosestimado_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
            
                
                <!-- Precio de Adquisición -->
                <div class="my-2 sm:col-span-2">
                    <label for="precio_adquisicion" class="text-gray-700 font-bold text-xl">Precio de Adquisición</label>
                    <input type="number" wire:model="activo.precio_adquisicion" class="block w-full border-2 px-2 py-2 text-sm sm:text-md rounded-md my-2 text-black" id="precio_adquisicion">
                    @error('activo.precio_adquisicion') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
                
                <!-- Descripción del Producto - Ocupa 2 Columnas -->
                <div class="my-2 sm:col-span-2">
                    <label for="descripcion" class="text-gray-700 font-bold text-xl">Descripción del Producto</label>
                    <textarea wire:model="activo.descripcion" class="block w-full border-2 px-2 py-2 text-sm sm:text-md rounded-md my-2 text-black" id="descripcion" placeholder="Ingresa la descripción del activo"></textarea>
                    @error('tipos.descripcion') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <!-- Carga de Imágenes -->
                <div class="my-2 sm:col-span-2">
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <!-- Imagen 1 -->
                        <div class="image-container">
                            <label class="mx-auto cursor-pointer flex w-full flex-col items-center rounded-xl border-2 border-dashed border-blue-400 bg-white p-6 text-center shadow-md">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                </svg>
                                <h2 class="mt-4 text-xl font-medium text-gray-700 tracking-wide">Imagen 1</h2>
                                <p class="mt-2 text-gray-500 tracking-wide">Carge su archivo PNG o JPG</p>
                                <input type="file" class="hidden" wire:model="subirfoto1" />
                                <br>
                                @if ($subirfoto1)
                                    <img src="{{ $subirfoto1->temporaryUrl() }}" width="100" height="100" alt="Imagen 1" />
                                @endif
                                <x-input-error for="subirfoto1" />
                            </label>
                        </div>

                        <!-- Imagen 2 -->
                        <div class="image-container">
                            <label class="mx-auto cursor-pointer flex w-full flex-col items-center rounded-xl border-2 border-dashed border-blue-400 bg-white p-6 text-center shadow-md">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                </svg>
                                <h2 class="mt-4 text-xl font-medium text-gray-700 tracking-wide">Imagen 2</h2>
                                <p class="mt-2 text-gray-500 tracking-wide">Carge su archivo PNG o JPG</p>
                                <input type="file" class="hidden" wire:model="subirfoto2" />
                                <br>
                                @if ($subirfoto2)
                                    <img src="{{ $subirfoto2->temporaryUrl() }}" width="100" height="100" alt="Imagen 2" />
                                @endif
                                <x-input-error for="subirfoto2" />
                            </label>
                        </div>

                        <!-- Imagen 3 -->
                        <div class="image-container">
                            <label class="mx-auto cursor-pointer flex w-full flex-col items-center rounded-xl border-2 border-dashed border-blue-400 bg-white p-6 text-center shadow-md">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                </svg>
                                <h2 class="mt-4 text-xl font-medium text-gray-700 tracking-wide">Imagen 3</h2>
                                <p class="mt-2 text-gray-500 tracking-wide">Carge su archivo PNG o JPG</p>
                                <input type="file" class="hidden" wire:model="subirfoto3" />
                                <br>
                                @if ($subirfoto3)
                                    <img src="{{ $subirfoto3->temporaryUrl() }}" width="100" height="100" alt="Imagen 3" />
                                @endif
                                <x-input-error for="subirfoto3" />
                            </label>
                        </div>

                        <!-- Imagen 4 -->
                        <div class="image-container">
                            <label class="mx-auto cursor-pointer flex w-full flex-col items-center rounded-xl border-2 border-dashed border-blue-400 bg-white p-6 text-center shadow-md">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                </svg>
                                <h2 class="mt-4 text-xl font-medium text-gray-700 tracking-wide">Imagen 4</h2>
                                <p class="mt-2 text-gray-500 tracking-wide">Carge su archivo PNG o JPG</p>
                                <input type="file" class="hidden" wire:model="subirfoto4" />
                                <br>
                                @if ($subirfoto4)
                                    <img src="{{ $subirfoto4->temporaryUrl() }}" width="100" height="100" alt="Imagen 4" />
                                @endif
                                <x-input-error for="subirfoto4" />
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Botón de Guardar -->
            <div class="flex justify-center mt-4">
                <button wire:click="saveActivoMob()" class="bg-gradient-to-r from-[#1763A6] to-[#1EA4D9] text-white px-6 py-2 rounded-lg shadow-lg font-bold hover:bg-[#1763A6]">Guardar</button>
            </div>
        </div>
    </div>
</div>
