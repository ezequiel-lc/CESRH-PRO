<?php

namespace App\Livewire\Dx035\Encuestas;

use Livewire\Component;
use App\Models\Dx035\Encuesta;

class EncuestaController extends Component
{
    public $clave, $empresa, $estado, $numeroEncuestas; // Otros campos según tu necesidad
    public $encuestaId; // Para editar una encuesta
    // Reglas de validación
    protected $rules = [
        'clave' => 'required|string',
        'empresa' => 'required|string',
        'estado' => 'required|boolean',
        'numeroEncuestas' => 'required|integer',
    ];

    // Cargar datos si es edición
    public function mount($encuestaId = null)
    {
        if ($encuestaId) {
            $encuesta = Encuesta::find($encuestaId);
            if ($encuesta) {
                $this->clave = $encuesta->clave;
                $this->empresa = $encuesta->empresa;
                $this->estado = $encuesta->estado;
                $this->numeroEncuestas = $encuesta->numeroEncuestas;
            }
        }
    }

    // Método para agregar o actualizar la encuesta
    public function submit()
    {
        $this->validate();

        Encuesta::updateOrCreate(
            ['id' => $this->encuestaId], // Si estamos editando, buscamos por ID
            [
                'clave' => $this->clave,
                'empresa' => $this->empresa,
                'estado' => $this->estado,
                'numeroEncuestas' => $this->numeroEncuestas,
            ]
        );

        session()->flash('message', $this->encuestaId ? 'Encuesta actualizada correctamente.' : 'Encuesta agregada correctamente.');

        return redirect()->route('encuesta.index');
    }

    // Método para eliminar una encuesta
    public function delete($id)
    {
        Encuesta::destroy($id);
        session()->flash('message', 'Encuesta eliminada correctamente.');
    }

    // Método de renderizado
    public function render()
    {
        return view('livewire.dx035.encuestas.mostrar-encuestas'); // O la vista que corresponda
    }
}
