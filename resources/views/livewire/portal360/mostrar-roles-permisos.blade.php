<div>
    <div class="w-full mt-1 flex justify-end mr-5">
        <button wire:click="redirigirrolespermisos()" class="bg-blue-500 text-white font-bold py-2 px-4 rounded hover:bg-gray-600 mr-4 mt-2">
            Agregar Rol
        </button>
    </div>
    <section class="antialiased bg-gray-100 text-gray-600 mt-6 px-4">
        <div class="flex flex-col justify-center h-full">
            <div class="w-full mx-auto bg-white shadow-lg rounded-lg border border-gray-200">
                <header class="px-5 py-4 border-b border-gray-100 flex justify-between items-center">
                    <h2 class="font-semibold text-gray-800 text-xl">Roles y Permisos</h2>
                    <div class="relative w-64">
                        <input class="border border-gray-300 pl-10 pr-3 py-2 rounded-md w-full text-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            wire:model.live="search"
                            type="text"
                            placeholder="Buscar roles..." />
                        <div class="absolute left-3 inset-y-0 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                    </div>
                </header>
                <div class="p-3">
                    <div class="overflow-x-auto">
                        <table class="table-auto w-full border-collapse">
                            <thead class="text-xs font-semibold uppercase text-gray-500 bg-gray-50">
                                <tr>
                                    <th class="p-3 text-left">Nombre del Rol</th>
                                    <th class="p-3 text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="text-sm divide-y divide-gray-200">
                                @forelse($roles as $role)
                                <tr class="hover:bg-gray-200">
                                    <td class="p-3 text-black">{{ $role->name }}</td>
                                    <td class="p-3 text-center">
                                        <div class="flex justify-center gap-3">
                                            <button class="bg-blue-500 text-white py-1 px-3 rounded hover:bg-blue-700">
                                                Editar
                                            </button>
                                            <button class="bg-red-500 text-white py-1 px-3 rounded hover:bg-red-700">
                                                Eliminar
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="2" class="p-4 text-center text-gray-500">
                                        Sin resultados para "{{ $this->search }}"
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                        @if ($roles->count())
                        <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
                            {{ $roles->links() }}
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
