<div>
    <div class="flex min-h-screen items-center justify-center py-3">
        <div class="grid bg-white rounded-lg shadow-xl w-full">
            <div class="flex justify-center py-4">
                <div class="flex bg-blue-200 rounded-full md:p-4 p-2 border-2 border-blue-300">
                    <svg xmlns="http://www.w3.org/2000/svg" height="32" width="28" viewBox="0 0 448 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path fill="#ffffff" d="M64 80c-8.8 0-16 7.2-16 16l0 320c0 8.8 7.2 16 16 16l320 0c8.8 0 16-7.2 16-16l0-320c0-8.8-7.2-16-16-16L64 80zM0 96C0 60.7 28.7 32 64 32l320 0c35.3 0 64 28.7 64 64l0 320c0 35.3-28.7 64-64 64L64 480c-35.3 0-64-28.7-64-64L0 96zM337 209L209 337c-9.4 9.4-24.6 9.4-33.9 0l-64-64c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l47 47L303 175c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9z"/>
                    </svg>
                </div>
            </div>

            <div class="flex justify-center">
                <div class="flex">
                    <h1 class="text-gray-600 font-bold md:text-2xl text-xl">Permisos</h1>
                </div>
            </div>

            <form class="mt-5 mx-7">
                <div class="grid grid-cols-1">
                    <label class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">
                        Nombre del Rol
                    </label>
                    <input wire:model.defer="nombre" type="text" placeholder="Nombre del rol"
                        class="py-2 px-3 w-full rounded-lg border-2 border-blue-300 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent" 
                        disabled/>
                    <x-input-error for="nombre" />
                </div>

                <!-- Checkbox para los permisos -->
                <div class="w-full mt-5">
                    <label class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold block">
                        Selecciona los Permisos
                    </label>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 w-full">
                        @foreach ($this->permissions as $permission)
                            <div class="flex items-center">
                                <input type="checkbox" wire:model="selectedPermissions"
                                    value="{{ $permission->id }}" class="w-4 h-4 accent-teal-600"
                                    disabled>
                                <span class="ml-2 text-left">{{ $permission->name }}</span>
                            </div>
                        @endforeach
                    </div>
                    <x-input-error for="selectedPermissions" />
                </div>




                <!-- Botones -->
                <div class='flex items-center justify-center md:gap-8 gap-4 pt-5 pb-5'>
                    <button type="button" onclick="window.history.back()"
                        class='w-auto bg-green-500 hover:bg-green-700 rounded-lg shadow-xl font-medium text-white px-4 py-2'>
                        Volver
                    </button>
                </div>
            </form>

            
        </div>
    </div>
</div>
