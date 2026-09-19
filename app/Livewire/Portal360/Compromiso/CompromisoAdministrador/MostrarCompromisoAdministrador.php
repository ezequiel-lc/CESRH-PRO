<?php

namespace App\Livewire\Portal360\Compromiso\CompromisoAdministrador;

use App\Models\Encuestas360\Compromiso;
use Illuminate\Support\Facades\Crypt;
use Livewire\Attributes\On;
use Livewire\Component;

class MostrarCompromisoAdministrador extends Component
{
    public function redirigirCompromisoAdministrador()
    {
        return redirect()->route('agregarCompromisoAdministrador');
    }

    #[On('eliminarCompromisoAdministrador')]
    public function deleteCompromisoAdministrador($id)
    {
        try {
            $decryptedId = Crypt::decrypt($id);

            $compromiso = Compromiso::findOrFail($decryptedId);
            $compromiso->delete();

            // Mostrar mensaje de éxito con SweetAlert2
            $this->dispatch('swal-success', message: 'Compromiso eliminado correctamente.');

            return redirect()->route('portal360.compromiso.compromiso-administrador.mostrar-compromiso-administrador');
        } catch (\Exception $e) {
            $this->dispatch('swal-error', message: 'Error al eliminar el compromiso.');
        }
    }
    public function render()
    {
        return view('livewire.portal360.compromiso.compromiso-administrador.mostrar-compromiso-administrador')->layout('layouts.portal360');
    }
}
