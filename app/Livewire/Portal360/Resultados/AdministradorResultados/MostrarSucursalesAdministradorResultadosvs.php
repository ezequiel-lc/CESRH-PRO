<?php

namespace App\Livewire\Portal360\Resultados\AdministradorResultados;

use App\Models\PortalRH\EmpresaSucursal;
use Livewire\Component;

class MostrarSucursalesAdministradorResultadosvs extends Component
{

    public $SucursalId; // ID de la relación empresa-sucursal
    public $empresaSucursal; // Datos de la relación empresa-sucursal
    public $mostrarTablaUsuarios = false; // Nueva variable para controlar la visibilidad de la tabla
    public $mostrarTablaGenerales = false; // Nueva variable para controlar la visibilidad de la tabla
    public $asignacionId; // Agrega esta propiedad si aplica

    public function mount($SucursalId)
    {
        $this->SucursalId = $SucursalId;
        $this->loadData();
        // $this->asignacionId = /* Aquí defines cómo obtener el valor de asignacionId */;
    }
    

    public function loadData()
    {
        $this->empresaSucursal = EmpresaSucursal::with(['sucursal'])
            ->where('id', $this->SucursalId)
            ->firstOrFail();
    }

    public function resultadosGeneralesPorUsuario()
    {
        // En lugar de redirigir, mostrar la tabla
        $this->mostrarTablaUsuarios = true;
    }

    public function resultadosGenerales()
    {
        // Mantener la redirección para esta acción si es necesario
        $this->mostrarTablaGenerales = true;
    }

    public function ocultarTabla()
    {
        $this->mostrarTablaUsuarios = false;
        $this->mostrarTablaGenerales = false;
    }

    public function render()
    {
        return view('livewire.portal360.resultados.administrador-resultados.mostrar-sucursales-administrador-resultadosvs')->layout('layouts.portal360');
    }
}
