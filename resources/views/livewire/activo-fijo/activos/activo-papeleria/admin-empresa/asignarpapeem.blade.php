@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .select2-container--default .select2-selection--single {
            border: 4px solid rgb(3, 168, 221);
            height: 47px;
            line-height: 28px;
            border-radius: 10px;
        }
        .select2 { width: 100%; }
    </style>
@endsection

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            $('#sucursall').select2({ width: '100%' });
            $('#sucursall').on('change', function() {
                @this.set('sucursal_id', this.value);
            });
        });
    </script>
@endsection

<div>
    <div class="h-screen overflow-y-auto">
        <div class="my-5">
            <div class="bg-gradient-to-r from-[#1763A6] to-[#1EA4D9] text-white font-bold text-xl py-4 px-6 rounded-t-lg shadow-lg">
                <h1 class="text-center text-2xl sm:text-3xl font-bold text-white">Asignar Activo Papeleria</h1>
            </div>
            <div class="bg-white rounded-b-lg p-4">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <!-- Empresa (solo lectura) -->
                    <div class="my-2">
                        <div class="py-2 my-2">
                            <label class="text-gray-700 font-bold text-xl">Empresa</label>
                        </div>
                        <input type="text" class="block w-full border-2 px-2 py-2 text-sm sm:text-md rounded-md my-2 text-black" 
                               value="{{ $empresa->nombre }}" readonly>
                    </div>

                    <!-- Select de Sucursal -->
                    <div class="my-2">
                        <div class="py-2 my-2">
                            <label for="sucursall" class="text-gray-700 font-bold text-xl">Sucursal</label>
                        </div>
                        <select id="sucursall" class="block w-full border-2 px-2 py-2 text-sm sm:text-md rounded-md my-2 text-black"
                                wire:model="sucursal_id">
                            <option value="">Selecciona la sucursal</option>
                            @foreach ($sucursalesFiltradas as $su)
                                <option value="{{ $su->id }}">{{ $su->nombre_sucursal }}</option>
                            @endforeach
                        </select>
                        <x-input-error for="sucursal_id" />
                    </div>

                    <!-- Select de Activo Tecnológico -->
                    <div class="my-2">
                        <div class="py-2 my-2">
                            <label for="activo" class="text-gray-700 font-bold text-xl">Activo Papeleria</label>
                        </div>
                        <select wire:model.live="activoSeleccionado" class="block w-full border-2 px-2 py-2 text-sm sm:text-md rounded-md my-2 text-black">
                            <option value="">Seleccione un activo</option>
                            @foreach ($activosFiltrados as $activo)
                                <option value="{{ $activo->id }}">{{ $activo->nombre }}</option>
                            @endforeach
                        </select>
                        <x-input-error for="activoSeleccionado" />
                    </div>

                    <!-- Select de Usuario -->
                    <div class="my-2">
                        <div class="py-2 my-2">
                            <label for="usuario" class="text-gray-700 font-bold text-xl">Usuario</label>
                        </div>
                        <select wire:model.live="usuarioSeleccionado" id="usuario" class="block w-full border-2 px-2 py-2 text-sm sm:text-md rounded-md my-2 text-black">
                            <option value="">Seleccione un usuario</option>
                            @foreach ($usuariosFiltrados as $usuario)
                                <option value="{{ $usuario->id }}">{{ $usuario->name }}</option>
                            @endforeach
                        </select>
                        <x-input-error for="usuarioSeleccionado" />
                    </div>

                    <!-- Campo para observaciones -->
                    <div class="my-2 sm:col-span-2 pb-2 pt-3">
                        <div class="py-2 my-2">
                            <label for="observaciones" class="text-gray-700 font-bold text-xl">Observaciones</label>
                        </div>
                        <input type="text" id="observaciones" wire:model="observaciones"
                               class="block w-full border-2 px-2 py-2 text-sm sm:text-md rounded-md my-2 text-black">
                        <x-input-error for="observaciones" />
                    </div>
                </div>

                <!-- Botón de Guardar -->
                <div class="flex justify-center mt-4 py-3">
                    <button wire:click="asignarActivo"
                        class="bg-gradient-to-r from-[#1763A6] to-[#1EA4D9] text-white px-6 py-2 rounded-lg shadow-lg font-bold hover:bg-[#1763A6]">Asignar</button>
                </div>
            </div>
        </div>
    </div>
</div>

