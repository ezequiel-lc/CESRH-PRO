<?php

namespace App\Livewire\Dx035\Encuestas;

use Livewire\Component;
use App\Models\Dx035\CorreoMasivo;
use Livewire\WithPagination;

class CorreosMasivos extends Component
{
    use WithPagination;

    public $correo;
    public $correos;

    protected $rules = [
        'correo' => 'required|email',
    ];

    public function mount()
    {
        $this->correos = CorreoMasivo::paginate(10);
    }

    public function agregarCorreo()
    {
        $this->validate();

        CorreoMasivo::create([
            'correo' => $this->correo,
        ]);

        $this->correo = '';
        $this->correos = CorreoMasivo::paginate(10); // Actualizar la lista
        session()->flash('message', 'Correo agregado correctamente.');
    }

    public function eliminarCorreo($id)
    {
        CorreoMasivo::find($id)->delete();
        $this->correos = CorreoMasivo::paginate(10); // Actualizar la lista
        session()->flash('message', 'Correo eliminado correctamente.');
    }

    public function render()
    {
        return view('livewire.dx035.encuestas.correos-masivos');
    }
}
