<?php

namespace App\Livewire\PortalCapacitacion\PerfilPuesto\AdminSucursal;

use Livewire\Component;
use App\Models\PortalCapacitacion\PerfilPuesto;
use App\Models\PortalCapacitacion\FuncionEspecifica;
use App\Models\PortalCapacitacion\RelacionInterna;
use App\Models\PortalCapacitacion\RelacionExterna;
use App\Models\PortalCapacitacion\ResponsabilidadUniversal;
use App\Models\PortalCapacitacion\FormacionHabilidadHumana;
use App\Models\PortalCapacitacion\FormacionHabilidadTecnica;
use Illuminate\Support\Facades\Crypt;

class VerMasPerfilPuestoSucursal extends Component
{
    public $puestoSeleccionado;
    public $perfil_puesto_id;

    public function cerrar()
    {
        return redirect()->route('mostrarPerfilPuestoSucursal');
    }

    public function mount($id)
    {
        // Desencriptamos el ID y lo buscamos en la base de datos
        $id = Crypt::decrypt($id);
        $this->puestoSeleccionado = PerfilPuesto::findOrFail($id);
        // Obtener las funciones específicas relacionadas con este perfil
        $this->puestoSeleccionado->load('FuncionesEspecificas');
        // Obtener las relaciones internas relacionadas con este perfil
        $this->puestoSeleccionado->load('RelacionesInternas');
        // Obtener las relaciones externas relacionadas con este perfil
        $this->puestoSeleccionado->load('RelacionesExternas');
        // Obtener las responsabilidades universales relacionadas con este perfil
        $this->puestoSeleccionado->load('ResponsabilidadesUniversales');
        // Obtener las formaciones en habilidades humanas relacionadas con este perfil
        $this->puestoSeleccionado->load('HabilidadesHumanas');
        // Obtener las formaciones en habilidades técnicas relacionadas con este perfil
        $this->puestoSeleccionado->load('HabilidadesTecnicas');

        $this->perfil_puesto_id = $id;
    }

    public function render()
    {
        return view('livewire.portal-capacitacion.perfil-puesto.admin-sucursal.ver-mas-perfil-puesto-sucursal')->layout("layouts.portal_capacitacion");
    }
}

