<?php

namespace App\Livewire\PortalRh\SucursalDepa;

use App\Models\PortalRh\SucursalDepartamento;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Facades\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;

use Illuminate\Support\Facades\Crypt;
use PowerComponents\LivewirePowerGrid\Traits\WithExport; 
use PowerComponents\LivewirePowerGrid\Components\SetUp\Exportable; 

final class SucursalDepaTable extends PowerGridComponent
{
    use WithExport;
    public string $tableName = 'sucursal-depa-table-yagi5t-table';

    public function setUp(): array
    {
        $this->showCheckBox();

        return [
            PowerGrid::header()
                ->showSearchInput(),
            PowerGrid::footer()
                ->showPerPage()
                ->showRecordCount(),
            PowerGrid::exportable(fileName: 'sucursal-departamento-export-file') 
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
        ];
    }

    public function datasource(): Builder
    {
        return SucursalDepartamento::query()
        ->leftJoin('sucursales', 'departamento_sucursal.sucursal_id', '=', 'sucursales.id')
        ->leftJoin('departamentos', 'departamento_sucursal.departamento_id', '=', 'departamentos.id')
        ->select([
            'departamento_sucursal.id', // Incluir el ID de la tabla pivote
            'departamento_sucursal.sucursal_id',
            'departamento_sucursal.departamento_id',
            'sucursales.nombre_sucursal as sucursal_nombre',
            'departamentos.nombre_departamento as departamento_nombre',
            'departamento_sucursal.created_at' // created_at también hya que seleccionarlo
        ]);


    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('id')
            ->add('sucursal_id')
            ->add('sucursal_nombre')
            ->add('departamento_id')
            ->add('departamento_nombre')
            ->add('created_at');
    }

    public function columns(): array
    {
        return [
            Column::make('Id', 'id'),
            Column::make('Sucursal id', 'sucursal_nombre')
                ->sortable()
                ->searchable(),
            Column::make('Departamento id', 'departamento_nombre')
                ->sortable()
                ->searchable(),

            Column::make('Created at', 'created_at')
                ->sortable()
                ->searchable(),

            Column::action('Action')
        ];
    }

    public function filters(): array
    {
        return [
        ];
    }

    #[\Livewire\Attributes\On('edit')]
    public function edit($rowId): void
    {
        $this->js('alert('.$rowId.')');
    }

    public function actions(SucursalDepartamento $row): array
    {
        return [
            Button::add('edit')
                ->slot('Editar')
                ->class('bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded')
                ->route('editarsucursaldepa', ['id' => Crypt::encrypt($row->id)]),
            
            Button::add('delete')
                ->slot('Eliminar')
                ->class('bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded')
                ->dispatch('confirmDelete', ['id' => $row->id]),
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
