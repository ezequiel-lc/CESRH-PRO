<?php

namespace App\Livewire\Portal360\Asignaciones\AsignacionesAdministrador;

use App\Models\Encuestas360\Asignacion;
use App\Models\Encuestas360\Encuesta360;
use App\Models\Encuestas360\Relacion;
use App\Models\PortalRH\Empresa;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;
use Livewire\Component;

class EditarAsignacionesAdministrador extends Component
{
    public $asignacionId;
    public $empresa_id = '';
    public $sucursal_id = '';
    public $tipo_user_calificador = '';
    public $calificador_id = '';
    public $tipo_user_calificado = '';
    public $calificado_id = '';
    public $relacion_id = '';
    public $encuesta_id = '';
    public $realizada; // Datetime string from the form (bound to fecha)
    public $resetRealizada = true; // New property for the checkbox

    public $usuarios;
    public $usuarios_calificador;
    public $usuarios_calificado;
    public $relaciones;
    public $encuestas;
    public $empresas;
    public $sucursales = [];
    public $tipos_usuario = [
        'Becario',
        'Trabajador',
        'Instructor',
        'Practicante'
    ];

    public function mount($id)
    {
        $this->asignacionId = Crypt::decrypt($id);
        $this->cargarDatosAsignacion();
    }

    protected function cargarDatosAsignacion()
    {
        $asignacion = Asignacion::with('calificador', 'calificado')->findOrFail($this->asignacionId);
    
        $this->calificador_id = $asignacion->calificador_id;
        $this->calificado_id = $asignacion->calificado_id;
    
        $calificador = User::with('empresa', 'sucursal')->findOrFail($this->calificador_id);
        $this->empresa_id = $calificador->empresa_id;
        $this->sucursal_id = $calificador->sucursal_id;
        $this->tipo_user_calificador = $calificador->tipo_user;
    
        $calificado = User::with('empresa', 'sucursal')->findOrFail($this->calificado_id);
        $this->tipo_user_calificado = $calificado->tipo_user;
    
        $this->relacion_id = $asignacion->relaciones_id;
        $this->encuesta_id = $asignacion->{'360_encuestas_id'}; // Corrige aquí
        $this->realizada = Carbon::parse($asignacion->fecha)->format('Y-m-d\TH:i');
        $this->resetRealizada = false;
    
        $this->empresas = Empresa::all();
        $this->relaciones = Relacion::all();
        $this->encuestas = Encuesta360::where('empresa_id', $this->empresa_id)->get();
    
        $this->usuarios = User::where('empresa_id', $this->empresa_id)
                            ->where('sucursal_id', $this->sucursal_id)
                            ->get();
    
        $this->usuarios_calificador = $this->usuarios->where('tipo_user', $this->tipo_user_calificador);
        $this->usuarios_calificado = $this->usuarios->where('tipo_user', $this->tipo_user_calificado);
    
        $empresa = Empresa::with('sucursales')->find($this->empresa_id);
        if ($empresa) {
            $this->sucursales = $empresa->sucursales;
            if ($this->sucursales->isEmpty()) {
                $this->dispatch('toastr-warning', message: 'No se encontraron sucursales para esta empresa');
            }
        } else {
            $this->sucursales = collect();
            $this->dispatch('toastr-error', message: 'No se encontró la empresa seleccionada');
        }
    }

    public function updatedEmpresaId($value)
    {
        if (!empty($value)) {
            try {
                $empresa = Empresa::with('sucursales')->findOrFail($value);
                $this->sucursales = $empresa->sucursales;

                $this->encuestas = Encuesta360::where('empresa_id', $value)->get();

                if ($this->sucursales->isEmpty()) {
                    $this->dispatch('toastr-error', message: 'No se encontraron sucursales para esta empresa');
                }

                $this->reset([
                    'sucursal_id',
                    'tipo_user_calificador',
                    'calificador_id',
                    'tipo_user_calificado',
                    'calificado_id',
                    'encuesta_id'
                ]);

                $this->usuarios = User::where('empresa_id', $value)->get();
            } catch (\Exception $e) {
                $this->dispatch('toastr-error', message: 'Error al cargar las sucursales y encuestas: ' . $e->getMessage());
                $this->sucursales = collect();
                $this->encuestas = collect();
                $this->usuarios = collect();
            }
        } else {
            $this->reset([
                'sucursal_id',
                'tipo_user_calificador',
                'calificador_id',
                'tipo_user_calificado',
                'calificado_id',
                'encuesta_id'
            ]);
            $this->sucursales = collect();
            $this->encuestas = collect();
            $this->usuarios = collect();
        }
    }

