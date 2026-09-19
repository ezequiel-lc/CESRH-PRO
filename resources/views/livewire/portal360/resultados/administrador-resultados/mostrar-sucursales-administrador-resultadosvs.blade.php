<div class="p-6 ml-4">
    

    @if($empresaSucursal)
    <div class="bg-white p-6 rounded-lg shadow-lg">
    <h2 class="text-2xl font-bold mb-4">Detalles de la Sucursal</h2>
        <table class="w-full border-collapse">
            <thead>
                <tr class="bg-blue-600 text-white">
                    <th class="px-4 py-3 text-left">Campo</th>
                    <th class="px-4 py-3 text-left">Valor</th>
                    <th class="px-4 py-3 text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <tr class="border-b hover:bg-gray-100">
                    <td class="px-4 py-3 font-semibold">Nombre de la Sucursal</td>
                    <td class="px-4 py-3">{{ $empresaSucursal->sucursal->nombre_sucursal }}</td>
                    <td class="px-4 py-3 text-center">
                        <div class="flex justify-center space-x-2">
                            <button wire:click="resultadosGenerales" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg shadow">
                                Resultados Generales
                            </button>
                            <button wire:click="resultadosGeneralesPorUsuario" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg shadow">
                                Resultados Generales por Usuario
                            </button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    @else
    <p class="text-red-500">No se encontraron datos para esta sucursal.</p>
    @endif

    <!-- Añadir la tabla PowerGrid cuando mostrarTablaUsuarios sea true -->
    @if($mostrarTablaUsuarios)
    <div class="mt-6 bg-white p-6 rounded-lg shadow-lg ml-2 mr-4">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-xl font-bold">Resultados Generales por Usuario</h3>
            <button wire:click="ocultarTabla" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded-lg shadow">
                Cerrar
            </button>
        </div>

        <livewire:portal360.envaluaciones.ver-resultados-por-usuario-admin.ver-resultados-usuario-table :sucursalId="$SucursalId" />
    </div>
    @endif

    @if($mostrarTablaGenerales)
    <div class="mt-6 bg-white p-6 rounded-lg shadow-lg ml-2 mr-4">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-xl font-bold">Resultados Generales</h3>
            <button wire:click="ocultarTabla" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded-lg shadow">
                Cerrar
            </button>
        </div>

        <livewire:portal360.envaluaciones.envaluacion-administrador.ver-resultados-generales-adminis :sucursalId="$SucursalId" />
    </div>
    @endif
</div>