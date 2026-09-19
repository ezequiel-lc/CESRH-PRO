<?php

namespace App\Livewire\PortalRh\EmpresSucursal;

use Livewire\Component;
use App\Models\PortalRH\Empresa;
use App\Models\PortalRH\Sucursal;
use App\Models\PortalRH\EmpresaSucursal;
use Illuminate\Support\Facades\DB;

class MostrarEmpresSucursal extends Component
{
    public $showModal = false; // Control para ventana emergente
    public $empresSucursalToDelete; // ID de la sucursal a eliminar

    public function redirigir()
    {
        return redirect()->route('agregarempressucursal');
    }

    // Método para eliminar un registro patronal
    protected $listeners = [
        'confirmDelete' => 'confirmDelete', // Captura el evento
    ]; 
    
    public function confirmDelete($id)
    {
        $this->empresSucursalToDelete = $id;
        $this->showModal = true;
    }
    
    public function deleteEmpresSucursal()
    {
        if ($this->empresSucursalToDelete) {
            EmpresaSucursal::find($this->empresSucursalToDelete)->delete();
            session()->flash('message', 'Dato eliminado exitosamente.');
        }

        $this->empresSucursalToDelete = null;
        $this->showModal = false;

        return redirect()->route('mostrarempressucursal');
    }

    public function render()
    {
        $empresSucursal = DB::table('empresa_sucursal')
            ->join('sucursales', 'empresa_sucursal.sucursal_id', '=', 'sucursales.id')
            ->join('empresas', 'empresa_sucursal.empresa_id', '=', 'empresas.id')
            ->select(
                'sucursales.nombre_sucursal as sucursal_nombre',
                'empresas.nombre as empresa_nombre'
            );

        return view('livewire.portal-rh.empres-sucursal.mostrar-empres-sucursal', [
            'empresSucursal' => $empresSucursal
        ])->layout('layouts.client');
    }
}
