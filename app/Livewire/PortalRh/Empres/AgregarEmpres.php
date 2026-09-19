<?php

namespace App\Livewire\PortalRh\Empres;

use Livewire\Component;
use App\Models\PortalRH\Empresa;
use Livewire\WithFileUploads;

class AgregarEmpres extends Component
{
    use WithFileUploads;
    public $empresa = [], $pdfConstancia; //almacenar 

    // Reglas de validación
    protected $rules = [
        'empresa.nombre' => 'required',
        'empresa.razon_social' => 'required',
        'empresa.rfc' => 'required|unique:empresas,rfc',
        'empresa.nombre_comercial' => 'required',
        'empresa.pais_origen' => 'required',
        'empresa.representante_legal' => 'required',
        'pdfConstancia' => 'required|file',
    ];

    protected $messages = [
        'empresa.nombre.required' => 'El nombre es obligatorio.',
        'empresa.razon_social.required' => 'La razón social es obligatoria.',
        'empresa.rfc.required' => 'El RFC es obligatorio.',
        'empresa.rfc.unique' => 'Este RFC ya esta asignada a otra empresa.',
        'empresa.nombre_comercial.required' => 'El nombre comercial es obligatorio.',
        'empresa.pais_origen.required' => 'El país de origen es obligatorio.',
        'empresa.representante_legal.required' => 'El representante legal es obligatorio.',
        'pdfConstancia.required' => 'El archivo es requerido, solo formato PDF.',
        'pdfConstancia.file' => 'Adjunta un archivo en formato PDF.',
    ];
    

    public function saveEmpres()
    {

        $this->validate();
        $this->pdfConstancia->storeAs('PortalRH/Empresas', $this->empresa['nombre'].".pdf", 'subirDocs');
        $this->empresa['url_constancia_situacion_fiscal'] = "PortalRH/Empresas/" . $this->empresa['nombre'] .".pdf";

        $nuevaEmpresa = new Empresa($this->empresa);
        $nuevaEmpresa->save();

        $this->empresa = [];
        $this->pdfConstancia=NULL;
        //$this->emit('showAnimatedToast', 'Empresa guardada correctamente.');
        session()->flash('message', 'Empresa agregada');
    }

    public function redirigir()
    {
        return redirect()->route('mostrarempresas');
    }

    public function render()
    {
        return view('livewire.portal-rh.empres.agregar-empres')->layout('layouts.client');
    }
}
