<div class="flex min-h-screen items-center justify-center py-3">
    <div class="grid bg-white rounded-lg shadow-xl w-full">
        <div class="flex justify-center py-4">
            <div class="flex bg-blue-200 rounded-full md:p-4 p-2 border-2 border-blue-300">
                <svg xmlns="http://www.w3.org/2000/svg" height="20" width="25"
                    viewBox="0 0 640 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                    <path fill="#ffffff"
                        d="M96 128a128 128 0 1 1 256 0A128 128 0 1 1 96 128zM0 482.3C0 383.8 79.8 304 178.3 304l91.4 0C368.2 304 448 383.8 448 482.3c0 16.4-13.3 29.7-29.7 29.7L29.7 512C13.3 512 0 498.7 0 482.3zM471 143c9.4-9.4 24.6-9.4 33.9 0l47 47 47-47c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9l-47 47 47 47c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0l-47-47-47 47c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l47-47-47-47c-9.4-9.4-9.4-24.6 0-33.9z" />
                </svg>
            </div>
        </div>

        <div class="flex justify-center">
            <div class="flex">
                <h1 class="text-gray-600 font-bold md:text-2xl text-xl">Agregar Baja</h1>
            </div>
        </div>

        <div class="relative mb-4">
            <div class="flex items-center justify-between">
                <!-- Alert (solo se muestra si hay mensaje en sesión) -->
                @if (session()->has('message'))
                    <div x-data="{ show: true }" x-init="setTimeout(() => {
                        show = false;
                        window.location.href = '{{ route('mostrarbaja') }}'
                    }, 4000)" x-show="show"
                        class="fixed top-4 left-4 max-w-xs w-full bg-green-500 text-white shadow-lg rounded-lg p-4 flex items-center space-x-3 transition-transform transform hover:scale-105 z-50">
                        <svg xmlns="http://www.w3.org/2000/svg" height="20" width="17.5"
                            viewBox="0 0 448 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                            <path fill="#ffffff"
                                d="M224 0c-17.7 0-32 14.3-32 32l0 19.2C119 66 64 130.6 64 208l0 25.4c0 45.4-15.5 89.5-43.8 124.9L5.3 377c-5.8 7.2-6.9 17.1-2.9 25.4S14.8 416 24 416l400 0c9.2 0 17.6-5.3 21.6-13.6s2.9-18.2-2.9-25.4l-14.9-18.6C399.5 322.9 384 278.8 384 233.4l0-25.4c0-77.4-55-142-128-156.8L256 32c0-17.7-14.3-32-32-32zm0 96c61.9 0 112 50.1 112 112l0 25.4c0 47.9 13.9 94.6 39.7 134.6L72.3 368C98.1 328 112 281.3 112 233.4l0-25.4c0-61.9 50.1-112 112-112zm64 352l-64 0-64 0c0 17 6.7 33.3 18.7 45.3s28.3 18.7 45.3 18.7s33.3-6.7 45.3-18.7s18.7-28.3 18.7-45.3z" />
                        </svg>
                        <div class="flex-1">
                            <p class="font-bold">
                                {{ session('message') }}
                            </p>
                            <!-- Mensaje extra, opcional -->
                            @if (session('message') == 'Notificación')
                                <p class="text-sm">Baja actualizada exitosamente</p>
                            @endif
                        </div>
                        <button @click="show = false" class="text-white hover:text-gray-300 focus:outline-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0
                                         011.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414
                                         1.414L10 11.414l-4.293 4.293a1 1 0
                                         01-1.414-1.414L8.586 10 4.293 5.707a1
                                         1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                @endif
            </div>
        </div>

        <form class="mt-5 mx-7">
            <div class="grid grid-cols-1 mt-5">
                <label for="nombre_usuario" class="uppercase md:text-sm text-xs text-gray-500 font-semibold">
                    Usuario
                </label>
                <input type="text" id="nombre_usuario" value="{{ $nombre_usuario }}" disabled
                    class="py-2 px-3 rounded-lg border-2 border-blue-300 mt-1 focus:outline-none" />
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-8 mt-5">
                <div class="grid grid-cols-1 mt-5">
                    <label for="fecha_baja" class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">
                        Fecha de baja
                    </label>
                    <input wire:model.defer="fecha_baja" type="date" id="fecha_baja"
                        class="py-2 px-3 rounded-lg border-2 border-blue-300 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent" />

                    <x-input-error for="fecha_baja" />
                </div>

                <div class="grid grid-cols-1 mt-5">
                    <label for="tipo_baja" class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">
                        Tipo de Baja
                    </label>
                    <select wire:model.defer="tipo_baja" id="tipo_baja"
                        class="py-2 px-3 rounded-lg border-2 border-blue-300 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent">
                        <option value="" selected>-- Selecciona una opción --</option>

                        <option value="Baja por renuncia voluntaria">
                            Baja por renuncia voluntaria
                        </option>
                        <option value="Baja por despido justificado">
                            Baja por despido justificado
                        </option>
                        <option value="Baja por despido injustificado">
                            Baja por despido injustificado
                        </option>
                        <option value="Baja por fin de contrato temporal">
                            Baja por fin de contrato temporal
                        </option>
                        <option value="Baja por suspensión del contrato">
                            Baja por suspensión del contrato
                        </option>
                        <option value="Baja por jubilación">
                            Baja por jubilación
                        </option>
                        <option value="Baja por fallecimiento del trabajador">
                            Baja por fallecimiento del trabajador
                        </option>
                    </select>

                    <x-input-error for="tipo_baja" />
                </div>
            </div>

            <div class="grid grid-cols-1 mt-5">
                <label for="motivo_baja" class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">
                    Motivo
                </label>

                <textarea wire:model.defer="motivo_baja" id="motivo_baja" rows="4" placeholder="Describe el motivo"
                    class="py-2 px-3 rounded-lg border-2 border-blue-300 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent resize-y">
                </textarea>

                <x-input-error for="motivo_baja" />
            </div>

            <div class="grid grid-cols-1 mt-5">
                <label for="observaciones"
                    class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">
                    Observaciones (Opcional)
                </label>

                <textarea wire:model.defer="observaciones" id="observaciones" rows="4"
                    placeholder="Añade tus observaciones de ser necesario"
                    class="py-2 px-3 rounded-lg border-2 border-blue-300 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent resize-y">
                </textarea>

                <x-input-error for="observaciones" />
            </div>

            <div class="flex flex-col items-center mt-5">
                <label for="pdfdocumento" class="uppercase text-lg md:text-xl text-gray-600 font-semibold mb-4">
                    Documento
                </label>
            
                <!-- Área de carga de archivos -->
                <div class="mx-auto cursor-pointer flex w-full max-w-lg flex-col items-center rounded-xl border-2 border-dashed border-blue-400 bg-white p-6 text-center"
                    onclick="document.getElementById('fileInput').click()" 
                    ondragover="event.preventDefault()" 
                    ondrop="handleDrop(event)">

                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-blue-500" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                    </svg>
            
                    <h2 class="mt-4 text-xl font-medium text-gray-700 tracking-wide">Adjuntar archivo</h2>
                    <p class="mt-2 text-gray-500 tracking-wide">Seleccione o arrastre su archivo aquí</p>
            
                    <!-- Input oculto, activado al hacer clic -->
                    <input type="file" id="fileInput" class="hidden" wire:model="pdfdocumento" accept=".pdf" />
            
                    <br>
            
                    @if ($pdfdocumento)
                        <img src="{{ asset('img/pdf_icon.jpeg') }}" alt="PDF Icon" width="100" height="100">
                    @endif
                </div>
            
                <!-- Mensaje de error -->
                <x-input-error for="pdfdocumento" class="text-red-600 text-sm mt-2" />
            </div>

            <!-- Botones -->
            <div class='flex items-center justify-center md:gap-8 gap-4 pt-5 pb-5'>
                <button type="button" wire:click="actualizarBaja"
                    class='w-auto bg-blue-500 hover:bg-blue-700 rounded-lg shadow-xl font-medium text-white px-4 py-2'>
                    Actualizar
                </button>

                <button type="button" onclick="window.history.back()"
                    class='w-auto bg-red-500 hover:bg-red-700 rounded-lg shadow-xl font-medium text-white px-4 py-2'>
                    Cancelar
                </button>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

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
