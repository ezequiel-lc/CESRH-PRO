<?php

namespace App\Livewire\PortalRh\Retardos;

use App\Models\PortalRh\Retardo;
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
use Illuminate\Support\Facades\DB;

final class RetardoTable extends PowerGridComponent
{
    public string $tableName = 'retardo-table-akhbss-table';
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
            PowerGrid::exportable(fileName: 'Retardos') 
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
        ];
    }

    public function datasource(): Builder
    {
        // Obtener el usuario autenticado
        $user = Auth::user();

        // Iniciar la consulta base
        $query = Retardo::query()
            ->select('retardos.*', 
            'users.name as nombre_usuario') // Seleccionamos los datos de Retardo y el nombre del usuario
            ->join('user_retardo', 'retardos.id', '=', 'user_retardo.retardo_id')
            ->join('users', 'user_retardo.user_id', '=', 'users.id');

        // Aplicar filtros según el rol del usuario
        if ($user->hasRole('GoldenAdmin')) {
            // GoldenAdmin ve todos los registros (sin filtro)
            return $query;
        } elseif ($user->hasRole('EmpresaAdmin')) {
            // EmpresaAdmin solo ve los usuarios de su empresa
            return $query->where('users.empresa_id', $user->empresa_id);
        } elseif ($user->hasRole('SucursalAdmin')) {
            // SucursalAdmin solo ve los usuarios de su sucursal
            return $query->where('users.sucursal_id', $user->sucursal_id);
        }

        // Si no tiene un rol reconocido, no se le muestran registros
        return $query->whereRaw('1 = 0'); // Devuelve una consulta vacía
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
            ->add('fecha_formatted', fn (Retardo $model) => Carbon::parse($model->fecha)->format('d/m/Y'))
            ->add('hora_entrada_programada')
            ->add('hora_entrada_real')
            ->add('minutos_retardo')
            ->add('motivo')
            ->add('status') //nombre_usuario
            ->add('nombre_usuario')
            ->add('created_at');
    }

    public function columns(): array
    {
        return [
            Column::make('Id', 'id'),
            Column::make('Usuario', 'nombre_usuario')
                ->sortable(),

            Column::make('Hora entrada programada', 'hora_entrada_programada')
                ->sortable()
                ->searchable(),

            Column::make('Hora entrada real', 'hora_entrada_real')
                ->sortable()
                ->searchable(),

            Column::make('Minutos retardo', 'minutos_retardo')
                ->sortable()
                ->searchable(),

            Column::make('Motivo', 'motivo')
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
            Filter::datepicker('fecha'),
        ];
    }

    #[\Livewire\Attributes\On('edit')]
    public function edit($rowId): void
    {
        $this->js('alert('.$rowId.')');
    }

    public function actions(Retardo $row): array
    {
        $actions = [];

        if (Gate::allows('Editar Retardo')) {
            $actions[] = Button::add('edit')
                ->slot('Editar')
                ->class('bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded')
                ->route('editarretardo', ['id' => Crypt::encrypt($row->id)]);
        }

        if (Gate::allows('Eliminar Retardo')) {
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
