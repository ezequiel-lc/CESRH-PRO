<?php

namespace App\Livewire\Portal360\Encpre\EncuestaPreguntaEncpreEmpresa;

use App\Models\Encuestas360\Encpre;
use Illuminate\Support\Facades\Crypt;
use Livewire\Attributes\On;
use Livewire\Component;

class MostrarEncuestaPreguntaEncpreEmpresa extends Component
{
    public function redirigirEncpreEmpresa()
    {
        return redirect()->route('agregarEncpreEmpresa');
    }

    #[On('eliminarEncpreEmpresa')]
    public function deleteEncpreEmpresa($id)
    {
        try {
            $decryptedId = Crypt::decrypt($id);
            $encpre = Encpre::findOrFail($decryptedId);
            
            // Obtener el ID de la encuesta
            $encuestaId = $encpre->encuestas_id;
            
            // Eliminar todas las relaciones que pertenecen a la misma encuesta
            Encpre::where('encuestas_id', $encuestaId)->delete();
            
            // Mostrar mensaje de éxito con SweetAlert2
            $this->dispatch('swal-success', message: 'Todas las preguntas de la encuesta fueron eliminadas correctamente.');
    
            return redirect()->route('portal360.encpre.encuesta-pregunta-encpre-empresa.mostrar-encuesta-pregunta-encpre-empresa');
        } catch (\Exception $e) {
            $this->dispatch('swal-error', message: 'Error al eliminar las relaciones: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.portal360.encpre.encuesta-pregunta-encpre-empresa.mostrar-encuesta-pregunta-encpre-empresa')->layout('layouts.portal360');
    }
}
