<?php

namespace App\Livewire\Portal360\Empresa\EmpresaAdministrador;

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

final class MostrarEmpresaAdministradorTable extends PowerGridComponent
{

    use WithExport;

    public string $tableName = 'mostrar-empresa-administrador-table-nakte4-table';

    public function setUp(): array
    {
        $this->showCheckBox();

        return [
            PowerGrid::header()
                ->showSearchInput(),
            PowerGrid::footer()
                ->showPerPage()
                ->showRecordCount(),
            PowerGrid::exportable('empresas_sucursales') // Nombre del archivo como primer parámetro
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV) // Tipos de ex
        ];
    }

    public function datasource(): Builder
    {
        return EmpresaSucursal::query()
        ->join('empresas', 'empresa_sucursal.empresa_id', '=', 'empresas.id')
        ->join('sucursales', 'empresa_sucursal.sucursal_id', '=', 'sucursales.id')
        ->select('empresa_sucursal.*', 'empresas.nombre as empresa_nombre', 'sucursales.clave_sucursal');
    }

    public function relationSearch(): array
    {
        return [
            'empresa' => [ // Nombre de la relación en el modelo EmpresaSucursal
                'nombre', // Columna en la tabla 'empresas' que se debe buscar
            ],
            'sucursal' => [ // Nombre de la relación en el modelo EmpresaSucursal
                'clave_sucursal', // Columna en la tabla 'sucursales' que se debe buscar
            ],
        ];
    }
    

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('empresa_nombre', fn(EmpresaSucursal $model) => $model->empresa->nombre)
            ->add('sucursal_clave', fn(EmpresaSucursal $model) => $model->sucursal->clave_sucursal);
    }

    public function columns(): array
    {
        return [
            Column::make('Id', 'id'),
            Column::make('Nombre Empresa', 'empresa_nombre')
                ->sortable(),
            // ->searchable(),

            Column::make('Clave Sucursal', 'sucursal_clave')
                ->sortable(),
            // ->searchable(),

            // Column::action('Action')
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

    // public function actions(EmpresaSucursal $row): array
    // {
    //     return [
    //         Button::add('edit')
    //             ->slot('Edit: ' . $row->id)
    //             ->id()
    //             ->class('pg-btn-white dark:ring-pg-primary-600 dark:border-pg-primary-600 dark:hover:bg-pg-primary-700 dark:ring-offset-pg-primary-800 dark:text-pg-primary-300 dark:bg-pg-primary-700')
    //             ->dispatch('edit', ['rowId' => $row->id])
    //     ];
    // }

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
