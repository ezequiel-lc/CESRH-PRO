<?php

namespace App\Livewire\PortalCapacitacion\Capacitaciones\CapGrupales\AdminSucursal;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\PortalCapacitacion\GrupocursoCapacitacion;
use App\Models\PortalRH\Empresa;
use App\Models\PortalRH\Sucursal;
use Illuminate\Support\Facades\Auth;

class MostrarCapacitacionesGrupalesSucursal extends Component
{
    use WithPagination;

    public $showModal = false; // Control para ventana emergente
    public $capacitacionToDelete;
    public $years = [];
    public $selectedYear = null;
    public $empresa_id;
    public $sucursal_id;
    public $capacitaciones = [];

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
        // Obtener el empresa_id y sucursal_id del usuario autenticado
        $this->empresa_id = Auth::user()->empresa_id;
        $this->sucursal_id = Auth::user()->sucursal_id;

        // Cargar las capacitaciones de la empresa y sucursal del usuario
        $this->capacitaciones = GrupocursoCapacitacion::where('empresa_id', $this->empresa_id)
            ->where('sucursal_id', $this->sucursal_id)
            ->get();
    }

    public function render()
    {
        return view('livewire.portal-capacitacion.capacitaciones.cap-grupales.admin-sucursal.mostrar-capacitaciones-grupales-sucursal', [
            'capacitaciones' => GrupocursoCapacitacion::where('empresa_id', $this->empresa_id)
                ->where('sucursal_id', $this->sucursal_id)
                ->doesntHave('participantes') // O usa la relación que corresponda
                ->with('curso') // Incluye los cursos
                ->paginate(3),
        ])->layout("layouts.portal_capacitacion");
    }
}