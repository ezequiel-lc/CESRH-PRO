<?php

namespace App\Livewire\Portal360\Asignaciones\AsignacionesSucursal;

use App\Models\Encuestas360\Asignacion;
use Illuminate\Support\Facades\Crypt;
use Livewire\Attributes\On;
use Livewire\Component;

class MostrarAsignacionSucursal extends Component
{
    public function redirigirAsignacionSucursal()
    {
        return redirect()->route('agregarAsignacionSucursal');
    }

    
    #[On('eliminarAsignacionSucursal')]
    public function deleteAsignacionSucursal($id)
    {
        try {
            $decryptedId = Crypt::decrypt($id);

            $asignacion = Asignacion::findOrFail($decryptedId);
            $asignacion->delete();

            // Mostrar mensaje de éxito con SweetAlert2
            $this->dispatch('swal-success', message: 'Asignación eliminada correctamente.');

            return redirect()->route('portal360.asignaciones.asignaciones-sucursal.mostrar-asignacion-sucursal');
        } catch (\Exception $e) {
            $this->dispatch('swal-error', message: 'Error al eliminar la asignación.');
        }
    }



    public function render()
    {
        return view('livewire.portal360.asignaciones.asignaciones-sucursal.mostrar-asignacion-sucursal')->layout('layouts.portal360');
    }
}
