<div class="max-w-3xl mx-auto bg-gradient-to-r from-white to-white p-10 rounded-xl shadow-2xl space-y-8">
    <h2 class="text-3xl font-bold text-center text-blue-800">📁 Subir Evidencia</h2>

    <form wire:submit.prevent="save" enctype="multipart/form-data" class="space-y-6">
        <!-- Input de Archivo (Evidencias) -->
        <div class="space-y-3">
            <label for="evidencias" class="block text-lg font-semibold text-gray-700">📷 Evidencias</label>
            <input type="file" id="evidencias" multiple 
                class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 transition duration-300 hover:scale-105 bg-gray-50"
                accept="image/*"
                wire:model="evidencias">
            @error('evidencias') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

            <div class="mt-4">
                <h3 class="text-lg font-bold">Imágenes seleccionadas:</h3>
                <div class="grid grid-cols-3 gap-4 mt-2">
                    @foreach ($evidenciasPreview as $index => $image)
                        <div class="relative">
                            <img src="{{ $image }}" class="max-w-48 max-h-48 object-cover rounded-lg shadow-md border border-gray-300">
                            <button type="button" wire:click.prevent="removeImage({{ $index }})"
                                class="absolute top-0 right-0 bg-red-500 text-white px-2 py-1 text-xs rounded">
                                X
                            </button>
                        </div>
                    @endforeach
                </div>
            </div>
            
        </div>

        <!-- Input de Archivo (PDF) -->
        <div class="space-y-3">
            <label for="documento" class="block text-lg font-semibold text-gray-700">📄 Documento PDF</label>
            <input type="file" wire:model="documento"
                class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 transition duration-300 hover:scale-105 bg-gray-50"
                accept="application/pdf">
            @error('documento') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

            @if ($documentoPreview)
                <h3 class="text-lg font-bold">Vista previa del PDF:</h3>
                <iframe src="{{ $documentoPreview }}" class="w-full h-64 border rounded"></iframe>
            @endif

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

<script>
    document.addEventListener('livewire:load', function () {
        window.addEventListener('refreshPreview', function () {
            // Forzar actualización sin afectar datos en la base de datos
        });
    });
</script>

    
