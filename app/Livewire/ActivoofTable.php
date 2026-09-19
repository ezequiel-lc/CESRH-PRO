<?php

namespace App\Livewire;

use App\Models\ActivoFijo\Activos\ActivoOficina;
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

final class ActivoofTable extends PowerGridComponent
{
    use WithExport;
    public string $tableName = 'activoof-table';
    protected $listeners = ['refreshPowerGrid' => '$refresh'];

    public function setUp(): array
    {
        $this->showCheckBox();

        return [
            PowerGrid::exportable('export')
                ->striped()
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
            PowerGrid::header()->showSearchInput(),
            PowerGrid::footer()->showPerPage()->showRecordCount(),
        ];
    }

    public function datasource(): Builder
    {
        $user = auth()->user();

        // Si el usuario no tiene sucursal, no mostrar nada
        if (!$user->sucursal_id) {
            return ActivoOficina::query()->whereRaw('1 = 0'); // Devuelve una consulta vacía
        }

        return ActivoOficina::query()
            ->with(['tipoActivo', 'anioEstimado'])
            ->where('sucursal_id', $user->sucursal_id);
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
            ->add('descripcion')
            ->add('numero_activo')
            ->add('ubicacion_fisica')
            ->add('tipo_activo_nombre', fn(ActivoOficina $model) => $model->tipoActivo->nombre_activo ?? 'N/A')
            ->add('fecha_adquisicion_formatted', fn(ActivoOficina $model) => $model->fecha_adquisicion ? Carbon::parse($model->fecha_adquisicion)->format('d/m/Y') : null)
            ->add('fecha_baja', fn(ActivoOficina $model) => $model->fecha_baja ? Carbon::parse($model->fecha_baja)->format('d/m/Y') : 'No disponible')
            ->add('precio_adquisicion')
            ->add('anioEstimado', fn(ActivoOficina $model) => $model->anioEstimado->vida_util_año ?? 'No asignado')
            ->add('created_at_formatted', fn(ActivoOficina $model) => $model->created_at->format('d/m/Y H:i'))
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
            Column::make('ID', 'id'),
            Column::make('Nombre', 'nombre')->sortable()->searchable(),
            Column::make('Descripción', 'descripcion')->sortable()->searchable(),
            Column::make('Número Activo', 'numero_activo')->sortable()->searchable(),
            Column::make('Ubicación Física', 'ubicacion_fisica')->sortable()->searchable(),
            Column::make('Tipo Activo', 'tipo_activo_nombre')
                ->sortable()
                ->searchable(),
            Column::make('Fecha Adquisición', 'fecha_adquisicion_formatted', 'fecha_adquisicion')->sortable(),
            Column::make('Fecha Baja', 'fecha_baja')->sortable(),
            Column::make('Precio Adquisición', 'precio_adquisicion')->sortable()->searchable(),
            Column::make('Año Estimado', 'anioEstimado')->sortable()->searchable(),
            Column::make('Creado el', 'created_at_formatted', 'created_at')->sortable(),
            Column::make('Estado', 'status_formatted')
                ->sortable()
                ->searchable(),
            Column::action('Action'),
        ];
    }

    public function filters(): array
    {
        return [
            Filter::datepicker('fecha_adquisicion'),
            Filter::datepicker('fecha_baja'),
        ];
    }

    #[\Livewire\Attributes\On('edit')]
    public function edit($rowId): void
    {
        $this->js('alert("Editando ID: ' . $rowId . '")');
    }

    public function actions(ActivoOficina $row): array
    {
        return [
            Button::add('edit')
                ->icon('default-edit')
                ->class('btn btn-primary')
                ->route('editaractofi', ['id' => $row->id]),
            Button::add('delete')
                ->icon('default-trash')
                ->class('btn btn-danger')
                ->dispatch('openModal', [
                    'component' => 'borrar-activo',
                    'arguments' => [
                        'vista' => 'mostraractofi', // Nombre de la vista actual
                        'activo_id' => $row->id
                    ]
                ]),
        ];
    }
}
