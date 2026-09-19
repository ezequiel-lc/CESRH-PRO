<?php

namespace App\Livewire\PortalCapacitacion\ResponsabilidadesUniversales\AdminEmpresa;

use App\Models\PortalCapacitacion\ResponsabilidadUniversal;
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

final class ResponsabilidadUniversalEmpresaTable extends PowerGridComponent
{
    public string $tableName = 'responsabilidad-universal-table-k8sa32-table';

    public function setUp(): array
    {
        $this->showCheckBox();

        return [
            PowerGrid::header()
                ->showSearchInput(),
            PowerGrid::footer()
                ->showPerPage()
                ->showRecordCount(),
            PowerGrid::exportable(fileName: 'responsabilidadesUniversales-export-file') 
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV), 
        ];
    }

    public function datasource(): Builder
    {
        $user = auth()->user();
        return ResponsabilidadUniversal::query()
            ->join('empresas', 'empresas.id', 'respons_univ.empresa_id')
            ->join('sucursales', 'sucursales.id', 'respons_univ.sucursal_id')
            ->select(
               'respons_univ.id',
               'respons_univ.sistema',
               'respons_univ.responsalidad',
               'empresas.nombre as empresa_nombre',
               'sucursales.nombre_sucursal as sucursal_nombre')
            ->where('respons_univ.empresa_id', $user->empresa_id);
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('sistema')
            ->add('responsalidad')
            ->add('sucursal_nombre');
    }

    public function columns(): array
    {
        return [
            Column::make('Sistema', 'sistema')
                ->sortable()
                ->searchable(),

            Column::make('Responsabilidad', 'responsalidad')
                ->sortable()
                ->searchable(),

            Column::make('Sucursal', 'sucursal_nombre')
                ->sortable(),

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

    public function actions(ResponsabilidadUniversal $row): array
    {
        return [
            Button::add('edit')
                ->slot('Editar')
                ->class('bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded')
                ->route('editarResponsabilidadesUniversalesEmpresa', ['id' => Crypt::encrypt($row->id)]),

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
