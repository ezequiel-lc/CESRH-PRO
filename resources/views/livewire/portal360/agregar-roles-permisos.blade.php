<div>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h2 class="text-2xl font-bold mb-6">Agregar Nuevo Rol</h2>

                <form wire:submit.prevent="saveRol" class="space-y-6">
                    <!-- Campo de Nombre de Rol -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Nombre del Rol
                        </label>
                        <input 
                            type="text" 
                            wire:model="RolNombre" 
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                            placeholder="Ingrese el nombre del rol">
                        @error('RolNombre') 
                            <span class="text-red-500 text-sm">{{ $message }}</span> 
                        @enderror
                    </div>

                    <!-- Lista de Permisos -->
                    <div class="space-y-4">
                        <h3 class="text-lg font-medium text-gray-900">Permisos</h3>

                        @foreach($Consulta2 as $permiso)
                        <div class="flex items-center">
                            <input 
                                type="checkbox" 
                                wire:model="permisos" 
                                value="{{ $permiso->name }}"
                                class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                            <label class="ml-2 text-sm text-gray-700">{{ $permiso->name }}</label>
                        </div>
                        @endforeach

                        @error('permisos') 
                            <span class="text-red-500 text-sm">{{ $message }}</span> 
                        @enderror
                    </div>

                    <!-- Botones de Acción -->
                    <div class="flex justify-end space-x-3">
                        <a href="{{ route('portal360.mostrarRolesPermisos') }}"
                            class="px-4 py-2 bg-gray-300 rounded-md text-gray-700 hover:bg-gray-400">
                            Cancelar
                        </a>
                        <button type="submit"
                            class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                            Guardar Rol
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
