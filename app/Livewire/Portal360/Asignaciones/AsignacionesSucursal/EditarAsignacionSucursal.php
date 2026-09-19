<?php

namespace App\Livewire\Portal360\Asignaciones\AsignacionesSucursal;

use App\Models\Encuestas360\Asignacion;
use App\Models\Encuestas360\Encuesta360;
use App\Models\Encuestas360\Relacion;
use App\Models\PortalRH\Empresa;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;
use Livewire\Component;

class EditarAsignacionSucursal extends Component
{
    public $asignacion;
    public $empresa_id;
    public $sucursal_id;
    public $tipo_user_calificador;
    public $calificador_id;
    public $tipo_user_calificado;
    public $calificado_id;
    public $relacion_id;
    public $encuesta_id;
    public $realizada;

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

    protected $rules = [
        'empresa_id' => 'required|exists:empresas,id',
        'sucursal_id' => 'required|exists:empresa_sucursal,id',
        'tipo_user_calificador' => 'required|in:Becario,Trabajador,Instructor,Practicante',
        'calificador_id' => 'required|exists:users,id',
        'tipo_user_calificado' => 'required|in:Becario,Trabajador,Instructor,Practicante',
        'calificado_id' => 'required|exists:users,id',
        'relacion_id' => 'required|exists:relaciones,id',
        'encuesta_id' => 'required|exists:360_encuestas,id',
        'realizada' => 'required|date'
    ];

    public function mount($id)
    {
        $this->asignacion = Asignacion::findOrFail(Crypt::decrypt($id));

        // Cargar datos de la asignación
        $this->empresa_id = $this->asignacion->empresa_id;
        $this->sucursal_id = $this->asignacion->sucursal_id;
        $this->tipo_user_calificador = $this->asignacion->calificador->tipo_user;
        $this->calificador_id = $this->asignacion->calificador_id;
        $this->tipo_user_calificado = $this->asignacion->calificado->tipo_user;
        $this->calificado_id = $this->asignacion->calificado_id;
        $this->relacion_id = $this->asignacion->relaciones_id;
        $this->encuesta_id = $this->asignacion->encuesta_id;
        $this->realizada = Carbon::parse($this->asignacion->fecha)->format('Y-m-d\TH:i');

        // Cargar empresas, relaciones y encuestas
        $this->empresas = Empresa::all();
        $this->relaciones = Relacion::all();
        $this->encuestas = Encuesta360::all();

        // Cargar usuarios y sucursales
        if ($this->empresa_id) {
            $empresa = Empresa::find($this->empresa_id);
            if ($empresa) {
                $this->sucursales = $empresa->sucursales;
            } else {
                $this->sucursales = collect(); // Si no se encuentra la empresa, establece sucursales como una colección vacía
            }
        } else {
            $this->sucursales = collect(); // Si no hay empresa_id, establece sucursales como una colección vacía
        }

        $this->usuarios = User::where('sucursal_id', $this->sucursal_id)->get();
        $this->usuarios_calificador = $this->usuarios->where('tipo_user', $this->tipo_user_calificador);
        $this->usuarios_calificado = $this->usuarios->where('tipo_user', $this->tipo_user_calificado);
    }
    public function updatedEmpresaId($value)
    {
        $this->sucursales = Empresa::find($value)->sucursales;
        $this->reset(['sucursal_id', 'tipo_user_calificador', 'calificador_id', 'tipo_user_calificado', 'calificado_id']);
    }

    public function updatedSucursalId($value)
    {
        $this->usuarios = User::where('sucursal_id', $value)->get();
        $this->reset(['tipo_user_calificador', 'calificador_id', 'tipo_user_calificado', 'calificado_id']);
    }

    public function updatedTipoUserCalificador($value)
    {
        $this->usuarios_calificador = $this->usuarios->where('tipo_user', $value);
        $this->reset('calificador_id');
    }

    public function updatedTipoUserCalificado($value)
    {
        $this->usuarios_calificado = $this->usuarios->where('tipo_user', $value);
        $this->reset('calificado_id');
    }
    public function saveAsignacionSucursal()
    {
        $this->validate();
        try {
            $this->asignacion->update([
                'calificador_id' => $this->calificador_id,
                'calificado_id' => $this->calificado_id,
                'relaciones_id' => $this->relacion_id,
                '360_encuestas_id' => $this->encuesta_id,
                'fecha' => Carbon::parse($this->realizada),
                'empresa_id' => $this->empresa_id,
                'sucursal_id' => $this->sucursal_id,
            ]);
    
            // Despachar el evento toastr-success
            $this->dispatch('toastr-success', message: 'Asignación actualizada correctamente');
    
            // Redirigir al usuario
            return redirect()->route('portal360.asignaciones.asignaciones-sucursal.mostrar-asignacion-sucursal');
        } catch (\Exception $e) {
            // En caso de error, despachar un evento toastr-error
            $this->dispatch('toastr-error', message: 'Error al actualizar la asignación: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.portal360.asignaciones.asignaciones-sucursal.editar-asignacion-sucursal')->layout('layouts.portal360');
    }

    // public function render()
    // {
    //     return view('livewire.portal360.asignaciones.asignaciones-sucursal.editar-asignacion-sucursal');
    // }
}
