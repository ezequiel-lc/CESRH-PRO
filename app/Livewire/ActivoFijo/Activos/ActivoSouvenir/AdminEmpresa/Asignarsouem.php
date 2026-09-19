<?php

namespace App\Livewire\ActivoFijo\Activos\ActivoSouvenir\AdminEmpresa;

use App\Models\ActivoFijo\Activos\ActivoSouvenir;
use App\Models\PortalRH\Empresa;
use App\Models\PortalRH\Sucursal;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;

class Asignarsouem extends Component
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
            $this->activosFiltrados = ActivoSouvenir::where('sucursal_id', $sucursalId)
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
            'activoSeleccionado' => 'required|exists:activos_souvenirs,id',
            'observaciones' => 'required|string',
        ]);

        $usuario = User::find($this->usuarioSeleccionado);
        $activo = ActivoSouvenir::find($this->activoSeleccionado);

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

        $rutaBase = 'ActivoFijo/Activos/ActivoSouvenir/Asignaciones/AdminEmpresa';
        $nombreActivo = $activo->nombre ?? 'activo_' . $activo->id;

        $usuario->activosSouvenir()->attach($activo->id, [
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
        return redirect()->route('mostrarasignsouem');
    }
    public function render()
    {
        return view('livewire.activo-fijo.activos.activo-souvenir.admin-empresa.asignarsouem')->layout('layouts.navactivos');
    }
}
