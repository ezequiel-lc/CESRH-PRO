<?php

namespace App\Livewire\Portal360\Asignaciones\AsignacionesAdministrador;

use App\Models\Encuestas360\Asignacion;
use Illuminate\Support\Facades\Crypt;
use Livewire\Attributes\On;
use Livewire\Component;

class MostrarAsignacionesAdministrador extends Component
{

    public function redirigirAsignacionAdministrador()
    {
        return redirect()->route('agregarAsignacionAdministrador');
    }

    #[On('eliminarAsignacionAdministrador')]
    public function deleteAsignacionAdministrador($id)
    {
        try {
            $decryptedId = Crypt::decrypt($id);

            $asignacion = Asignacion::findOrFail($decryptedId);
            $asignacion->delete();

            // Mostrar mensaje de éxito con SweetAlert2
            $this->dispatch('swal-success', message: 'Asignación eliminada correctamente.');

            return redirect()->route('portal360.asignaciones.asignaciones-administrador.mostrar-asignaciones-administrador');
        } catch (\Exception $e) {
            $this->dispatch('swal-error', message: 'Error al eliminar la asignación.');
        }
    }



    public function render()
    {
        return view('livewire.portal360.asignaciones.asignaciones-administrador.mostrar-asignaciones-administrador')->layout('layouts.portal360');
    }
}
