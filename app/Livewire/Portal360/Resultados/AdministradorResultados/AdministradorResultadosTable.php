<?php

namespace App\Livewire\Portal360\Resultados\AdministradorResultados;

use App\Models\Encuestas360\Asignacion;
use App\Models\PortalRH\EmpresaSucursal;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Components\SetUp\Exportable;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Facades\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\Traits\WithExport;

final class AdministradorResultadosTable extends PowerGridComponent
{
    public string $tableName = 'administrador-resultados-table-jtzuoo-table';
    use WithExport; // Agregamos el trait para exportación

    public function setUp(): array
    {
        $this->showCheckBox();

        return [
            PowerGrid::exportable('Resultados_Administrador_' . now()->format('Ymd_His')) // Configuración de exportación
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
        return EmpresaSucursal::query()
            ->join('empresas', 'empresa_sucursal.empresa_id', '=', 'empresas.id')
            ->select('empresa_sucursal.*', 'empresas.nombre as empresa_nombre');
    }

    public function relationSearch(): array
    {
        return [
            'empresa' => ['nombre'], // Habilitamos búsqueda en la relación empresa
        ];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('empresa_nombre', fn(EmpresaSucursal $model) => $model->empresa->nombre);
    }

    public function columns(): array
    {
        return [
            Column::make('Id', 'id'),
            Column::make('Nombre Empresa', 'empresa_nombre')
                ->sortable(),
            Column::action('Action')
        ];
    }

    public function filters(): array
    {
        return [
            Filter::datepicker('fecha'),
        ];
    }

    #[\Livewire\Attributes\On('edit')]
    public function edit($rowId): void
    {
        $this->js('alert(' . $rowId . ')');
    }

    public function actions(EmpresaSucursal $row): array
    {
        return [
            Button::add('vizualizar')
                ->slot('Visualizar')
                ->class('pg-btn-white dark:ring-pg-primary-600 dark:border-pg-primary-600 dark:hover:bg-pg-primary-700 dark:ring-offset-pg-primary-800 dark:text-pg-primary-300 dark:bg-pg-primary-700')
                ->route('VizualizarResultadosGeneralesAdministrador', ['SucursalId' => $row->id]),
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
