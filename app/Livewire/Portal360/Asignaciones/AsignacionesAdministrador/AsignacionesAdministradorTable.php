<?php

namespace App\Livewire\Portal360\Asignaciones\AsignacionesAdministrador;

use App\Models\Encuestas360\Asignacion;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Crypt;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Components\SetUp\Exportable;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Facades\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\Traits\WithExport;


final class AsignacionesAdministradorTable extends PowerGridComponent
{
    public string $tableName = 'asignaciones-administrador-table-qixcut-table';

    use WithExport;

    public function setUp(): array
    {
        $this->showCheckBox();

        return [
            PowerGrid::header()
                ->showSearchInput(),
            PowerGrid::footer()
                ->showPerPage()
                ->showRecordCount(),
            PowerGrid::exportable('Asignaciones_Administrador_' . now()->format('Ymd_His'))
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
        ];
    }

    public function datasource(): Builder
    {
        return Asignacion::query()
            ->leftJoin('users as calificador', 'asignaciones.calificador_id', '=', 'calificador.id')
            ->leftJoin('users as calificado', 'asignaciones.calificado_id', '=', 'calificado.id')
            ->leftJoin('relaciones', 'asignaciones.relaciones_id', '=', 'relaciones.id')
            ->leftJoin('360_encuestas as encuesta', 'asignaciones.360_encuestas_id', '=', 'encuesta.id')
            ->leftJoin('empresas', 'calificador.empresa_id', '=', 'empresas.id')
            ->leftJoin('sucursales', 'calificado.sucursal_id', '=', 'sucursales.id')
            ->select([
                'asignaciones.*',
                'calificador.name as calificador_nombre', // Cambiado de "nombre" a "name"
                'calificado.name as calificado_nombre',   // Cambiado de "nombre" a "name"
                'relaciones.nombre as relacion_nombre',
                'encuesta.nombre as encuesta_nombre',
                'empresas.nombre as empresa_nombre',
                'sucursales.nombre_sucursal as sucursal_nombre'
            ]);
    }


    public function relationSearch(): array
    {
        return [
            'calificador' => [ // Relación con la tabla 'users' (calificador)
                'name', // Columna en la tabla 'users'
            ],
            'calificado' => [ // Relación con la tabla 'users' (calificado)
                'name', // Columna en la tabla 'users'
            ],
            'relacion' => [ // Relación con la tabla 'relaciones'
                'nombre', // Columna en la tabla 'relaciones'
            ],
            'encuesta' => [ // Relación con la tabla '360_encuestas'
                'nombre', // Columna en la tabla '360_encuestas'
            ],
            'calificador.empresa' => [ // Relación con la tabla 'empresas' a través de 'calificador'
                'nombre', // Columna en la tabla 'empresas'
            ],
            'calificado.sucursal' => [ // Relación con la tabla 'sucursales' a través de 'calificado'
                'nombre_sucursal', // Columna en la tabla 'sucursales'
            ],
        ];
    }


    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('calificador_name')
            ->add('calificado_name')
            ->add('relacion_nombre')
            ->add('encuesta_nombre')
            ->add('realizada_si_no', fn(Asignacion $model) => $model->realizada ? 'Sí' : 'No')
            ->add('realizada_formatted', fn(Asignacion $model) => $model->realizada ? 'Completada' : 'Pendiente')
            ->add('fecha_formatted', fn(Asignacion $model) => Carbon::parse($model->fecha)->format('d/m/Y'))
            ->add('estatus_personalizado', function (Asignacion $model) {
                $hoy = Carbon::today();
                $fechaAsignacion = Carbon::parse($model->fecha)->startOfDay();

                if ($model->realizada) {
                    return 'Completada';
                } elseif ($hoy->equalTo($fechaAsignacion)) {
                    return 'Disponible hoy';
                } elseif ($hoy->lessThan($fechaAsignacion)) {
                    return 'Futura';
                } else {
                    return 'Expirada';
                }
            });
    }
    public function columns(): array
    {
        return [
            Column::make('Id', 'id'),

            // Column::make('Realizada', 'realizada')
            //     ->sortable()
            //     ->searchable(),

            Column::make('Realizada', 'realizada_si_no')
                ->sortable()
                ->searchable(),

            // Column::make('Fecha',  'fecha')
            //     ->sortable(),

            Column::make('Fecha',  'fecha_formatted')
                ->sortable(),

            Column::make('Nombre Empresa', 'empresa_nombre')
                ->sortable()
                ->searchable(),

            Column::make('Nombre Sucursal', 'sucursal_nombre')
                ->sortable()
                ->searchable(),

            Column::make('Calificador', 'calificador_nombre')
                ->sortable()
                ->searchable(),

            Column::make('Calificado', 'calificado_nombre')
                ->sortable()
                ->searchable(),

            Column::make('Relación', 'relacion_nombre')
                ->sortable()
                ->searchable(),

            Column::make('Encuesta', 'encuesta_nombre')
                ->sortable()
                ->searchable(),

            Column::make('Estatus', 'estatus_personalizado')
                ->sortable(),

            Column::action('Action')
        ];
    }

    // public function filters(): array
    // {
    //     return [
    //         Filter::datepicker('fecha'),
    //     ];
    // }

    #[\Livewire\Attributes\On('edit')]
    public function edit($rowId): void
    {
        $this->js('alert(' . $rowId . ')');
    }

    public function actions(Asignacion $row): array
    {
        return [
            Button::add('edit')
                ->slot('<svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 inline-block mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M17.414 2.586a2 2 0 0 1 0 2.828l-10 10A2 2 0 0 1 6 16H4a1 1 0 0 1-1-1v-2a2 2 0 0 1 .586-1.414l10-10a2 2 0 0 1 2.828 0zM5 13v2h2l10-10-2-2L5 13z"/>
                        </svg> Editar')
                ->class('bg-blue-500 hover:bg-blue-700 text-white font-semibold py-2 px-3 rounded-lg shadow-md transition-all duration-300 flex items-center')
                ->route('editarAsignacionadministradordev', ['id' => Crypt::encrypt($row->id)]),

            Button::add('delete')
                ->slot('<svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 inline-block mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M6 2a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v1h3a1 1 0 1 1 0 2h-1v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5H2a1 1 0 1 1 0-2h3V2zm2 1v1h4V3H8zM5 5v11h10V5H5zm3 3a1 1 0 0 1 2 0v5a1 1 0 0 1-2 0V8zm4 0a1 1 0 0 1 2 0v5a1 1 0 0 1-2 0V8z" clip-rule="evenodd"/>
                        </svg> Eliminar')
                ->class('bg-red-500 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded-lg shadow-md transition-all duration-300 flex items-center')
                ->dispatch('confirmarEliminarAsignacionAdministrador', ['id' => Crypt::encrypt($row->id)]),
        ];
    }
}
