<?php

namespace App\Livewire\Portal360;

use Livewire\Component;

class NavigationMenu extends Component
{

    public $isSidebarOpen = false;
    public $isUsuariosOpen = false;
    public $isEncuestasOpen = false;

    public function mount()
    {
        // Leer el estado del sidebar desde la sesión, pero usar true por defecto en pantallas grandes
        $this->isSidebarOpen = $this->isDesktop() ? true : session()->get('isSidebarOpen', false);
        $this->isUsuariosOpen = session()->get('isUsuariosOpen', false);
        $this->isEncuestasOpen = session()->get('isEncuestasOpen', false);
    }

    public function toggleSidebar()
    {
        $this->isSidebarOpen = !$this->isSidebarOpen;
        session()->put('isSidebarOpen', $this->isSidebarOpen);
    }

    public function toggleUsuarios()
    {
        $this->isUsuariosOpen = !$this->isUsuariosOpen;
        session()->put('isUsuariosOpen', $this->isUsuariosOpen);
    }

    public function toggleEncuestas()
    {
        $this->isEncuestasOpen = !$this->isEncuestasOpen;
        session()->put('isEncuestasOpen', $this->isEncuestasOpen);
    }

    // Método para detectar si es una pantalla de escritorio (ancho > 768px, por ejemplo)
    private function isDesktop()
    {
        return request()->header('sec-ch-width') >= 768 || request()->is('localhost'); // Ajusta según tu lógica
    }
    public function render()
    {
        return view('livewire.portal360.navigation-menu')->layout('layouts.portal360');
    }
}


//resources\views\navigation-menudev.blade.php