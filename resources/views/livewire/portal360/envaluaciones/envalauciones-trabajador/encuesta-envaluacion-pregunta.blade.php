<div>
    <div class="container mx-auto p-6 flex-1">
        <div class="bg-white rounded-lg shadow-lg p-8">
            <!-- Título de la encuesta -->
            <h2 class="text-3xl font-bold text-gray-800 mb-4 text-center">
                Encuesta: {{ $asignacion->encuesta->nombre }}
            </h2>
            <!-- Indicaciones -->
            <p class="text-2xl mb-8 text-left text-lg">
                {{ $asignacion->encuesta->indicaciones }}
            </p>

            <!-- Información del calificador y calificado -->
            <div class="flex flex-col sm:flex-row justify-between items-center mb-8 p-4 rounded-lg">
                <div class="text-gray-700 mb-4 sm:mb-0">
                    <!-- <p>
                        <strong class="font-semibold">Calificador:</strong> {{ $calificador->name }} (ID: {{ $calificador->id }})
                    </p>
                    <p>
                        <strong class="font-semibold">Calificado:</strong> {{ $calificado->name }} (ID: {{ $calificado->id }})
                    </p> -->
                </div>
                <div class="flex items-center">
                    <label for="perPage" class="text-sm font-medium text-gray-700 mr-3">Mostrar:</label>
                    <select wire:model.live="perPage" id="perPage" class="border border-gray-300 rounded-lg shadow-sm px-3 py-2 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                        @foreach ($perPageOptions as $option)
                        <option value="{{ $option }}">{{ $option === 'all' ? 'Todas' : $option }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Formulario de preguntas -->
            <form wire:submit.prevent="submit">
                @foreach($paginatedPreguntas as $encpre)
                @php $pregunta = $encpre->pregunta; @endphp
                <div class="mb-8 bg-gray-50 p-6 rounded-lg shadow-sm border border-gray-200" wire:key="pregunta-{{ $pregunta->id }}">
                    <!-- Texto de la pregunta -->
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">
                        {{ $pregunta->texto }}
                    </h3>
                    <!-- Descripción de la pregunta -->
                    <p class="text-gray-600 mb-4">{{ $pregunta->descripcion }}</p>

                    <!-- Opciones de respuesta -->
                    <div class="space-y-4">
                        @foreach($pregunta->respuestas as $respuesta)
                        <label class="flex items-center space-x-4 cursor-pointer">
                            <input
                                type="radio"
                                wire:model.live="respuestas.{{ $pregunta->id }}"
                                value="{{ $respuesta->id }}"
                                class="h-5 w-5 text-indigo-600 border-gray-300 focus:ring-indigo-500 transition duration-150 ease-in-out">
                            <span class="text-gray-700 text-base">
                                {{ $respuesta->texto }}
                            </span>
                        </label>
                        @endforeach
                    </div>

                    <!-- Mensaje de error -->
                    @error('respuestas.' . $pregunta->id)
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>
                @endforeach

                <!-- Paginación y botón de envío -->
                <div class="flex flex-col sm:flex-row justify-between items-center mt-10">
                    <div class="text-gray-600 mb-4 sm:mb-0">
                        {{ $paginatedPreguntas->links() }}
                    </div>
                    <button
                        type="submit"
                        class="bg-indigo-600 text-white px-6 py-3 rounded-lg hover:bg-indigo-700 transition duration-200 ease-in-out shadow-md">
                        Completar Encuesta
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>