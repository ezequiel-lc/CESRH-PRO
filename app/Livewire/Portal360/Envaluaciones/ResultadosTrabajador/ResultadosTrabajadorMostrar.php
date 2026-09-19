<?php

namespace App\Livewire\Portal360\Envaluaciones\ResultadosTrabajador;

use App\Models\Encuestas360\Asignacion;
use App\Models\Encuestas360\RespuestaUsuario;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Barryvdh\DomPDF\Facade\Pdf;
use IcehouseVentures\LaravelChartjs\Facades\Chartjs;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Spatie\Browsershot\Browsershot;

class ResultadosTrabajadorMostrar extends Component
{
    public float $promedioFinal = 0;
    public string $resultadoFinal = 'Desconocido';
    public string $calificadoNombre = '';
    public string $empresaNombre = '';
    public string $sucursalNombre = '';
    public array $datosGrafica = [];
    public $chartBase64 = null;
    public array $datosTabla = [
        'items' => [],
        'promedioAutoevaluacion' => 0,
        'promedioOtros' => 0,
        'promedioDiferencia' => 0,
    ];

    public function mount()
    {
        $this->calcularPromedioFinal();
        $this->obtenerDatosCalificado();
        $this->datosGrafica = $this->obtenerDatosGrafica();
        $this->chartBase64 = $this->generateChartBase64();
        $this->datosTabla = $this->obtenerDatosTabla();
    }

    private function calcularPromedioFinal(): void
    {
        $userId = auth()->id();
        $asignaciones = DB::table('asignaciones')
            ->where('calificado_id', $userId)
            ->where('realizada', 1)
            ->pluck('id');

        if ($asignaciones->isEmpty()) {
            return;
        }

        $respuestas = RespuestaUsuario::whereIn('asignaciones_id', $asignaciones)
            ->with('respuesta360')
            ->get();

        if ($respuestas->isEmpty()) {
            return;
        }

        $totalPuntuacion = $respuestas->sum(function ($respuestaUsuario) {
            return $respuestaUsuario->respuesta360->puntuacion;
        });

        $this->promedioFinal = $totalPuntuacion / $respuestas->count();
        $this->resultadoFinal = $this->obtenerColor($this->promedioFinal);
    }

    private function obtenerColor(float $promedio): string
    {
        if ($promedio >= 0 && $promedio < 1) return 'Bajo';
        elseif ($promedio >= 1 && $promedio < 2) return 'Regular';
        elseif ($promedio >= 2 && $promedio < 3) return 'Bueno';
        elseif ($promedio >= 3 && $promedio <= 4) return 'Sobresaliente';
        return 'Desconocido';
    }

    private function obtenerDatosCalificado(): void
    {
        $userId = auth()->id();
        $asignacion = Asignacion::where('calificado_id', $userId)
            ->with(['calificado', 'calificador.empresa', 'calificador.sucursal'])
            ->latest()
            ->first();

        if ($asignacion) {
            $this->calificadoNombre = $asignacion->calificado->name;
            $this->empresaNombre = $asignacion->calificador->empresa->nombre;
            $this->sucursalNombre = $asignacion->calificador->sucursal->nombre_sucursal ?? 'No especificada';
        }
    }

