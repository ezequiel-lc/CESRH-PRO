<?php

namespace App\Livewire\Portal360\Encpre\EncuestaPreguntaEncpreSucursal;

use App\Models\Encuestas360\Encpre;
use Illuminate\Support\Facades\Crypt;
use Livewire\Attributes\On;
use Livewire\Component;

class MostrarEncuestaPreguntaEncpreSucursal extends Component
{

    public function redirigirEncpreSucursal()
    {
        return redirect()->route('agregarEncpreSucursal');
    }

    #[On('eliminarEncpreSucursal')]
    public function deleteEncpreSucursal($id)
    {
        try {
            $decryptedId = Crypt::decrypt($id);

            $encpre = Encpre::findOrFail($decryptedId);
            $encpre->delete();

            // Mostrar mensaje de éxito con SweetAlert2
            $this->dispatch('swal-success', message: 'Encuesta y preguunta eliminada correctamente.');

            return redirect()->route('portal360.encpre.encuesta-pregunta-encpre-sucursal.mostrar-encuesta-pregunta-encpre-sucursal');
        } catch (\Exception $e) {
            $this->dispatch('swal-error', message: 'Error al eliminar la relación.');
        }
    }
    
    public function render()
    {
        return view('livewire.portal360.encpre.encuesta-pregunta-encpre-sucursal.mostrar-encuesta-pregunta-encpre-sucursal')->layout('layouts.portal360');
    }
}
