<?php

namespace App\Livewire\PortalRh\SucursalDepa;

use Livewire\Component;
use App\Models\PortalRH\Sucursal;
use App\Models\PortalRH\Departamento;
use App\Models\PortalRH\SucursalDepartamento;
use Illuminate\Support\Facades\Crypt;

use Illuminate\Support\Facades\DB;

class EditarSucursalDepa extends Component
{
    public $sucursalDepa_id, $sucursal_id, $departamento_id, $status;
    public $sucursales, $departamentos;

    public function mount($id)
    {
        $id = Crypt::decrypt($id);
        $sucursalDepa = SucursalDepartamento::findOrFail($id);
        
        $this->sucursalDepa_id = $id;
        $this->sucursal_id = $sucursalDepa->sucursal_id;
        $this->departamento_id = $sucursalDepa->departamento_id;
        //$this->status = $sucursalDepa->status;

        $this->sucursales = Sucursal::all();
        $this->departamentos = Departamento::all();
    }

    public function actualizarSucursalDepa()
    {
        $this->validate([
            'sucursal_id' => 'required|integer',
            'departamento_id' => 'required|integer',
            //'status' => 'required|integer',
        ]);

        SucursalDepartamento::updateOrCreate(['id' => $this->sucursalDepa_id], [
            'sucursal_id' => $this->sucursal_id,
            'departamento_id' => $this->departamento_id,
            //'status' => $this->status,
        ]);

        return redirect()->route('mostrarsucursaldepa')->with('message', 'Asignación actualizada correctamente.');
    }

    public function render()
    {
        return view('livewire.portal-rh.sucursal-depa.editar-sucursal-depa', [
            'sucursaldepartament' => DB::table('sucursal_departament')->get()
        ])->layout('layouts.client');
    }
}
