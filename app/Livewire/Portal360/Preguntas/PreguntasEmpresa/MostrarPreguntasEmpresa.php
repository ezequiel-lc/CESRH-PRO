<?php

namespace App\Livewire\Portal360\Preguntas\PreguntasEmpresa;

use App\Models\Encuestas360\Pregunta;
use Illuminate\Support\Facades\Crypt;
use Livewire\Attributes\On;
use Livewire\Component;

class MostrarPreguntasEmpresa extends Component
{
    public function redirigirpreguntaEmpresa()
    {
        return redirect()->route('agregarPreguntaEmpresa');
    }

    #[On('eliminarPreguntaEmpresa')]
    public function deletePreguntaEmpresa($id)
    {
        try {
            $decryptedId = Crypt::decrypt($id);
            
            $pregunta = Pregunta::findOrFail($decryptedId);
            
            // Eliminar primero las respuestas relacionadas
            $pregunta->respuestas()->delete();
            
            // Luego eliminar la pregunta
            $pregunta->delete();

            // Mostrar mensaje de éxito con SweetAlert2
            $this->dispatch('swal-success', message: 'Pregunta eliminada correctamente.');
            
            return redirect()->route('portal360.preguntas.preguntas-empresa.mostrar-preguntas-empresa');
        } catch (\Exception $e) {
            $this->dispatch('swal-error', message: 'Error al eliminar la pregunta: ' . $e->getMessage());
        }
    }


    public function render()
    {
        return view('livewire.portal360.preguntas.preguntas-empresa.mostrar-preguntas-empresa')->layout('layouts.portal360');
    }
}
