<?php

namespace App\Livewire;

use App\Models\ActivoFijo\Activos\ActivoPapeleria;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Facades\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;

final class ActivotecadTable extends PowerGridComponent
{
    public string $tableName = 'activotecad-table-1csuuc-table';

    public function setUp(): array
    {
        $this->showCheckBox();

        return [
            PowerGrid::header()
                ->showSearchInput(),
            PowerGrid::footer()
                ->showPerPage()
                ->showRecordCount(),
                PowerGrid::class()
        ];
    }

    public function datasource(): Builder
    {
        return ActivoPapeleria::query();
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('codigo_producto')
            ->add('nombre')
            ->add('marca')
            ->add('tipo')
            ->add('cantidad')
            ->add('estado')
            ->add('disponible')
            ->add('fecha_adquisicion_formatted', fn (ActivoPapeleria $model) => Carbon::parse($model->fecha_adquisicion)->format('d/m/Y'))
            ->add('fecha_baja')
            ->add('tipo_activo_id')
            ->add('aniosestimado_id')
            ->add('color')
            ->add('precio_unitario')
            ->add('foto1')
            ->add('foto2')
            ->add('foto3')
            ->add('empresa_id')
            ->add('sucursal_id')
            ->add('created_at');
    }

    public function columns(): array
    {
        return [
            Column::make('Id', 'id'),
            Column::make('Id', 'id'),
            Column::make('Codigo producto', 'codigo_producto')
                ->sortable()
                ->searchable(),

            Column::make('Nombre', 'nombre')
                ->sortable()
                ->searchable(),

            Column::make('Marca', 'marca')
                ->sortable()
                ->searchable(),

            Column::make('Tipo', 'tipo')
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

            Column::make('Fecha baja', 'fecha_baja')
                ->sortable()
                ->searchable(),

            Column::make('Tipo activo id', 'tipo_activo_id'),
            Column::make('Aniosestimado id', 'aniosestimado_id'),
            Column::make('Color', 'color')
                ->sortable()
                ->searchable(),

            Column::make('Precio unitario', 'precio_unitario')
                ->sortable()
                ->searchable(),

            Column::make('Foto1', 'foto1')
                ->sortable()
                ->searchable(),

            Column::make('Foto2', 'foto2')
                ->sortable()
                ->searchable(),

            Column::make('Foto3', 'foto3')
                ->sortable()
                ->searchable(),

            Column::make('Empresa id', 'empresa_id')
                ->sortable()
                ->searchable(),

            Column::make('Sucursal id', 'sucursal_id')
                ->sortable()
                ->searchable(),

            Column::make('Created at', 'created_at_formatted', 'created_at')
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
            Filter::datepicker('fecha_adquisicion'),
        ];
    }

    #[\Livewire\Attributes\On('edit')]
    public function edit($rowId): void
    {
        $this->js('alert('.$rowId.')');
    }

    public function actions(ActivoPapeleria $row): array
    {
        return [
            Button::add('edit')
                ->slot('Edit: '.$row->id)
                ->id()
                ->class('pg-btn-white dark:ring-pg-primary-600 dark:border-pg-primary-600 dark:hover:bg-pg-primary-700 dark:ring-offset-pg-primary-800 dark:text-pg-primary-300 dark:bg-pg-primary-700')
                ->dispatch('edit', ['rowId' => $row->id])
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
