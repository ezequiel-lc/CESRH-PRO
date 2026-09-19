<?php

namespace App\Livewire\ActivoFijo\TablasPower;

use App\Models\ActivoFijo\Activos\ActivoUniforme;
use App\Models\PortalRH\Sucursal;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Facades\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\Components\SetUp\Exportable;
use PowerComponents\LivewirePowerGrid\Traits\WithExport;

final class UniformeTable extends PowerGridComponent
{
    public string $tableName = 'uniforme-table-au1rtd-table';
    protected $listeners = ['refreshPowerGrid' => '$refresh'];


    public function setUp(): array
    {
        $this->showCheckBox();

        return [
            PowerGrid::exportable('export')
                ->striped()
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
        $usuario = Auth::user();

        // Obtener las sucursales asociadas a la empresa del usuario autenticado
        $sucursalesEmpresa = Sucursal::whereHas('empresas', function ($query) use ($usuario) {
            $query->where('empresas.id', $usuario->empresa_id);
        })->pluck('id');

        // Filtrar los activos por las sucursales de la empresa
        return ActivoUniforme::query()
            ->with(['tipoActivo'])
            ->whereIn('sucursal_id', $sucursalesEmpresa);
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('descripcion')
            ->add('talla')
            ->add('cantidad')
            ->add('estado')
            ->add('disponible')
            ->add('fecha_adquisicion_formatted', fn(ActivoUniforme $model) => Carbon::parse($model->fecha_adquisicion)->format('d/m/Y'))
            ->add('observaciones')
            ->add('tipo_activo_nombre', fn(ActivoUniforme $model) => $model->tipoActivo->nombre_activo ?? 'N/A')
            ->add('color')
            ->add('sucursal_nombre', fn(ActivoUniforme $model) => optional(Sucursal::where('id', $model->sucursal_id)->first())->nombre_sucursal ?? 'No asignado')
            ->add('status_formatted', fn($model) => match ($model->status) {
                'Activo' => '<span class="inline-flex items-center gap-1 rounded-full bg-green-50 px-2 py-1 text-xs font-semibold text-green-600"><span class="h-1.5 w-1.5 rounded-full bg-green-600"></span>Activo</span>',
                'Asignado' => '<span class="inline-flex items-center gap-1 rounded-full bg-blue-50 px-2 py-1 text-xs font-semibold text-blue-600"><span class="h-1.5 w-1.5 rounded-full bg-blue-600"></span>Asignado</span>',
                'Baja' => '<span class="inline-flex items-center gap-1 rounded-full bg-red-50 px-2 py-1 text-xs font-semibold text-red-600"><span class="h-1.5 w-1.5 rounded-full bg-red-600"></span>Baja</span>',
                default => '<span class="inline-flex items-center gap-1 rounded-full bg-gray-50 px-2 py-1 text-xs font-semibold text-gray-600"><span class="h-1.5 w-1.5 rounded-full bg-gray-600"></span>' . $model->status . '</span>'
            });
    }

    public function columns(): array
    {
        return [
            Column::make('Id', 'id'),
            Column::make('Descripcion', 'descripcion')
                ->sortable()
                ->searchable(),

            Column::make('Talla', 'talla')
                ->sortable()
                ->searchable(),

            Column::make('Cantidad', 'cantidad')
                ->sortable()
                ->searchable(),

            Column::make('Estado', 'estado')
                ->sortable()
                ->searchable(),

            Column::make('Disponible', 'disponible')
                ->sortable()
                ->searchable(),

            Column::make('Fecha adquisicion', 'fecha_adquisicion_formatted', 'fecha_adquisicion')
                ->sortable(),

            Column::make('Observaciones', 'observaciones')
                ->sortable()
                ->searchable(),

            Column::make('Tipo Activo', 'tipo_activo_nombre')
                ->sortable()
                ->searchable(),
            Column::make('Color', 'color')
                ->sortable()
                ->searchable(),
            Column::make('Sucursal', 'sucursal_nombre')
                ->sortable()
                ->searchable(),
            Column::make('Estado', 'status_formatted')
                ->sortable()
                ->searchable(),
            Column::action('Action')
        ];
    }

    public function filters(): array
    {
        $usuario = Auth::user();

        // Obtener solo las sucursales asociadas a la empresa del usuario
        $sucursales = Sucursal::whereHas('empresas', function ($query) use ($usuario) {
            $query->where('empresas.id', $usuario->empresa_id);
        })->get();

        return [
            Filter::datepicker('fecha_adquisicion'),
            Filter::datepicker('fecha_baja'),
            Filter::select('sucursal_id', 'sucursal_id')
                ->dataSource($sucursales)
                ->optionValue('id')
                ->optionLabel('nombre_sucursal'),
        ];
    }

    #[\Livewire\Attributes\On('edit')]
    public function edit($rowId): void
    {
        $this->js('alert(' . $rowId . ')');
    }

    public function actions(ActivoUniforme $row): array
    {
        return [
            Button::add('edit')
                ->icon('default-edit')
                ->class('btn btn-primary')
                ->route('editaruni', ['id' => $row->id]),
            Button::add('delete')
                ->icon('default-trash')
                ->class('btn btn-danger')
                ->dispatch('openModal', [
                    'component' => 'borrar-activo',
                    'arguments' => [
                        'vista' => 'mostraruni', // Nombre de la vista actual
                        'activo_id' => $row->id
                    ]
                ]),
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
