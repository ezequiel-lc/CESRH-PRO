<div>
    <div class="bg-white shadow-md rounded-lg p-6 mx-4 my-6">
        <p class="text-center text-xl font-extrabold text-black md:text-3xl">
            Pregunta
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

    <!-- Respuesta 1 -->
    <div class="bg-white shadow-md rounded-lg p-6 mx-4 my-6">
        <p class="text-center text-xl font-extrabold text-black md:text-3xl">
            Respuestas
        </p>
        <div class="mb-6">
            <label for="respuesta1" class="block text-sm font-medium text-gray-700 mb-2">
                Respuesta 1
            </label>
            <textarea
                id="respuesta1"
                wire:model.live="respuestas.0.texto"
                rows="3"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition duration-150 ease-in-out"
                placeholder="Ingrese la respuesta..."></textarea>
            <x-input-error for="respuestas.0.texto" />
        </div>
        <div class="mb-6">
            <label for="puntuacion1" class="block text-sm font-medium text-gray-700 mb-2">
                Puntuación (0-4) <!-- Updated label -->
            </label>
            <input
                type="number"
                id="puntuacion1"
                wire:model.live="respuestas.0.puntuacion"
                min="0" 
                max="4"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition duration-150 ease-in-out"
                placeholder="Ingrese la puntuación (0-4)..."> <!-- Updated placeholder -->
            <x-input-error for="respuestas.0.puntuacion" />
        </div>
    </div>

    <!-- Respuesta 2 -->
    <div class="bg-white shadow-md rounded-lg p-6 mx-4 my-6">
        <p class="text-center text-xl font-extrabold text-black md:text-3xl">
            Respuestas
        </p>
        <div class="mb-6">
            <label for="respuesta2" class="block text-sm font-medium text-gray-700 mb-2">
                Respuesta 2
            </label>
            <textarea
                id="respuesta2"
                wire:model.live="respuestas.1.texto"
                rows="3"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition duration-150 ease-in-out"
                placeholder="Ingrese la respuesta..."></textarea>
            <x-input-error for="respuestas.1.texto" />
        </div>
        <div class="mb-6">
            <label for="puntuacion2" class="block text-sm font-medium text-gray-700 mb-2">
                Puntuación (0-4) <!-- Updated label -->
            </label>
            <input
                type="number"
                id="puntuacion2"
                wire:model.live="respuestas.1.puntuacion"
                min="0" 
                max="4"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition duration-150 ease-in-out"
                placeholder="Ingrese la puntuación (0-4)..."> <!-- Updated placeholder -->
            <x-input-error for="respuestas.1.puntuacion" />
        </div>
    </div>

    <!-- Respuesta 3 -->
    <div class="bg-white shadow-md rounded-lg p-6 mx-4 my-6">
        <p class="text-center text-xl font-extrabold text-black md:text-3xl">
            Respuestas
        </p>
        <div class="mb-6">
            <label for="respuesta3" class="block text-sm font-medium text-gray-700 mb-2">
                Respuesta 3
            </label>
            <textarea
                id="respuesta3"
                wire:model.live="respuestas.2.texto"
                rows="3"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition duration-150 ease-in-out"
                placeholder="Ingrese la respuesta..."></textarea>
            <x-input-error for="respuestas.2.texto" />
        </div>
        <div class="mb-6">
            <label for="puntuacion3" class="block text-sm font-medium text-gray-700 mb-2">
                Puntuación (0-4) <!-- Updated label -->
            </label>
            <input
                type="number"
                id="puntuacion3"
                wire:model.live="respuestas.2.puntuacion"
                min="0"
                max="4"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition duration-150 ease-in-out"
                placeholder="Ingrese la puntuación (0-4)..."> <!-- Updated placeholder -->
            <x-input-error for="respuestas.2.puntuacion" />
        </div>
    </div>

    <!-- Respuesta 4 -->
    <div class="bg-white shadow-md rounded-lg p-6 mx-4 my-6">
        <p class="text-center text-xl font-extrabold text-black md:text-3xl">
            Respuestas
        </p>
        <div class="mb-6">
            <label for="respuesta4" class="block text-sm font-medium text-gray-700 mb-2">
                Respuesta 4
            </label>
            <textarea
                id="respuesta4"
                wire:model.live="respuestas.3.texto"
                rows="3"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition duration-150 ease-in-out"
                placeholder="Ingrese la respuesta..."></textarea>
            <x-input-error for="respuestas.3.texto" />
        </div>
        <div class="mb-6">
            <label for="puntuacion4" class="block text-sm font-medium text-gray-700 mb-2">
                Puntuación (0-4) <!-- Updated label -->
            </label>
            <input
                type="number"
                id="puntuacion4"
                wire:model.live="respuestas.3.puntuacion"
                min="0" 
                max="4"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition duration-150 ease-in-out"
                placeholder="Ingrese la puntuación (0-4)..."> <!-- Updated placeholder -->
            <x-input-error for="respuestas.3.puntuacion" />
        </div>
    </div>

    <div class="bg-white shadow-md rounded-lg p-6 mx-4">
        <div>
            <button
                wire:click="savePreguntaSucursal"
                class="w-full inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-150 ease-in-out">
                Guardar Pregunta
            </button>
        </div>
    </div>
</div>