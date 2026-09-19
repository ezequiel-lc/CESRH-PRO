<div class="font-sans">
    <div class="relative min-h-screen flex justify-center items-center bg-gray-200">
        <div class="bg-white p-6 rounded-lg shadow-lg w-full sm:w-3/4 md:w-6/5 lg:w-3/2 flex flex-col items-center relative py-12">
            <h1 class="text-xl sm:text-2xl font-bold text-gray-800 text-center uppercase tracking-wide
               bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 text-transparent bg-clip-text
               drop-shadow-lg pb-2 border-b-4 border-blue-400 inline-block">
                Editar Responsabilidades Universales
            </h1>

            <div class="relative sm:max-w-sm w-full mt-12">
                <div class="card bg-blue-200 shadow-lg w-full h-full rounded-3xl absolute transform -rotate-6 z-0"></div>
                <div class="card bg-blue-600 shadow-lg w-full h-full rounded-3xl absolute transform rotate-6 z-0"></div>
                
                <div class="relative w-full rounded-3xl px-6 py-4 bg-gray-100 shadow-md z-10">
                    <label class="block mt-3 text-base text-gray-700 text-center font-semibold">
                        Responsabilidades Universales
                    </label>
                    
                    <form class="mt-10">
                        <div>
                            <label class="block text-gray-700">Empresa</label>
                            <select wire:model.live="empresa_id"
                                class="mt-1 block w-full border-none bg-gray-100 h-11 rounded-xl shadow-lg 
                                hover:bg-blue-100 focus:bg-blue-100 focus:ring-0">
                                <option value="">Seleccione una empresa</option>
                                @foreach($empresas as $empresa)
                                    <option value="{{ $empresa->id }}">{{ $empresa->nombre }}</option>
                                @endforeach
                            </select>
                            @error('empresa_id') 
                                    <span class="text-red-500 text-sm">{{ $message }}</span> 
                            @enderror
                        </div>
    
    
                        <!-- Selección de Sucursal -->
                        <div class="mt-4">
                            <label class="block text-gray-700">Sucursal</label>
                            <select wire:model.live="sucursal_id"
                                class="mt-1 block w-full border-none bg-gray-100 h-11 rounded-xl shadow-lg 
                                hover:bg-blue-100 focus:bg-blue-100 focus:ring-0">
                                <option value="">Seleccione una sucursal</option>
                                @foreach($sucursales as $sucursal)
                                    <option value="{{ $sucursal->id }}">{{ $sucursal->nombre_sucursal }}</option>
                                @endforeach
                            </select>
                            @error('sucursal_id') 
                                <span class="text-red-500 text-sm">{{ $message }}</span> 
                            @enderror
                        </div>

                        <div class="mt-4">
                            <label class="block text-gray-700">Sistema</label>  <!-- Se agregará un campo de sistema -->
                            <input 
                                type="text" 
                                wire:model="sistema" 
                                class="mt-1 block w-full border-none bg-gray-100 h-11 rounded-xl shadow-lg 
                                hover:bg-blue-100 focus:bg-blue-100 focus:ring-0">
                            @error('universal.sistema')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mt-4"> 
                            <label class="block text-gray-700">Responsabilidad</label>  <!-- Se agregará un campo de responsabilidad -->               
                            <input 
                                type="text" 
                                wire:model="responsalidad" 
                                class="mt-1 block w-full border-none bg-gray-100 h-11 rounded-xl shadow-lg 
                                hover:bg-blue-100 focus:bg-blue-100 focus:ring-0"> 
                            @error('universal.responsabilidad')    
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror                      
                        </div>

                        <div class="mt-7">
                            <button 
                                wire:click="store()"
                                class="bg-blue-500 w-full py-3 rounded-xl text-white shadow-xl 
                                hover:shadow-inner focus:outline-none transition duration-500 ease-in-out 
                                transform hover:scale-105">
                                Guardar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
