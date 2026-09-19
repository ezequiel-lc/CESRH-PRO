<?php

namespace App\Livewire\Portal360\Asignaciones\AsignacionesEmpresa;

use App\Models\Encuestas360\Asignacion;
use App\Models\Encuestas360\Encuesta360;
use App\Models\Encuestas360\Relacion;
use App\Models\PortalRH\Empresa;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Livewire\Component;

class EditarAsignacionesEmpresa extends Component
{
    public $asignacion;
    public $asignacionId;
    public $sucursal_id;
    public $tipo_user_calificador;
    public $calificador_id;
    public $tipo_user_calificado;
    public $calificado_id;
    public $relacion_id;
    public $encuesta_id;
    public $realizada;
    public $resetRealizada = false;
    public $usuarios;
    public $usuarios_calificador;
    public $usuarios_calificado;
    public $relaciones;
    public $encuestas;
    public $sucursales = [];
    public $tipos_usuario = [
        'Becario',
        'Trabajador',
        'Instructor',
        'Practicante'
    ];
    protected $rules = [
        'sucursal_id' => 'required|exists:empresa_sucursal,id',
        'tipo_user_calificador' => 'required|in:Becario,Trabajador,Instructor,Practicante',
        'calificador_id' => 'required|exists:users,id',
        'tipo_user_calificado' => 'required|in:Becario,Trabajador,Instructor,Practicante',
        'calificado_id' => 'required|exists:users,id',
        'relacion_id' => 'required|exists:relaciones,id',
        'encuesta_id' => 'required|exists:360_encuestas,id',
        'realizada' => 'required|date',
        'resetRealizada' => 'boolean'
    ];
    
    public function mount($id)
    {
        $this->asignacionId = Crypt::decrypt($id);
        $this->cargarDatosAsignacion();
    }
    
    protected function cargarDatosAsignacion()
{
    $this->asignacion = Asignacion::with(['calificador', 'calificado', 'sucursal', 'relacion', 'encuesta'])
        ->findOrFail($this->asignacionId);

    $this->calificador_id = $this->asignacion->calificador_id;
    $this->calificado_id = $this->asignacion->calificado_id;
    
    // Obtener sucursal_id del calificador
    $calificador = $this->asignacion->calificador;
    $this->sucursal_id = $calificador ? $calificador->sucursal_id : null;

    $this->relacion_id = $this->asignacion->relaciones_id;
    $this->encuesta_id = $this->asignacion->{'360_encuestas_id'};
    $this->realizada = Carbon::parse($this->asignacion->fecha)->format('Y-m-d\TH:i');
    $this->resetRealizada = false;

    $this->tipo_user_calificador = $calificador ? $calificador->tipo_user : null;
    $calificado = $this->asignacion->calificado;
    $this->tipo_user_calificado = $calificado ? $calificado->tipo_user : null;

    $empresa_id = Auth::user()->empresa_id;
    $this->relaciones = Relacion::all();
    $this->encuestas = Encuesta360::where('empresa_id', $empresa_id)->get();
    $empresa = Empresa::with('sucursales')->find($empresa_id);
    $this->sucursales = $empresa ? $empresa->sucursales : collect();

    $this->cargarUsuariosSucursal();
}
    protected function cargarUsuariosSucursal()
    {
        if (!empty($this->sucursal_id)) {
            try {
                $usuarios_sucursal = User::where('sucursal_id', $this->sucursal_id)
                    ->where('empresa_id', Auth::user()->empresa_id)
                    ->get();
                
                if ($usuarios_sucursal->isEmpty()) {
                    // Si no hay usuarios específicos en esa sucursal, carga todos los de la empresa
                    $this->usuarios = User::where('empresa_id', Auth::user()->empresa_id)->get();
                    $this->dispatch('toastr-info', message: 'Se han cargado usuarios de toda la empresa ya que esta sucursal no tiene usuarios específicos');
                } else {
                    $this->usuarios = $usuarios_sucursal;
                }
                
                // Filtra los usuarios por tipo
                $this->filtrarUsuariosPorTipo();
                
            } catch (\Exception $e) {
                $this->dispatch('toastr-error', message: 'Error al cargar los usuarios: ' . $e->getMessage());
                $this->usuarios = collect();
                $this->usuarios_calificador = collect();
                $this->usuarios_calificado = collect();
            }
        } else {
            $this->usuarios = collect();
            $this->usuarios_calificador = collect();
            $this->usuarios_calificado = collect();
        }
    }
    
