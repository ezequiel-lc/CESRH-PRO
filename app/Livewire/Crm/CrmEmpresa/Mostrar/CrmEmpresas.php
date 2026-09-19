<?php

namespace App\Livewire\Crm\CrmEmpresa\Mostrar;

use App\Models\Crm\CrmEmpresa;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Facades\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\Components\SetUp\Exportable;
use PowerComponents\LivewirePowerGrid\Traits\WithExport;



final class CrmEmpresas extends PowerGridComponent
{

    use WithExport;

    public string $tableName = 'crm-empresas-oik5xr-table';

    public function setUp(): array
    {
        $this->showCheckBox();

        return [
            PowerGrid::exportable('export')
            ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
            PowerGrid::header()
                ->showSearchInput(),
            PowerGrid::footer()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    public function datasource(): Builder
    {
        return CrmEmpresa::query();
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('nombre')
            ->add('tamano_empresa')
            ->add('clasificacion')
            ->add('pagina_web')
            ->add('imgagen', function(CrmEmpresa $model){
                return '<img src="'.e($model->imgagen).'" />';
            })
            ->add('created_at');
    }

    public function columns(): array
    {
        return [
            Column::make('Id', 'id'),
            Column::make('Nombre', 'nombre')
                ->sortable()
                ->searchable(),

            Column::make('Tamano empresa', 'tamano_empresa')
                ->sortable()
                ->searchable(),

            Column::make('Pagina web', 'pagina_web')
                ->sortable()
                ->searchable(),

            Column::make('Clasificacion', 'clasificacion')
                ->sortable()
                ->searchable(),

            Column::make('Logotipo', 'logotipo')
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

    public function actions(CrmEmpresa $row): array
    {
        return [
            Button::make('edit', 'Editar')
                ->class('bg-indigo-500 cursor-pointer text-white px-3 py-2.5 m-1 rounded text-sm')
                ->route('EditEmpresa', ['id' => $row->id]),

            Button::add('delete')
                ->slot('Eliminar')
                ->class('bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded')
                ->dispatchTo('crm.crm-empresa.eliminar.eliminar-empresa','confirmDelete', ['id' => $row->id]),


            // Button::make('destroy', 'Delete')
            //     ->class('text-red-500 font-medium hover:underline')
            //     ->emit('DeleteEmpresa', ['id' => 'id']),
        ];

   }
}
