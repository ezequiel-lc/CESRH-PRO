<?php

namespace App\Livewire\Portal360\Envaluaciones\ResultadosTrabajador;

use App\Models\Encuestas360\RespuestaUsuario;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Components\SetUp\Exportable;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Facades\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\Traits\WithExport;

final class ResultadosTrabajadorTable extends PowerGridComponent
{
    public string $tableName = 'resultados-trabajador-table-0sj5yb-table';

    public float $promedioFinal = 0;
    public string $resultadoFinal = '';
    use WithExport;

    public function setUp(): array
    {
        $this->showCheckBox();
        
        // Calcular el promedio final al cargar la tabla
        $this->calcularPromedioFinal();

        return [
            PowerGrid::exportable('Resultados_Trabajador_' . now()->format('Ymd_His'))
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
        return RespuestaUsuario::query()
            ->with(['respuesta360.pregunta', 'asignacion.calificado', 'asignacion.encuesta'])
            ->whereHas('asignacion', function ($query) {
                $query->where('calificado_id', auth()->id())
                      ->where('realizada', 1);
            });
    }

    public function relationSearch(): array
    {
        {
            return [
                'respuesta360' => [
                    'texto',
                ],
                'respuesta360.pregunta' => [
                    'texto',
                ],
                'asignacion' => [
                    'id',
                ],
                'asignacion.calificado' => [
                    'name', // Asumiendo que el usuario tiene un campo 'name'
                ],
                'asignacion.encuesta' => [
                    'nombre', // Asumiendo que la encuesta tiene un campo 'nombre'
                ],
            ];
        }
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
        ->add('competencia', fn (RespuestaUsuario $model) => $model->respuesta360->pregunta->texto)
        ->add('respuestas', fn (RespuestaUsuario $model) => $model->respuesta360->texto)  
        ->add('puntuacion', fn (RespuestaUsuario $model) => $this->calcularPromedio($model))  
        ->add('resultado', fn (RespuestaUsuario $model) => $this->obtenerColor($this->calcularPromedio($model)));  
    }

    public function columns(): array
    {
        return [
            Column::make('Competencias Evaluadas', 'competencia')->searchable(),
            Column::make('Respuestas', 'respuestas')->searchable(),  
            Column::make('Puntuación', 'puntuacion'), 
            Column::make('Resultado', 'resultado'),  
        ];
    }

    private function calcularPromedio(RespuestaUsuario $model): float
    {
        // Obtener todas las respuestas para la misma asignación y pregunta
        $respuestas = RespuestaUsuario::where('asignaciones_id', $model->asignaciones_id)
            ->whereHas('respuesta360', function ($query) use ($model) {
                $query->where('preguntas_id', $model->respuesta360->preguntas_id);
            })
            ->with('respuesta360')
            ->get();

        $total = $respuestas->sum(function ($respuestaUsuario) {
            return $respuestaUsuario->respuesta360->puntuacion;
        });

        $count = $respuestas->count();

        return $count > 0 ? $total / $count : 0;
    }

    private function obtenerColor(float $promedio): string
    {
        if ($promedio >= 0 && $promedio < 1) return 'Bajo';
        elseif ($promedio >= 1 && $promedio < 2) return 'Regular';
        elseif ($promedio >= 2 && $promedio < 3) return 'Bueno';
        elseif ($promedio >= 3 && $promedio <= 4) return 'Sobresaliente';
        return 'Desconocido';
    }
    
    private function calcularPromedioFinal(): void
    {
        $userId = auth()->id();
        
        // Consulta para obtener todas las asignaciones completadas para el usuario
        $asignaciones = DB::table('asignaciones')
            ->where('calificado_id', $userId)
            ->where('realizada', 1)
            ->pluck('id');
            
        if ($asignaciones->isEmpty()) {
            $this->promedioFinal = 0;
            $this->resultadoFinal = 'Desconocido';
            return;
        }
        
        // Obtener todas las respuestas para esas asignaciones
        $respuestas = RespuestaUsuario::whereIn('asignaciones_id', $asignaciones)
            ->with('respuesta360')
            ->get();
            
        if ($respuestas->isEmpty()) {
            $this->promedioFinal = 0;
            $this->resultadoFinal = 'Desconocido';
            return;
        }
        
        // Calcular el promedio final
        $totalPuntuacion = $respuestas->sum(function ($respuestaUsuario) {
            return $respuestaUsuario->respuesta360->puntuacion;
        });
        
        $this->promedioFinal = $totalPuntuacion / $respuestas->count();
        $this->resultadoFinal = $this->obtenerColor($this->promedioFinal);
    }

    

    public function filters(): array
    {
        return [];
    }

    #[\Livewire\Attributes\On('edit')]
    public function edit($rowId): void
    {
        $this->js('alert(' . $rowId . ')');
    }

    // public function actions(RespuestaUsuario $row): array
    // {
    //     return [
    //         Button::add('edit')
    //             ->slot('Edit: ' . $row->id)
    //             ->id()
    //             ->class('pg-btn-white dark:ring-pg-primary-600 dark:border-pg-primary-600 dark:hover:bg-pg-primary-700 dark:ring-offset-pg-primary-800 dark:text-pg-primary-300 dark:bg-pg-primary-700')
    //             ->dispatch('edit', ['rowId' => $row->id])
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
