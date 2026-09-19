<div>
    <h1 class="text-2xl font-bold mb-4">Responder Cuestionario</h1>

    @foreach($preguntas as $pregunta)
        <div class="mb-4">
            <label class="block text-gray-700">{{ $pregunta->Pregunta }}</label>
            <select wire:model="respuestas.{{ $pregunta->id }}" class="border rounded-lg p-2">
                <option value="">Seleccione una opción</option>
                <option value="Sí">Sí</option>
                <option value="No">No</option>
            </select>
        </div>
    @endforeach

    @if($mostrarSeccionesAdicionales)
        <!-- Aquí puedes agregar las secciones adicionales si es necesario -->
    @endif

    <button wire:click="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">Enviar Respuestas</button>
</div>









<!-- <div>
    <h1>Responder Cuestionario</h1>

    <livewire:powergrid.table
        :datasource="$datasource"
        :columns="$columns"
        :actions="$actions"
    />
</div> -->
