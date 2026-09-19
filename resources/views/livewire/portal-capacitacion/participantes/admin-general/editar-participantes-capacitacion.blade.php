<div class="max-w-4xl mx-auto mt-8 mb-8 p-4 bg-white shadow-lg rounded-lg">
    <div class="relative flex flex-col min-w-0 break-words bg-gradient-to-r from-blue-500 to-indigo-600 rounded-t-2xl p-6 text-white text-center">
        <h2 class="text-3xl font-bold">📋 Editar Participantes</h2>
        <p class="text-2xl font-light mt-2"><strong>Capacitación:</strong> {{ $capacitacion->nombreCapacitacion }}</p>
        <p class="text-2xl font-light"><strong>Grupo: </strong>{{ $capacitacion->nombreGrupo }}</p>
    </div>

    @if (session()->has('message'))
        <div class="bg-green-100 text-green-700 p-3 rounded-md mb-4 text-center font-medium">
            {{ session('message') }}
        </div>
    @endif

    {{-- Estado general de la capacitación --}}
    <div class="mb-6">
        <label for="estadoCapacitacion" class="block text-lg font-semibold text-gray-700 mb-2 mt-5">Estado de la Capacitación:</label>
        <div class="flex items-center gap-4">
            <select id="estadoCapacitacion" wire:model="estadoCapacitacion"
                    class="border border-gray-300 rounded-lg p-3 w-56 focus:ring-2 focus:ring-blue-400">
                @foreach ($statusOptions as $status)
                    <option value="{{ $status }}">{{ ucfirst($status) }}</option>
                @endforeach
            </select>
            <button wire:click="actualizarEstadoCapacitacion"
                    class="bg-green-500 text-white px-6 py-3 rounded-lg shadow-md hover:bg-green-600 transition font-semibold">
                    Actualizar Estado
            </button>
        </div>
        
    </div>

    {{-- Tabla de Participantes --}}
    <div class="overflow-x-auto">
        <table class="w-full border-collapse rounded-lg overflow-hidden shadow-md">
            <thead>
                <tr class="bg-gradient-to-r from-indigo-500 to-blue-500 text-white text-lg">
                    <th class="p-4 text-left">👤 Nombre</th>
                    <th class="p-4 text-left">🧑‍💻 Tipo de usuario</th>
                    <th class="p-4 text-center">⚙️ Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($participantes as $participante)
                    <tr class="border-b border-gray-300 hover:bg-blue-50 transition">
                        <td class="p-4 text-gray-800 font-medium">{{ $participante->name }}</td>
                        <td class="p-4 text-gray-600">{{ $participante->tipo_user }}</td>
                        <td class="p-4 text-center">
                            <button wire:click="eliminarParticipante({{ $participante->participante_id }}, {{ $participante->user_id }})"
                                    class="bg-red-500 text-white px-4 py-2 rounded-lg shadow-md hover:bg-red-600 transition">
                                     Eliminar
                            </button>                        
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
