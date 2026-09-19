@section('css')
    <!--Select2-->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .select2-container--default .select2-selection--single {
            border: 4px solid rgb(3, 168, 221);
            height: 47px;
            line-height: 28px;
            border-radius: 10px;
            /* Mejor ajuste */
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
            function initializeSelect2() {
                $('#sucursall').select2({
                    placeholder: 'Selecciona la sucursal',
                    allowClear: true
                });

                // Obtener el valor de sucursal desde Blade y aplicarlo a Select2
                let selectedValue = @json($sucursal);

                if (selectedValue) {
                    $('#sucursall').val(selectedValue).trigger('change');
                }

                // Sincronizar Select2 con Livewire al cambiar la selección
                $('#sucursall').on('change', function() {
                    @this.set('sucursal', this.value);
                });
            }

            initializeSelect2();

            // Reaplicar Select2 y actualizar valor después de cada actualización de Livewire
            Livewire.hook('message.processed', (message, component) => {
                initializeSelect2();
            });
        });
    </script>
@endsection
<div>
    <div class="h-screen overflow-y-auto">
        <div class="my-5">
            <div
                class="bg-gradient-to-r from-[#1763A6] to-[#1EA4D9] text-white font-bold text-xl py-4 px-6 rounded-t-lg shadow-lg">
                <h1 class="text-center text-2xl sm:text-3xl font-bold text-white">Editar Tecnología</h1>
            </div>

            <div class="bg-white rounded-b-lg shadow-2xl p-6">
                <div class="my-2">
                    <div class="py-2 my-2">
                        <label for="nombre" class="text-gray-700 font-bold text-xl">Sucursal</label>
                    </div>
                    <div wire:ignore>
                        <select id="sucursall" class="select2" wire:model="sucursal">
                            <option value="">Selecciona la sucursal</option>
                            @foreach ($sucursales as $id => $nombre_sucursal)
                                <option value="{{ $id }}">{{ $nombre_sucursal }}</option>
                            @endforeach
                        </select>
                    </div>
                    <x-input-error for="sucursal" />
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="my-2">
                        <label for="nombre" class="text-gray-700 font-bold text-xl">Nombre del Producto</label>
                        <input type="text" wire:model="nombre"
                            class="block w-full border-2 px-2 py-2 text-sm sm:text-md rounded-md my-2 text-black"
                            id="nombre">
                    </div>

                    <div class="my-2">
                        <label for="numser" class="text-gray-700 font-bold text-xl">Número de Serie</label>
                        <input type="text" wire:model="numser"
                            class="block w-full border-2 px-2 py-2 text-sm sm:text-md rounded-md my-2 text-black"
                            id="numser">
                    </div>
                    <div class="my-2">
                        <label for="numact" class="text-gray-700 font-bold text-xl">Número de Activo</label>
                        <input type="text" wire:model="numact"
                            class="block w-full border-2 px-2 py-2 text-sm sm:text-md rounded-md my-2 text-black"
                            id="numact">
                    </div>
                    <div class="my-2">
                        <label for="ubicacion" class="text-gray-700 font-bold text-xl">Ubicación Física</label>
                        <input type="text" wire:model="ubicacion"
                            class="block w-full border-2 px-2 py-2 text-sm sm:text-md rounded-md my-2 text-black"
                            id="ubicacion">
                    </div>
                    <div class="my-2">
                        <label for="fechaad" class="text-gray-700 font-bold text-xl">Fecha de Adquisición</label>
                        <input type="date" wire:model="fechaad"
                            class="block w-full border-2 px-2 py-2 text-sm sm:text-md rounded-md my-2 text-gray-500"
                            id="fechaad">
                    </div>
                    <div class="my-2">
                        <label for="fechaba" class="text-gray-700 font-bold text-xl">Fecha de Baja</label>
                        <input type="date" wire:model="fechaba"
                            class="block w-full border-2 px-2 py-2 text-sm sm:text-md rounded-md my-2 text-gray-500"
                            id="fechaba">
                    </div>
                    <div class="my-2">
                        <label for="anio" class="text-gray-700 font-bold text-xl">Año Estimado</label>
                        <select wire:model="anio"
                            class="block w-full border-2 px-2 py-2 text-sm sm:text-md rounded-md my-2 text-gray-500"
                            id="anio">
                            <option value="">Seleccione el año estimado</option>
                            @foreach ($anios as $id => $nombre)
                                <option value="{{ $id }}">{{ $nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="my-2">
                        <label for="status" class="text-gray-700 font-bold text-xl">Estado</label>
                        <select wire:model="status" class="block w-full border-2 px-2 py-2 text-sm sm:text-md rounded-md my-2 text-gray-500" id="status">
                            <option value="Activo">Activo</option>
                            <option value="Baja">Baja</option>
                        </select>   
                    </div>

                    <div class="my-2 sm:col-span-2">
                        <label for="precioad" class="text-gray-700 font-bold text-xl">Precio de Adquisición</label>
                        <input type="number" wire:model="precioad"
                            class="block w-full border-2 px-2 py-2 text-sm sm:text-md rounded-md my-2 text-black"
                            id="precioad">
                    </div>
                    <div class="my-2 sm:col-span-2">
                        <label for="descripcion" class="text-gray-700 font-bold text-xl">Descripción</label>
                        <textarea wire:model="descripcion" class="block w-full border-2 px-2 py-2 text-sm sm:text-md rounded-md my-2 text-black"
                            id="descripcion"></textarea>
                    </div>
                    <div class="my-2 sm:col-span-2">
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                            <!-- Imagen 1 -->
                            <div class="image-container">
                                <label
                                    class="mx-auto cursor-pointer flex w-full flex-col items-center rounded-xl border-2 border-dashed border-blue-400 bg-white p-6 text-center shadow-md">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-blue-500"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                    </svg>
                                    <h2 class="mt-4 text-xl font-medium text-gray-700 tracking-wide">Imagen 1</h2>
                                    <p class="mt-2 text-gray-500 tracking-wide">Cargue su archivo PNG o JPG</p>
                                    <input type="file" class="hidden" wire:model="subirfoto1" />
                                    <br>
                                    @if ($subirfoto1)
                                        <img src="{{ $subirfoto1->temporaryUrl() }}" width="100" height="100"
                                            alt="Imagen 1" />
                                    @elseif ($foto1)
                                        <img src="{{ asset($foto1) }}" width="100" height="100"
                                            alt="Imagen 1" />
                                    @endif
                                    <x-input-error for="subirfoto1" />
                                </label>
                            </div>

                            <!-- Imagen 2 -->
                            <div class="image-container">
                                <label
                                    class="mx-auto cursor-pointer flex w-full flex-col items-center rounded-xl border-2 border-dashed border-blue-400 bg-white p-6 text-center shadow-md">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-blue-500"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                    </svg>
                                    <h2 class="mt-4 text-xl font-medium text-gray-700 tracking-wide">Imagen 2</h2>
                                    <p class="mt-2 text-gray-500 tracking-wide">Cargue su archivo PNG o JPG</p>
                                    <input type="file" class="hidden" wire:model="subirfoto2" />
                                    <br>
                                    @if ($subirfoto2)
                                        <img src="{{ $subirfoto2->temporaryUrl() }}" width="100" height="100"
                                            alt="Imagen 2" />
                                    @elseif ($foto2)
                                        <img src="{{ asset($foto2) }}" width="100" height="100"
                                            alt="Imagen 2" />
                                    @endif
                                    <x-input-error for="subirfoto2" />
                                </label>
                            </div>

                            <!-- Imagen 3 -->
                            <div class="image-container">
                                <label
                                    class="mx-auto cursor-pointer flex w-full flex-col items-center rounded-xl border-2 border-dashed border-blue-400 bg-white p-6 text-center shadow-md">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-blue-500"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                    </svg>
                                    <h2 class="mt-4 text-xl font-medium text-gray-700 tracking-wide">Imagen 3</h2>
                                    <p class="mt-2 text-gray-500 tracking-wide">Cargue su archivo PNG o JPG</p>
                                    <input type="file" class="hidden" wire:model="subirfoto3" />
                                    <br>
                                    @if ($subirfoto3)
                                        <img src="{{ $subirfoto3->temporaryUrl() }}" width="100" height="100"
                                            alt="Imagen 3" />
                                    @elseif ($foto3)
                                        <img src="{{ asset($foto3) }}" width="100" height="100"
                                            alt="Imagen 3" />
                                    @endif
                                    <x-input-error for="subirfoto3" />
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex justify-center mt-5">
                    <button wire:click="editar"
                        class="bg-gradient-to-r from-[#1763A6] to-[#1EA4D9] hover:bg-[#1763A6] text-white font-bold py-2 px-4 rounded-lg shadow-lg">Actualizar</button>
                </div>
            </div>
        </div>
    </div>
</div>
