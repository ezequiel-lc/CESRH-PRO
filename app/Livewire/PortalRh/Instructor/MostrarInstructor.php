<?php

namespace App\Livewire\PortalRh\Instructor;

use Livewire\Component;
use App\Models\PortalRH\Instructor;

class MostrarInstructor extends Component
{
    public $showModal = false; // Control para ventana emergente
    public $instructorToDelete; // ID de la sucursal a eliminar

    // Redirigir a una vista para agregar sucursales
    public function redirigir()
    {
        return redirect()->route('agregarinstructor');
    }

    
    // Eliminacion
    protected $listeners = [
        'confirmDelete' => 'confirmDelete', // Captura el evento
    ]; 
    
    public function confirmDelete($id)
    {
        $this->instructorToDelete = $id;
        $this->showModal = true;
    }
    
    public function deleteInstructor()
    {
        if ($this->instructorToDelete) {
            Instructor::find($this->instructorToDelete)->delete();
            session()->flash('message', 'Instructor eliminado exitosamente.');
        }

        $this->instructorToDelete = null;
        $this->showModal = false;

        return redirect()->route('mostrarinstructor');
    }

    public function render()
    {
        return view('livewire.portal-rh.instructor.mostrar-instructor')->layout('layouts.client');
    }
}
