<?php

namespace App\Livewire\Portal360\Encuesta\EncuestaAdministrador;

use App\Models\Encuestas360\Encuesta360;
use Illuminate\Support\Facades\Crypt;
use Livewire\Attributes\On;
use Livewire\Component;

class MostrarEncuestaAdministrador extends Component
{
    public function redirigirencuestaAdministrador()
    {
        return redirect()->route('agregarEncuestaAdministrador');
    }


    #[On('eliminarEncuesta')]
    public function deleteEncuesta($id)
    {
        try {
            $decryptedId = Crypt::decrypt($id);

            $encuesta = Encuesta360::findOrFail($decryptedId);
            $encuesta->delete();

            // Mostrar mensaje de éxito con SweetAlert2
            $this->dispatch('swal-success', message: 'Encuesta eliminada correctamente.');

            return redirect()->route('portal360.encuesta.encuesta-administrador.mostrar-encuesta-administrador');
        } catch (\Exception $e) {
            $this->dispatch('swal-error', message: 'Error al eliminar la encuesta.');
        }
    }

    public function render()
    {
        return view('livewire.portal360.encuesta.encuesta-administrador.mostrar-encuesta-administrador')->layout('layouts.portal360');
    }
}
