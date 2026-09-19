<?php

namespace App\Livewire\PortalCapacitacion\RelacionesInternas\AdminSucursal;

use App\Models\PortalCapacitacion\RelacionInterna;
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

final class RelacionInternaSucursalTable extends PowerGridComponent
{
    use WithExport;

    public string $tableName = 'relacion-interna-table-sfcaij-table';

    public function setUp(): array
    {
        $this->showCheckBox();

        return [
            PowerGrid::header()
                ->showSearchInput(),
            PowerGrid::footer()
                ->showPerPage()
                ->showRecordCount(),
            PowerGrid::exportable(fileName: 'relacionesInternas-export-file') 
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
        ];
    }

    public function datasource(): Builder
    {
        $user = auth()->user();
        return RelacionInterna::query()
        ->join('empresas', 'empresas.id', 'relaciones_internas.empresa_id')
        ->join('sucursales','sucursales.id', 'relaciones_internas.sucursal_id')
        ->select(
            'relaciones_internas.id',
            'relaciones_internas.puesto',
            'relaciones_internas.razon_motivo',
            'relaciones_internas.frecuencia',
            'empresas.nombre as empresa_nombre',
            'sucursales.nombre_sucursal as sucursal_nombre')
        ->where('relaciones_internas.empresa_id', $user->empresa_id)
        ->where('relaciones_internas.sucursal_id', $user->sucursal_id);
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('puesto')
            ->add('razon_motivo')
            ->add('frecuencia');
    }

    public function columns(): array
    {
        return [
            Column::make('Puesto', 'puesto')
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

    /*[\Livewire\Attributes\On('edit')]
    public function edit($rowId): void
    {
        $this->js('alert('.$rowId.')');
    }

    public function actions(RelacionInterna $row): array
    {
        return [
            Button::add('edit')
                ->slot('Edit: '.$row->id)
                ->id()
                ->class('pg-btn-white dark:ring-pg-primary-600 dark:border-pg-primary-600 dark:hover:bg-pg-primary-700 dark:ring-offset-pg-primary-800 dark:text-pg-primary-300 dark:bg-pg-primary-700')
                ->dispatch('edit', ['rowId' => $row->id])
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

    public function actions(RelacionInterna $row): array
    {
        return [
            Button::add('edit')
                ->slot('Editar')
                ->class('bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded')
                ->route('editarRelacionesInternasSucursal', ['id' => Crypt::encrypt($row->id)]),

            Button::add('delete')
                ->slot('Eliminar')
                ->class('bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded')
                ->dispatch('confirmDelete', ['id' => $row->id]),
        ];
    }
}
