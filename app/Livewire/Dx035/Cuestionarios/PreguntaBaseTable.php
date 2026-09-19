<?php

namespace App\Livewire\Dx035\Cuestionarios;

use App\Models\Dx035\PreguntaBase;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Facades\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\PowerGridColumns;

class PreguntaBaseTable extends PowerGridComponent
{
    public string $tableName = 'pregunta-base-table';

    public function setUp(): array
    {
        return [
            PowerGrid::header()
                ->showSearchInput(),
            PowerGrid::footer()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    public function datasource()
    {
        return PreguntaBase::query();
    }

    public function addColumns(): PowerGridColumns
    {
        return PowerGrid::columns()
            ->addColumn('id')
            ->addColumn('pregunta')
            ->addColumn('seccion')
            ->addColumn('categoria')
            ->addColumn('dominio')
            ->addColumn('dimension')
            ->addColumn('puntuacion')
            ->addColumn('cuestionarios_id');
    }

    public function columns(): array
    {
        return [
            Column::make('ID', 'id'),
            Column::make('Pregunta', 'Pregunta'),
            Column::make('Sección', 'Seccion'),
            Column::make('Categoría', 'Categoria'),
            Column::make('Dominio', 'Dominio'),
            Column::make('Dimensión', 'Dimension'),
            Column::make('Puntuación', 'Puntuacion'),
            Column::make('Cuestionario ID', 'cuestionarios_id'),
            Column::action('Acciones'), // Columna de acciones
        ];
    }

    public function filters(): array
    {
        return [
           
        ];
    }

    public function actions(PreguntaBase $row): array
    {
        return [
            Button::add('edit')
                ->slot('Editar')
                ->class('bg-blue-500 text-white px-2 py-1 rounded')
                ->route('preguntas.editar', ['id' => $row->id]),
        ];
    }
}
