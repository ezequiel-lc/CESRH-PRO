<?php

namespace App\Livewire\ActivoFijo\TipoActivo;

use App\Models\ActivoFijo\Tipoactivo;
use Livewire\Component;

class Editartipoactivo extends Component
{
    public $nombreactivo,$tipoactivo_id;

    public function mount($id)
    {
        $item = Tipoactivo::findOrFail($id);
        $this->tipoactivo_id= $id;
        $this->nombreactivo = $item->nombre_activo;
    }

    public function editaract(){
        $this->validate([
            'nombreactivo' =>'required',
        ]);

        Tipoactivo::find($this->tipoactivo_id)->update([
            'nombre_activo' => $this->nombreactivo,
        ]);

        return redirect()->route('mostrartipoactivo');
    }



    public function render()
    {
        return view('livewire.activo-fijo.tipo-activo.editartipoactivo')->layout('layouts.navactivos');
    }
}
