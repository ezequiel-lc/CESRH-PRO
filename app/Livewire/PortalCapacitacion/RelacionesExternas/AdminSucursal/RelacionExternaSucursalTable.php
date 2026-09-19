<?php

namespace App\Livewire\PortalCapacitacion\RelacionesExternas\AdminSucursal;

use App\Models\PortalCapacitacion\RelacionExterna;
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

final class RelacionExternaSucursalTable extends PowerGridComponent
{
    use WithExport;

    public string $tableName = 'relacion-externa-table-dxolrh-table';

    public function setUp(): array
    {
        $this->showCheckBox();

        return [
            PowerGrid::header()
                ->showSearchInput(),
            PowerGrid::footer()
                ->showPerPage()
                ->showRecordCount(),
            PowerGrid::exportable(fileName: 'relacionesExternas-export-file') 
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV), 
        ];
    }

    public function datasource(): Builder
    {
        $user = auth()->user();

        return RelacionExterna::query()
        ->join('empresas', 'empresas.id', 'relaciones_externas.empresa_id')
        ->join('sucursales', 'sucursales.id', 'relaciones_externas.sucursal_id')
        ->select(
            'relaciones_externas.id', 
            'relaciones_externas.nombre',
            'relaciones_externas.razon_motivo', 
            'relaciones_externas.frecuencia',
            'empresas.nombre as empresa_nombre',
            'sucursales.nombre_sucursal as sucursal_nombre')
        ->where('relaciones_externas.empresa_id', $user->empresa_id) // Filtra por empresa del usuario
        ->where('relaciones_externas.sucursal_id', $user->sucursal_id);

            
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('nombre')
            ->add('razon_motivo')
            ->add('frecuencia');
    }

    public function columns(): array
    {
        return [
            Column::make('Nombre', 'nombre')
            ->sortable()
            ->searchable(),

            Column::make('Razon motivo', 'razon_motivo')
                ->sortable()
                ->searchable(),

            Column::make('Frecuencia', 'frecuencia')
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

    public function actions(RelacionExterna $row): array
    {
        return [
            Button::add('edit')
                ->slot('Editar')
                ->class('bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded')
                ->route('editarRelacionesExternasSucursal', ['id' => Crypt::encrypt($row->id)]),

            Button::add('delete')
                ->slot('Eliminar')
                ->class('bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded')
                ->dispatch('confirmDelete', ['id' => $row->id]),
        ];
    }
}