    protected function filtrarUsuariosPorTipo()
    {
        // Filtra los calificadores según el tipo seleccionado
        if (!empty($this->tipo_user_calificador)) {
            $this->usuarios_calificador = $this->usuarios->where('tipo_user', $this->tipo_user_calificador);
        } else {
            $this->usuarios_calificador = collect();
        }
        
        // Filtra los calificados según el tipo seleccionado
        if (!empty($this->tipo_user_calificado)) {
            $this->usuarios_calificado = $this->usuarios->where('tipo_user', $this->tipo_user_calificado);
        } else {
            $this->usuarios_calificado = collect();
        }
    }
    
    public function updatedSucursalId($value)
    {
        $this->cargarUsuariosSucursal();
        
        // Verifica si los usuarios seleccionados existen en la nueva sucursal
        if (!empty($this->calificador_id) && !$this->usuarios->contains('id', $this->calificador_id)) {
            $this->reset('calificador_id');
        }
        
        if (!empty($this->calificado_id) && !$this->usuarios->contains('id', $this->calificado_id)) {
            $this->reset('calificado_id');
        }
    }
    
    public function updatedTipoUserCalificador($value)
    {
        if (!empty($value)) {
            $this->usuarios_calificador = $this->usuarios->where('tipo_user', $value);
            
            // Verifica si el calificador actual coincide con el nuevo tipo
            $currentCalificador = $this->usuarios->firstWhere('id', $this->calificador_id);
            if (!$currentCalificador || $currentCalificador->tipo_user !== $value) {
                $this->reset('calificador_id');
            }
        } else {
            $this->usuarios_calificador = collect();
            $this->reset('calificador_id');
        }
    }
    
    public function updatedTipoUserCalificado($value)
    {
        if (!empty($value)) {
            $this->usuarios_calificado = $this->usuarios->where('tipo_user', $value);
            
            // Verifica si el calificado actual coincide con el nuevo tipo
            $currentCalificado = $this->usuarios->firstWhere('id', $this->calificado_id);
            if (!$currentCalificado || $currentCalificado->tipo_user !== $value) {
                $this->reset('calificado_id');
            }
        } else {
            $this->usuarios_calificado = collect();
            $this->reset('calificado_id');
        }
    }
    
    public function saveAsignacionEmpresa()
    {
        $this->validate();
        
        try {
            $encuesta = Encuesta360::findOrFail($this->encuesta_id);
            if ($encuesta->empresa_id !== Auth::user()->empresa_id) {
                $this->dispatch('toastr-error', message: 'La encuesta seleccionada no pertenece a tu empresa.');
                return;
            }
            
            $this->asignacion->update([
                'calificador_id' => $this->calificador_id,
                'calificado_id' => $this->calificado_id,
                'relaciones_id' => $this->relacion_id,
                '360_encuestas_id' => $this->encuesta_id,
                'realizada' => $this->resetRealizada ? 0 : $this->asignacion->realizada,
                'fecha' => Carbon::parse($this->realizada),
                'empresa_id' => Auth::user()->empresa_id,
                'sucursal_id' => $this->sucursal_id,
            ]);
            
            $message = 'Asignación actualizada correctamente.';
            if ($this->resetRealizada) {
                $message .= ' El estado de la encuesta se ha restablecido para poder contestarla nuevamente.';
            }
            $this->dispatch('toastr-success', message: $message);
            return redirect()->route('portal360.asignaciones.asignaciones-empresa.mostrar-asignaciones-empresa');
        } catch (\Exception $e) {
            $this->dispatch('toastr-error', message: 'Error al actualizar la asignación: ' . $e->getMessage());
        }
    }
    public function render()
    {
        return view('livewire.portal360.asignaciones.asignaciones-empresa.editar-asignaciones-empresa')->layout('layouts.portal360');
    }
}
