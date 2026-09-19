<div class="flex min-h-screen items-start justify-center pt-6">
    <div class="grid bg-white rounded-lg shadow-xl w-full"> <br>

        <div class="flex justify-center">
            <div class="flex">
                <h1 class="text-gray-600 font-bold md:text-2xl text-xl">Mis Incidencias</h1>
            </div>
        </div>

        <div class="mt-5 mx-7">
            @if ($retardos->isEmpty())
                <div class="p-6 text-center text-gray-600">
                    <p>Sin retardos actualmente</p>
                </div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 p-6">
                    @foreach ($retardos as $retardo)
                        <div class="w-full mx-auto bg-white shadow-xl rounded-lg text-gray-900 p-4">
                            <div class="rounded-t-lg h-32 overflow-hidden">
                                <img class="object-cover object-top w-full" src="{{ asset('img/cesrh.jpeg') }}"
                                    alt="Background">
                            </div>

                            <div class="text-center mt-2">
                                <h2><strong>Usuario:</strong>
                                    {{ $retardo->users->first() ? $retardo->users->first()->name : 'Sin asignar' }}
                                </h2>
                                <p><strong>Fecha:</strong> {{ $retardo->fecha }}</p>
                                <p><strong>Hora de entrada programada:</strong> {{ $retardo->hora_entrada_programada }}</p>
                                <p><strong>Hora de entrada real:</strong> {{ $retardo->hora_entrada_real }}</p>
                                <p><strong>Minutos de retardo:</strong> {{ $retardo->minutos_retardo }}</p>
                                <p class="my-2">
                                    <strong>Status:</strong> 
                                    <span class="py-1 px-3 rounded text-white 
                                        {{ $retardo->status === 'Activo' ? 'bg-green-500' : 'bg-red-500' }}">
                                        {{ $retardo->status }}
                                    </span>
                                </p> 
                            </div>

                            <div class="flex gap-4 mt-4">
                                <!-- Aquí pueden ir botones o acciones -->
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <!-- Botones -->
        <div class="flex items-center justify-center md:gap-8 gap-4 pt-5 pb-5">
            <button type="button" onclick="window.history.back()"
                class="w-auto bg-green-500 hover:bg-green-700 rounded-lg shadow-xl font-medium text-white px-4 py-2">
                Volver
            </button>
        </div>
    </div>
</div>