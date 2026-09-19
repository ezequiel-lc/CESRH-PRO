<?php

namespace App\Livewire\PortalCapacitacion\Capacitaciones\CapGrupales;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ReconocimientoController
{
    public function descargar($id)
    {
        $capsGrupalesId = Crypt::decrypt($id);
    
        // Verificar si hay evidencias aprobadas antes de permitir la descarga
        $tieneEvidenciasAprobadas = DB::table('evidencias')
            ->whereIn('id', function ($query) use ($capsGrupalesId) {
                $query->select('evidencias_id')
                    ->from('participante_evidencia')
                    ->where('grupocursos_capacitaciones_id', $capsGrupalesId);
            })
            ->where('status', 'aprobado')
            ->exists();
    
        if (!$tieneEvidenciasAprobadas) {
            return redirect()->back()->with('error', 'No se puede descargar el reconocimiento sin evidencias aprobadas.');
        }
    
        // Obtener datos del curso
        $curso = DB::table('cursos')
            ->where('id', $capsGrupalesId)
            ->select('nombre', 'horas')
            ->first();
    
        // Obtener datos de las fechas de inicio y fin del curso
        $fechas = DB::table('grupocursos_capacitaciones')
            ->where('id', $capsGrupalesId)
            ->select('fechaIni', 'fechaFin')
            ->first();
    
        // Obtener el nombre del usuario autenticado
        $user = auth()->user();
    
        // Generar el PDF con los datos del curso, fechas y usuario
        $pdf = Pdf::loadView('livewire.portal-capacitacion.capacitaciones.cap-grupales.reconocimiento', [
            'id' => $capsGrupalesId,
            'curso' => $curso,
            'fechas' => $fechas,
            'user' => $user,
        ]);
    
        return $pdf->download('Reconocimiento.pdf');
    }
    

}