    private function obtenerDatosTabla(): array
    {
        $userId = auth()->id();
        $asignaciones = Asignacion::where('calificado_id', $userId)
            ->where('realizada', 1)
            ->with('respuestasUsuario.respuesta360.pregunta')
            ->get();

        if ($asignaciones->isEmpty()) {
            return [
                'items' => [],
                'promedioAutoevaluacion' => 0,
                'promedioOtros' => 0,
                'promedioDiferencia' => 0,
            ];
        }

        $datosTabla = [];
        $preguntasAgrupadas = [];
        $sumaAutoevaluacion = 0;
        $conteoAutoevaluacion = 0;
        $sumaPromedioOtros = 0;

        foreach ($asignaciones as $asignacion) {
            $esAutoevaluacion = $asignacion->calificador_id === $asignacion->calificado_id;

            foreach ($asignacion->respuestasUsuario as $respuesta) {
                $preguntaId = $respuesta->respuesta360->preguntas_id;
                $puntuacion = $respuesta->respuesta360->puntuacion;
                $preguntaTexto = $respuesta->respuesta360->pregunta->texto;

                if (!isset($preguntasAgrupadas[$preguntaId])) {
                    $preguntasAgrupadas[$preguntaId] = [
                        'texto' => $preguntaTexto,
                        'autoevaluacion' => null,
                        'sumaOtros' => 0,
                        'conteoOtros' => 0,
                    ];
                }

                if ($esAutoevaluacion) {
                    $preguntasAgrupadas[$preguntaId]['autoevaluacion'] = $puntuacion;
                    $sumaAutoevaluacion += $puntuacion;
                    $conteoAutoevaluacion++;
                } else {
                    $preguntasAgrupadas[$preguntaId]['sumaOtros'] += $puntuacion;
                    $preguntasAgrupadas[$preguntaId]['conteoOtros']++;
                }
            }
        }

        foreach ($preguntasAgrupadas as $preguntaId => $data) {
            $autoevaluacion = $data['autoevaluacion'] ?? 0;
            $promedioOtros = $data['conteoOtros'] > 0 ? $data['sumaOtros'] / $data['conteoOtros'] : 0;
            $diferencia = $autoevaluacion - $promedioOtros;

            $sumaPromedioOtros += $promedioOtros;

            $datosTabla[] = [
                'competencia' => $data['texto'],
                'autoevaluacion' => round($autoevaluacion, 1),
                'promedio' => round($promedioOtros, 1),
                'diferencia' => round($diferencia, 1),
            ];
        }

        $promedioAutoevaluacion = $conteoAutoevaluacion > 0 ? $sumaAutoevaluacion / $conteoAutoevaluacion : 0;
        $promedioOtros = count($datosTabla) > 0 ? $sumaPromedioOtros / count($datosTabla) : 0;
        $promedioDiferencia = $promedioAutoevaluacion - $promedioOtros;

        return [
            'items' => $datosTabla,
            'promedioAutoevaluacion' => round($promedioAutoevaluacion, 1),
            'promedioOtros' => round($promedioOtros, 1),
            'promedioDiferencia' => round($promedioDiferencia, 1),
        ];
    }

    private function obtenerDatosGrafica(): array
    {
        $userId = auth()->id();
        $asignaciones = Asignacion::where('calificado_id', $userId)
            ->where('realizada', 1)
            ->with('respuestasUsuario.respuesta360.pregunta')
            ->get();

        if ($asignaciones->isEmpty()) {
            return [];
        }

        $preguntasAgrupadas = [];

        foreach ($asignaciones as $asignacion) {
            $esAutoevaluacion = $asignacion->calificador_id === $asignacion->calificado_id;

            foreach ($asignacion->respuestasUsuario as $respuesta) {
                $preguntaId = $respuesta->respuesta360->preguntas_id;
                $puntuacion = $respuesta->respuesta360->puntuacion;
                $preguntaTexto = $respuesta->respuesta360->pregunta->texto;

                if (!isset($preguntasAgrupadas[$preguntaId])) {
                    $preguntasAgrupadas[$preguntaId] = [
                        'texto' => $preguntaTexto,
                        'autoevaluacion' => null,
                        'sumaOtros' => 0,
                        'conteoOtros' => 0,
                    ];
                }

                if ($esAutoevaluacion) {
                    $preguntasAgrupadas[$preguntaId]['autoevaluacion'] = $puntuacion;
                } else {
                    $preguntasAgrupadas[$preguntaId]['sumaOtros'] += $puntuacion;
                    $preguntasAgrupadas[$preguntaId]['conteoOtros']++;
                }
            }
        }

        $datosGrafica = [];
        foreach ($preguntasAgrupadas as $preguntaId => $data) {
            $autoevaluacion = $data['autoevaluacion'] ?? 0;
            $promedioOtros = $data['conteoOtros'] > 0 ? $data['sumaOtros'] / $data['conteoOtros'] : 0;

            $datosGrafica[] = [
                'pregunta' => $data['texto'],
                'puntuacion' => round($promedioOtros, 2),
                'autoevaluacion' => round($autoevaluacion, 2),
            ];
        }

        return $datosGrafica;
    }

