<?php

namespace App\Livewire\PortalCapacitacion\HabilidadesTecnicas\AdminEmpresa;

use App\Models\PortalCapacitacion\FormacionHabilidadTecnica;
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

final class HabilidadTecnicaEmpresaTable extends PowerGridComponent
{
    use WithExport;

    public string $tableName = 'habilidad-tecnica-table-zyrbph-table';

    public function setUp(): array
    {
        $this->showCheckBox();

        return [
            PowerGrid::header()
                ->showSearchInput(),
            PowerGrid::footer()
                ->showPerPage()
                ->showRecordCount(),
            PowerGrid::exportable(fileName: 'funcionesEspecificas-export-file') 
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
        ];
    }

    public function datasource(): Builder
    {
        $user = auth()->user();
        return FormacionHabilidadTecnica::query()
        ->join('empresas', 'empresas.id', 'formaciones_tecnicas.empresa_id')
        ->join('sucursales', 'sucursales.id', 'formaciones_tecnicas.sucursal_id')
        ->select(
            'formaciones_tecnicas.id', 
            'formaciones_tecnicas.descripcion', 
            'formaciones_tecnicas.nivel', 
            'empresas.nombre as empresa_nombre',
            'sucursales.nombre_sucursal as sucursal_nombre')
        ->where('formaciones_tecnicas.empresa_id', $user->empresa_id);
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('descripcion')
            ->add('nivel')
            ->add('sucursal_nombre');
    }

    public function columns(): array
    {
        return [
            Column::make('Descripcion', 'descripcion')
                ->sortable()
                ->searchable(),

            Column::make('Nivel', 'nivel')
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

    public function actions(FormacionHabilidadTecnica $row): array
    {
        return [
            Button::add('edit')
                ->slot('Editar')
                ->class('bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded')
                ->route('editarHabilidadesTecnicasEmpresa', ['id' => Crypt::encrypt($row->id)]),

            Button::add('delete')
                ->slot('Eliminar')
                ->class('bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded')
                ->dispatch('confirmDelete', ['id' => $row->id]),
        ];
    }
}
