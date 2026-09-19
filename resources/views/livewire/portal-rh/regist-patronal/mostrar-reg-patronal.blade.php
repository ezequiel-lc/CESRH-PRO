<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold text-gray-800">Gestión de Registros Patronales</h1>
        <button wire:click="redirigir" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded">
            Agregar Registro Patronal
        </button>
    </div>

    <div class="bg-white shadow-md rounded-lg p-4">
        <div class="flex flex-wrap items-center justify-between gap-4 mb-4">
            <div class="flex-1">
                <label for="search" class="sr-only">Buscar</label>
                <input type="text" wire:model="search" id="search"
                    class="w-full bg-gray-50 border border-gray-300 text-gray-800 text-sm rounded-lg p-2.5"
                    placeholder="Buscar por registro, razón social o RFC...">
            </div>
            <div>
                <label for="porpagina" class="sr-only">Resultados por página</label>
                <select wire:model="porpagina" id="porpagina"
                    class="bg-gray-50 border border-gray-300 text-gray-800 text-sm rounded-lg p-2.5">
                    <option value="5">5 por página</option>
                    <option value="10">10 por página</option>
                    <option value="15">15 por página</option>
                    <option value="20">20 por página</option>
                </select>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="table-auto w-full border-collapse">
                <thead class="bg-gray-50 text-gray-600 text-sm font-medium uppercase border-b border-gray-200">
                    <tr>
                        <th class="p-3 text-left">Registro Patronal</th>
                        <th class="p-3 text-left">RFC</th>
                        <th class="p-3 text-left">Razón Social</th>
                        <th class="p-3 text-left">Regimen Fiscal</th>
                        <th class="p-3 text-center">Teléfono</th>
                        <th class="p-3 text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 text-sm">
                    @forelse ($registros as $registro)
                        <tr>
                            <td class="p-3">{{ $registro->registro_patronal }}</td>
                            <td class="p-3">{{ $registro->rfc }}</td>
                            <td class="p-3">{{ $registro->nombre_o_razon_social }}</td>
                            <td class="p-3">{{ $registro->regimen_fiscal }}</td>
                            <td class="p-3 text-center">{{ $registro->imms_telefono }}</td>
                            <td class="p-3 text-center">

                                <button wire:click="eliminar({{ $registro->id }})"
                                    class="text-red-600 hover:text-red-800 ml-4">Eliminar</button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="p-4 text-center text-gray-500">
                                Sin resultados para la búsqueda "{{ $this->search }}"
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($registros->count())
            <div class="mt-4">
                {{ $registros->links() }}
            </div>
        @endif
    </div>
</div>
