<?php

namespace App\Livewire\PortalRh\DepartamentPuesto;

use Livewire\Component;
use App\Models\PortalRH\Departamento;
use App\Models\PortalRH\Puesto;
use App\Models\PortalRH\DepartamentoPuesto;
use Illuminate\Support\Facades\DB;

class MostrarDepartamentPuesto extends Component
{
    public $showModal = false; // Control para ventana emergente
    public $depaPuestoToDelete; // ID de la sucursal a eliminar

    public function redirigir()
    {
        return redirect()->route('agregardepapuesto');
    }

    // Método para eliminar un registro patronal
    protected $listeners = [
        'confirmDelete' => 'confirmDelete', // Captura el evento
    ]; 
    
    public function confirmDelete($id)
    {
        $this->depaPuestoToDelete = $id;
        $this->showModal = true;
    }
    
    public function deleteDepaPuesto()
    {
        if ($this->depaPuestoToDelete) {
            DepartamentoPuesto::find($this->depaPuestoToDelete)->delete();
            session()->flash('message', 'Dato eliminado exitosamente.');
        }

        $this->depaPuestoToDelete = null;
        $this->showModal = false;

        return redirect()->route('mostrardepapuesto');
    }

    public function render()
    {
        $departamentpuest = DB::table('departament_puest')
            ->join('departamentos', 'departament_puest.departamento_id', '=', 'departamentos.id')
            ->join('puestos', 'departament_puest.puesto_id', '=', 'puestos.id')
            ->select(
                'departamentos.nombre_departamento as departamento_nombre',
                'puestos.nombre_puesto as puesto_nombre'
            );

        return view('livewire.portal-rh.departament-puesto.mostrar-departament-puesto', [
            'departamentpuest' => $departamentpuest
        ])->layout('layouts.client');
    }
}
