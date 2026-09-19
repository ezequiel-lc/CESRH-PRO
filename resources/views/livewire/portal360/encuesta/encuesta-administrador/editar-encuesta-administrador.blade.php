<div>
    <div class="w-full max-w-4xl mx-auto bg-white shadow-lg rounded-sm border border-gray-200 p-8">
        <header class="px-5 py-4 border-b border-gray-100">
            <h2 class="font-semibold text-gray-800 text-xl">Editar Encuesta</h2>
        </header>

        <!-- Formulario -->
        <div class="space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Empresa -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Empresa</label>
                    <select
                        wire:model.live="encuesta.empresa_id"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        <option value="">Seleccione una empresa</option>
                        @foreach($empresas as $empresa)
                            <option value="{{ $empresa->id }}">{{ $empresa->nombre }}</option>
                        @endforeach
                    </select>
                    @error('encuesta.empresa_id')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Sucursal -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Sucursal</label>
                    <select
                        wire:model="encuesta.sucursal_id"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                        @if(!$encuesta['empresa_id']) disabled @endif>
                        <option value="">Seleccione una sucursal</option>
                        @foreach($sucursales as $sucursal)
                            <option value="{{ $sucursal->id }}">{{ $sucursal->nombre_sucursal }}</option>
                        @endforeach
                    </select>
                    @error('encuesta.sucursal_id')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Nombre -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Nombre</label>
                    <input type="text"
                        wire:model="encuesta.nombre"
                        class="mt-1 block px-2.5 pb-2.5 pt-2 w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    @error('encuesta.nombre')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Descripción -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Descripción</label>
                    <textarea 
                        wire:model="encuesta.descripcion"
                        class="mt-1 block px-2.5 pb-2.5 pt-2 w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"></textarea>
                    @error('encuesta.descripcion')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Indicaciones -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Indicaciones</label>
                    <textarea 
                        wire:model="encuesta.indicaciones"
                        class="mt-1 block px-2.5 pb-2.5 pt-2 w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"></textarea>
                    @error('encuesta.indicaciones')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Botones -->
            <div class="flex justify-end gap-2 mt-4">
                <a
                    href="{{ route('portal360.encuesta.encuesta-administrador.mostrar-encuesta-administrador') }}"
                    class="bg-gray-500 text-white font-bold py-2 px-4 rounded hover:bg-gray-600">
                    Cancelar
                </a>
                <button 
                    wire:click.prevent="saveEncuestaAdministrador"
                    class="bg-blue-700 text-white font-bold py-2 px-4 rounded hover:bg-blue-600">
                    Guardar Encuesta
                </button>
            </div>
        </div>
    </div>
</div>
