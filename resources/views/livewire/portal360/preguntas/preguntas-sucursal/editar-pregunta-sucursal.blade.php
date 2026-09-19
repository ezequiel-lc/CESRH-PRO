<div>
    <div class="bg-white shadow-md rounded-lg p-6 mx-4 my-6">
        <p class="text-center text-xl font-extrabold text-black md:text-3xl">
            Editar Pregunta
        </p>
        <div>
            <div class="mb-6">
                <label for="texto" class="block text-sm font-medium text-gray-700 mb-2">
                    Pregunta
                </label>
                <textarea
                    id="texto"
                    wire:model.live="pregunta.texto"
                    rows="4"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition duration-150 ease-in-out"
                    placeholder="Ingrese el texto de la pregunta..."></textarea>
                <x-input-error for="pregunta.texto" />
            </div>
            <div class="mb-6">
                <label for="descripcion" class="block text-sm font-medium text-gray-700 mb-2">
                    Descripción
                </label>
                <textarea
                    id="descripcion"
                    wire:model.live="pregunta.descripcion"
                    rows="3"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition duration-150 ease-in-out"
                    placeholder="Ingrese la descripción..."></textarea>
                <x-input-error for="pregunta.descripcion" />
            </div>
        </div>
    </div>

    <!-- Resto del código para las respuestas -->
    @foreach ($respuestas as $index => $respuesta)
    <div class="bg-white shadow-md rounded-lg p-6 mx-4 my-6">
        <p class="text-center text-xl font-extrabold text-black md:text-3xl">
            Respuesta {{ $index + 1 }}
        </p>
        <div class="mb-6">
            <label for="respuesta{{ $index + 1 }}" class="block text-sm font-medium text-gray-700 mb-2">
                Respuesta {{ $index + 1 }}
            </label>
            <textarea
                id="respuesta{{ $index + 1 }}"
                wire:model.live="respuestas.{{ $index }}.texto"
                rows="3"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition duration-150 ease-in-out"
                placeholder="Ingrese la respuesta {{ $index + 1 }}..."></textarea>
            <x-input-error for="respuestas.{{ $index }}.texto" />
        </div>
        <div class="mb-6">
            <label for="puntuacion{{ $index + 1 }}" class="block text-sm font-medium text-gray-700 mb-2">
                Puntuación (0-4) <!-- Updated label -->
            </label>
            <input
                type="number"
                id="puntuacion{{ $index + 1 }}"
                wire:model.live="respuestas.{{ $index }}.puntuacion"
                min="0" 
                max="4"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition duration-150 ease-in-out"
                placeholder="Ingrese la puntuación (0-4)..."> <!-- Updated placeholder -->
            <x-input-error for="respuestas.{{ $index }}.puntuacion" />
        </div>
    </div>
    @endforeach

    <div class="bg-white shadow-md rounded-lg p-6 mx-4">
        <div>
            <button
                wire:click="editarSucursaldx"
                class="w-full inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-150 ease-in-out">
                Guardar Cambios
            </button>
        </div>
    </div>
</div>