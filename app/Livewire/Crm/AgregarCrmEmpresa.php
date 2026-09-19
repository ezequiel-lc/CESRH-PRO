<?php

namespace App\Livewire\Crm;

use Livewire\Component;
use App\Models\Crm\CrmEmpresa;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;

class AgregarCrmEmpresa extends Component
{
    use WithFileUploads;
    #[Validate('image|max:1024')] // 1MB Max
    public $pruebadeimagen;

    public $empresa = [], $img;
    public $consulta;

    protected $rules = [
        'empresa.id' => 'required',
        'empresa.nombre' => 'required',
        'empresa.tamano_empresa' => 'required',
        'empresa.pagina_web' => 'required',
        'empresa.logotipo' => 'required|image|mimes:jpg,png,jpeg|max:2048',
    ];

    protected $messages = [
        'empresa.id.required' => 'id requerido',
        'empresa.nombre.required' => 'nombre requerido',
        'empresa.tamano_empresa.required' => 'empresa requerido',
        'empresa.pagina_web.required' => 'pagina web requerida',
        'empresa.logotipo.required' => 'logotipo requerido',
    ];

    public function mount()
    {
        $this->consulta = CrmEmpresa::get();
    }

    public function saveEmpresa()
    {
        $this->validate();
        dd($this->subirLogo);
        $this->subirLogo->storeAs('ImagenCrmEmpresa', $this->empresa['nombre']."-imagen.png", 'subirDocs');
        $this->empresa['logotipo'] = "ArchivoCrmEmpresa/".$this->empresa['nombre']."imagen.png";

        $AgregarEmpresa = new CrmEmpresa($this->empresa);
        $AgregarEmpresa->save();

        $this->empresa=[];
        $this->subirLogo=NULL;
        $this->emit('showAnimatedToast', 'Producto guardado correctamente');
        return redirect()->route('Createcrm');
    }

    public function render()
    {
        return view('livewire.crm.agregar-crm-empresa')->layout('layouts.prueba');
    }
}
