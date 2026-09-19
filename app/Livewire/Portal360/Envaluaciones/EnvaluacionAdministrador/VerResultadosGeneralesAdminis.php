<?php

namespace App\Livewire\Portal360\Envaluaciones\EnvaluacionAdministrador;

use App\Models\Encuestas360\Asignacion;
use App\Models\PortalRH\EmpresaSucursal;
use Livewire\Component;

class VerResultadosGeneralesAdminis extends Component
{

    public $sucursalId;
    public $empresaNombre;
    public $sucursalNombre;
    public $resultados = [];

    public function mount($sucursalId)
    {
        $this->sucursalId = $sucursalId;
        
        $empresaSucursal = EmpresaSucursal::with(['empresa', 'sucursal'])
            ->where('id', $this->sucursalId)
            ->firstOrFail();
            
        $this->empresaNombre = $empresaSucursal->empresa->nombre ?? 'No especificado';
        $this->sucursalNombre = $empresaSucursal->sucursal->nombre_sucursal ?? 'No especificado';
        
        $asignaciones = Asignacion::with([
            'calificador.empresa',
            'calificado.sucursal',
            'calificado.departamento',
            'respuestasUsuario.respuesta360.pregunta'
        ])
        ->whereHas('calificado', function($query) use ($empresaSucursal) {
            $query->where('sucursal_id', $empresaSucursal->sucursal_id);
        })
        ->where('realizada', 1)
        ->get();
        
        $this->resultados = $this->obtenerResultadosPorSucursal($asignaciones);
    }
    
    private function obtenerResultadosPorSucursal($asignaciones)
    {
        $resultadosPorPregunta = [];
        
        if ($asignaciones->isEmpty()) {
            return [
                'Sin datos' => [
                    [
                        'nombre' => 'N/A',
                        'departamento' => 'N/A',
                        'autoevaluacion' => 0,
                        'promedio' => 0
                    ]
                ]
            ];
        }

        // Group by question and employee
        $preguntasAgrupadas = [];
        foreach ($asignaciones as $asignacion) {
            $esAutoevaluacion = $asignacion->calificador_id === $asignacion->calificado_id;
            $calificadoId = $asignacion->calificado_id;
            
            if (!isset($preguntasAgrupadas[$calificadoId])) {
                $preguntasAgrupadas[$calificadoId] = [
                    'nombre' => $asignacion->calificado->name,
                    'departamento' => $asignacion->calificado->departamento->nombre_departamento ?? 'No especificado',
                    'preguntas' => []
                ];
            }

            foreach ($asignacion->respuestasUsuario as $respuestaUsuario) {
                $preguntaId = $respuestaUsuario->respuesta360->preguntas_id;
                $preguntaTexto = $respuestaUsuario->respuesta360->pregunta->texto;
                
                if (!isset($preguntasAgrupadas[$calificadoId]['preguntas'][$preguntaId])) {
                    $preguntasAgrupadas[$calificadoId]['preguntas'][$preguntaId] = [
                        'texto' => $preguntaTexto,
                        'autoevaluacion' => null,
                        'sumaOtros' => 0,
                        'conteoOtros' => 0
                    ];
                }

                $puntuacion = $respuestaUsuario->respuesta360->puntuacion;
                if ($esAutoevaluacion) {
                    $preguntasAgrupadas[$calificadoId]['preguntas'][$preguntaId]['autoevaluacion'] = $puntuacion;
                } else {
                    $preguntasAgrupadas[$calificadoId]['preguntas'][$preguntaId]['sumaOtros'] += $puntuacion;
                    $preguntasAgrupadas[$calificadoId]['preguntas'][$preguntaId]['conteoOtros']++;
                }
            }
        }

        // Group by question
        $resultadosPorPreguntaTexto = [];
        foreach ($preguntasAgrupadas as $calificadoId => $data) {
            foreach ($data['preguntas'] as $preguntaId => $preguntaData) {
                $preguntaTexto = $preguntaData['texto'];
                $autoevaluacion = $preguntaData['autoevaluacion'] ?? 0;
                $promedio = $preguntaData['conteoOtros'] > 0 ? 
                    $preguntaData['sumaOtros'] / $preguntaData['conteoOtros'] : 0;

                if (!isset($resultadosPorPreguntaTexto[$preguntaTexto])) {
                    $resultadosPorPreguntaTexto[$preguntaTexto] = [];
                }

                $resultadosPorPreguntaTexto[$preguntaTexto][] = [
                    'nombre' => $data['nombre'],
                    'departamento' => $data['departamento'],
                    'autoevaluacion' => round($autoevaluacion, 1),
                    'promedio' => round($promedio, 1)
                ];
            }
        }

        // Add averages for each question
        foreach ($resultadosPorPreguntaTexto as $preguntaTexto => $resultados) {
            $sumaAutoevaluacion = 0;
            $sumaPromedio = 0;
            $conteo = count($resultados);

            foreach ($resultados as $resultado) {
                $sumaAutoevaluacion += $resultado['autoevaluacion'];
                $sumaPromedio += $resultado['promedio'];
            }

            $resultadosPorPreguntaTexto[$preguntaTexto][] = [
                'nombre' => 'Promedio final',
                'departamento' => '',
                'autoevaluacion' => $conteo > 0 ? round($sumaAutoevaluacion / $conteo, 1) : 0,
                'promedio' => $conteo > 0 ? round($sumaPromedio / $conteo, 1) : 0
            ];
        }

        return $resultadosPorPreguntaTexto;
    }
    public function render()
    {
        return view('livewire.portal360.envaluaciones.envaluacion-administrador.ver-resultados-generales-adminis', [
            'resultados' => $this->resultados,
        ])->layout('layouts.portal360');
    }
}
