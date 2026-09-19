<?php

namespace App\Livewire\PortalCapacitacion\Capacitaciones\CapGrupales\AdminEmpresa;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;
use App\Models\PortalRH\Becario;
use App\Models\PortalRH\Practicante;
use App\Models\PortalRH\Trabajador;
use App\Models\PortalRH\Instructor;
use App\Models\PortalRH\Empresa;
use Illuminate\Support\Facades\DB;
use App\Models\PortalCapacitacion\GrupocursoCapacitacion;
use App\Models\PortalRH\Sucursal;
use App\Models\PortalRH\EmpresaSucursal;
use Illuminate\Support\Facades\Auth;

class MostrarCapacitacionesGrupalesEmpresa extends Component
{
    use WithPagination;

    public $showModal = false; // Control para ventana emergente
    public $capacitacionToDelete;
    public $years = [];
    public $selectedYear = null; 
    public $sucursal_id;
    public $sucursales = [];
    public $capacitaciones = [];
    public $empresa_id; // Asegúrate de que esta línea esté presente

    protected $listeners = [
        'confirmDelete' => 'confirmDelete', // Captura el evento
    ]; 
    
    public function confirmDelete($id)
    {
        $this->capacitacionToDelete = $id;
        $this->showModal = true; // Mostrar modal
    }

    public function deleteCapacitacion()
    {
        if ($this->capacitacionToDelete) {
            // Eliminar capacitación grupal
            GrupocursoCapacitacion::find($this->capacitacionToDelete)->delete();
            session()->flash('message', 'Capacitación grupal eliminada con éxito');
        }

        // Restablecer el estado
        $this->capacitacionToDelete = null;
        $this->showModal = false;

        return redirect()->route('verCapacitacionesGruEmpresa'); // Redirigir después de eliminar
    }

    public function mount()
    {
        // Obtener el empresa_id del usuario autenticado
        $this->empresa_id = Auth::user()->empresa_id;

        // Cargar las sucursales relacionadas con la empresa del usuario
        $this->sucursales = Empresa::find($this->empresa_id)->sucursales;

        // Cargar las capacitaciones de la empresa del usuario
        $this->capacitaciones = GrupocursoCapacitacion::where('empresa_id', $this->empresa_id)->get();
    }

    public function updatedSucursalId()
    {
        $this->filterCapacitaciones();
    }

    public function filterCapacitaciones()
    {
        $query = GrupocursoCapacitacion::query();

        // Filtrar por empresa_id del usuario autenticado
        $query->where('empresa_id', $this->empresa_id);

        if ($this->sucursal_id) {
            $query->where('sucursal_id', $this->sucursal_id);
        }

        $this->capacitaciones = $query->get();
    }

    public function render()
    {
        return view('livewire.portal-capacitacion.capacitaciones.cap-grupales.admin-empresa.mostrar-capacitaciones-grupales-empresa', [
            'capacitaciones' => GrupocursoCapacitacion::where('empresa_id', $this->empresa_id)
                ->doesntHave('participantes') // O usa la relación que corresponda
                ->with('curso') // Incluye los cursos
                ->paginate(3),
        ])->layout("layouts.portal_capacitacion");
    }
  
}   