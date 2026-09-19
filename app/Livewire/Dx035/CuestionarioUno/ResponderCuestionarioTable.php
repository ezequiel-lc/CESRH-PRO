<?php

namespace App\Livewire\Dx035\CuestionarioUno;

use app\Models\Dx035\PreguntaBase;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Facades\Rule;
use PowerComponents\LivewirePowerGrid\Facades\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;

final class ResponderCuestionarioTable extends PowerGridComponent
{
    use ActionButton;

    public $cuestionario_id;

    public string $tableName = 'responder-cuestionario-table-jncvvc-table';

    public function setUp()
    {
        $this->showCheckBox()
            ->showPerPage(10)
            ->showExportOption('download', ['excel', 'csv'])
            ->showSearchInput();
    }

    public function datasource()
    {
        return PreguntaBase::where('cuestionarios_id', $this->cuestionario_id);
    }

    public function addColumns(): PowerGrid
    {
        return PowerGrid::columns([
            PowerGrid::column('id', 'ID'),
            PowerGrid::column('Seccion', 'Sección'),
            PowerGrid::column('Pregunta', 'Pregunta'),
            PowerGrid::column('respuesta', 'Respuesta')
                ->editable(true, 'respuesta'), // Permitir editar la respuesta
        ]);
    }

    public function actions(): array
    {
        return [
            Button::add('guardar-respuestas')
                ->caption('Guardar Respuestas')
                ->class('bg-blue-500 text-white px-4 py-2 rounded')
                ->emit('guardarRespuestas', []),
        ];
    }

    public function guardarRespuestas()
    {
        // Obtener las respuestas del grid
        $respuestas = $this->fillData();

        // Crear un registro en TrabajadorEncuesta
        $trabajadorEncuesta = TrabajadorEncuesta::create([
            'Clave' => $this->cuestionario_id,
            'users_id' => Auth::id(), // Asumiendo que el usuario está autenticado
            'Avance' => 100, // Marcar como completado
        ]);

        // Guardar las respuestas en la base de datos
        foreach ($respuestas as $pregunta_id => $respuesta) {
            Respuesta::create([
                'trabajadores_encuestas_id' => $trabajadorEncuesta->id,
                'preguntas_bases_id' => $pregunta_id,
                'respuesta' => $respuesta['respuesta'],
            ]);
        }

        // Mostrar un mensaje de éxito
        $this->dispatchBrowserEvent('alert', [
            'type' => 'success',
            'message' => 'Respuestas guardadas exitosamente.',
        ]);
    }

    public function render()
    {
        return view('livewire.dx035.cuestionario-uno.responder-cuestionario-table');
    }
}
