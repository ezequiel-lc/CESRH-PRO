<?php

namespace App\Livewire\Portal360\Resultados\EmpresaResultados;

use App\Models\PortalRH\EmpresaSucursal;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Facades\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;

final class EmpresaResultadosTable extends PowerGridComponent
{
    public string $tableName = 'empresa-resultados-table-sqmaqk-table';

    public function setUp(): array
    {
        $this->showCheckBox();

        return [
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
            ->join('sucursales', 'empresa_sucursal.sucursal_id', '=', 'sucursales.id')
            ->where('empresa_sucursal.empresa_id', Auth::user()->empresa_id)
            ->select('empresa_sucursal.*', 'sucursales.nombre_sucursal');
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('sucursal_nombre', fn(EmpresaSucursal $model) => $model->sucursal->nombre_sucursal);
    }

    public function columns(): array
    {
        return [
            Column::make('Id', 'id'),
            Column::make('Nombre Sucursal', 'sucursal_nombre')
                ->sortable(),

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

    public function actions(EmpresaSucursal $row): array
    {
        return [
            Button::add('vizualizar')
            ->slot('Visualizar')
            ->class('pg-btn-white dark:ring-pg-primary-600 dark:border-pg-primary-600 dark:hover:bg-pg-primary-700 dark:ring-offset-pg-primary-800 dark:text-pg-primary-300 dark:bg-pg-primary-700')
            ->route('VizualizarResultadosGeneralesEmpresa', ['SucursalId' => $row->id]),
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
