<?php

namespace App\Livewire\PortalRh\Puest;

use Livewire\Component;
use App\Models\PortalRH\Puesto;
use Illuminate\Support\Facades\Crypt;
use App\Models\PortalRH\Departamento;

class EditarPuest extends Component
{
    public $puest_id, $nombre_puesto, $departamentos, $departamento_id;
    

    public function mount($id)
    {
        $id = Crypt::decrypt($id);
        $puest = Puesto::findOrFail($id);
        $this->departamentos = Departamento::all();

        $this->puest_id = $id;
        $this->nombre_puesto = $puest->nombre_puesto;

        // Cargar empresa asociada desde la tabla pivote
        $this->departamento_id = $puest->departamentos()->first()->id ?? null;
    }

    public function actualizarPuesto()
    {
        $this->validate([
            'nombre_puesto' => 'required',
            'departamento_id' => 'required|exists:departamentos,id',
        ]);

        $puest = Puesto::findOrFail($this->puest_id);
        $puest->update([
            'nombre_puesto' => $this->nombre_puesto,
        ]);

        // Actualizar relación en la tabla pivote 
        $puest->departamentos()->sync([
            $this->departamento_id => [
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        //$this->emit('editBann', 'Departamento editado correctamente');
        return redirect()->route('mostrarpuesto');
    }


    public function render()
    {
        return view('livewire.portal-rh.puest.editar-puest')->layout('layouts.client');
    }
}
