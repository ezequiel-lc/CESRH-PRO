<?php

namespace App\Livewire\PortalRh\EmpresSucursal;

use App\Models\PortalRh\EmpresaSucursal;
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

final class EmpresSucursalTable extends PowerGridComponent
{
    public string $tableName = 'empres-sucursal-table-mrx2ky-table';
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
            PowerGrid::exportable(fileName: 'empresa-sucursal-export-file') 
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
        ];
    }

    public function datasource(): Builder
    {
        return EmpresaSucursal::query()
        ->leftJoin('empresas', 'empresa_sucursal.empresa_id', '=', 'empresas.id')
        ->leftJoin('sucursales', 'empresa_sucursal.sucursal_id', '=', 'sucursales.id')
        
        ->select([
            'empresa_sucursal.id', // Incluir el ID de la tabla pivote
            'empresa_sucursal.empresa_id',
            'empresa_sucursal.sucursal_id',
            'empresas.nombre as empresa_nombre',
            'sucursales.nombre_sucursal as sucursal_nombre',
            'empresa_sucursal.created_at', // created_at también hya que seleccionarlo
            'empresa_sucursal.updated_at'
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
            ->add('empresa_id')
            ->add('empresa_nombre')
            ->add('sucursal_id')
            ->add('sucursal_nombre')
            ->add('status')
            ->add('created_at')
            ->add('updated_at');
    }

    public function columns(): array
    {
        return [
            Column::make('Id', 'id'),
            Column::make('Empresa', 'empresa_nombre'),
            Column::make('Sucursal', 'sucursal_nombre'),
            Column::make('Status', 'status')
                ->sortable()
                ->searchable(),

            Column::make('Fecha creación', 'created_at')
                ->sortable()
                ->searchable(),

            Column::make('Fecha actualización', 'updated_at')
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

    public function actions(EmpresaSucursal $row): array
    {
        return [
            Button::add('edit')
                ->slot('Editar')
                ->class('bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded')
                ->route('editarempressucursal', ['id' => Crypt::encrypt($row->id)]),
            
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
