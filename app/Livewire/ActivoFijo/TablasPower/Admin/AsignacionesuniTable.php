<?php

namespace App\Livewire\ActivoFijo\TablasPower\Admin;

use Illuminate\Database\Query\Builder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
//use PowerComponents\LivewirePowerGrid\Exportable;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Facades\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\Components\SetUp\Exportable;


final class AsignacionesuniTable extends PowerGridComponent
{
    public string $tableName = 'asignacionesuni-table-egoibi-table';

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
        return DB::table('activos_uniforme_user')
            ->join('users', 'activos_uniforme_user.user_id', '=', 'users.id')
            ->join('activos_uniformes', 'activos_uniforme_user.activos_uniformes_id', '=', 'activos_uniformes.id')
            ->join('sucursales', 'activos_uniformes.sucursal_id', '=', 'sucursales.id')
            ->join('empresa_sucursal', 'sucursales.id', '=', 'empresa_sucursal.sucursal_id')
            ->join('empresas', 'empresa_sucursal.empresa_id', '=', 'empresas.id')
            ->select([
                'activos_uniforme_user.id',
                'users.name as usuario',
                'activos_uniformes.descripcion as activo',
                'sucursales.nombre_sucursal as sucursal', // Nombre de la sucursal
                'empresas.nombre as empresa',             // Nombre de la empresa
                'activos_uniforme_user.fecha_asignacion',
                'activos_uniforme_user.fecha_devolucion',
                'activos_uniforme_user.observaciones',
                'activos_uniforme_user.status',
                'activos_uniforme_user.foto',
                'activos_uniforme_user.created_at',
                'activos_uniforme_user.updated_at',
            ]);
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('usuario') // Campo del join con users.name
            ->add('activo')  // Campo del join con activos_tecnologias.nombre
            ->add('sucursal')  // Añadido
            ->add('empresa')
            ->add('fecha_asignacion')
            ->add('fecha_asignacion_formatted', fn($model) => Carbon::parse($model->fecha_asignacion)->format('d/m/Y'))
            ->add('fecha_devolucion')
            ->add('fecha_devolucion_formatted', fn($model) => $model->fecha_devolucion ? Carbon::parse($model->fecha_devolucion)->format('d/m/Y') : 'No definida')
            ->add('observaciones')
            ->add('status', fn($model) => $model->status ? 'Asignado' : 'Devuelto')
            ->add('created_at')
            ->add('created_at_formatted', fn($model) => Carbon::parse($model->created_at)->format('d/m/Y H:i'))
            ->add('updated_at')
            ->add('updated_at_formatted', fn($model) => Carbon::parse($model->updated_at)->format('d/m/Y H:i'));
    }

    public function columns(): array
    {
        return [
            Column::make('Id', 'id'),
            Column::make('Usuario', 'usuario') // Corregido
                ->sortable()
                ->searchable(),

            Column::make('Activo', 'activo') // Corregido
                ->sortable()
                ->searchable(),

            Column::make('Sucursal', 'sucursal') // Añadido
                ->sortable()
                ->searchable(),

            Column::make('Empresa', 'empresa')   // Añadido
                ->sortable()
                ->searchable(),
            Column::make('Fecha asignacion', 'fecha_asignacion_formatted', 'fecha_asignacion')
                ->sortable(),

            Column::make('Fecha devolucion', 'fecha_devolucion_formatted', 'fecha_devolucion')
                ->sortable(),

            Column::make('Observaciones', 'observaciones')
                ->sortable()
                ->searchable(),

            Column::make('Estado', 'status')
                ->sortable()
                ->searchable(),

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
        $registro = DB::table('activos_uniforme_user')->where('id', $rowId)->first();
        if ($registro->status == 0) { // Comparar con entero
            return; // No hacer nada si ya está devuelto
        }

        DB::transaction(function () use ($rowId, $registro) {
            // Actualizar la asignación a 0 (Devuelto)
            DB::table('activos_uniforme_user')
                ->where('id', $rowId)
                ->update([
                    'status' => 0, // 0 = Devuelto (entero)
                    'fecha_devolucion' => now(),
                    'updated_at' => now(),
                ]);

            // Actualizar el activo en activos_tecnologias a 'Activo'
            DB::table('activos_uniformes')
                ->where('id', $registro->activos_uniformes_id)
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
        DB::table('activos_uniforme_user')
            ->where('id', $rowId)
            ->delete();

        session()->flash('message', 'Asignación eliminada correctamente.');
        $this->refresh();
    }

    public function actions($row): array
    {
        return [
            Button::add('devolver')
                ->icon('default-asign') // Manteniendo el ícono
                ->id()
                ->class('btn btn-primary' . ($row->status == 0 ? ' disabled' : '')) // Clase condicional
                ->dispatch('devolver', ['rowId' => $row->id]),

            Button::add('delete')
                ->icon('default-trash')
                ->class('btn btn-danger')
                ->dispatch('openModal', [
                    'component' => 'borrar-activo',
                    'arguments' => [
                        'vista' => 'asignaciones-uni', // Nombre único para esta vista
                        'activo_id' => $row->id // ID de la asignación
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
