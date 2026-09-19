<div class="max-w-4xl px-10 my-6 py-8 bg-white rounded-lg shadow-md mx-auto relative">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-4xl sm:text-5xl font-extrabold text-gray-800 text-center w-full">
            <span class="bg-gradient-to-r from-blue-500 to-blue-400 text-transparent bg-clip-text">
                📚 Capacitaciones Grupales
            </span>
            <span class="block text-sm text-gray-500 mt-2 uppercase tracking-widest">
                Mejora tus habilidades con cada curso
            </span>
        </h1>
    </div>

    <div class="flex justify-between items-center mb-4">
        <button onclick="window.location.href='{{ route('agregarCapacitacionesGruEmpresa') }}'"
            class="bg-green-500 text-white px-2 py-1 rounded-lg shadow-md hover:bg-green-600 
            flex items-center gap-2 transition-all duration-300 transform hover:scale-105">
            <i class="fas fa-plus"></i>
            Agregar Capacitación
        </button>
    </div>

    @if (session()->has('error'))
        <div class="text-red-500 bg-red-100 p-2 rounded-md text-center">
            {{ session('error') }}
        </div>
    @endif

    <!-- Filtro de Sucursal -->
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
        <!-- Select Sucursal -->
        <div>
            <label for="sucursal_id" class="block text-sm font-medium text-gray-700">Sucursal</label>
            <select id="sucursal_id" wire:model.live="sucursal_id"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200">
                <option value="">Selecciona una sucursal</option>
                @foreach($sucursales as $sucursal)
                    <option value="{{ $sucursal->id }}">{{ $sucursal->nombre_sucursal }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="flex justify-between items-center mb-4">
        <select wire:model="selectedYear"
            class="px-5 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200">
            <option value="">Seleccionar año</option>
            @foreach ($years as $year)
                <option value="{{ $year }}">{{ $year }}</option>
            @endforeach
        </select>

        <button onclick="validateAndExport()" wire:loading.attr="disabled"
            wire:target="exportarTodasCapacitaciones"
            class="ml-2 bg-red-500 text-white px-2 py-1 rounded-lg shadow-md hover:bg-red-600 
                flex items-center gap-2 transition-all duration-300 transform hover:scale-105">
            <span wire:loading.remove wire:target="exportarTodasCapacitaciones" class="flex items-center gap-2">
                <i class="fas fa-file-pdf"></i>
                Exportar todo
            </span>
            <span wire:loading.flex wire:target="exportarTodasCapacitaciones" class="flex items-center gap-2">
                <i class="fa-solid fa-spinner animate-spin text-lg text-white"></i>
                Procesando...
            </span>
        </button>
    </div>

    <!-- Mensaje de error si no se selecciona año -->
    <div id="year-error" class="text-red-500 bg-red-100 p-2 rounded-md text-center hidden">
        Por favor, selecciona un año antes de exportar.
    </div>

    <!-- Mostrar capacitaciones solo si se ha seleccionado sucursal -->
    @if ($sucursal_id)
        @if ($capacitaciones->isEmpty())
            <p class="mt-2 text-gray-600 text-center">No hay capacitaciones disponibles para esta sucursal.</p>
        @else
            @foreach ($capacitaciones as $capacitacion)
            <div class="mt-8 p-6 border border-gray-300 rounded-lg shadow-md hover:shadow-lg transition-all relative bg-white">
                <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center">
                    <div class="mb-4 sm:mb-0">
                        <h2 class="text-2xl text-gray-800 font-bold">{{ $capacitacion->nombreCapacitacion }}</h2>
                        <p class="text-gray-700 font-semibold mt-3">Grupo: {{ $capacitacion->nombreGrupo }}</p>
                    </div>
                    <div class="text-sm text-gray-600 flex flex-col sm:flex-row sm:gap-4">
                        <span><strong>Fecha inicio:</strong> {{ $capacitacion->fechaIni }}</span>
                        <span><strong>Fecha fin:</strong> {{ $capacitacion->fechaFin }}</span>
                    </div>
                </div>
                
                <p class="mt-4 text-gray-600">Objetivo: {{ $capacitacion->objetivo_capacitacion }}</p>
                <p class="text-gray-700 font-semibold mt-2">Curso: {{ $capacitacion->curso->nombre }}</p>
                
                <div class="flex justify-between items-center mt-6 border-t pt-4">
                    <div class="flex gap-3">
                        <div x-data="{ show: false }" class="relative">
                            <button wire:click="confirmDelete({{ $capacitacion->id }})"
                                @mouseover="show = true" @mouseleave="show = false"
                                class="text-red-500 hover:text-red-700 p-2 rounded-full transition-all duration-300 transform hover:scale-110 focus:scale-110">
                                <i class="fas fa-trash-alt text-xl"></i>
                            </button>
                            <div x-show="show" class="absolute -top-8 left-1/2 transform -translate-x-1/2 bg-gray-800 text-white text-xs rounded py-1 px-2">Eliminar Curso</div>
                        </div>
                        
                        <div x-data="{ show: false }" class="relative">
                            <button onclick="window.location.href='{{ route('editarCapacitacionesGruEmpresa', Crypt::encrypt($capacitacion->id)) }}'"
                                @mouseover="show = true" @mouseleave="show = false"
                                class="text-blue-500 hover:text-blue-700 p-2 rounded-full transition-all duration-300 transform hover:scale-110 focus:scale-110">
                                <i class="fas fa-edit text-xl"></i>
                            </button>
                            <div x-show="show" class="absolute -top-8 left-1/2 transform -translate-x-1/2 bg-gray-800 text-white text-xs rounded py-1 px-2">Editar Curso</div>
                        </div>

                        <div x-data="{ show: false }" class="relative">
                            <button onclick="window.location.href='{{ route('agregarTrabajadorCapacitacionGrupalEmpresa', Crypt::encrypt($capacitacion->id)) }}'"
                                @mouseover="show = true" @mouseleave="show = false"
                                class="text-blue-500 hover:text-blue-700 p-2 rounded-full transition-all duration-300 transform hover:scale-110 focus:scale-110">
                                <i class="fa-solid fa-user-plus text-xl"></i>
                            </button>
                            <div x-show="show" class="absolute -top-8 left-1/2 transform -translate-x-1/2 bg-gray-800 text-white text-xs rounded py-1 px-2">Agregar Trabajadores</div>
                        </div>
                        
                        <div x-data="{ show: false }" class="relative">
                            <button onclick="window.location.href='{{ route('editarTrabajadorCapacitacionGrupalEmpresa', Crypt::encrypt($capacitacion->id)) }}'"
                                @mouseover="show = true" @mouseleave="show = false"
                                class="text-green-500 hover:text-green-700 p-2 rounded-full transition-all duration-300 transform hover:scale-110 focus:scale-110">
                                <i class="fa-solid fa-user-pen text-xl"></i>
                            </button>
                            <div x-show="show" class="absolute -top-8 left-1/2 transform -translate-x-1/2 bg-gray-800 text-white text-xs rounded py-1 px-2">Editar Trabajadores</div>
                        </div>
                    </div>
                    <div class="flex gap-3">
                        <button wire:click="exportarPDF({{ $capacitacion->id }})" wire:loading.attr="disabled" wire:target="exportarPDF" class="bg-blue-500 text-white px-3 py-1.5 rounded-lg shadow-md hover:bg-blue-600 flex items-center gap-2 transition-all duration-300 transform hover:scale-105">
                            <span wire:loading.remove wire:target="exportarPDF">
                                <i class="fas fa-file-pdf"></i>
                                Exportar PDF
                            </span>
                            <span wire:loading.flex wire:target="exportarPDF">
                                <i class="fa-solid fa-spinner animate-spin text-lg text-white"></i>
                                Procesando...
                            </span>
                        </button>
                        <a class="bg-green-500 text-white px-3 py-1.5 rounded-lg hover:bg-green-600 transition-all duration-300 transform hover:scale-105 flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m5.231 13.481L15 17.25m-4.5-15H5.625c-.621 0-1.125.504-1.125 1.125v16.5c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Zm3.75 11.625a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                              </svg> Evidencias
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        @endif
    @endif

    <!-- Modal de confirmación -->
    <div id="modalConfirm"
        class="{{ $showModal ? '' : 'hidden' }} fixed z-50 inset-0 bg-gray-900 bg-opacity-60 overflow-y-auto h-full w-full px-4">
        <div class="relative top-40 mx-auto shadow-xl rounded-md bg-white max-w-md">
            <div class="flex justify-end p-2">
                <button wire:click="$set('showModal', false)" type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>
            <div class="p-6 pt-0 text-center">
                <svg class="w-20 h-20 text-red-600 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <h3 class="text-xl font-normal text-gray-500 mt-5 mb-6">¿Estás seguro de que deseas eliminar esta
                    capacitación?</h3>
                <button wire:click="deleteCapacitacion"
                    class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-base inline-flex items-center px-3 py-2.5 text-center mr-2">
                    Eliminar
                </button>
                <button wire:click="$set('showModal', false)"
                    class="text-gray-900 bg-white hover:bg-gray-100 focus:ring-4 focus:ring-cyan-200 border border-gray-200 font-medium inline-flex items-center rounded-lg text-base px-3 py-2.5 text-center">
                    Cancelar
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    function validateAndExport() {
        var selectedYear = document.querySelector('select[wire\\:model="selectedYear"]').value;
        var errorMessage = document.getElementById('year-error');

        if (!selectedYear) {
            errorMessage.classList.remove('hidden');
        } else {
            errorMessage.classList.add('hidden');
            // Proceed with the export function
            @this.call('exportarTodasCapacitaciones');
        }
    }
</script>