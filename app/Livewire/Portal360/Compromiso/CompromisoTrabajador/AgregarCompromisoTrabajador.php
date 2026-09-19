<?php

namespace App\Livewire\Portal360\Compromiso\CompromisoTrabajador;

use App\Models\Encuestas360\Compromiso;
use App\Models\Encuestas360\Pregunta;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AgregarCompromisoTrabajador extends Component
{
    public $compromiso;
    public $fecha_inicio;
    public $fecha_termino;
    public $pregunta_id;

    protected $rules = [
        'compromiso' => 'required|string|max:255',
        'fecha_inicio' => 'required|date',
        'fecha_termino' => 'required|date|after_or_equal:fecha_inicio',
        'pregunta_id' => 'required|exists:preguntas,id',
    ];

    public function save()
    {
        $this->validate();

        Compromiso::create([
            'users_id' => Auth::id(),
            'preguntas_id' => $this->pregunta_id,
            'compromiso' => $this->compromiso,
            'alta' => $this->fecha_inicio,
            'vencimiento' => $this->fecha_termino,
            'verificado' => false, // Por defecto no verificado
        ]);

        session()->flash('message', 'Compromiso agregado exitosamente.');
        return redirect()->route('portal360.compromiso.compromiso-trabajador.mostrar-compromiso-trabajador'); // Ajusta el nombre de la ruta si es diferente
    }

    public function render()
    {
        $preguntas = Pregunta::all(); // Obtener todas las preguntas disponibles para el select
        return view('livewire.portal360.compromiso.compromiso-trabajador.agregar-compromiso-trabajador', [
            'preguntas' => $preguntas,
        ])->layout('layouts.portal360');
    }
}
