<?php

namespace App\Livewire\Portal360;

use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class MostrarRolesPermisos extends Component
{
    use WithPagination;

    public $porpagina = 5;
    public $search = '';

    public function redirigirrolespermisos()
    {
        return redirect()->route('agregarrolespermisos');
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function updatedPorpagina()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.portal360.mostrar-roles-permisos', [
            'roles' => Role::where('name', 'LIKE', "%{$this->search}%")
                ->orderBy('name', 'ASC')
                ->paginate($this->porpagina),
        ])->layout('layouts.portal360');
    }

    // public function render()
    // {
    //     return view('livewire.portal360.mostrar-roles-permisos');
    // }
}
