<div class="max-w-4xl mx-auto mt-10 p-6 bg-white shadow-lg rounded-xl">
    <h1 class="text-3xl font-bold text-center text-indigo-600 mt-6 drop-shadow-lg animate-fade-in">
        Asocia un perfil de puesto a un trabajador
    </h1>
    
    <div class="mt-6"> 
        <label for="empresa" class="block text-lg font-medium text-gray-800">Seleccione una empresa:</label>
        <select wire:model.live="empresa_id" id="empresa" class="mt-2 block w-full p-3 border border-gray-300 rounded-lg shadow-md focus:ring-indigo-500 focus:border-indigo-500 transition duration-300 ease-in-out">
            <option value="">-- Seleccione --</option>
            @foreach($empresas as $empresa)
                <option value="{{ $empresa->id }}">{{ $empresa->nombre }}</option>
            @endforeach
        </select>
    </div>

    @if($empresa_id)
    <div  class="mt-6">
        <label for="sucursal" class="block text-lg font-medium text-gray-800">Seleccione una sucursal:</label>
        <select wire:model.live="sucursal_id" id="sucursal" class="mt-2 block w-full p-3 border border-gray-300 rounded-lg shadow-md focus:ring-indigo-500 focus:border-indigo-500 transition duration-300 ease-in-out">
            <option value="">-- Seleccione --</option>
            @foreach($sucursales as $sucursal)
                <option value="{{ $sucursal->id }}">{{ $sucursal->nombre_sucursal }}</option>
            @endforeach
        </select>
    </div>
    @endif

    @if($sucursal_id)
        <div  class="mt-6">
            <label class="block text-lg font-medium text-gray-800">Seleccione el tipo de personal:</label>
            <div class="flex space-x-4 mt-3">
                <button wire:click="setTipo('trabajador')" class="p-4 bg-blue-500 text-white rounded-lg shadow-lg hover:bg-blue-600 transform hover:scale-105 transition duration-300 ease-in-out flex flex-col items-center">
                    <img src="https://cdn-icons-png.flaticon.com/512/2450/2450449.png" alt="Trabajador" class="w-15 h-15 mb-2">
                    Trabajador
                </button>
                <button wire:click="setTipo('becario')" class="p-4 bg-green-500 text-white rounded-lg shadow-lg hover:bg-green-600 transform hover:scale-105 transition duration-300 ease-in-out flex flex-col items-center">
                    <img src="https://cdn-icons-png.flaticon.com/512/3854/3854900.png" alt="Becario" class="w-15 h-15 mb-2">
                    Becario
                </button>
                <button wire:click="setTipo('practicante')" class="p-4 bg-yellow-500 text-white rounded-lg shadow-lg hover:bg-yellow-600 transform hover:scale-105 transition duration-300 ease-in-out flex flex-col items-center">
                    <img src="https://cdn-icons-png.flaticon.com/512/1807/1807598.png" alt="Practicante" class="w-15 h-15 mb-2">
                    Practicante
                </button>
                <button wire:click="setTipo('instructor')" class="p-4 bg-pink-500 text-white rounded-lg shadow-lg hover:bg-pink-600 transform hover:scale-105 transition duration-300 ease-in-out flex flex-col items-center">
                    <img src="https://cdn-icons-png.flaticon.com/512/3410/3410150.png" alt="instructor" class="w-15 h-15 mb-2">
                    Instructor
                </button>
            </div>
        </div>
    @endif

    @if($tipo_seleccionado && count($opciones) > 0)
    <div  class="mt-6">
        <h3 class="text-lg font-semibold text-gray-800">Seleccione un {{ ucfirst($tipo_seleccionado) }}:</h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 mt-4">
            @foreach($opciones as $opcion)
                <div class="p-5 border rounded-xl shadow-lg hover:bg-gray-100 cursor-pointer transform hover:scale-105 transition duration-300 ease-in-out flex flex-col items-center text-center">
                    <img src="{{ $opcion->usuarios->profile_photo_path ? asset('public/ImagenProducto/' . $opcion->usuarios->profile_photo_path) : asset('https://icons.veryicon.com/png/o/miscellaneous/two-color-icon-library/user-286.png') }}" 
                        class="w-16 h-16 rounded-full mb-3 shadow-md">
                    <a class="text-lg font-semibold text-indigo-600 hover:text-indigo-800" href='{{ route("asignarPerfilPuesto", ["id" => Crypt::encrypt($opcion->id), "tipoUsuario" => $tipo_seleccionado]) }}'>{{ $opcion->usuarios->name ?? 'Sin nombre' }}</a>
                    <p class="text-sm text-gray-600">{{ $opcion->usuarios->email ?? 'Sin email' }}</p>
                </div>
            @endforeach
        </div>
    </div>
    @else
        @if($tipo_seleccionado)
            <div class="mt-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg text-center">
                No hay usuarios disponibles para este tipo de personal.
            </div>
        @endif
    @endif
</div>
