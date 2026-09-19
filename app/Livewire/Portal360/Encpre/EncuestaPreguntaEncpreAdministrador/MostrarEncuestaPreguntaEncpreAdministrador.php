<?php

namespace App\Livewire\Portal360\Encpre\EncuestaPreguntaEncpreAdministrador;

use App\Models\Encuestas360\Encpre;
use Illuminate\Support\Facades\Crypt;
use Livewire\Attributes\On;
use Livewire\Component;

class MostrarEncuestaPreguntaEncpreAdministrador extends Component
{
    public function redirigirEncpreAdministrador()
    {
        return redirect()->route('agregarEncpreAdministrador');
    }

    #[On('eliminarEncpreAdministrador')]
    public function deleteEncpreAdministrador($id)
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
            
            return redirect()->route('portal360.encpre.encuesta-pregunta-encpre-administrador.mostrar-encuesta-pregunta-encpre-administrador');
        } catch (\Exception $e) {
            $this->dispatch('swal-error', message: 'Error al eliminar las relaciones: ' . $e->getMessage());
        }
    }


    public function render()
    {
        return view('livewire.portal360.encpre.encuesta-pregunta-encpre-administrador.mostrar-encuesta-pregunta-encpre-administrador')->layout('layouts.portal360');
    }
}
