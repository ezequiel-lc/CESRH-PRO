<?php

namespace App\Livewire\PortalRh\RegistPatronal;

use Livewire\Component;
use App\Models\PortalRH\RegistroPatronal;

class AgregarRegPatronal extends Component
{
    public $registro = [];

    

    protected $rules = [
        'registro.registro_patronal' => 'required',
        'registro.rfc' => 'required|size:13',
        'registro.nombre_o_razon_social' => 'required',
        'registro.regimen_capital' => 'required',
        'registro.regimen_fiscal' => 'required',
        'registro.actividad_economica' => 'required',
        'registro.imss_calle_manzana' => 'required',
        'registro.imms_num_exterior' => 'required',
        'registro.imms_num_int' => 'nullable',
        'registro.imms_colonia' => 'required',
        'registro.imms_codigo_postal' => 'required|digits:5',
        'registro.imms_estado' => 'required',
        'registro.imms_municipio' => 'required',
        'registro.imms_telefono' => 'required|digits:10',
        'registro.imms_convenio_rembolso_subsidios' => 'required',
        'registro.imms_tipo_contribucion' => 'required',
        'registro.area_geografica' => 'required',
        'registro.delegacion_imms' => 'required',
        'registro.subdelegacion_imms' => 'required',
        'registro.prima_año' => 'required',
        'registro.prima_mes' => 'required',
        'registro.porcentaje_prima_rt' => 'required',
        'registro.clase_riesgo_trabajo' => 'required',
        'registro.acreditacion_stps' => 'required',
        'registro.representante_legal' => 'required',
        'registro.puesto_representante' => 'required',
        'registro.cuenta_contable' => 'required',
    ];

    // MENSAJES DE VALIDACIÓN
    protected $messages = [
        'registro.*.required' => 'Este campo es obligatorio.',
        'registro.rfc.size' => 'El RFC debe tener exactamente 13 caracteres.',
        'registro.imms_codigo_postal.digits' => 'El código postal debe tener 5 dígitos.',
        'registro.imms_telefono.digits' => 'El teléfono debe tener 10 dígitos.',
        //'registro.prima_año.digits' => 'El año de prima debe tener 4 dígitos.',
        //'registro.prima_mes.digits' => 'El mes de prima debe tener 2 dígitos.',
        'registro.porcentaje_prima_rt.numeric' => 'El porcentaje de prima debe ser un número.',
        
    ];



    // Método para guardar el registro patronal
    public function saveRegistro()
    {
        $this->validate();

        RegistroPatronal::create($this->registro);

        $this->registro = [];
        //$this->emit('showAnimatedToast', 'Registro patronal guardado correctamente.');
        return redirect()->route('mostrarregpatronal');
    }

    public function render()
    {
        return view('livewire.portal-rh.regist-patronal.agregar-reg-patronal')->layout('layouts.client');
    }
}
