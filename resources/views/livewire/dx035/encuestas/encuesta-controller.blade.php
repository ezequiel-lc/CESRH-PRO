<div>
    <h2>{{ $encuestaId ? 'Editar Encuesta' : 'Agregar Encuesta' }}</h2>

    <form wire:submit.prevent="submit">
        <div>
            <label for="clave">Clave:</label>
            <input type="text" id="clave" wire:model="clave">
            @error('clave') <span>{{ $message }}</span> @enderror
        </div>
        <div>
            <label for="empresa">Empresa:</label>
            <input type="text" id="empresa" wire:model="empresa">
            @error('empresa') <span>{{ $message }}</span> @enderror
        </div>
        <div>
            <label for="estado">Estado:</label>
            <input type="checkbox" id="estado" wire:model="estado">
            @error('estado') <span>{{ $message }}</span> @enderror
        </div>
        <div>
            <label for="numeroEncuestas">Número de Encuestas:</label>
            <input type="number" id="numeroEncuestas" wire:model="numeroEncuestas">
            @error('numeroEncuestas') <span>{{ $message }}</span> @enderror
        </div>

        <button type="submit">{{ $encuestaId ? 'Actualizar' : 'Guardar' }}</button>
    </form>

    @if ($encuestaId)
        <button wire:click="delete({{ $encuestaId }})">Eliminar Encuesta</button>
    @endif

    <!-- Aquí añades el componente PowerGrid -->
    <livewire:powergrid.encuesta-power-grid />
</div>
