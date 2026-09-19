<?php

namespace App\Livewire\Portal360\Preguntas\PreguntasEmpresa;

use App\Models\Encuestas360\Respuesta;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Components\SetUp\Exportable;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Facades\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\Traits\WithExport;


final class PreguntasEmpresaTable extends PowerGridComponent
{
    public string $tableName = 'preguntas-empresa-table-nllzw2-table';
    use WithExport;
    public function setUp(): array
    {
        $this->showCheckBox();

        return [
            PowerGrid::exportable(fileName: 'preguntas')
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
            PowerGrid::header()
                ->showSearchInput(),
            PowerGrid::footer()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    public function datasource(): Builder
    {
        return Respuesta::query()
            ->join('preguntas', 'preguntas.id', '=', '360_respuestas.preguntas_id')
            ->join('sucursales', 'sucursales.id', '=', '360_respuestas.sucursal_id') // Cambiado de 'empresas' a 'sucursales'
            ->select([
                '360_respuestas.id',
                'preguntas.id as pregunta_id',
                'preguntas.texto',
                'preguntas.descripcion',
                '360_respuestas.texto as respuesta_texto',
                '360_respuestas.puntuacion',
                'sucursales.nombre_sucursal as sucursal_nombre' // Cambiado de 'empresas.nombre as empresa_nombre'
            ])
            ->where('360_respuestas.empresa_id', Auth::user()->empresa_id);
    
    }

    public function relationSearch(): array
    {
        return [
            'pregunta' => [ // Relación con la tabla 'preguntas' (usando el nombre correcto de la relación)
                'texto',       // Columna en la tabla 'preguntas'
                'descripcion', // Columna en la tabla 'preguntas'
            ],
            'empresa' => [ // Relación con la tabla 'empresas'
                'nombre',     // Columna en la tabla 'empresas'
            ],
            'sucursal' => [ // Relación con la tabla 'sucursales'
                'nombre_sucursal', // Columna en la tabla 'sucursales'
            ],
        ];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('pregunta_id')
            ->add('texto')
            ->add('descripcion')
            ->add('respuesta_texto')
            ->add('puntuacion')
            ->add('sucursal_nombre'); // Cambiado de 'empresa_nombre'
    }

    public function columns(): array
    {
        return [
            Column::make('Id', 'id'),
            Column::make('Pregunta', 'texto')
                ->sortable()
                ->searchable(),

            Column::make('Descripción', 'descripcion')
                ->sortable()
                ->searchable(),

            Column::make('Respuesta', 'respuesta_texto')
                ->sortable()
                ->searchable(),

            Column::make('Puntuación', 'puntuacion')
                ->sortable()
                ->searchable(),

            Column::make('Sucursal', 'sucursal_nombre') // Cambiado de 'Empresa', 'empresa_nombre'
                ->sortable()
                ->searchable(),

            Column::action('Action')
        ];
    }


    public function filters(): array
    {
        return [];
    }

    #[\Livewire\Attributes\On('edit')]
    public function edit($rowId): void
    {
        $this->js('alert(' . $rowId . ')');
    }

    public function actions(Respuesta $row): array
    {
        $preguntaId = $row->pregunta_id;


        return [
            Button::add('edit')
                ->slot('<svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 inline-block mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M17.414 2.586a2 2 0 0 1 0 2.828l-10 10A2 2 0 0 1 6 16H4a1 1 0 0 1-1-1v-2a2 2 0 0 1 .586-1.414l10-10a2 2 0 0 1 2.828 0zM5 13v2h2l10-10-2-2L5 13z"/>
                        </svg> Editar') 
                ->class('bg-blue-500 hover:bg-blue-700 text-white font-semibold py-2 px-3 rounded-lg shadow-md transition-all duration-300 flex items-center')
                ->route('editarPreguntaEmpre', ['id' => Crypt::encrypt($preguntaId)]),
    
            Button::add('delete')
                ->slot('<svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 inline-block mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M6 2a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v1h3a1 1 0 1 1 0 2h-1v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5H2a1 1 0 1 1 0-2h3V2zm2 1v1h4V3H8zM5 5v11h10V5H5zm3 3a1 1 0 0 1 2 0v5a1 1 0 0 1-2 0V8zm4 0a1 1 0 0 1 2 0v5a1 1 0 0 1-2 0V8z" clip-rule="evenodd"/>
                        </svg> Eliminar') 
                ->class('bg-red-500 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded-lg shadow-md transition-all duration-300 flex items-center')
                ->dispatch('confirmarEliminarPreguntaEmpresa', ['id' => Crypt::encrypt($preguntaId)]),
        ];
    }
}
