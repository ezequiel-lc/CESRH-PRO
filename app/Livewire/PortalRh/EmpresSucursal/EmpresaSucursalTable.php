<?php

namespace App\Livewire\PortalRh\EmpresSucursal;

use App\Models\PortalRh\Empresa;
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

final class EmpresaSucursalTable extends PowerGridComponent
{
    public string $tableName = 'empresa-sucursal-table-zcd6vq-table';

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
        return Empresa::query()
        ->join('empresa_sucursal', 'empresas.id', '=', 'empresa_sucursal.empresa_id')
        ->join('sucursales', 'empresa_sucursal.sucursal_id', '=', 'sucursales.id')
        ->select(
            'empresas.id', 
            'empresas.nombre', 
            'sucursales.nombre_sucursal as sucursal_nombre',
            'empresa_sucursal.id as empresa_sucursal_id', // id
            'empresa_sucursal.created_at', 
            'empresa_sucursal.status',
            'empresa_sucursal.updated_at'
        );

        //dd($query->get()); // Verifica qué valores se están obteniendo
        //return $query;
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('empresa_sucursal_id')
            ->add('nombre')
            ->add('sucursal_nombre')
            ->add('created_at');
    }

    public function columns(): array
    {
        return [
            Column::make('Id', 'empresa_sucursal_id'),
            Column::make('Empresa', 'nombre')
                ->sortable()
                ->searchable(),
            
            Column::make('Sucursal', 'sucursal_nombre')
                ->sortable()
                ->searchable(),

            Column::make('Status', 'status')
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

    public function actions(Empresa $row): array
    {
        //dd($row->empresa_sucursal_id);

        // Agrega este dd() temporalmente para verificar la encriptación
        //dd($row->empresa_sucursal_id, Crypt::encrypt($row->empresa_sucursal_id));
        
        return [
            Button::add('edit')
                ->slot('Editar')
                ->class('bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded')
                //->route('editarempressucursal', ['empresa_sucursal_id' => base64_encode($row->empresa_sucursal_id)]),
                ->route('editarempressucursal', ['empresa_sucursal_id' => Crypt::encrypt($row->empresa_sucursal_id)]),
            
            Button::add('delete')
                ->slot('Eliminar')
                ->class('bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded')
                ->dispatch('confirmDelete', ['id' => $row->empresa_sucursal_id]),
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
