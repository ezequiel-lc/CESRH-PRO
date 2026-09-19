<?php

namespace App\Livewire\Portal360\Asignaciones\AsignacionesEmpresa;

use App\Models\Encuestas360\Asignacion;
use Illuminate\Support\Facades\Crypt;
use Livewire\Attributes\On;
use Livewire\Component;

class MostrarAsignacionesEmpresa extends Component
{

    public function redirigirAsignacionEmpresa()
    {
        return redirect()->route('agregarAsignacionEmpresa');
    }

    #[On('eliminarAsignacionEmpresa')]
    public function deleteAsignacionEmpresa($id)
    {
        try {
            $decryptedId = Crypt::decrypt($id);

            $asignacion = Asignacion::findOrFail($decryptedId);
            $asignacion->delete();

            // Mostrar mensaje de éxito con SweetAlert2
            $this->dispatch('swal-success', message: 'Asignación eliminada correctamente.');

            return redirect()->route('portal360.asignaciones.asignaciones-empresa.mostrar-asignaciones-empresa');
        } catch (\Exception $e) {
            $this->dispatch('swal-error', message: 'Error al eliminar la asignación.');
        }
    }


    public function render()
    {
        return view('livewire.portal360.asignaciones.asignaciones-empresa.mostrar-asignaciones-empresa')->layout('layouts.portal360');

    }
}
