<?php

namespace App\Livewire;

use LivewireUI\Modal\ModalComponent;

class EditUser extends ModalComponent
{
    public static function modalMaxWidth(): string
    {
        return 'md';
    }
    public function render()
    {
        return view('livewire.edit-user');
    }
}
