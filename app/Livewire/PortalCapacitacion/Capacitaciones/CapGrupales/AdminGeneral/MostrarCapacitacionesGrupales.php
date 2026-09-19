<?php

namespace App\Livewire\PortalCapacitacion\Capacitaciones\CapGrupales\AdminGeneral;

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
use Illuminate\Support\Facades\Crypt;

class MostrarCapacitacionesGrupales extends Component
{
    use WithPagination;

    public $showModal = false; // Control para ventana emergente
    public $capacitacionToDelete;
    public $years = [];
    public $selectedYear = null; 
    public $empresa_id;
    public $sucursal_id;
    public $empresas = [];
    public $sucursales = [];
    public $capacitaciones = [];
    public $userSeleccionado;

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

        return redirect()->route('verCapacitacionesGru'); // Redirigir después de eliminar
    }

    public function mount()
    {

        $this->empresas = Empresa::all();
        $this->sucursales = collect();
        $this->capacitaciones = GrupocursoCapacitacion::all();
    }

    public function updatedEmpresaId()
    {
        if ($this->empresa_id) {
            $this->sucursales = Sucursal::whereIn('id', EmpresaSucursal::where('empresa_id', $this->empresa_id)->pluck('sucursal_id'))->get();
            $this->sucursal_id = null;
        } else {
            $this->sucursales = collect();
        }
        $this->filterCapacitaciones();

    }

    public function updatedSucursalId()
    {
        $this->filterCapacitaciones();
    }

    public function filterCapacitaciones()
    {
        $query = GrupocursoCapacitacion::query();

        if ($this->empresa_id) {
            $query->where('empresa_id', $this->empresa_id);
        }

        if ($this->sucursal_id) {
            $query->where('sucursal_id', $this->sucursal_id);
        }

        $this->capacitaciones = $query->get();
    }


    public function render()
    {
        return view('livewire.portal-capacitacion.capacitaciones.cap-grupales.admin-general.mostrar-capacitaciones-grupales', [
            'capacitaciones' => GrupocursoCapacitacion::doesntHave('participantes') // O usa la relación que corresponda
                ->with('curso') // Incluye los cursos
                ->paginate(3),
        ])->layout("layouts.portal_capacitacion");
    }
  
}
