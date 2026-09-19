<div class="p-6">
    <div class="bg-white shadow-lg rounded-lg p-6">
        <!-- Header -->
        <div class="border-b border-gray-300 pb-4 mb-4">
            <h2 class="text-xl font-bold text-gray-900">Agregar Compromiso</h2>
        </div>

        <!-- Formulario -->
        <form wire:submit.prevent="save" class="space-y-6">
            <!-- Pregunta -->
            <div>
                <label for="pregunta_id" class="block text-sm font-medium text-gray-700">Pregunta Relacionada</label>
                <select
                    wire:model="pregunta_id"
                    id="pregunta_id"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                    <option value="">Seleccione una pregunta</option>
                    @foreach($preguntas as $pregunta)
                    <option value="{{ $pregunta->id }}">{{ $pregunta->texto }}</option>
                    @endforeach
                </select>
                @error('pregunta_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Compromiso -->
            <div>
                <label for="compromiso" class="block text-sm font-medium text-gray-700">Compromiso</label>
                <textarea
                    wire:model="compromiso"
                    id="compromiso"
                    rows="3"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                    placeholder="Escribe tu compromiso aquí..."></textarea>
                @error('compromiso') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Fecha Inicio -->
            <div>
                <label for="fecha_inicio" class="block text-sm font-medium text-gray-700">Fecha de Inicio</label>
                <input
                    type="date"
                    wire:model="fecha_inicio"
                    id="fecha_inicio"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                @error('fecha_inicio') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Fecha Término -->
            <div>
                <label for="fecha_termino" class="block text-sm font-medium text-gray-700">Fecha de Término</label>
                <input
                    type="date"
                    wire:model="fecha_termino"
                    id="fecha_termino"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                @error('fecha_termino') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Botones -->
            <div class="flex justify-end gap-4">
                <a
                    href="{{ route('portal360.compromiso.compromiso-trabajador.mostrar-compromiso-trabajador') }}"
                    class="bg-gray-500 hover:bg-gray-600 text-white font-semibold py-2 px-6 rounded-lg shadow transition duration-200">
                    Cancelar
                </a>
                <button
                    type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg shadow transition duration-200">
                    Guardar Compromiso
                </button>
            </div>
        </form>

        <!-- Mensaje de Éxito -->
        @if (session()->has('message'))
        <div class="mt-4 p-4 bg-green-100 text-green-700 rounded-md">
            {{ session('message') }}
        </div>
        @endif
    </div>
</div>