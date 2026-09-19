<?php

namespace App\Livewire\Portal360\Encuesta\EncuestaSucursal;

use App\Models\Encuestas360\Encuesta360;
use Illuminate\Support\Facades\Crypt;
use Livewire\Attributes\On;
use Livewire\Component;

class MostrarEncuestaSucursal extends Component
{

    public function redirigirencuestaSucursal()
    {
        return redirect()->route('agregarEncuestaSucursal');
    }

    #[On('eliminarEncuestaSucursal')]
    public function deleteEncuestaSucursal($id)
    {
        try {
            $decryptedId = Crypt::decrypt($id);

            $encuesta = Encuesta360::findOrFail($decryptedId);
            $encuesta->delete();

            // Mostrar mensaje de éxito con SweetAlert2
            $this->dispatch('swal-success', message: 'Encuesta eliminada correctamente.');

            return redirect()->route('portal360.encuesta.encuesta-sucursal.mostrar-encuesta-sucursal');
        } catch (\Exception $e) {
            $this->dispatch('swal-error', message: 'Error al eliminar la encuesta.');
        }
    }


    public function render()
    {
        return view('livewire.portal360.encuesta.encuesta-sucursal.mostrar-encuesta-sucursal')->layout('layouts.portal360');
    }
}
