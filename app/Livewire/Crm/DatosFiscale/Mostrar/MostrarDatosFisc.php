<?php

namespace App\Livewire\Crm\DatosFiscale\Mostrar;

use App\Models\Crm\DatosFiscale;
use Illuminate\Support\Facades\Crypt;
use Livewire\Attributes\On;
use Livewire\Component;

class MostrarDatosFisc extends Component
{
    public function render()
    {
        return view('livewire.crm.datos-fiscale.mostrar.mostrar-datos-fisc')->layout('layouts.crm');
    }


    #[On('confirmDeleteDato')]
    public function deleteDato($id)
    {
        try {
            $decryptedId = Crypt::decrypt($id);

            $dato = DatosFiscale::findOrFail($decryptedId);
            $dato->delete();

            // Mostrar mensaje de éxito con SweetAlert2
            $this->dispatch('swal-success', message: 'Encuesta eliminada correctamente.');

            return redirect()->route('mostrarDatosFiscales');
        } catch (\Exception $e) {
            $this->dispatch('swal-error', message: 'Error al eliminar la encuesta.');
        }
    }
}