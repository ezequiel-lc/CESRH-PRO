<div>
    <div class="w-full max-w-4xl mx-auto bg-white shadow-lg rounded-sm border border-gray-200 p-8">
        <header class="px-5 py-4 border-b border-gray-100">
            <h2 class="font-semibold text-gray-800 text-xl">Editar Cliente</h2>
        </header>

        <div class="space-y-6 p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Nombre -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Nombre</label>
                    <input type="text"
                        wire:model="nombre"
                        class="mt-1 block px-2.5 pb-2.5 pt-2 w-[780px] block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    @error('nombre')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="flex justify-end space-x-4">
                <a href="{{ route('portal360.relaciones.relaciones-sucursal.mostrar-relaciones-sucursales') }}"
                    class="bg-gray-500 text-white font-bold py-2 px-4 rounded hover:bg-gray-600">
                    Cancelar
                </a>
                <button wire:click.prevent="editarRelacionesSucursales"
                    class="bg-blue-700 text-white font-bold py-2 px-4 rounded hover:bg-blue-600">
                    Actualizar Relaciones
                </button>
            </div>
        </div>
    </div>
</div>