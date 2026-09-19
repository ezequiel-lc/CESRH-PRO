<?php

namespace App\Livewire\PortalCapacitacion\AsociarPuestoTrabajador\AdminEmpresa;

use Livewire\Component;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;
use App\Models\PortalCapacitacion\PerfilPuesto;
use App\Models\PortalRH\Trabajador;
use App\Models\PortalRH\Becario;
use App\Models\PortalRH\Practicante;
use App\Models\PortalRH\Instructor;

class AsignarPerfilPuestoEmpresa extends Component
{
    public $usuario;
    public $perfiles = [];
    public $perfilSeleccionado;
    public $status;
    public $fecha_inicio;
    public $fecha_final;
    public $motivo_cambio;
    public $tipoUsuario;

    public function mount($id, $tipoUsuario)
    {
        $this->tipoUsuario = $tipoUsuario;
        $id = Crypt::decrypt($id);

        // Buscar el usuario en la tabla correspondiente según el tipo de usuario
        switch ($tipoUsuario) {
            case 'trabajador':
                $modelo = Trabajador::with('usuarios')->find($id);
                break;
            case 'becario':
                $modelo = Becario::with('usuarios')->find($id);
                break;
            case 'practicante':
                $modelo = Practicante::with('usuarios')->find($id);
                break;
            case 'instructor':
                $modelo = Instructor::with('usuarios')->find($id);
                break;
            default:
                abort(404, 'Tipo de usuario no válido.');
        }

        if (!$modelo || !$modelo->usuarios) {
            abort(404, 'Usuario no encontrado.');
        }

        // Asignamos la información del usuario correcto
        $this->usuario = $modelo->usuarios;

        // Obtener la empresa y sucursal del usuario autenticado
        $empresa_id = Auth::user()->empresa_id;
        $sucursal_id = Auth::user()->sucursal_id;

        // Filtrar los perfiles de puesto por la misma empresa y sucursal
        $this->perfiles = PerfilPuesto::where('empresa_id', $empresa_id)
            ->where('sucursal_id', $sucursal_id)
            ->get();
    }

    public function asignarPerfil()
    {
        $this->validate([
            'perfilSeleccionado' => 'required',
            'status' => 'required',
            'fecha_inicio' => 'required',
            'fecha_final' => 'required',
            'motivo_cambio' => 'required|string',
        ]);

        // Asigna el perfil de puesto al usuario en la tabla pivote
        $this->usuario->perfilesPuestos()->attach($this->perfilSeleccionado, [
            'status' => $this->status,
            'fecha_inicio' => $this->fecha_inicio,
            'fecha_final' => $this->fecha_final,
            'motivo_cambio' => $this->motivo_cambio,
        ]);

        $this->reset(['perfilSeleccionado', 'status', 'fecha_inicio', 'fecha_final', 'motivo_cambio']);

        session()->flash('success', 'Perfil de Puesto asignado exitosamente.');
    }

    public function render()
    {
        return view('livewire.portal-capacitacion.asociar-puesto-trabajador.admin-empresa.asignar-perfil-puesto-empresa')
            ->layout("layouts.portal_capacitacion");
    }
}
