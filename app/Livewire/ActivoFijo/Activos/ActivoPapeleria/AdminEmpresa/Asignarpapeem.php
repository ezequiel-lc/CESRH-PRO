<?php

namespace App\Livewire\ActivoFijo\Activos\ActivoPapeleria\AdminEmpresa;

use App\Models\ActivoFijo\Activos\ActivoPapeleria;
use App\Models\PortalRH\Empresa;
use App\Models\PortalRH\Sucursal;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;

class Asignarpapeem extends Component
{

    use WithFileUploads;

    public $empresa; // Empresa del usuario autenticado (solo lectura)
    public $sucursalesFiltradas = [];
    public $sucursal_id; // Sucursal seleccionada
    public $activosFiltrados = [];
    public $usuariosFiltrados = [];
    public $usuarioSeleccionado;
    public $activoSeleccionado;
    public $observaciones;

    public function mount()
    {
        // Obtener la empresa del usuario autenticado
        $this->empresa = Empresa::find(Auth::user()->empresa_id);

        // Cargar las sucursales de la empresa del usuario autenticado
        $this->sucursalesFiltradas = Sucursal::join('empresa_sucursal', 'sucursales.id', '=', 'empresa_sucursal.sucursal_id')
            ->where('empresa_sucursal.empresa_id', Auth::user()->empresa_id)
            ->select('sucursales.*') // Evitar duplicados
            ->distinct()
            ->get();
    }

    public function updatedSucursalId($sucursalId)  
    {
        if ($sucursalId) {
            $this->activosFiltrados = ActivoPapeleria::where('sucursal_id', $sucursalId)
                ->where('status', 'Activo')
                ->get();

            $this->usuariosFiltrados = User::where('sucursal_id', $sucursalId)
                ->where('empresa_id', Auth::user()->empresa_id)
                ->whereHas('roles', function ($query) {
                    $query->where('name', 'SusursalAdmin');
                })
                ->get();
        } else {
            $this->activosFiltrados = [];
            $this->usuariosFiltrados = [];
        }
    }

    public function asignarActivo()
    {
        $this->validate([
            'sucursal_id' => 'required|exists:sucursales,id',
            'usuarioSeleccionado' => 'required|exists:users,id',
            'activoSeleccionado' => 'required|exists:activos_papelerias,id',
            'observaciones' => 'required|string',
        ]);

        $usuario = User::find($this->usuarioSeleccionado);
        $activo = ActivoPapeleria::find($this->activoSeleccionado);

        if ($activo->status !== 'Activo') {
            session()->flash('error', 'El activo seleccionado no está disponible para asignación.');
            return;
        }
        if (!$usuario || !$activo) {
            session()->flash('error', 'Usuario o activo no encontrado.');
            return;
        }

        // Verificar que el usuario pertenece a la empresa del autenticado
        if ($usuario->empresa_id !== Auth::user()->empresa_id) {
            session()->flash('error', 'El usuario no pertenece a tu empresa.');
            return;
        }

        // Verificar que el activo pertenece a una sucursal de la empresa del autenticado
        $sucursalValida = DB::table('empresa_sucursal')
            ->where('sucursal_id', $activo->sucursal_id)
            ->where('empresa_id', Auth::user()->empresa_id)
            ->exists();

        if (!$sucursalValida) {
            session()->flash('error', 'El activo no pertenece a una sucursal de tu empresa.');
            return;
        }

        $rutaBase = 'ActivoFijo/Activos/ActivoPapeleria/Asignaciones/AdminEmpresa';
        $nombreActivo = $activo->nombre ?? 'activo_' . $activo->id;

        $usuario->activosPapeleria()->attach($activo->id, [
            'fecha_asignacion' => now(),
            'fecha_devolucion' => null,
            'observaciones' => $this->observaciones,
            'status' => 1,
        ]);
        
        $activo->update([
            'status' => 'Asignado',
            'updated_at' => now(),
        ]);  

        $this->reset([
            'sucursal_id',
            'usuarioSeleccionado',
            'activoSeleccionado',
            'observaciones',
        ]);

        session()->flash('message', 'Activo tecnológico asignado correctamente.');
        return redirect()->route('mostrarasignpapeem');
    }
    public function render()
    {
        return view('livewire.activo-fijo.activos.activo-papeleria.admin-empresa.asignarpapeem')->layout('layouts.navactivos');
    }
}
