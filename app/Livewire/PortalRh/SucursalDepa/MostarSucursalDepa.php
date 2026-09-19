<?php

namespace App\Livewire\PortalRh\SucursalDepa;

use Livewire\Component;
use App\Models\PortalRH\Departamento;
use App\Models\PortalRH\Sucursal;
use App\Models\PortalRH\SucursalDepartamento;

use Illuminate\Support\Facades\DB;

class MostarSucursalDepa extends Component
{
    public $showModal = false; // Control para ventana emergente
    public $sucursalToDelete; // ID de la sucursal a eliminar

    public function redirigir()
    {
        return redirect()->route('agregarsucursaldepa');
    }

    // Método para eliminar un registro patronal
    protected $listeners = [
        'confirmDelete' => 'confirmDelete', // Captura el evento
    ]; 
    
    public function confirmDelete($id)
    {
        $this->sucursalToDelete = $id;
        $this->showModal = true;
    }
    
    public function deleteSucursalDepa()
    {
        if ($this->sucursalToDelete) {
            SucursalDepartamento::find($this->sucursalToDelete)->delete();
            session()->flash('message', 'Dato eliminado exitosamente.');
        }

        $this->sucursalToDelete = null;
        $this->showModal = false;

        return redirect()->route('mostrarsucursaldepa');
    }


    public function render()
    {
        $sucursaldepartament = DB::table('departamento_sucursal')
            ->join('sucursales', 'departamento_sucursal.sucursal_id', '=', 'sucursales.id')
            ->join('departamentos', 'departamento_sucursal.departamento_id', '=', 'departamentos.id')
            ->select(
                'sucursales.nombre_sucursal as sucursal_nombre',
                'departamentos.nombre_departamento as departamento_nombre'
            );

        return view('livewire.portal-rh.sucursal-depa.mostar-sucursal-depa', [
            'sucursaldepartament' => $sucursaldepartament
        ])->layout('layouts.client');
    }
}
