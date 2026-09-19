<?php

namespace App\Livewire\ActivoFijo\Activos\ActivoTecnologias\AdminAdmin;

use App\Models\ActivoFijo\Activos\ActivoTecnologia;
use App\Models\ActivoFijo\Tipoactivo;
use App\Models\PortalRH\Empresa;
use App\Models\PortalRH\Sucursal;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;

class Asignartec extends Component
{

    use WithFileUploads;
    public $empresas, $sucursales;
    public $empresaSeleccionada;
    public $sucursalesFiltradas = [];
    public $sucursal_id; // Agregamos esta propiedad para almacenar la sucursal seleccionada
    public $activosFiltrados = [];
    public $usuariosFiltrados = [];
    public $subirfoto1, $subirfoto2, $subirfoto3;
    public $usuarioSeleccionado; // Añadido
    public $activoSeleccionado;
    public $observaciones;

    public function mount()
    {
        // Obtener todas las empresas
        $this->empresas = Empresa::all();

        // Inicializar empresaSeleccionada con la empresa del usuario autenticado
        $this->empresaSeleccionada = Auth::user()->empresa_id;

        // Cargar sucursales de la empresa del usuario autenticado
        $this->sucursalesFiltradas = Sucursal::join('empresa_sucursal', 'sucursales.id', '=', 'empresa_sucursal.sucursal_id')
            ->where('empresa_sucursal.empresa_id', Auth::user()->empresa_id)
            ->get();
    }

    public function updatedEmpresaSeleccionada($empresaId)
    {
        // Obtén las sucursales relacionadas con la empresa seleccionada
        $empresa = Empresa::find($empresaId);
        if ($empresa) {
            $this->sucursalesFiltradas = $empresa->sucursales;
        } else {
            $this->sucursalesFiltradas = []; // Si no se encuentra la empresa, vacía el listado de sucursales
        }

        // Reiniciar la selección de sucursal
        $this->sucursal_id = null;
        $this->activosFiltrados = [];
        $this->usuariosFiltrados = [];
    }

    public function updatedSucursalId($sucursalId)
    {
        if ($sucursalId) {
            // Filtrar solo los activos con status 'Activo'
            $this->activosFiltrados = ActivoTecnologia::where('sucursal_id', $sucursalId)
                ->where('status', 'Activo')
                ->get();
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
            'activoSeleccionado' => 'required|exists:activos_tecnologias,id',
            'observaciones' => 'required|string',
            'subirfoto1' => 'nullable|image|max:1024',
            'subirfoto2' => 'nullable|image|max:1024',
            'subirfoto3' => 'nullable|image|max:1024',
        ]);

        $usuario = User::find($this->usuarioSeleccionado);
        $activo = ActivoTecnologia::find($this->activoSeleccionado);

        // Verificar que el activo está disponible (status = 'Activo')
        if ($activo->status !== 'Activo') {
            session()->flash('error', 'El activo seleccionado no está disponible para asignación.');
            return;
        }

        // Definir la ruta base para las imágenes
        $rutaBase = 'ActivoFijo/Activos/ActivoTecnologia/Asignaciones/Admin';
        $nombreActivo = $activo->nombre ?? 'activo_' . $activo->id;

        // Manejar el almacenamiento de las imágenes
        $foto1Path = $this->subirfoto1
            ? $this->subirfoto1->storeAs($rutaBase, "{$nombreActivo}-foto1.png", 'public')
            : null;
        $foto2Path = $this->subirfoto2
            ? $this->subirfoto2->storeAs($rutaBase, "{$nombreActivo}-foto2.png", 'public')
            : null;
        $foto3Path = $this->subirfoto3
            ? $this->subirfoto3->storeAs($rutaBase, "{$nombreActivo}-foto3.png", 'public')
            : null;

        // Usar una transacción para asegurar consistencia
        DB::transaction(function () use ($usuario, $activo, $foto1Path, $foto2Path, $foto3Path) {
            // Asignar el activo al usuario con status 1 (entero para activos_tecnologia_user)
            $usuario->activosTecnologia()->attach($activo->id, [
                'fecha_asignacion' => now(),
                'fecha_devolucion' => null,
                'observaciones' => $this->observaciones,
                'status' => 1, // 1 = Asignado (entero)
                'foto1' => $foto1Path,
                'foto2' => $foto2Path,
                'foto3' => $foto3Path,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Actualizar el status del activo a 'Asignado' (string para activos_tecnologias)
            $activo->update([
                'status' => 'Asignado',
                'updated_at' => now(),
            ]);  
        });

        // Resetear campos después de la asignación
        $this->reset([
            'usuarioSeleccionado',
            'activoSeleccionado',
            'observaciones',
            'subirfoto1',
            'subirfoto2',
            'subirfoto3',
        ]);

        // Mensaje de éxito y redirección
        session()->flash('message', 'Activo asignado correctamente.');
        return redirect()->route('mostrarasignaad');
    }

    public function render()
    {
        return view('livewire.activo-fijo.activos.activo-tecnologias.admin-admin.asignartec')->layout('layouts.navactivos');
    }
}
