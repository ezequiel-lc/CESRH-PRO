<div>
    <div class="flex min-h-screen items-center justify-center py-3">
        <div class="grid bg-white rounded-lg shadow-xl w-full">
            <div class="flex justify-center py-4">
                <div class="flex bg-blue-200 rounded-full md:p-4 p-2 border-2 border-blue-300">
                    <svg xmlns="http://www.w3.org/2000/svg" height="20" width="12.5"
                        viewBox="0 0 320 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                        <path fill="#ffffff"
                            d="M160 0c17.7 0 32 14.3 32 32l0 35.7c1.6 .2 3.1 .4 4.7 .7c.4 .1 .7 .1 1.1 .2l48 8.8c17.4 3.2 28.9 19.9 25.7 37.2s-19.9 28.9-37.2 25.7l-47.5-8.7c-31.3-4.6-58.9-1.5-78.3 6.2s-27.2 18.3-29 28.1c-2 10.7-.5 16.7 1.2 20.4c1.8 3.9 5.5 8.3 12.8 13.2c16.3 10.7 41.3 17.7 73.7 26.3l2.9 .8c28.6 7.6 63.6 16.8 89.6 33.8c14.2 9.3 27.6 21.9 35.9 39.5c8.5 17.9 10.3 37.9 6.4 59.2c-6.9 38-33.1 63.4-65.6 76.7c-13.7 5.6-28.6 9.2-44.4 11l0 33.4c0 17.7-14.3 32-32 32s-32-14.3-32-32l0-34.9c-.4-.1-.9-.1-1.3-.2l-.2 0s0 0 0 0c-24.4-3.8-64.5-14.3-91.5-26.3c-16.1-7.2-23.4-26.1-16.2-42.2s26.1-23.4 42.2-16.2c20.9 9.3 55.3 18.5 75.2 21.6c31.9 4.7 58.2 2 76-5.3c16.9-6.9 24.6-16.9 26.8-28.9c1.9-10.6 .4-16.7-1.3-20.4c-1.9-4-5.6-8.4-13-13.3c-16.4-10.7-41.5-17.7-74-26.3l-2.8-.7s0 0 0 0C119.4 279.3 84.4 270 58.4 253c-14.2-9.3-27.5-22-35.8-39.6c-8.4-17.9-10.1-37.9-6.1-59.2C23.7 116 52.3 91.2 84.8 78.3c13.3-5.3 27.9-8.9 43.2-11L128 32c0-17.7 14.3-32 32-32z" />
                    </svg>
                </div>
            </div>

            <div class="flex justify-center">
                <div class="flex">
                    <h1 class="text-gray-600 font-bold md:text-2xl text-xl">Agregar Cambio de Salario</h1>
                </div>
            </div>

            <div class="relative mb-4">
                <div class="flex items-center justify-between">
                    @if (session()->has('message'))
                        <div x-data="{ show: true }" x-init="setTimeout(() => {
                            show = false;
                            window.location.href = '{{ route('mostrarcambiosal') }}'
                        }, 5000)" x-show="show"
                            class="fixed top-4 left-4 max-w-xs w-full bg-green-500 text-white shadow-lg rounded-lg p-4 flex items-center space-x-3 transition-transform transform hover:scale-105 z-50">
                            <svg xmlns="http://www.w3.org/2000/svg" height="20" width="17.5"
                                viewBox="0 0 448 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                                <path fill="#ffffff"
                                    d="M224 0c-17.7 0-32 14.3-32 32l0 19.2C119 66 64 130.6 64 208l0 25.4c0 45.4-15.5 89.5-43.8 124.9L5.3 377c-5.8 7.2-6.9 17.1-2.9 25.4S14.8 416 24 416l400 0c9.2 0 17.6-5.3 21.6-13.6s2.9-18.2-2.9-25.4l-14.9-18.6C399.5 322.9 384 278.8 384 233.4l0-25.4c0-77.4-55-142-128-156.8L256 32c0-17.7-14.3-32-32-32zm0 96c61.9 0 112 50.1 112 112l0 25.4c0 47.9 13.9 94.6 39.7 134.6L72.3 368C98.1 328 112 281.3 112 233.4l0-25.4c0-61.9 50.1-112 112-112zm64 352l-64 0-64 0c0 17 6.7 33.3 18.7 45.3s28.3 18.7 45.3 18.7s33.3-6.7 45.3-18.7s18.7-28.3 18.7-45.3z" />
                            </svg>
                            <div class="flex-1">
                                <p class="font-bold">{{ session('message') }}</p>
                                @if (session('message') == 'Cambio de salario agregado')
                                    <p class="text-sm">El cambio de salario fue agregado al historial del usuario exitosamente</p>
                                @endif
                            </div>
                            <button @click="show = false" class="text-white hover:text-gray-300 focus:outline-none">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>
                        </div>
                    @endif
    
                </div>
            </div>

            <form class="mt-5 mx-7">
                <h1 class="uppercase md:text-sm text-xs text-gray-900 text-light font-semibold"> 
                    Seleccione su Empresa, Sucursal y Departamento para hallar más rápido al usuario
                </h1>
    
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-8 mt-5">
                    
                    <div class="grid grid-cols-1 mt-5">
                        <label for="empresa" class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">
                            Empresa</label>
                        <select wire:model.live="empresa" id="empresa"
                            class="py-2 px-3 rounded-lg border-2 border-blue-300 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent">
                            <option value=""> --- Seleccione una empresa --- </option>
                            @foreach ($empresas as $empresa)
                                <option value="{{ $empresa->id }}">{{ $empresa->nombre }}</option>
                            @endforeach
                        </select>
    
                        <x-input-error for="empresa" />
                    </div>
    
                    <div class="grid grid-cols-1 mt-5">
                        <label for="sucursal" class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">
                            Sucursal
                        </label>
                        <select wire:model.live="sucursal" id="sucursal"
                            class="py-2 px-3 rounded-lg border-2 border-blue-300 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent">
                            <option value=""> --- Seleccione una sucursal --- </option>
                            @forelse ($sucursales as $sucursal)
    
                                @foreach($sucursal->sucursales as $mi_sucursal)
    
                                    <option value="{{ $mi_sucursal->id }}">{{ $mi_sucursal->nombre_sucursal }}
                                    </option>
                                @endforeach
    
                            @empty
                                <option value=""> Sin sucursales </option>
                            @endforelse
                        </select>
    
                        <x-input-error for="sucursal" />
                    </div>
                </div>
    
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-8 mt-5">
                    <!--  -->
                    <div class="grid grid-cols-1 mt-5">
                        <label for="departamento"
                            class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">
                            Departamento</label>
                        <select wire:model.live="departamento" id="departamento"
                            class="py-2 px-3 rounded-lg border-2 border-blue-300 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent">
                            <option value=""> --- Seleccione un departamento --- </option>
                            @forelse ($departamentos as $departamento)
    
                                @foreach($departamento->departamentos as $mi_depa)
    
                                    <option value="{{ $mi_depa->id }}">{{ $mi_depa->nombre_departamento }}
                                    </option>
                                @endforeach
    
                            @empty
                                <option value=""> Sin departamentos</option>
                            @endforelse
                        </select>
    
                        <x-input-error for="departamento" />
                    </div>
    
    
                    <!--  -->
                    <div class="grid grid-cols-1 mt-5">
                        <label for="user_id"
                            class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">
                            Usuarios</label>
                        <select wire:model.defer="user_id" id="user_id"
                            class="py-2 px-3 rounded-lg border-2 border-blue-300 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent">
                            <option value=""> --- Seleccione un usuario --- </option>
                            @forelse ($users as $user)
    
                                @foreach($user->users as $mi_user)
                                    <option value="{{ $mi_user->id }}">{{ $mi_user->name }}
                                    </option>
                                @endforeach
    
                            @empty
                                <option value=""> Sin usuarios </option>
                            @endforelse
                        </select>
    
                        <x-input-error for="user_id" />
                    </div>
                </div>

                <!-- Razón Social y RFC -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-8 mt-5">
                    <div class="grid grid-cols-1 mt-5">
                        <label for="fecha_cambio"
                            class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">
                            Fecha
                        </label>
                        <input wire:model.defer="salario.fecha_cambio" type="date" id="fecha_cambio"
                            class="py-2 px-3 rounded-lg border-2 border-blue-300 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent" />
    
    
                        <x-input-error for="salario.fecha_cambio" />
                    </div>

                    <div class="grid grid-cols-1 mt-5">
                        <label for="salario_anterior"
                            class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">
                            Salario Anterior
                        </label>
                        <input wire:model.defer="salario.salario_anterior" type="text" 
                            id="salario_anterior" placeholder="1500.50"
                            class="py-2 px-3 rounded-lg border-2 border-blue-300 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent" />

                        <x-input-error for="salario.salario_anterior" />
                    </div>
                </div>

                <!--  -->
                <div class="grid grid-cols-1 mt-5">
                    <label for="salario_nuevo"
                        class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">
                        Nuevo Salario
                    </label>
                    <input wire:model.defer="salario.salario_nuevo" type="text" 
                        id="salario_nuevo" placeholder="1500.50"
                        class="py-2 px-3 rounded-lg border-2 border-blue-300 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent" />

                    <x-input-error for="salario.salario_nuevo" />
                </div>

                <div class="grid grid-cols-1 mt-5">
                    <label for="motivo"
                        class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">
                        Motivo del cambio de salario
                    </label>

                    <textarea wire:model.defer="salario.motivo" id="motivo" rows="4"
                        placeholder="Añade el motivo"
                        class="py-2 px-3 rounded-lg border-2 border-blue-300 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent resize-y">
                    </textarea>

                    <x-input-error for="salario.motivo" />
                </div>

                <!--  -->
                <div class="grid grid-cols-1 mt-5">
                    <label for="observaciones"
                        class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">
                        Observaciones (NA - si no aplica)
                    </label>

                    <textarea wire:model.defer="salario.observaciones" id="observaciones" rows="4"
                        placeholder="Añade tus observaciones de ser necesario"
                        class="py-2 px-3 rounded-lg border-2 border-blue-300 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent resize-y">
                    </textarea>

                    <x-input-error for="salario.observaciones" />
                </div>

                <!-- documento -->
                <div class="flex flex-col items-center mt-5">
                    <label for="documento" class="uppercase text-lg md:text-xl text-gray-600 font-semibold mb-4">
                        Documento
                    </label>

                    <!-- Área de carga de archivos -->
                    <div class="mx-auto cursor-pointer flex w-full max-w-lg flex-col items-center rounded-xl border-2 border-dashed border-blue-400 bg-white p-6 text-center"
                        onclick="document.getElementById('fileInput').click()" ondragover="event.preventDefault()"
                        ondrop="handleDrop(event)">

                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-blue-500" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                        </svg>

                        <h2 class="mt-4 text-xl font-medium text-gray-700 tracking-wide">Adjuntar archivo</h2>
                        <p class="mt-2 text-gray-500 tracking-wide">Seleccione o arrastre su archivo aquí</p>

                        <!-- Input oculto, activado al hacer clic -->
                        <input type="file" id="fileInput" class="hidden" wire:model.defer="documento"
                            accept=".pdf" />

                        <br>

                        @if ($documento)
                            <img src="{{ asset('img/pdf_icon.jpeg') }}" alt="PDF Icon" width="100" height="100">
                        @endif
                    </div>

                    <!-- Mensaje de error -->
                    <x-input-error for="documento" class="text-red-600 text-sm mt-2" />
                </div>


                <!-- Botones -->
                <div class='flex items-center justify-center md:gap-8 gap-4 pt-5 pb-5'>

                    <button type="button" wire:click="saveSalario"
                        class='w-auto bg-blue-500 hover:bg-blue-700 rounded-lg shadow-xl font-medium text-white px-4 py-2'>
                        Agregar Cambio de Salario
                    </button>

                    <button type="button" wire:click="redirigirSalario"
                        class='w-auto bg-red-500 hover:bg-red-700 rounded-lg shadow-xl font-medium text-white px-4 py-2'>
                        Cancelar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function handleDrop(event) {
        event.preventDefault();
        const fileInput = document.getElementById('fileInput');
        if (event.dataTransfer.files.length > 0) {
            fileInput.files = event.dataTransfer.files;
            fileInput.dispatchEvent(new Event('change')); // Dispara el evento de cambio
        }
    }
</script>
