<?php

namespace App\Livewire\PortalRh\Bajas;

use App\Models\User;
use App\Models\PortalRh\Baja;
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

final class BajaTable extends PowerGridComponent
{
    use WithExport;
    public string $tableName = 'baja-table-nvgkac-table';

    public function setUp(): array
    {
        $this->showCheckBox();

        return [
            PowerGrid::header()
                ->showSearchInput(),
            PowerGrid::footer()
                ->showPerPage()
                ->showRecordCount(),
            PowerGrid::exportable(fileName: 'bajas')
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
        ];
    }

    public function datasource(): Builder
    {
        $user = Auth::user(); // Obtener el usuario autenticado
        $query = Baja::query()->with('user'); // Cargar relación con User

        if ($user->hasRole('GoldenAdmin')) {
            // GoldenAdmin ve todos los registros
            return $query;
        }

        if ($user->hasRole('EmpresaAdmin')) {
            // EmpresaAdmin ve solo los registros de su empresa
            return $query->whereHas('user', function ($q) use ($user) {
                $q->where('empresa_id', $user->empresa_id);
            });
        }

        if ($user->hasRole('SucursalAdmin')) {
            // SucursalAdmin ve solo los registros de su sucursal
            return $query->whereHas('user', function ($q) use ($user) {
                $q->where('sucursal_id', $user->sucursal_id);
            });
        }

        // Si no tiene un rol válido, no devuelve registros
        return $query->whereNull('id');
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
            ->add('fecha_baja_formatted', fn (Baja $model) => Carbon::parse($model->fecha_baja)->format('d/m/Y'))
            ->add('motivo_baja')
            ->add('tipo_baja')
            ->add('observaciones')
            ->add('user.name')
            ->add('created_at')
            ->add('updated_at')
            ->add('documento', function (Baja $model) {
                return '<a href="' . asset('PortalRH/Bajas/' . basename($model->documento)) . '" target="_blank" class="text-blue-600 hover:underline">Ver PDF</a>';
            })
            ;
    }

    public function columns(): array
    {
        return [
            Column::make('Id', 'id'),

            Column::make('Usuario', 'user.name')
                ->sortable()
                ->searchable(),

            Column::make('Fecha baja', 'fecha_baja_formatted', 'fecha_baja')
                ->sortable(),

            Column::make('Motivo baja', 'motivo_baja')
                ->sortable()
                ->searchable(),

            Column::make('Tipo baja', 'tipo_baja')
                ->sortable()
                ->searchable(),

            Column::make('Documento', 'documento')
                ->sortable()
                ->searchable(),

            Column::make('Observaciones', 'observaciones')
                ->sortable()
                ->searchable(),

            Column::make('Creado el', 'created_at')
                ->sortable()
                ->searchable(),

            Column::make('Actualizado el', 'updated_at')
                ->sortable()
                ->searchable(),

            Column::action('Action')
        ];
    }

    public function filters(): array
    {
        return [
            Filter::datepicker('fecha_baja'),
        ];
    }

    #[\Livewire\Attributes\On('edit')]
    public function edit($rowId): void
    {
        $this->js('alert('.$rowId.')');
    }

    public function actions(Baja $row): array
    {
        $actions = [];

        if (Gate::allows('Editar Baja')) {
            $actions[] = Button::add('edit')
                ->slot('Editar')
                ->class('bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded')
                ->route('editarbaja', ['id' => Crypt::encrypt($row->id)]);
        }

        if (Gate::allows('Eliminar Baja')) {
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
