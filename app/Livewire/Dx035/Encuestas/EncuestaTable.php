<?php

namespace App\Livewire\Dx035\Encuestas;

use App\Models\Dx035\Encuesta;
use App\Models\Dx035\EncuestaCuestionario;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Facades\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\PowerGridColumns;
use Illuminate\Database\Eloquent\Builder;


use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\PowerGridFields;

use Illuminate\Support\Facades\Crypt;

use PowerComponents\LivewirePowerGrid\Traits\WithExport;
use PowerComponents\LivewirePowerGrid\Components\SetUp\Exportable;

use Illuminate\Support\Facades\Blade;

final class EncuestaTable extends PowerGridComponent
{
    public string $tableName = 'encuestas_table'; // Nombre único para la tabla
    public string $primaryKey = 'id';            // Especificar que la clave primaria es 'id'
    public string $keyType = 'int';              // Especificar que la clave primaria es de tipo int

    public function setUp(): array
    {
        return [
            PowerGrid::header()
                ->showSearchInput(), // Habilitar la barra de búsqueda

            PowerGrid::footer()
                ->showPerPage() // Mostrar selector de elementos por página
                ->showRecordCount(), // Mostrar contador de registros
        ];
    }

    public function datasource(): Builder
    {
        return Encuesta::query();
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('Empresa')
            ->add('Formato')
            ->add('rating_stars', fn ($dish) => Blade::render('<x-icons.arrow/>')) // Campo virtual
            ->add('FechaInicio')
            ->add('FechaFinal')
            ->add('Estado')
            ->add('EncuestasContestadas');
    }

    public function columns(): array
    {
        return [
            Column::make('ID', 'id')
                ->sortable(),

            Column::make('Empresa', 'Empresa')
                ->searchable()
                ->sortable(),

            Column::make('Cuestionarios', 'Formato')
                ->bodyAttribute('text-center'),

            // Columna personalizada para "Compartir"

            Column::make('Rating', 'rating_stars')
            ->bodyAttribute('text-center'),

            Column::make('Inicio', 'FechaInicio')
                ->sortable(),

            Column::make('Cierre', 'FechaFinal')
                ->sortable(),

            Column::make('Estado', 'Estado')
                ->bodyAttribute('text-center'),

            Column::make('Avance', 'EncuestasContestadas')
                ->bodyAttribute('text-center'),

            // Columna de acciones (editar y eliminar)
            Column::action('Acciones'),
        ];
    }

    public function actions(EncuestaCuestionario $row): array
    {
        return [

            // Botón: Editar
            Button::add('edit')
                ->slot('<i class="fas fa-edit"></i>')
                ->class('btn btn-sm btn-primary')
                ->route('encuestas.edit', ['id' => $row->encuesta_id]),

            // Botón: Eliminar
            Button::add('delete')
                ->slot('<i class="fas fa-trash"></i>')
                ->class('btn btn-sm btn-danger')
                ->dispatch('confirmDelete', ['id' => $row->encuesta_id]), // Emitir evento para eliminar
        ];
    }
}
