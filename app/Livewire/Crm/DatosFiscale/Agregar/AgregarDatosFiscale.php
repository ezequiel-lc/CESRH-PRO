<?php

namespace App\Livewire\Crm\DatosFiscale\Agregar;

use Livewire\Component;
use App\Models\Crm\DatosFiscale;
use App\Models\Crm\CrmEmpresa;

class AgregarDatosFiscale extends Component
{
    public $dato = [];
    public $consulta;

    protected $rules = [
        'dato.razon_social' => 'required',
        'dato.rfc' => 'required',
        'dato.calle' => 'required',
        'dato.numero_exterior' => 'required',
        'dato.numero_interior' => '',
        'dato.colonia' => 'required',
        'dato.municipio' => 'required',
        'dato.localidad' => 'required',
        'dato.estado' => 'required',
        'dato.pais' => 'required',
        'dato.codigo_postal' => 'required',
        'dato.crm_empresas_id' => 'required',
    ];

    protected $messages = [
        'dato.razon_social.required' => 'Razon social requerida',
        'dato.rfc.required' => 'RFC requerido',
        'dato.calle.required' => 'Calle requerida',
        'dato.numero_exterior.required' => 'Numero Exterior requerido',
        // 'dato.numero_interior.required' => 'Numero Interior requerido',
        'dato.colonia.required' => 'Colonia requerida',
        'dato.municipio.required' => 'Municipio requerido',
        'dato.localidad.required' => 'Localidad requerida',
        'dato.estado.required' => 'Estado requerido',
        'dato.pais.required' => 'Pais requerido',
        'dato.codigo_postal.required' => 'Codigo Postal requerida',
        'dato.crm_empresas_id.required' => 'Empresa requerida',
    ];

    public function mount()
    {
        $this->consulta = DatosFiscale::get();
    }

    public function saveDato()
    {
        $this->validate();

        $AgregarDato = new DatosFiscale($this->dato);
        $AgregarDato->save();

        $this->dato = [];
    }

    public function render()
    {
        return view('livewire.crm.datos-fiscale.agregar.agregar-datos-fiscale', [
            'empresa' => CrmEmpresa::get()
        ])->layout('layouts.crm');
    }
}
