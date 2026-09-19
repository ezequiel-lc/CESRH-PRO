<?php

namespace App\Livewire\PortalRh\Incidencias;

use Livewire\Component;
use App\Models\PortalRH\Incidencia;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class VerIncidencias extends Component
{
    public $incidencias, $eventosCalendario;

    public function mount()
    {
        $user = Auth::user();

        // Obtener incidencias del usuario autenticado (para las tarjetas)
        $this->incidencias = Incidencia::with('users')
            ->whereHas('users', function ($query) use ($user) {
                $query->where('users.id', $user->id);
            })
            ->get();

        // Formatear incidencias para el calendario
        $this->eventosCalendario = $this->incidencias->map(function ($incidencia) {
            return [
                'title' => $incidencia->tipo_incidencia,
                'start' => $incidencia->fecha_inicio,
                'end' => date('Y-m-d', strtotime($incidencia->fecha_final)), // Para que incluya el último día
                'color' => match ($incidencia->tipo_incidencia) {
                    'Falta injustificada' => '#E9D5FF',
                    'Salida anticipada sin permiso' => '#C084FC',
                    'Olvido de marcar entrada/salida' => '#9333EA',
                    'Intento de marcar asistencia por otro trabajador' => '#6B21A8',
                    'Bajo rendimiento laboral' => '#BFDBFE',
                    'Incumplimiento de metas u objetivos' => '#60A5FA',
                    'Errores recurrentes en tareas asignadas' => '#2563EB',
                    'Retrasos constantes en la entrega de trabajos' => '#1E40AF',
                    'Falsificación de justificantes médicos' => '#D9F99D',
                    'Enfermedad contagiosa sin aviso previo' => '#A3E635',
                    'Uso inadecuado de recursos o herramientas de la empresa' => '#65A30D',
                    'Desobediencia a instrucciones superiores' => '#3F6212',
                    'Falta de respeto a compañeros o superiores' => '#FED7AA',
                    'Uso indebido del tiempo laboral (uso de redes sociales, celular, etc.)' => '#FB923C',
                    'Realización de actividades personales en horario laboral' => '#EA580C',
                    'Uso de lenguaje ofensivo o agresivo' => '#9A3412',
                    'Divulgación de información confidencial' => '#A7F3D0',
                    'Hurto o robo dentro de la empresa' => '#34D399',
                    'Fraude o alteración de documentos' => '#0D9488',
                    'Violencia física o amenazas en el trabajo' => '#115E59',
                    'Consumo de alcohol o drogas en horario laboral' => '#FECACA',
                    'Acoso sexual o discriminación' => '#F87171',
                    'Uso indebido de credenciales o accesos restringidos' => '#DC2626',
                    default => '#1E3A8A',
                }
            ];
        })->toArray();
    }
    
    public function render()
    {
        return view('livewire.portal-rh.incidencias.ver-incidencias', [
            'ver_cards' => $this->incidencias,  // Para las tarjetas
            'eventosCalendario' => $this->eventosCalendario,  // Para el calendario
        ])->layout('layouts.client');
    }
}
