<div class="relative pt-2 min-h-screen bg-gray-100">
    <!-- Barra superior con botón de agregar -->
    <div class="mt-8 flex justify-end mr-5">
        <button wire:click="redirigir()"  class="bg-blue-700 text-white font-bold py-2 px-4 w-auto rounded hover:bg-gray-600">
            Agregar
        </button>

        <div class="flex justify-center my-4">
            <label class="mr-2 font-semibold text-gray-700">Sucursal:</label>
            <select wire:model.live="sucursal_id" class="p-2 border border-gray-300 rounded-lg">
                <option value="">Seleccione una sucursal</option>
                @foreach($sucursales as $sucursal)
                    <option value="{{ $sucursal->id }}">{{ $sucursal->nombre_sucursal }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <!-- Barra de búsqueda -->
    <div class="flex justify-center my-6">
        <div class="relative w-2/3 max-w-lg">
            <input type="text" wire:model.live="search" placeholder="Buscar por nombre, área o proceso..."
                class="w-full p-3 pl-10 text-gray-700 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none" />
            <svg class="absolute left-3 top-3 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
        </div>
    </div>

    <!-- Contenedor de tarjetas -->
    <div class="w-full flex justify-center items-center">
        <div class="w-full bg-white p-5 bg-opacity-40 backdrop-filter backdrop-blur-lg shadow-lg rounded-lg">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 text-center mx-auto">
                @forelse($puestos as $puesto)
                <article
                    class="relative bg-white p-6 shadow-lg transition duration-300 group transform hover:-translate-y-2 hover:shadow-2xl rounded-2xl cursor-pointer border">
                    <div class="relative mb-4 rounded-2xl">
                        <img class="max-h-80 rounded-2xl w-full object-cover transition-transform duration-300 transform group-hover:scale-105"
                            src="https://images.pexels.com/photos/163097/twitter-social-media-communication-internet-network-163097.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2"
                            alt="">
                        <a class="flex justify-center items-center bg-blue-700 bg-opacity-80 z-10 absolute top-0 left-0 w-full h-full text-white rounded-2xl opacity-0 transition-all duration-300 transform group-hover:scale-105 text-xl group-hover:opacity-100"
                            href="{{ route('vermasPerfilPuesto', Crypt::encrypt($puesto->id)) }}" target="_self"
                            rel="noopener noreferrer">
                            Ver más
                            <svg class="ml-2 w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 5l7 7-7 7M5 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                    <h3 class="font-medium text-xl leading-8 text-center text-gray-700">
                        {{ $puesto->nombre_puesto }}
                    </h3>
                    <p class="text-sm font-semibold text-gray-600">Área: {{ $puesto->area }}</p>
                    <p class="text-sm text-gray-500">Proceso: {{ $puesto->proceso }}</p>

                    <div class="flex justify-center space-x-4 mt-4 opacity-0 group-hover:opacity-100 transition-opacity">
                        <button class="text-blue-600 hover:text-blue-800" onclick="window.location.href='{{ route('editarPerfilPuestoEmpresa', Crypt::encrypt($puesto->id)) }}'">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                            </svg>                              
                        </button>
                        <button class="text-red-600 hover:text-red-800" wire:click="confirmDelete({{ $puesto->id }})">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                            </svg>
                        </button>
                    </div>      
                </article>
                @empty
                <div class="text-center text-gray-500 col-span-3 mt-6">
                    <p class="text-lg">😕 No se encontraron resultados para "<strong>{{ $search }}</strong>"</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Modal de confirmación -->
    <div id="modalConfirm"
        class="{{ $showModal ? '' : 'hidden' }} fixed z-50 inset-0 bg-gray-900 bg-opacity-60 overflow-y-auto h-full w-full px-4">
        <div class="relative top-40 mx-auto shadow-xl rounded-md bg-white max-w-md">
            <div class="flex justify-end p-2">
                <button wire:click="$set('showModal', false)" type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center">
                    ❌
                </button>
            </div>
            <div class="p-6 pt-0 text-center">
                <svg class="w-20 h-20 text-red-600 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <h3 class="text-xl font-normal text-gray-500 mt-5 mb-6">¿Estás seguro de que deseas eliminar este
                    perfil de puesto?</h3>
                <button wire:click="deletePerfil"
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
