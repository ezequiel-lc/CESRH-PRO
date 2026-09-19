<?php

namespace App\Livewire\Crm\Leads\Modal;

use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class Seleccion extends ModalComponent
{
    public $cantidad;

    public function seleccionarCantidad()
    {
        $this->dispatch('generarForms', cantidad: $this->cantidad);
        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.crm.leads.modal.seleccion');
    }
}
