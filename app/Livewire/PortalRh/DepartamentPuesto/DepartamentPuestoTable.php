<?php

namespace App\Livewire\PortalRh\DepartamentPuesto;

use App\Models\PortalRh\DepartamentoPuesto;
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

final class DepartamentPuestoTable extends PowerGridComponent
{
    use WithExport;
    public string $tableName = 'departament-puesto-table-o6dda1-table';

    public function setUp(): array
    {
        $this->showCheckBox();

        return [
            PowerGrid::header()
                ->showSearchInput(),
            PowerGrid::footer()
                ->showPerPage()
                ->showRecordCount(),
            PowerGrid::exportable(fileName: 'departamento-puesto-export-file') 
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV), 
        ];
    }

    public function datasource(): Builder
    {
        return DepartamentoPuesto::query()
        ->leftJoin('departamentos', 'departamento_puesto.departamento_id', '=', 'departamentos.id')
        ->leftJoin('puestos', 'departamento_puesto.puesto_id', '=', 'puestos.id')
        ->select([
            'departamento_puesto.id', // Incluir el ID de la tabla pivote
            'departamento_puesto.departamento_id',
            'departamento_puesto.puesto_id',
            'departamentos.nombre_departamento as departamento_nombre',
            'puestos.nombre_puesto as puesto_nombre', 
            'departamento_puesto.created_at' // created_at también hya que seleccionarlo
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
            ->add('departamento_id')
            ->add('departamento_nombre')
            ->add('puesto_id')
            ->add('puesto_nombre')
            ->add('status')
            ->add('created_at');
    }

    public function columns(): array
    {
        return [
            Column::make('Id', 'id'),
            Column::make('Departamento id', 'departamento_nombre'),
            Column::make('Puesto id', 'puesto_nombre'),
            
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

    public function actions(DepartamentoPuesto $row): array
    {
        return [
            Button::add('edit')
                ->slot('Editar')
                ->class('bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded')
                ->route('editardepapuesto', ['id' => Crypt::encrypt($row->id)]),
            
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
