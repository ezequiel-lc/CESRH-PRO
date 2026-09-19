<?php

namespace App\Livewire\ActivoFijo\Activos\ActivoMobiliario\AdminAdmin;

use App\Models\ActivoFijo\Activos\ActivoMobiliario;
use App\Models\PortalRH\Empresa;
use App\Models\PortalRH\Sucursal;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class Asignarmob extends Component
{
    use WithFileUploads;

    public $empresas, $sucursales;
    public $empresaSeleccionada;
    public $sucursalesFiltradas = [];
    public $sucursal_id;
    public $activosFiltrados = [];
    public $usuariosFiltrados = [];
    public $subirfoto1;
    public $usuarioSeleccionado;
    public $activoSeleccionado;
    public $observaciones;

    public function mount()
    {
        $this->empresas = Empresa::all();
        $this->empresaSeleccionada = Auth::user()->empresa_id;
        $this->sucursalesFiltradas = Sucursal::join('empresa_sucursal', 'sucursales.id', '=', 'empresa_sucursal.sucursal_id')
            ->where('empresa_sucursal.empresa_id', Auth::user()->empresa_id)
            ->get();
    }

    public function updatedEmpresaSeleccionada($empresaId)
    {
        $empresa = Empresa::find($empresaId);
        if ($empresa) {
            $this->sucursalesFiltradas = $empresa->sucursales;
        } else {
            $this->sucursalesFiltradas = [];
        }
        $this->sucursal_id = null;
        $this->activosFiltrados = [];
        $this->usuariosFiltrados = [];
    }

    public function updatedSucursalId($sucursalId)
    {
        if ($sucursalId) {
            $this->activosFiltrados = ActivoMobiliario::where('sucursal_id', $sucursalId)->get();
            $this->usuariosFiltrados = User::where('sucursal_id', $sucursalId)->get();
        } else {
            $this->activosFiltrados = [];
            $this->usuariosFiltrados = [];
        }
    }

    public function asignarActivo()
    {
        $this->validate([
            'usuarioSeleccionado' => 'required|exists:users,id',
            'activoSeleccionado' => 'required|exists:activos_mobiliarios,id', // Corregido
            'observaciones' => 'required|string',
            'subirfoto1' => 'nullable|image|max:1024',
        ]);

        $usuario = User::find($this->usuarioSeleccionado);
        $activo = ActivoMobiliario::find($this->activoSeleccionado);

        if (!$usuario || !$activo) {
            session()->flash('error', 'Usuario o activo no encontrado.');
            return;
        }

        // Definir la ruta base para las imágenes
        $rutaBase = 'ActivoFijo/Activos/ActivoMobiliario/Asignaciones/Admin'; // Corregido
        $nombreActivo = $activo->nombre ?? 'activo_' . $activo->id;

        // Manejar el almacenamiento de las imágenes
        $foto1Path = $this->subirfoto1 
            ? $this->subirfoto1->storeAs($rutaBase, "{$nombreActivo}-foto1.png", 'public') 
            : null;

        // Asignar el activo al usuario
        $usuario->activosMobiliario()->attach($activo->id, [ // Corregido a "activosMobiliario"
            'fecha_asignacion' => now(),
            'fecha_devolucion' => null,
            'observaciones' => $this->observaciones,
            'status' => 1,
            'foto1' => $foto1Path,
        ]);

        $activo->update([
            'status' => 'Asignado',
            'updated_at' => now(),
        ]);

        // Resetear campos después de la asignación
        $this->reset([
            'usuarioSeleccionado',
            'activoSeleccionado',
            'observaciones',
            'subirfoto1',
        ]);

        // Redirigir con mensaje de éxito
        session()->flash('message', 'Activo mobiliario asignado correctamente.');
        return redirect()->route('mostrarasignmobad');
    }

    public function render()
    {
        return view('livewire.activo-fijo.activos.activo-mobiliario.admin-admin.asignarmob')
            ->layout('layouts.navactivos');
    }
}