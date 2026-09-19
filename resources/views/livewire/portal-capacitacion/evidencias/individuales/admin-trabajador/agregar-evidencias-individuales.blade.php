<div class="max-w-3xl mx-auto bg-white p-10 rounded-xl shadow-2xl space-y-8">
    <h2 class="text-2xl font-bold text-center text-gray-800">📁 Subir Evidencia</h2>

    <form wire:submit.prevent="save" enctype="multipart/form-data" class="space-y-6">
        <!-- Input de Archivo (Evidencias) -->
        <div class="space-y-3">
            <label for="evidencias" class="block text-lg font-semibold text-gray-700">📷 Evidencias</label>
            <input type="file" wire:model="evidencias" id="evidencias" 
                   class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 transition duration-300 hover:scale-105 bg-gray-50"
                   accept="image/*">
            @error('evidencias') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

            <!-- Previsualización de la imagen (Reducida) -->
            @if ($evidencias)
                <div class="mt-3 flex justify-center">
                    <img src="{{ $evidencias->temporaryUrl() }}" 
                         alt="Evidencia Preview" 
                         class="max-w-48 max-h-48 object-cover rounded-lg shadow-md border border-gray-300">
                </div>
            @endif
        </div>

        <!-- Textarea de Comentarios -->
        <div class="space-y-3">
            <label for="comentarios" class="block text-lg font-semibold text-gray-700">💬 Comentarios</label>
            <textarea wire:model="comentarios" id="comentarios" 
                      class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300 hover:scale-105 bg-gray-50"
                      placeholder="Escribe algún comentario (opcional)"></textarea>
            @error('comentarios') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Select de Estado -->
        <div class="space-y-3">
            <label for="status" class="block text-lg font-semibold text-gray-700">📌 Estado</label>
            <select wire:model="status" id="status"
                    class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 transition duration-300 hover:scale-105 bg-gray-50">
                    <option value="pendiente">Selecciona un estado</option>
                    <option value="pendiente">Pendiente</option>
                    <option value="completado">Completado</option>
                    <option value="en_proceso">En proceso</option>
            </select>
            @error('status') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Input de Fecha -->
        <div class="space-y-3">
            <label for="fecha" class="block text-lg font-semibold text-gray-700">📅 Fecha</label>
            <input type="date" wire:model="fecha" id="fecha"
                   class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 transition duration-300 hover:scale-105 bg-gray-50">
            @error('fecha') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="flex justify-center gap-4">
            <!-- Botón Guardar -->
            <button type="submit"
                    class="w-72 bg-green-500 text-white py-3 rounded-lg hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500 transition duration-300 transform hover:scale-105 flex items-center justify-center gap-2 shadow-lg">
                Guardar Evidencia
            </button>

            <button type="button"
                    onclick="window.history.back()"
                    class="w-72 bg-red-500 text-white py-3 rounded-lg hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 transition duration-300 transform hover:scale-105 flex items-center justify-center gap-2 shadow-lg">
                Cancelar
            </button>
        </div>
        

        @if (session()->has('message'))
            <div class="mt-4 text-green-700 bg-green-100 p-4 rounded-lg border border-green-300 shadow">
                {{ session('message') }}
            </div>
        @endif
    </form>
</div>
