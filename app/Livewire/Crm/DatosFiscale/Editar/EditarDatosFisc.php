<?php

namespace App\Livewire\Crm\DatosFiscale\Editar;

use App\Models\Crm\DatosFiscale;
use Livewire\Component;
use App\Models\Crm\CrmEmpresa;

class EditarDatosFisc extends Component
{
    public $dato_id, $razon_social, $rfc;
    public $calle, $numero_exterior, $numero_interior, $colonia, $municipio, $localidad, $estado, $pais, $codigo_postal;
    public $crm_empresaid;

    public function mount($id)
    {
        $tem = DatosFiscale::findOrFail($id);

        $this->dato_id = $id;
        $this->razon_social = $tem->razon_social;
        $this->rfc = $tem->rfc;
        $this->calle = $tem->calle;
        $this->numero_exterior = $tem->numero_exterior;
        $this->numero_interior = $tem->numero_interior;
        $this->colonia = $tem->colonia;
        $this->municipio = $tem->municipio;
        $this->localidad= $tem->localidad;
        $this->estado = $tem->estado;
        $this->pais = $tem->pais;
        $this->codigo_postal = $tem->codigo_postal;
        $this->crm_empresaid = $tem->crm_empresaid;
    }

    public function editDato()
    {
        $this->validate([
            'razon_social' => 'required',
            'rfc' => 'required',
            'calle' => 'required',
            'numero_exterior' => 'required',
            'numero_interior' => '',
            'colonia' => 'required',
            'municipio' => 'required',
            'localidad' => 'required',
            'estado' => 'required',
            'pais' => 'required',
            'codigo_postal' => 'required',
            'crm_empresaid' => 'required',
        ]);

        DatosFiscale::updateOrCreate(['id'=>$this->dato_id], [
            'razon_social' => $this->razon_social,
            'rfc' => $this->rfc,
            'calle' => $this->calle,
            'numero_exterior' => $this->numero_exterior,
            'numero_interior' => $this->numero_interior,
            'colonia' => $this->colonia,
            'municipio' => $this->municipio,
            'localidad' => $this->localidad,
            'estado' => $this->estado,
            'pais' => $this->pais,
            'codigo_postal' => $this->codigo_postal,
            'crm_empresaid' => $this->crm_empresaid
        ]);
        return redirect()->route('mostrarDatosFiscales');
    }
    public function render()
    {
        return view('livewire.crm.datos-fiscale.editar.editar-datos-fisc',[
            'empresa' => CrmEmpresa::get()
        ])->layout('layouts.crm');
    }
}