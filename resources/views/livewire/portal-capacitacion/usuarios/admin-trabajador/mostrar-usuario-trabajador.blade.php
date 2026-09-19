<div class="flex flex-col items-center min-h-screen relative mx-auto bg-gray-100 shadow-lg rounded-lg p-6 border border-gray-200 py-10 px-4">
    <div class="text-center mb-8">
        <h2 class="text-3xl font-bold text-blue-900 sm:text-4xl">Mi Perfil de Puesto</h2>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 max-w-3xl justify-center">
        @if($user) 
        <div class="bg-white rounded-xl shadow-lg overflow-hidden transition-transform transform hover:scale-105"> 
            <!-- Imagen de portada -->
            <div class="h-[180px] w-full overflow-hidden">
                <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name ?? 'Usuario') }}&background=random" 
                     alt="Foto de {{ $user->name ?? 'Usuario' }}" 
                     class="w-full h-full object-cover object-center">
            </div>
        
            <!-- Contenido de la tarjeta -->
            <div class="p-6 text-center">
                <p class="text-xl font-semibold text-gray-800">{{ $user->name }}</p>
                <p class="text-gray-600 text-sm mt-3">{{ $user->email }}</p>
        
                <a href="{{ route('vermasUsuariosTrabajador', Crypt::encrypt($user->id)) }}" 
                    class="block mt-6 px-4 py-2 bg-blue-900 text-white text-sm rounded-lg hover:bg-blue-700 transition">
                    Ver más
                </a>
            </div>
        </div>        
        @else
            <p class="text-gray-500 text-lg col-span-full text-center">No hay usuarios registrados.</p>
        @endif
    </div>
</div>
