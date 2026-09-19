<?php

namespace App\Livewire\PortalRh\RegistPatronal;

use App\Models\PortalRH\RegistroPatronal;
use Livewire\Component;
use Livewire\WithPagination;


class MostrarRegPatronal extends Component
{
    use WithPagination;

    public $porpagina = 5; // Número de registros por página
    public $search = ''; // Variable de búsqueda
    public $registroToDelete; // ID del registro a eliminar

    // Resetea la página cuando cambia la búsqueda
    public function updatedSearch()
    {
        $this->resetPage();
    }

    // Resetea la página cuando cambia el número de resultados por página
    public function updatedPorpagina()
    {
        $this->resetPage();
    }

    public function redirigir()
    {
        return redirect()->route('agregarregpatronal');
    }

    // Método para eliminar un registro patronal
    public function eliminar($id)
    {
        $this->registroToDelete = $id;

        if ($this->registroToDelete) {
            RegistroPatronal::find($this->registroToDelete)->delete();
            session()->flash('message', 'Registro patronal eliminado exitosamente.');
        }
    }

    public function render()
    {
        return view('livewire.portal-rh.regist-patronal.mostrar-reg-patronal', [
            'registros' => RegistroPatronal::where('registro_patronal', 'LIKE', "%{$this->search}%")
                ->orWhere('nombre_o_razon_social', 'LIKE', "%{$this->search}%")
                ->orWhere('rfc', 'LIKE', "%{$this->search}%")
                ->orderBy('registro_patronal', 'ASC')
                ->paginate($this->porpagina),
        ])->layout('layouts.client');

    }
}
