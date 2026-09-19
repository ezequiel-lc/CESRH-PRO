<div class="p-6 bg-white rounded-lg shadow-md">
    <h2 class="text-xl font-bold mb-4">Agregar Pregunta Base</h2>

    <!-- Mensaje de éxito -->
    @if (session()->has('message'))
        <div class="p-4 mb-4 text-sm text-green-800 bg-green-200 rounded-lg" role="alert">
            {{ session('message') }}
        </div>
    @endif

    <!-- Campos del formulario -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <!-- Pregunta -->
        <div>
            <label for="pregunta" class="block text-sm font-medium text-gray-700">Pregunta</label>
            <input type="text" id="pregunta" wire:model="pregunta" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            @error('pregunta') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Sección -->
        <div>
            <label for="seccion" class="block text-sm font-medium text-gray-700">Sección</label>
            <input type="text" id="seccion" wire:model="seccion" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            @error('seccion') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Categoría -->
        <div>
            <label for="categoria" class="block text-sm font-medium text-gray-700">Categoría</label>
            <input type="text" id="categoria" wire:model="categoria" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            @error('categoria') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Dominio -->
        <div>
            <label for="dominio" class="block text-sm font-medium text-gray-700">Dominio</label>
            <input type="text" id="dominio" wire:model="dominio" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            @error('dominio') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Dimensión -->
        <div>
            <label for="dimension" class="block text-sm font-medium text-gray-700">Dimensión</label>
            <input type="text" id="dimension" wire:model="dimension" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            @error('dimension') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Puntuación -->
        <div>
            <label for="puntuacion" class="block text-sm font-medium text-gray-700">Puntuación</label>
            <input type="number" id="puntuacion" wire:model="puntuacion" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            @error('puntuacion') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Selección de Cuestionario -->
        <div>
            <label for="cuestionarios_id" class="block text-sm font-medium text-gray-700">Cuestionario</label>
            <select id="cuestionarios_id" wire:model="cuestionarios_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                <option value="">Selecciona un cuestionario</option>
                @foreach($cuestionarios as $cuestionario)
                    <option value="{{ $cuestionario->id }}">{{ $cuestionario->Nombre }}</option>
                @endforeach
            </select>
            @error('cuestionarios_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>
    </div>

    <!-- Botón para guardar -->
    <div class="mt-6">
        <button wire:click="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
            Guardar Pregunta
        </button>
    </div>
</div>
