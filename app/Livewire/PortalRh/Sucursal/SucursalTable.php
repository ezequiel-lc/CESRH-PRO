<?php

namespace App\Livewire\PortalRh\Sucursal;

use App\Models\PortalRh\Sucursal;
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
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

final class SucursalTable extends PowerGridComponent
{
    use WithExport;
    public string $tableName = 'sucursal-table-qre6er-table';

    public function setUp(): array
    {
        $this->showCheckBox();

        return [
            PowerGrid::header()
                ->showSearchInput(),
            PowerGrid::footer()
                ->showPerPage()
                ->showRecordCount(),
            PowerGrid::exportable(fileName: 'Sucursales') 
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
        ];
    }

    public function datasource(): Builder
    {
        $user = Auth::user();

        $query = Sucursal::query()
            ->leftJoin('registros_patronales', 'sucursales.registro_patronal_id', '=', 'registros_patronales.id')
            ->select([
                'sucursales.*',
                'registros_patronales.registro_patronal as nombre_registro_patronal'
        ]);

        // 🔹 Filtrar por sucursal si el usuario es Trabajador o Practicante
        if ($user->hasRole(['Trabajador PORTAL RH', 'Trabajador GLOBAL', 'Practicante'])) {
            $query->where('sucursales.id', $user->sucursal_id);
        }

        return $query;
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
            ->add('clave_sucursal')
            ->add('nombre_sucursal')
            ->add('zona_economica')
            ->add('estado')
            ->add('cuenta_contable')
            ->add('rfc')
            ->add('correo')
            ->add('telefono')
            ->add('status')
            ->add('registro_patronal_id')
            ->add('nombre_registro_patronal')
            ->add('created_at');
    }

    public function columns(): array
    {
        return [
            Column::make('Id', 'id'),
            Column::make('Clave sucursal', 'clave_sucursal')
                ->sortable()
                ->searchable(),

            Column::make('Nombre sucursal', 'nombre_sucursal')
                ->sortable()
                ->searchable(),

            Column::make('Zona economica', 'zona_economica')
                ->sortable()
                ->searchable(),

            Column::make('Estado', 'estado')
                ->sortable()
                ->searchable(),

            Column::make('Cuenta contable', 'cuenta_contable')
                ->sortable()
                ->searchable(),

            Column::make('Rfc', 'rfc')
                ->sortable()
                ->searchable(),

            Column::make('Correo', 'correo')
                ->sortable()
                ->searchable(),

            Column::make('Telefono', 'telefono')
                ->sortable()
                ->searchable(),

            Column::make('Status', 'status')
                ->sortable()
                ->searchable(),

            Column::make('Registro patronal', 'nombre_registro_patronal')
                ->sortable()
                ->searchable(),
            
            Column::make('Created at', 'created_at')
                ->sortable(),

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

    public function actions(Sucursal $row): array
    {
        $actions = [];

        if (Gate::allows('Editar Sucursal')) {
            $actions[] = Button::add('edit')
                ->slot('Editar')
                ->class('bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded')
                ->route('editarsucursal', ['id' => Crypt::encrypt($row->id)]);
        }

        if (Gate::allows('Eliminar Sucursal')) {
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
