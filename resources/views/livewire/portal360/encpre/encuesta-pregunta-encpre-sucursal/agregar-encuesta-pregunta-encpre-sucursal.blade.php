<div>
    <div class="py-6 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <div class="mb-8">
                <h1 class="text-2xl font-semibold text-gray-900">Agregar Pregunta a Encuesta</h1>
                <p class="mt-2 text-sm text-gray-700">Seleccione primero la encuesta y luego las preguntas.</p>
            </div>

            <div class="bg-white shadow rounded-lg p-6">
                <div class="space-y-6">
                    <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-1">
                        <!-- Encuesta Selector -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                1. Seleccionar Encuesta
                            </label>
                            <div class="relative">
                                <select
                                    wire:model.live="formData.encuestas_id"
                                    class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 rounded-md">
                                    <option value="">Seleccione una encuesta</option>
                                    @foreach($encuestas as $encuesta)
                                    <option value="{{ $encuesta->id }}">{{ $encuesta->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('formData.encuestas_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Preguntas Checkboxes -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                2. Seleccionar Preguntas
                            </label>
                            <div class="mt-2 space-y-2 max-h-64 overflow-y-auto border rounded-md p-2">
                                @if(empty($formData['encuestas_id']))
                                    <p class="text-sm text-gray-500">Primero seleccione una encuesta</p>
                                @elseif($preguntas->isEmpty())
                                    <p class="text-sm text-amber-600">No hay preguntas disponibles</p>
                                @else
                                    @foreach($preguntas as $index => $pregunta)
                                    <div class="flex items-center">
                                        <input
                                            type="checkbox"
                                            wire:model.live="formData.preguntas_id"
                                            value="{{ $pregunta->id }}"
                                            id="pregunta_{{ $pregunta->id }}"
                                            class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                        <label for="pregunta_{{ $pregunta->id }}" class="ml-2 text-sm text-gray-900">
                                            {{ $index + 1 }}. {{ $pregunta->texto }}
                                        </label>
                                    </div>
                                    @endforeach
                                @endif
                            </div>
                            @error('formData.preguntas_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="flex justify-end space-x-3 mt-6 pt-6 border-t border-gray-200">
                        <button
                            wire:click="guardar"
                            type="submit"
                            wire:loading.attr="disabled"
                            @if(empty($formData['encuestas_id']) || $preguntas->isEmpty()) disabled @endif
                            class="px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 disabled:opacity-50 disabled:cursor-not-allowed">
                            <span wire:loading.remove>Guardar</span>
                            <span wire:loading>Guardando...</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>