    public function updatedSucursalId($value)
    {
        if (!empty($value)) {
            try {
                $usuarios_sucursal = User::where('sucursal_id', $value)
                    ->where('empresa_id', $this->empresa_id)
                    ->get();

                if ($usuarios_sucursal->isEmpty()) {
                    $this->usuarios = User::where('empresa_id', $this->empresa_id)->get();
                    $this->dispatch('toastr-info', message: 'Se han cargado usuarios de toda la empresa ya que esta sucursal no tiene usuarios específicos');
                } else {
                    $this->usuarios = $usuarios_sucursal;
                }

                $this->reset(['tipo_user_calificador', 'calificador_id', 'tipo_user_calificado', 'calificado_id']);
            } catch (\Exception $e) {
                $this->dispatch('toastr-error', message: 'Error al cargar los usuarios: ' . $e->getMessage());
                $this->usuarios = collect();
            }
        } else {
            $this->reset(['tipo_user_calificador', 'calificador_id', 'tipo_user_calificado', 'calificado_id']);
            $this->usuarios = collect();
        }
    }

    public function updatedTipoUserCalificador($value)
    {
        if (!empty($value)) {
            $this->usuarios_calificador = $this->usuarios->where('tipo_user', $value);
            $this->reset('calificador_id');
        } else {
            $this->reset('calificador_id');
        }
    }
    public function updatedCalificadorId($value)
    {
        if (!empty($value)) {
            // No necesitas avanzar un "step" aquí
        }
    }

    public function updatedTipoUserCalificado($value)
    {
        if (!empty($value)) {
            $this->usuarios_calificado = $this->usuarios->where('tipo_user', $value);
            $this->reset('calificado_id');
        } else {
            $this->reset('calificado_id');
        }
    }

    public function updatedCalificadoId($value)
    {
        if (!empty($value)) {
            // No necesitas avanzar un "step" aquí
        }
    }

    public function updatedRelacionId($value)
    {
        if (!empty($value)) {
            // No necesitas avanzar un "step" aquí
        }
    }

    public function updatedEncuestaId($value)
    {
        if (!empty($value)) {
            // No necesitas avanzar un "step" aquí
        }
    }

    public function saveAsignacionAdministrador()
    {
        $this->validate([
            'empresa_id' => 'required|exists:empresas,id',
            'sucursal_id' => 'required|exists:sucursales,id',
            'tipo_user_calificador' => 'required|in:Becario,Trabajador,Instructor,Practicante',
            'calificador_id' => 'required|exists:users,id',
            'tipo_user_calificado' => 'required|in:Becario,Trabajador,Instructor,Practicante',
            'calificado_id' => 'required|exists:users,id',
            'relacion_id' => 'required|exists:relaciones,id',
            'encuesta_id' => 'required|exists:360_encuestas,id',
            'realizada' => 'required|date'
        ]);

        try {
            $asignacion = Asignacion::findOrFail($this->asignacionId);
            $asignacion->update([
                'calificador_id' => $this->calificador_id,
                'calificado_id' => $this->calificado_id,
                'relaciones_id' => $this->relacion_id,
                '360_encuestas_id' => $this->encuesta_id,
                'realizada' => $this->resetRealizada ? 0 : $asignacion->realizada, // Use checkbox value
                'fecha' => Carbon::parse($this->realizada),
                'empresa_id' => $this->empresa_id,
                'sucursal_id' => $this->sucursal_id,
            ]);

            $message = 'Asignación actualizada correctamente.';
            if ($this->resetRealizada) {
                $message .= ' El estado de la encuesta se ha restablecido para poder contestarla nuevamente.';
            }
            $this->dispatch('toastr-success', message: $message);
            return redirect()->route('portal360.asignaciones.asignaciones-administrador.mostrar-asignaciones-administrador');
        } catch (\Exception $e) {
            $this->dispatch('toastr-error', message: 'Error al actualizar la asignación: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.portal360.asignaciones.asignaciones-administrador.editar-asignaciones-administrador')->layout('layouts.portal360');
    }
}