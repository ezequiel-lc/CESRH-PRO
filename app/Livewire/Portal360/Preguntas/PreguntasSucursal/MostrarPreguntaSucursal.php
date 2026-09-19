<?php

namespace App\Livewire\Portal360\Preguntas\PreguntasSucursal;

use App\Models\Encuestas360\Pregunta;
use Illuminate\Support\Facades\Crypt;
use Livewire\Attributes\On;
use Livewire\Component;

class MostrarPreguntaSucursal extends Component
{
    public function redirigirpreguntaSucursal()
    {
        return redirect()->route('agregarPreguntaSucursal');
    }

    
    #[On('eliminarPreguntaSucursal')]
    public function deletePreguntaSucursal($id)
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
            
            return redirect()->route('portal360.preguntas.preguntas-sucursal.mostrar-pregunta-sucursal');
        } catch (\Exception $e) {
            $this->dispatch('swal-error', message: 'Error al eliminar la pregunta: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.portal360.preguntas.preguntas-sucursal.mostrar-pregunta-sucursal')->layout('layouts.portal360');
    }
}
