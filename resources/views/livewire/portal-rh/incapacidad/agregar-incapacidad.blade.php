<div>
    <div class="flex min-h-screen items-center justify-center py-3">
        <div class="grid bg-white rounded-lg shadow-xl w-full">
            <div class="flex justify-center py-4">
                <div class="flex bg-blue-200 rounded-full md:p-4 p-2 border-2 border-blue-300">
                    <svg xmlns="http://www.w3.org/2000/svg" height="20" width="22.5"
                        viewBox="0 0 576 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                        <path fill="#ffffff"
                            d="M0 64C0 28.7 28.7 0 64 0L224 0l0 128c0 17.7 14.3 32 32 32l128 0 0 47-92.8 37.1c-21.3 8.5-35.2 29.1-35.2 52c0 56.6 18.9 148 94.2 208.3c-9 4.8-19.3 7.6-30.2 7.6L64 512c-35.3 0-64-28.7-64-64L0 64zm384 64l-128 0L256 0 384 128zm39.1 97.7c5.7-2.3 12.1-2.3 17.8 0l120 48C570 277.4 576 286.2 576 296c0 63.3-25.9 168.8-134.8 214.2c-5.9 2.5-12.6 2.5-18.5 0C313.9 464.8 288 359.3 288 296c0-9.8 6-18.6 15.1-22.3l120-48zM527.4 312L432 273.8l0 187.8c68.2-33 91.5-99 95.4-149.7z" />
                    </svg>
                </div>
            </div>

            <div class="flex justify-center">
                <div class="flex">
                    <h1 class="text-gray-600 font-bold md:text-2xl text-xl">Solicitar Incapacidad o Permiso</h1>
                </div>
            </div>

            <div class="relative mb-4">
                <div class="flex items-center justify-between">
                    @if (session()->has('message'))
                        <div x-data="{ show: true }" x-init="setTimeout(() => {
                            show = false;
                            window.location.href = '{{ route('mostrarincapacidad') }}'
                        }, 5000)" x-show="show"
                            class="fixed top-4 left-4 max-w-xs w-full bg-green-500 text-white shadow-lg rounded-lg p-4 flex items-center space-x-3 transition-transform transform hover:scale-105 z-50">
                            <svg xmlns="http://www.w3.org/2000/svg" height="20" width="17.5"
                                viewBox="0 0 448 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                                <path fill="#ffffff"
                                    d="M224 0c-17.7 0-32 14.3-32 32l0 19.2C119 66 64 130.6 64 208l0 25.4c0 45.4-15.5 89.5-43.8 124.9L5.3 377c-5.8 7.2-6.9 17.1-2.9 25.4S14.8 416 24 416l400 0c9.2 0 17.6-5.3 21.6-13.6s2.9-18.2-2.9-25.4l-14.9-18.6C399.5 322.9 384 278.8 384 233.4l0-25.4c0-77.4-55-142-128-156.8L256 32c0-17.7-14.3-32-32-32zm0 96c61.9 0 112 50.1 112 112l0 25.4c0 47.9 13.9 94.6 39.7 134.6L72.3 368C98.1 328 112 281.3 112 233.4l0-25.4c0-61.9 50.1-112 112-112zm64 352l-64 0-64 0c0 17 6.7 33.3 18.7 45.3s28.3 18.7 45.3 18.7s33.3-6.7 45.3-18.7s18.7-28.3 18.7-45.3z" />
                            </svg>
                            <div class="flex-1">
                                <p class="font-bold">{{ session('message') }}</p>
                                @if (session('message') == 'Incapacidad enviada para aprobación.')
                                    <p class="text-sm">La solicitud se ha enviado y está pendiente de revisión, revisa
                                        en 3 días hábiles</p>
                                @elseif(session('message') == 'Incidencia aprobada y registrada.')
                                    <p class="text-sm">La solicitud se aprobó y ya está registrada.</p>
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
                <div class="grid grid-cols-1">
                    <label for="tipo"
                        class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">
                        Tipo de Incapacidad
                    </label>
                    <select wire:model.defer="incapacidad.tipo" id="tipo"
                        class="py-2 px-3 rounded-lg border-2 border-blue-300 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent">
                        <option value="" selected>-- Selecciona una opción --</option>
                        <option value="Incapacidad por enfermedad general">Incapacidad por enfermedad general</option>
                        <option value="Incapacidad por cirugía o tratamiento médico">
                            Incapacidad por cirugía o tratamiento médico
                        </option>
                        <option value="Incapacidad por accidente de trabajo">
                            Incapacidad por accidente de trabajo
                        </option>
                        <option value="Incapacidad por maternidad o paternidad">
                            Incapacidad por maternidad o paternidad
                        </option>
                        <option value="Incapacidad por invalidez o discapacidad">
                            Incapacidad por invalidez o discapacidad
                        </option>
                        <option value="Incapacidad por razones psicológicas o psiquiátricas">
                            Incapacidad por razones psicológicas o psiquiátricas
                        </option>
                        <option value="Vacaciones">Vacaciones</option>
                    </select>

                    <x-input-error for="incapacidad.tipo" />
                </div>

                <div class="grid grid-cols-1 mt-5">
                    <label for="motivo" class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">
                        Motivo
                    </label>

                    <textarea wire:model.defer="incapacidad.motivo" id="motivo" rows="4" placeholder="Describe el motivo"
                        class="py-2 px-3 rounded-lg border-2 border-blue-300 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent resize-y">
                    </textarea>

                    <x-input-error for="incapacidad.motivo" />
                </div>


                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-8 mt-5">
                    <div class="grid grid-cols-1 mt-5">
                        <label for="fecha_inicio"
                            class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">
                            Fecha Inicio
                        </label>
                        <input wire:model.defer="incapacidad.fecha_inicio" type="date" id="fecha_inicio"
                            class="py-2 px-3 rounded-lg border-2 border-blue-300 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent" />


                        <x-input-error for="incapacidad.fecha_inicio" />
                    </div>

                    <div class="grid grid-cols-1 mt-5">
                        <label for="fecha_final"
                            class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">
                            Fecha Final
                        </label>
                        <input wire:model.defer="incapacidad.fecha_final" type="date" id="fecha_final"
                            class="py-2 px-3 rounded-lg border-2 border-blue-300 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent" />


                        <x-input-error for="incapacidad.fecha_final" />
                    </div>
                </div>

                <div class="grid grid-cols-1 mt-5">
                    <label for="observaciones"
                        class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">
                        Observaciones (Opcional)
                    </label>

                    <textarea wire:model.defer="incapacidad.observaciones" id="observaciones" rows="4"
                        placeholder="Añade tus observaciones de ser necesario"
                        class="py-2 px-3 rounded-lg border-2 border-blue-300 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent resize-y">
                    </textarea>

                    <x-input-error for="incapacidad.observaciones" />
                </div>

                <div class="flex flex-col items-center mt-5">
                    <label for="documento" class="uppercase text-lg md:text-xl text-gray-600 font-semibold mb-4">
                        Comprobante de Incidencia
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
                            <img src="{{ asset('img/pdf_icon.jpeg') }}" alt="PDF Icon" width="100"
                                height="100">
                        @endif
                    </div>

                    <!-- Mensaje de error -->
                    <x-input-error for="documento" class="text-red-600 text-sm mt-2" />
                </div>

                <!-- Botones -->
                <div class='flex items-center justify-center md:gap-8 gap-4 pt-5 pb-5'>
                    <button type="button" wire:click="saveIncapacidad"
                        class='w-auto bg-blue-500 hover:bg-blue-700 rounded-lg shadow-xl font-medium text-white px-4 py-2'>
                        Agregar
                    </button>

                    <button type="button" wire:click="redirigirIncapacidad"
                        class='w-auto bg-red-500 hover:bg-red-700 rounded-lg shadow-xl font-medium text-white px-4 py-2'>
                        Cancelar
                    </button>
                </div>
            </form>
        </div>
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