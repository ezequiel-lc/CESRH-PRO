<?php

namespace App\Livewire\PortalRh\Empres;

//use App\Models\PortalRh\Empres;
use App\Models\PortalRH\Empresa;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Crypt;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Facades\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\Traits\WithExport; 
use PowerComponents\LivewirePowerGrid\Components\SetUp\Exportable; 
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;


final class EmpresTable extends PowerGridComponent
{
    use WithExport;
    public string $tableName = 'empres-table-u4eqeo-table';

    public function setUp(): array
    {
        $this->showCheckBox();

        return [
            PowerGrid::header()
                ->showSearchInput(),
            PowerGrid::footer()
                ->showPerPage()
                ->showRecordCount(),
            PowerGrid::exportable(fileName: 'empresas')
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
        ];
    }

    public function datasource(): Builder
    {
        $user = Auth::user();

        // Si el usuario es administrador, devolver todos los departamentos
        if ($user->hasRole('GoldenAdmin')) {
            return Empresa::query();
        }

        // Si el usuario es trabajador o practicante, devolver solo su departamento
        return Empresa::where('id', $user->empresa_id);
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
            ->add('nombre')
            ->add('razon_social')
            ->add('rfc')
            ->add('nombre_comercial')
            ->add('pais_origen')
            ->add('representante_legal')

            ->add('url_constancia_situacion_fiscal', function (Empresa $model) {
                return '<a href="' . asset('PortalRH/Empresas/' . basename($model->url_constancia_situacion_fiscal)) . '" target="_blank" class="text-blue-600 hover:underline">Ver PDF</a>';
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

            Column::make('Razon social', 'razon_social')
                ->sortable()
                ->searchable(),

            Column::make('Rfc', 'rfc')
                ->sortable()
                ->searchable(),

            Column::make('Nombre comercial', 'nombre_comercial')
                ->sortable()
                ->searchable(),

            Column::make('Pais origen', 'pais_origen')
                ->sortable()
                ->searchable(),

            Column::make('Representante legal', 'representante_legal')
                ->sortable()
                ->searchable(),

            Column::make('Url constancia situacion fiscal', 'url_constancia_situacion_fiscal')
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
        $actions = [];

        if (Gate::allows('Editar Empresa')) {
            $actions[] = Button::add('edit')
                ->slot('Editar')
                ->class('bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded')
                ->route('editarempresa', ['id' => Crypt::encrypt($row->id)]);
        }

        if (Gate::allows('Eliminar Empresa')) {
            $actions[] = Button::add('delete')
                ->slot('Eliminar')
                ->class('bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded')
                ->dispatch('confirmDelete', ['id' => $row->id]); 
        }

        return $actions;
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
