<?php

namespace App\Livewire\PortalRh\Departament;

use Livewire\Component;
use App\Models\PortalRH\Departamento;
use Illuminate\Support\Facades\Crypt;
use App\Models\PortalRH\Sucursal;

class EditarDepartament extends Component
{
    public $departament_id, $nombre_departamento, $sucursales, $sucursal_id;

    public function mount($id)
    {
        $id = Crypt::decrypt($id);
        $departament = Departamento::findOrFail($id);

        $this->departament_id = $id;
        $this->nombre_departamento = $departament->nombre_departamento;

        $this->sucursales = Sucursal::all();

        // Cargar empresa asociada desde la tabla pivote
        $this->sucursal_id = $departament->sucursales()->first()->id ?? null;
    }

    public function actualizarDepartament()
    {
        $this->validate([
            'nombre_departamento' => 'required',
            'sucursal_id' => 'required|exists:sucursales,id',
        ]);

        $departament = Departamento::findOrFail($this->departament_id);

        $departament->update([
            'nombre_departamento' => $this->nombre_departamento,
        ]);

        // Actualizar relación en la tabla pivote 
        $departament->sucursales()->sync([
            $this->sucursal_id => [
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        //$this->emit('editBann', 'Departamento editado correctamente');
        return redirect()->route('mostrardepa');
    }

    public function redirigir()
    {
        return redirect()->route('mostrardepa');
    }

    public function render()
    {
        return view('livewire.portal-rh.departament.editar-departament')->layout('layouts.client');
    }
}