    private function generateChartBase64()
    {
        $totalPreguntas = count($this->datosGrafica);
        if ($totalPreguntas === 0) {
            return null;
        }

        $labels = array_column($this->datosGrafica, 'pregunta');
        $dataPuntuacion = array_column($this->datosGrafica, 'puntuacion');
        $dataAutoevaluacion = array_column($this->datosGrafica, 'autoevaluacion');

        $chartConfig = [
            'type' => 'horizontalBar',
            'data' => [
                'labels' => $labels,
                'datasets' => [
                    [
                        'label' => 'Promedio',
                        'data' => $dataPuntuacion,
                        'backgroundColor' => 'gold',
                        'barThickness' => 15,
                    ],
                    [
                        'label' => 'Autoevaluación',
                        'data' => $dataAutoevaluacion,
                        'backgroundColor' => 'skyblue',
                        'barThickness' => 15,
                    ],
                ],
            ],
            'options' => [
                'responsive' => true,
                'maintainAspectRatio' => false,
                'scales' => [
                    'xAxes' => [
                        [
                            'ticks' => [
                                'beginAtZero' => true,
                                'max' => 4,
                                'fontColor' => 'black',
                                'fontSize' => 10,
                            ],
                            'gridLines' => [
                                'color' => 'rgba(0, 0, 0, 0.1)',
                                'zeroLineWidth' => 1,
                                'zeroLineColor' => 'black',
                            ],
                        ],
                    ],
                    'yAxes' => [
                        [
                            'ticks' => [
                                'fontColor' => 'black',
                                'fontSize' => 12,
                            ],
                            'gridLines' => [
                                'display' => false,
                            ],
                        ],
                    ],
                ],
                'legend' => [
                    'display' => true,
                    'position' => 'top',
                    'labels' => [
                        'fontColor' => 'black',
                        'fontSize' => 12
                    ]
                ],
            ],
        ];

        $jsonConfig = json_encode($chartConfig);
        $response = Http::get('https://quickchart.io/chart', [
            'c' => $jsonConfig,
            'width' => 1000,
            'height' => 400,
        ]);

        if ($response->successful()) {
            return "data:image/png;base64," . base64_encode($response->body());
        }

        Log::error('Error al generar gráfico con QuickChart', [
            'status' => $response->status(),
            'body' => $response->body(),
        ]);
        return null;
    }

    public function exportarPDF()
    {
        $data = [
            'promedioFinal' => $this->promedioFinal,
            'resultadoFinal' => $this->resultadoFinal,
            'calificadoNombre' => $this->calificadoNombre,
            'empresaNombre' => $this->empresaNombre,
            'sucursalNombre' => $this->sucursalNombre,
            'datosGrafica' => $this->datosGrafica,
            'chartBase64' => $this->chartBase64,
            'datosTabla' => $this->datosTabla,
        ];

        $pdf = Pdf::loadView('livewire.portal360.envaluaciones.resultados-trabajador.resultados-trabajador-pdf', $data)
            ->setPaper('a4', 'portrait')
            ->setOptions([
                'dpi' => 150,
                'isRemoteEnabled' => true,
                'isHtml5ParserEnabled' => true,
            ]);

        return response()->streamDownload(
            fn() => print($pdf->output()),
            'resultados_evaluacion_360_' . $this->calificadoNombre . '.pdf'
        );
    }

    public function render()
    {
        return view('livewire.portal360.envaluaciones.resultados-trabajador.resultados-trabajador-mostrar')
            ->layout('layouts.portal360');
    }
}
