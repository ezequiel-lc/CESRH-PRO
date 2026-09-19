<?php

namespace App\Livewire\Portal360\Resultados\EmpresaResultados;

use App\Models\PortalRH\EmpresaSucursal;
use Livewire\Component;

class MostrarResultadosEmpresasv extends Component
{
    public $SucursalId;
    public $empresaSucursal;
    public $mostrarTablaUsuarios = false;
    public $mostrarTablaGenerales = false;

    public function mount($SucursalId)
    {
        $this->SucursalId = $SucursalId;
        $this->loadData();
    }

    public function loadData()
    {
        $this->empresaSucursal = EmpresaSucursal::with(['sucursal'])
            ->where('id', $this->SucursalId)
            ->firstOrFail();
    }

    public function resultadosGeneralesPorUsuario()
    {
        $this->mostrarTablaUsuarios = true;
    }

    public function resultadosGenerales()
    {
        $this->mostrarTablaGenerales = true;
    }

    public function ocultarTabla()
    {
        $this->mostrarTablaUsuarios = false;
        $this->mostrarTablaGenerales = false;
    }

    public function render()
    {
        return view('livewire.portal360.resultados.empresa-resultados.mostrar-resultados-empresasv')->layout('layouts.portal360');
    }
}
