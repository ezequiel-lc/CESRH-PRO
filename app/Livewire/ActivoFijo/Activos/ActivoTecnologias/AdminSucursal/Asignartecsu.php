<?php

namespace App\Livewire\ActivoFijo\Activos\ActivoTecnologias\AdminSucursal;

use App\Models\ActivoFijo\Activos\ActivoTecnologia;
use App\Models\PortalRH\Empresa;
use App\Models\PortalRH\Sucursal;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;

class Asignartecsu extends Component
{
    use WithFileUploads;

    public $empresa;
    public $sucursal;
    public $activosFiltrados = [];
    public $usuariosFiltrados = [];
    public $subirfoto1, $subirfoto2, $subirfoto3;
    public $usuarioSeleccionado;
    public $activoSeleccionado;
    public $observaciones;

    public function mount()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $this->empresa = Empresa::find($user->empresa_id);
        $this->sucursal = Sucursal::find($user->sucursal_id);

        if (!$user->hasRole('SusursalAdmin')) {
            session()->flash('error', 'No tienes permiso para realizar esta acción.');
            return redirect()->route('mostrarasigntecsuc');
        }

        // Filtrar activos por sucursal y status 'Activo'
        $this->activosFiltrados = ActivoTecnologia::where('sucursal_id', $this->sucursal->id)
            ->where('status', 'Activo')
            ->get();

        $this->usuariosFiltrados = User::where('sucursal_id', $this->sucursal->id)
            ->where('empresa_id', $user->empresa_id)
            ->whereHas('roles', function ($query) {
                $query->where('name', 'Trabajador GLOBAL');
            })
            ->get();
    }

    public function asignarActivo()
    {
        $this->validate([
            'usuarioSeleccionado' => 'required|exists:users,id',
            'activoSeleccionado' => 'required|exists:activos_tecnologias,id',
            'observaciones' => 'required|string',
            'subirfoto1' => 'nullable|image|max:1024',
            'subirfoto2' => 'nullable|image|max:1024',
            'subirfoto3' => 'nullable|image|max:1024',
        ], [
            'usuarioSeleccionado.required' => 'El usuario es obligatorio.',
            'activoSeleccionado.required' => 'El activo tecnológico es obligatorio.',
            'observaciones.required' => 'Las observaciones son obligatorias.',
        ]);

        $usuario = User::find($this->usuarioSeleccionado);
        $activo = ActivoTecnologia::find($this->activoSeleccionado);

        if (!$usuario || !$activo) {
            session()->flash('error', 'Usuario o activo no encontrado.');
            return;
        }

        if ($activo->status != 'Activo') {
            session()->flash('error', 'El activo seleccionado no está disponible para asignación.');
            return;
        }

        /** @var \App\Models\User $user */
        $user = Auth::user();

        if ($usuario->empresa_id != $user->empresa_id) {
            session()->flash('error', 'El usuario no pertenece a tu empresa.');
            return;
        }

        if ($usuario->sucursal_id != $this->sucursal->id) {
            session()->flash('error', 'El usuario no pertenece a tu sucursal.');
            return;
        }

        if ($activo->sucursal_id != $this->sucursal->id) {
            session()->flash('error', 'El activo no pertenece a tu sucursal.');
            return;
        }

        $rutaBase = 'ActivoFijo/Activos/ActivoTecnologia/Asignaciones/SusursalAdmin';
        $nombreActivo = $activo->nombre ?? 'activo_' . $activo->id;

        $foto1Path = $this->subirfoto1
            ? $this->subirfoto1->storeAs($rutaBase, "{$nombreActivo}-foto1.png", 'public')
            : null;
        $foto2Path = $this->subirfoto2
            ? $this->subirfoto2->storeAs($rutaBase, "{$nombreActivo}-foto2.png", 'public')
            : null;
        $foto3Path = $this->subirfoto3
            ? $this->subirfoto3->storeAs($rutaBase, "{$nombreActivo}-foto3.png", 'public')
            : null;

        $usuario->activosTecnologia()->attach($activo->id, [
            'fecha_asignacion' => now(),
            'fecha_devolucion' => null,
            'observaciones' => $this->observaciones,
            'status' => 1,
            'foto1' => $foto1Path,
            'foto2' => $foto2Path,
            'foto3' => $foto3Path,
        ]);

        $activo->update([
            'status' => 'Asignado',
            'updated_at' => now(),
        ]);

        $this->reset([
            'usuarioSeleccionado',
            'activoSeleccionado',
            'observaciones',
            'subirfoto1',
            'subirfoto2',
            'subirfoto3'
        ]);

        session()->flash('message', 'Activo tecnológico asignado correctamente.');
        return redirect()->route('mostrarasigntecsu');
    }

    public function render()
    {
        return view('livewire.activo-fijo.activos.activo-tecnologias.admin-sucursal.asignartecsu')->layout('layouts.navactivos');
    }
}