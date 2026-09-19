<?php

namespace App\Livewire\Portal360\Envaluaciones\EnvaluacionAdministrador;

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

final class ResultadosAdministradorTable extends PowerGridComponent
{
    public string $tableName = 'resultados-administrador-table-avtuvj-table';
    use WithExport; // Agregar el trait para exportación

    public function setUp(): array
    {
        $this->showCheckBox();

        return [
            PowerGrid::exportable('Resultados_Administrador_' . now()->format('Ymd_His')) // Configurar exportación
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV), // Formatos XLS y CSV
            PowerGrid::header()
                ->showSearchInput(),
            PowerGrid::footer()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    public function datasource(): Builder
    {
        return Asignacion::query()
            ->leftJoin('users as calificador', 'asignaciones.calificador_id', '=', 'calificador.id')
            ->leftJoin('users as calificado', 'asignaciones.calificado_id', '=', 'calificado.id')
            ->leftJoin('empresas', 'calificador.empresa_id', '=', 'empresas.id')
            ->leftJoin('sucursales', 'calificado.sucursal_id', '=', 'sucursales.id')
            ->select([
                'asignaciones.id',
                'empresas.nombre as empresa_nombre',
                'sucursales.nombre_sucursal as sucursal_nombre',
                // Agrega un campo para identificar grupos únicos
                DB::raw("CONCAT(empresas.nombre, '-', sucursales.nombre_sucursal) as group_key")
            ]);

            // Filtrar por los checkboxes seleccionados
        if (!empty($this->checkboxValues)) {
            $query->whereIn('asignaciones.id', $this->checkboxValues);
        }

    }


    public function relationSearch(): array
    {
        return [
            'calificador' => ['name'],           // Búsqueda en el nombre del calificador
            'calificado' => ['name'],            // Búsqueda en el nombre del calificado
            'calificador.empresa' => ['nombre'], // Relación anidada: calificador -> empresa
            'calificado.sucursal' => ['nombre_sucursal'], // Relación anidada: calificado -> sucursal
        ];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('empresa_nombre')
            ->add('sucursal_nombre');
    }

    public function columns(): array
    {
        return [
            Column::make('Id', 'id'),
            Column::make('Nombre Empresa', 'empresa_nombre')
                ->sortable()
                ->searchable(),

            Column::make('Nombre Sucursal', 'sucursal_nombre')
                ->sortable()
                ->searchable(),

            Column::action('Action')
        ];
    }

    public function filters(): array
    {
        return [
            Filter::inputText('empresa_nombre', 'empresas.nombre')
                ->operators(['contains']), // Filtra por nombre de empresa
            Filter::inputText('sucursal_nombre', 'sucursales.nombre_sucursal')
                ->operators(['contains']), // Filtra por nombre de sucursal
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
            Button::add('comenzar')
                ->slot('Vizualizar')
                ->class('pg-btn-white dark:ring-pg-primary-600 dark:border-pg-primary-600 dark:hover:bg-pg-primary-700 dark:ring-offset-pg-primary-800 dark:text-pg-primary-300 dark:bg-pg-primary-700')
                ->route('VizualisarResultadosGenerales', ['asignacionId' => $row->id]),
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
