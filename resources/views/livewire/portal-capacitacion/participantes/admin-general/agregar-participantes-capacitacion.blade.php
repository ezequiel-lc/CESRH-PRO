<div class="w-full max-w-6xl mx-auto px-5 mb-8">
    <div class="relative flex flex-col break-words min-w-0 bg-clip-border rounded-2xl bg-white shadow-xl m-5 border border-gray-300">
        <div class="relative flex flex-col min-w-0 break-words bg-gradient-to-r from-blue-500 to-indigo-600 rounded-t-2xl p-6 text-white text-center">
            <h2 class="text-3xl font-bold">📋 Agregar Participantes</h2>
            <p class="text-2xl font-light mt-2"><strong>Capacitación:</strong> {{ $capacitacion->nombreCapacitacion }}</p>
            <p class="text-2xl font-light"><strong>Grupo: </strong>{{ $capacitacion->nombreGrupo }}</p>
        </div>

        <div class="flex-auto block py-8 pt-6 px-6">
            <div class="overflow-x-auto">
                <table class="w-full my-0 align-middle text-dark border-neutral-200 text-lg">
                    <thead class="align-bottom bg-gray-200 text-gray-700">
                        <tr class="font-semibold text-lg">
                            <th class="py-4 px-6 text-center">✅ Seleccionar</th>
                            <th class="py-4 px-6 text-start">👤 Nombre</th>
                            <th class="py-4 px-6 text-start">🧑‍💻 Tipo de usuario</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($usuarios as $usuario)
                            <tr class="border-b border-gray-300 hover:bg-blue-50 transition">
                                <td class="py-4 px-6 text-center">
                                    <input type="checkbox" wire:click="toggleSeleccion({{ $usuario->id }})"
                                        class="h-6 w-6 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                                        @if(in_array($usuario->id, $usuariosSeleccionados)) checked @endif>
                                </td>
                                <td class="py-4 px-6 text-gray-800">
                                    {{ $usuario->name }}
                                </td>
                                <td class="py-4 px-6 text-gray-600">
                                    {{ $usuario->tipo_user }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        
        @if (session()->has('message'))
            <div class="bg-green-100 text-green-700 p-4 rounded-md mx-6 mt-4 text-center">
                {{ session('message') }}
            </div>
        @endif

        <div class="flex justify-end gap-4 px-6 pb-6">
            <button wire:click="guardarParticipantes"
                class="bg-gradient-to-r bg-green-600 px-8 py-3 rounded-xl shadow-md hover:bg-green-700 transition text-lg font-semibold">
                Guardar Participantes
            </button>
            <button onclick="window.location.href='{{ route('verCapacitacionesGru')}}'"
                class="px-8 py-3 bg-red-500 text-white font-semibold rounded-xl shadow-md hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-400 transition text-lg">
                Cancelar
            </button>
        </div>
        
          
    </div>
</div>
