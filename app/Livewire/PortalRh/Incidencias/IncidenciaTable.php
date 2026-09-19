<?php

namespace App\Livewire\PortalRh\Incidencias;

use App\Models\PortalRh\Incidencia;
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

final class IncidenciaTable extends PowerGridComponent
{
    public string $tableName = 'incidencia-table-truwzm-table';
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
            PowerGrid::exportable(fileName: 'Incidencias') 
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
        ];
    }

    public function datasource(): Builder
    {
        $user = Auth::user();

        if ($user->hasRole('GoldenAdmin')) { // Ajusta el nombre del rol según corresponda
            // Para Admin, mostramos TODAS las incidencias usando leftJoin para obtener el nombre del usuario,
            // o un mensaje por defecto si no hay registro en la tabla pivote.
            $query = Incidencia::query()
                ->leftJoin('user_incidencia', 'incidencias.id', '=', 'user_incidencia.incidencia_id')
                ->leftJoin('users', 'users.id', '=', 'user_incidencia.user_id')
                ->select([
                    'incidencias.*',
                    'users.name as nombre_usuario'
                ]);
        } elseif ($user->hasRole(['Trabajador PORTAL RH', 'Trabajador GLOBAL', 'Practicante'])) {
            // Para estos roles, usamos inner join y filtramos por su user_id
            $query = Incidencia::query()
                ->join('user_incidencia', 'incidencias.id', '=', 'user_incidencia.incidencia_id')
                ->join('users', 'users.id', '=', 'user_incidencia.user_id')
                ->select([
                    'incidencias.*',
                    'users.name as nombre_usuario'
                ])
                ->where('user_incidencia.user_id', $user->id);
        } else {
            // Consulta por defecto
            $query = Incidencia::query()->select('incidencias.*');
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
            ->add('nombre_usuario')
            ->add('tipo_incidencia')
            ->add('status')
            ->add('fecha_inicio_formatted', fn (Incidencia $model) => Carbon::parse($model->fecha_inicio)->format('d/m/Y'))
            ->add('fecha_final_formatted', fn (Incidencia $model) => Carbon::parse($model->fecha_final)->format('d/m/Y'));
    }

    public function columns(): array
    {
        return [
            Column::make('Id', 'id'),

            Column::make('Usuario', 'nombre_usuario')
                ->sortable()
                ->searchable(),
            
            Column::make('Incidencia', 'tipo_incidencia')
                ->sortable()
                ->searchable(),

            Column::make('Fecha inicio', 'fecha_inicio_formatted', 'fecha_inicio')
                ->sortable(),

            Column::make('Fecha final', 'fecha_final_formatted', 'fecha_final')
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

    public function actions(Incidencia $row): array
    {
        $actions = [];

        if (Gate::allows('Editar Incidencia')) {
            $actions[] = Button::add('edit')
                ->slot('Editar')
                ->class('bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded')
                ->route('editarincidencia', ['id' => Crypt::encrypt($row->id)]);
        }

        if (Gate::allows('Eliminar Incidencia')) {
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
