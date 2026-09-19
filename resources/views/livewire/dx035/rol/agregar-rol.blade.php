<div>
    <div class="flex min-h-screen items-center justify-center py-3">
        <div class="grid bg-white rounded-lg shadow-xl w-full">
            <div class="flex justify-center py-4">
                <div class="flex bg-blue-200 rounded-full md:p-4 p-2 border-2 border-blue-300">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24" width="30" viewBox="0 0 640 512">
                        <path fill="#ffffff" d="M96 128a128 128 0 1 1 256 0A128 128 0 1 1 96 128zM0 482.3C0 383.8 79.8 304 178.3 304l91.4 0C368.2 304 448 383.8 448 482.3c0 16.4-13.3 29.7-29.7 29.7L29.7 512C13.3 512 0 498.7 0 482.3zM504 312l0-64-64 0c-13.3 0-24-10.7-24-24s10.7-24 24-24l64 0 0-64c0-13.3 10.7-24 24-24s24 10.7 24 24l0 64 64 0c13.3 0 24 10.7 24 24s-10.7 24-24 24l-64 0 0 64c0 13.3-10.7 24-24 24s-24-10.7-24-24z"/>
                    </svg>
                </div>
            </div>

            <div class="flex justify-center">
                <div class="flex">
                    <h1 class="text-gray-600 font-bold md:text-2xl text-xl">Asignar Rol</h1>
                </div>
            </div>

            <form class="mt-5 mx-7">
                <div class="grid grid-cols-1">
                    <label class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">
                        Nombre del Rol
                    </label>
                    <input wire:model.defer="name" type="text" placeholder="Nombre del rol"
                        class="py-2 px-3 w-full rounded-lg border-2 border-blue-300 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent" />
                    <x-input-error for="name" />
                </div>

                <div class="w-full mt-5">
                    <label class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold block">
                        Selecciona los Permisos
                    </label>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 w-full">
                        @foreach ($this->permissions as $permission)
                            <div class="flex items-center">
                                <input type="checkbox" wire:model.defer="selectedPermissions"
                                    value="{{ $permission->name }}" class="w-4 h-4 accent-teal-600">
                                <span class="ml-2 text-left">{{ $permission->name }}</span>
                            </div>
                        @endforeach
                    </div>
                    <x-input-error for="selectedPermissions" />
                </div>

                <div class='flex items-center justify-center md:gap-8 gap-4 pt-5 pb-5'>
                    <button type="button" wire:click="AgregarRol"
                        class='w-auto bg-blue-500 hover:bg-blue-700 rounded-lg shadow-xl font-medium text-white px-4 py-2'>
                        Agregar
                    </button>
                    <button type="button" onclick="window.history.back()"
                        class='w-auto bg-red-500 hover:bg-red-700 rounded-lg shadow-xl font-medium text-white px-4 py-2'>
                        Cancelar
                    </button>
                </div>
            </form>

            @if (session()->has('message'))
                <div class="text-center text-green-500 font-semibold py-2">
                    {{ session('message') }}
                </div>
            @endif
        </div>
    </div>
</div>