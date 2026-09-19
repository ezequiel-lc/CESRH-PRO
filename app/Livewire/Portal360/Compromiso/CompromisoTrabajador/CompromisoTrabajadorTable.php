<?php

namespace App\Livewire\Portal360\Compromiso\CompromisoTrabajador;

use App\Models\Encuestas360\Compromiso;
use App\Models\Encuestas360\RespuestaUsuario;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Components\SetUp\Exportable;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Facades\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\Traits\WithExport;

final class CompromisoTrabajadorTable extends PowerGridComponent
{
    public string $tableName = 'compromiso-trabajador-table-atox1b-table';
    use WithExport; // Agregamos el trait para exportación

    public function setUp(): array
    {
        $this->showCheckBox();

        return [
            PowerGrid::exportable('Compromisos_Trabajador_' . now()->format('Ymd_His')) 
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
        return Compromiso::query()
            ->where('users_id', Auth::id())
            ->with(['pregunta']);
    }

    public function relationSearch(): array
    {
        return [
            'pregunta' => ['texto'],
        ];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('alta_formatted', fn (Compromiso $model) => Carbon::parse($model->alta)->format('d/m/Y'))
            ->add('vencimiento_formatted', fn (Compromiso $model) => Carbon::parse($model->vencimiento)->format('d/m/Y'))
            ->add('compromiso')
            ->add('verificado', fn (Compromiso $model) => $model->verificado ? 'Sí' : 'No')
            ->add('pregunta_texto', fn (Compromiso $model) => $model->pregunta ? $model->pregunta->texto : 'Sin pregunta')
            ->add('autoevaluacion', function (Compromiso $model) {
                if ($model->preguntas_id) {
                    $autoevaluacion = RespuestaUsuario::whereHas('respuesta360', function ($query) use ($model) {
                        $query->where('preguntas_id', $model->preguntas_id);
                    })
                    ->whereHas('asignacion', function ($query) use ($model) {
                        $query->where('calificador_id', Auth::id())
                              ->where('calificado_id', Auth::id());
                    })
                    ->with('respuesta360')
                    ->first();

                    return $autoevaluacion ? number_format($autoevaluacion->respuesta360->puntuacion, 2) : 'N/A';
                }
                return 'N/A';
            })
            ->add('promedio_otros', function (Compromiso $model) {
                if ($model->preguntas_id) {
                    $promedio = RespuestaUsuario::whereHas('respuesta360', function ($query) use ($model) {
                        $query->where('preguntas_id', $model->preguntas_id);
                    })
                    ->whereHas('asignacion', function ($query) use ($model) {
                        $query->where('calificado_id', Auth::id())
                              ->where('calificador_id', '!=', Auth::id());
                    })
                    ->with('respuesta360')
                    ->get()
                    ->avg(function ($respuestaUsuario) {
                        return $respuestaUsuario->respuesta360->puntuacion;
                    });

                    return $promedio ? number_format($promedio, 2) : '0';
                }
                return 'N/A';
            })
            ->add('created_at');
    }

    public function columns(): array
    {
        return [
            Column::make('Pregunta', 'pregunta_texto')
                ->searchable(),

            Column::make('Autoevaluación', 'autoevaluacion'),

            Column::make('Promedio', 'promedio_otros'),

            Column::make('Fecha Inicio', 'alta_formatted', 'alta'),

            Column::make('Fecha Término', 'vencimiento_formatted', 'vencimiento'),

            Column::make('Compromiso', 'compromiso')
                ->searchable(),

            Column::make('Cumplido', 'verificado')
                ->searchable(),
        ];
    }

    public function filters(): array
    {
        return [];
    }

    
    #[\Livewire\Attributes\On('edit')]
    public function edit($rowId): void
    {
        $this->js('alert('.$rowId.')');
    }

    // public function actions(Compromiso $row): array
    // {
    //     return [
    //         // Button::add('edit')
    //         //     ->slot('Edit: '.$row->id)
    //         //     ->id()
    //         //     ->class('pg-btn-white dark:ring-pg-primary-600 dark:border-pg-primary-600 dark:hover:bg-pg-primary-700 dark:ring-offset-pg-primary-800 dark:text-pg-primary-300 dark:bg-pg-primary-700')
    //         //     ->dispatch('edit', ['rowId' => $row->id])
    //     ];
    // }

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
