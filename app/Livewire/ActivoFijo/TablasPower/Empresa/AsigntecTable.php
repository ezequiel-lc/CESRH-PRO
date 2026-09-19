<?php

namespace App\Livewire\ActivoFijo\TablasPower\Empresa;

use Illuminate\Database\Query\Builder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
//use PowerComponents\LivewirePowerGrid\Exportable;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Facades\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\Components\SetUp\Exportable;


final class AsigntecTable extends PowerGridComponent
{
    public string $tableName = 'asigntec-table-odu84e-table';

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
        return DB::table('activos_tecnologia_user')
            ->join('users', 'activos_tecnologia_user.user_id', '=', 'users.id')
            ->join('activos_tecnologias', 'activos_tecnologia_user.activos_tecnologias_id', '=', 'activos_tecnologias.id')
            ->join('sucursales', 'activos_tecnologias.sucursal_id', '=', 'sucursales.id')
            ->join('empresa_sucursal', 'sucursales.id', '=', 'empresa_sucursal.sucursal_id')
            ->join('empresas', 'empresa_sucursal.empresa_id', '=', 'empresas.id')
            ->where('empresas.id', Auth::user()->empresa_id) // Filtrar por la empresa del usuario autenticado
            ->select([
                'activos_tecnologia_user.id',
                'users.name as usuario',
                'activos_tecnologias.nombre as activo',
                'sucursales.nombre_sucursal as sucursal',
                'empresas.nombre as empresa',
                'activos_tecnologia_user.fecha_asignacion',
                'activos_tecnologia_user.fecha_devolucion',
                'activos_tecnologia_user.observaciones',
                'activos_tecnologia_user.status',
                'activos_tecnologia_user.foto1',
                'activos_tecnologia_user.foto2',
                'activos_tecnologia_user.foto3',
                'activos_tecnologia_user.created_at',
                'activos_tecnologia_user.updated_at',
            ]);
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('usuario')
            ->add('activo')
            ->add('sucursal')
            ->add('empresa')
            ->add('fecha_asignacion')
            ->add('fecha_asignacion_formatted', fn($model) => Carbon::parse($model->fecha_asignacion)->format('d/m/Y'))
            ->add('fecha_devolucion')
            ->add('fecha_devolucion_formatted', fn($model) => $model->fecha_devolucion ? Carbon::parse($model->fecha_devolucion)->format('d/m/Y H:i') : 'No definida')
            ->add('observaciones')
            ->add('status_formatted', fn($model) => $model->status == 1
                ? '<span class="inline-flex items-center gap-1 rounded-full bg-green-50 px-2 py-1 text-xs font-semibold text-green-600"><span class="h-1.5 w-1.5 rounded-full bg-green-600"></span>Asignado</span>'
                : '<span class="inline-flex items-center gap-1 rounded-full bg-blue-50 px-2 py-1 text-xs font-semibold text-blue-600"><span class="h-1.5 w-1.5 rounded-full text-blue-600"></span>Devuelto</span>')->add('created_at')
            ->add('created_at_formatted', fn($model) => Carbon::parse($model->created_at)->format('d/m/Y H:i'))
            ->add('updated_at')
            ->add('updated_at_formatted', fn($model) => Carbon::parse($model->updated_at)->format('d/m/Y H:i'));
    }

    public function columns(): array
    {
        return [
            Column::make('Id', 'id')
                ->sortable()
                ->searchable(),

            Column::make('Usuario', 'usuario')
                ->sortable()
                ->searchable(),

            Column::make('Activo', 'activo')
                ->sortable()
                ->searchable(),

            Column::make('Sucursal', 'sucursal')
                ->sortable()
                ->searchable(),

            Column::make('Empresa', 'empresa')
                ->sortable()
                ->searchable(),

            Column::make('Fecha Asignación', 'fecha_asignacion_formatted', 'fecha_asignacion')
                ->sortable(),

            Column::make('Fecha Devolución', 'fecha_devolucion_formatted', 'fecha_devolucion')
                ->sortable(),

            Column::make('Observaciones', 'observaciones')
                ->sortable()
                ->searchable(),

            Column::make('Estado', 'status_formatted')->sortable()->searchable(), // Usar el campo formateado


            Column::make('Creado', 'created_at_formatted', 'created_at')
                ->sortable(),

            Column::make('Actualizado', 'updated_at_formatted', 'updated_at')
                ->sortable(),

            Column::action('Acciones')
        ];
    }

    public function filters(): array
    {
        return [
            Filter::datepicker('fecha_asignacion'),
            Filter::datepicker('fecha_devolucion'),
        ];
    }

    #[\Livewire\Attributes\On('devolver')]
    public function devolver($rowId): void
    {
        $registro = DB::table('activos_tecnologia_user')->where('id', $rowId)->first();
        if ($registro->status == 0) { // Comparar con entero
            return; // No hacer nada si ya está devuelto
        }

        DB::transaction(function () use ($rowId, $registro) {
            // Actualizar la asignación a 0 (Devuelto)
            DB::table('activos_tecnologia_user')
                ->where('id', $rowId)
                ->update([
                    'status' => 0, // 0 = Devuelto (entero)
                    'fecha_devolucion' => now(),
                    'updated_at' => now(),
                ]);

            // Actualizar el activo en activos_tecnologias a 'Activo'
            DB::table('activos_tecnologias')
                ->where('id', $registro->activos_tecnologias_id)
                ->update([
                    'status' => 'Activo', // String para activos_tecnologias
                    'updated_at' => now(),
                ]);
        });

        session()->flash('message', 'Activo marcado como devuelto correctamente.');
        $this->refresh();
    }

    #[\Livewire\Attributes\On('deleteAsignacion')]
    public function deleteAsignacion($rowId): void
    {
        DB::table('activos_tecnologia_user')
            ->where('id', $rowId)
            ->delete();

        session()->flash('message', 'Asignación eliminada correctamente.');
        $this->refresh();
    }

    public function actions($row): array
    {
        return [
            Button::add('devolver')
                ->icon('default-asign')
                ->class('btn btn-primary' . ($row->status == 0 ? ' disabled' : ''))
                ->dispatch('devolver', ['rowId' => $row->id]),

            Button::add('delete')
                ->icon('default-trash')
                ->class('btn btn-danger')
                ->dispatch('openModal', [
                    'component' => 'borrar-activo',
                    'arguments' => [
                        'vista' => 'asignaciones-tec-empresa', // Vista única para AdminEmpresa
                        'activo_id' => $row->id
                    ]
                ]),
        ];
    }
}
