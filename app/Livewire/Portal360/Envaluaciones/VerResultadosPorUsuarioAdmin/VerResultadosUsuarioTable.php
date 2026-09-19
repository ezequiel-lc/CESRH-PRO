<?php

namespace App\Livewire\Portal360\Envaluaciones\VerResultadosPorUsuarioAdmin;

use App\Models\Encuestas360\Asignacion;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Components\SetUp\Exportable;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Facades\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\Traits\WithExport;

final class VerResultadosUsuarioTable extends PowerGridComponent
{
    public string $tableName = 'ver-resultados-usuario-table-0rkklm-table';
    use WithExport;
    public $sucursalId = null;
    
    public function setUp(): array
    {
        $this->showCheckBox();
        return [
            PowerGrid::exportable('Resultados_Usuario_' . now()->format('Ymd_His'))
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
        // Agrupamos por calificado_id y encuesta_id para evitar duplicados
        $query = Asignacion::query()
            ->leftJoin('users as calificado', 'asignaciones.calificado_id', '=', 'calificado.id')
            ->leftJoin('puestos', 'calificado.puesto_id', '=', 'puestos.id')
            ->leftJoin('departamentos', 'calificado.departamento_id', '=', 'departamentos.id')
            ->leftJoin('empresas', 'calificado.empresa_id', '=', 'empresas.id')
            ->leftJoin('sucursales', 'calificado.sucursal_id', '=', 'sucursales.id')
            ->select([
                DB::raw('MIN(asignaciones.id) as id'), // Usamos el ID mínimo como representativo
                'calificado.name as calificado_nombre',
                'puestos.nombre_puesto as puesto_nombre',
                'departamentos.nombre_departamento as departamento_nombre',
                'empresas.nombre as empresa_nombre',
                'sucursales.nombre_sucursal as sucursal_nombre',
                DB::raw('MAX(asignaciones.realizada) as realizada'), // Si al menos una está realizada
                DB::raw('MAX(asignaciones.fecha) as fecha'),
                DB::raw('MAX(asignaciones.created_at) as created_at'),
                'calificado_id',
                'asignaciones.360_encuestas_id', // Agrupamos también por encuesta
            ])
            ->groupBy([
                'calificado_id',
                'asignaciones.360_encuestas_id',
                'calificado.name',
                'puestos.nombre_puesto',
                'departamentos.nombre_departamento',
                'empresas.nombre',
                'sucursales.nombre_sucursal'
            ]);
            
        // Filtrar por sucursal si se proporciona un ID
        if ($this->sucursalId) {
            $query->where('calificado.sucursal_id', $this->sucursalId);
        }
        
        return $query;
    }
    
    public function relationSearch(): array
    {
        return [
            'calificado' => ['name'],
            'calificado.puesto' => ['nombre_puesto'],
            'calificado.departamento' => ['nombre_departamento'],
            'calificado.empresa' => ['nombre'],
            'calificado.sucursal' => ['nombre_sucursal'],
        ];
    }
    
    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('calificado_nombre')
            ->add('puesto_nombre')
            ->add('departamento_nombre')
            ->add('empresa_nombre')
            ->add('sucursal_nombre')
            ->add('realizada_formatted', fn(Asignacion $model) => $model->realizada ? 'Sí' : 'No')
            ->add('fecha_formatted', fn(Asignacion $model) => Carbon::parse($model->fecha)->format('d/m/Y'))
            ->add('created_at');
    }
    
    public function columns(): array
    {
        return [
            Column::make('Id', 'id'),
            Column::make('Calificado', 'calificado_nombre')
                ->sortable()
                ->searchable(),
            Column::make('Puesto', 'puesto_nombre')
                ->sortable()
                ->searchable(),
            Column::make('Departamento', 'departamento_nombre')
                ->sortable()
                ->searchable(),
            Column::make('Empresa', 'empresa_nombre')
                ->sortable()
                ->searchable(),
            Column::make('Sucursal', 'sucursal_nombre')
                ->sortable()
                ->searchable(),
            Column::make('Realizada', 'realizada_formatted', 'realizada')
                ->sortable()
                ->searchable(),
            Column::make('Fecha', 'fecha_formatted', 'fecha')
                ->sortable(),
            Column::action('Action')
        ];
    }
    
    public function filters(): array
    {
        return [
            // Filter::inputText('calificado_nombre', 'calificado.name')
            //     ->operators(['contains']),
            // Filter::inputText('puesto_nombre', 'puestos.nombre_puesto')
            //     ->operators(['contains']),
            // Filter::inputText('departamento_nombre', 'departamentos.nombre_departamento')
            //     ->operators(['contains']),
            // Filter::inputText('empresa_nombre', 'empresas.nombre')
            //     ->operators(['contains']),
            // Filter::inputText('sucursal_nombre', 'sucursales.nombre_sucursal')
            //     ->operators(['contains']),
            // Filter::datepicker('fecha'),
        ];
    }
    #[\Livewire\Attributes\On('edit')]
    public function edit($rowId): void
    {
        $this->js('alert(' . $rowId . ')');
    }

    public function actions(Asignacion $row): array
    {
        return [
            Button::add('vizualizar')
                ->slot('Vizualizar')
                ->class('pg-btn-white dark:ring-pg-primary-600 dark:border-pg-primary-600 dark:hover:bg-pg-primary-700 dark:ring-offset-pg-primary-800 dark:text-pg-primary-300 dark:bg-pg-primary-700')
                ->route('VizualizarResultadosGeneralesUsuario', ['asignacionId' => $row->id]),
        ];
    }

    /*
    public function actionRules($row): array
    {
       return [
            // Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($row) => $row->id === 1)
                ->hide(),
        ];
    }
    */
}
