<?php

namespace App\Livewire\PortalRh\Incapacidad;

use App\Models\PortalRh\Incapacidad;
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

final class IncapacidadTable extends PowerGridComponent
{
    use WithExport;
    public string $tableName = 'incapacidad-table-u97jjs-table';

    public function setUp(): array
    {
        $this->showCheckBox();

        return [
            PowerGrid::header()
                ->showSearchInput(),
            PowerGrid::footer()
                ->showPerPage()
                ->showRecordCount(),
            PowerGrid::exportable(fileName: 'Incapacidades') 
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
        ];
    }

    public function datasource(): Builder
    {
        $user = Auth::user();

        if ($user->hasRole('GoldenAdmin')) {
            // Si es un administrador, mostrar todas las incapacidades
            $query = Incapacidad::query()
                ->leftJoin('user_incapacidad', 'incapacidades.id', '=', 'user_incapacidad.incapacidad_id')
                ->leftJoin('users', 'users.id', '=', 'user_incapacidad.user_id')
                ->select([
                    'incapacidades.*',
                    'incapacidades.status as stat',
                    DB::raw("COALESCE(users.name, 'PENDIENTE DE APROBACIÓN') as nombre_usuario"),
                ]);
        } elseif ($user->hasRole(['Trabajador PORTAL RH', 'Trabajador GLOBAL', 'Practicante'])) {
            // Si es un trabajador, mostrar solo sus incapacidades
            $query = Incapacidad::query()
                ->join('user_incapacidad', 'incapacidades.id', '=', 'user_incapacidad.incapacidad_id')
                ->join('users', 'users.id', '=', 'user_incapacidad.user_id')
                ->select([
                    'incapacidades.*',
                    'incapacidades.status as stat',
                    'users.name as nombre_usuario'
                ])
                ->where('user_incapacidad.user_id', $user->id);
        } else {
            // Si no tiene ninguno de estos roles, devolver solo las incapacidades sin relaciones
            $query = Incapacidad::query()->select('incapacidades.*');
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
            ->add('fecha_inicio_formatted', fn (Incapacidad $model) => Carbon::parse($model->fecha_inicio)->format('d/m/Y'))
            ->add('fecha_final_formatted', fn (Incapacidad $model) => Carbon::parse($model->fecha_final)->format('d/m/Y'))
            ->add('motivo')
            ->add('tipo')
            ->add('documento', function (Incapacidad $model) {
                return '<a href="' . asset('PortalRH/Incapacidades/' . basename($model->documento)) . '" target="_blank" class="text-blue-600 hover:underline">Ver Justificante</a>';
            })
            ->add('status')
            ->add('observaciones');
    }

    public function columns(): array
    {
        return [
            Column::make('Id', 'id'),

            Column::make('Usuario', 'nombre_usuario')
                ->sortable()
                ->searchable(),

            Column::make('Status', 'status')
                ->sortable()
                ->searchable(),

            Column::make('Fecha inicio', 'fecha_inicio_formatted', 'fecha_inicio')
                ->sortable(),

            Column::make('Fecha final', 'fecha_final_formatted', 'fecha_final')
                ->sortable(),

            Column::make('Motivo', 'motivo')
                ->sortable()
                ->searchable(),

            Column::make('Tipo', 'tipo')
                ->sortable()
                ->searchable(),

            Column::make('Documento', 'documento')
                ->sortable()
                ->searchable(),

            

            Column::make('Observaciones', 'observaciones')
                ->sortable()
                ->searchable(),

            Column::action('Action')
        ];
    }

    public function filters(): array
    {
        return [
            Filter::datepicker('fecha_inicio'),
            Filter::datepicker('fecha_final'),
        ];
    }

    #[\Livewire\Attributes\On('edit')]
    public function edit($rowId): void
    {
        $this->js('alert('.$rowId.')');
    }

    public function actions(Incapacidad $row): array
    {
        $actions = [];

        if (Gate::allows('Editar Incapacidad')) {
            $actions[] = Button::add('edit')
                ->slot('Editar')
                ->class('bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded')
                ->route('editarincapacidad', ['id' => Crypt::encrypt($row->id)]);
        }

        if (Gate::allows('Eliminar Incapacidad')) {
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
