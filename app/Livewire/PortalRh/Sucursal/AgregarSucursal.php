<?php

namespace App\Livewire\PortalRh\Sucursal;

use Livewire\Component;
use App\Models\PortalRH\Sucursal;
use App\Models\PortalRH\RegistroPatronal;
use Illuminate\Support\Facades\DB;
use App\Models\PortalRH\Empresa;

class AgregarSucursal extends Component
{
    public $sucursal = [];
    public $regpatronales, $empresas, $empresa_id;

    public function mount()
    {
        $this->regpatronales = RegistroPatronal::all();
        $this->empresas = Empresa::all();
    }

    // REGLAS DE VALIDACIÓN
    protected $rules = [
        'sucursal.clave_sucursal' => 'required|unique:sucursales,clave_sucursal',
        'sucursal.nombre_sucursal' => 'required',
        'sucursal.zona_economica' => 'required',
        'sucursal.estado' => 'required',
        'sucursal.cuenta_contable' => 'required',
        'sucursal.rfc' => 'required|size:13|unique:sucursales,rfc',
        'sucursal.correo' => 'required|email',
        'sucursal.telefono' => 'required|digits:10',
        'sucursal.status' => 'required',
        'sucursal.registro_patronal_id' => 'required|exists:registros_patronales,id',
        'empresa_id' => 'required|exists:empresas,id',
    ];

    // MENSAJES DE VALIDACIÓN
    protected $messages = [
        'sucursal.clave_sucursal.required' => 'La clave de la sucursal es requerida',
        'sucursal.clave_sucursal.unique' => 'Esta clave ya esta asignada a otra sucursal.',
        'sucursal.nombre_sucursal.required' => 'El nombre de la sucursal es requerido',
        'sucursal.zona_economica.required' => 'La zona económica es requerida',
        'sucursal.estado.required' => 'El estado es requerido',
        'sucursal.cuenta_contable.required' => 'La cuenta contable es requerida',
        'sucursal.rfc.required' => 'El RFC es requerido',
        'sucursal.rfc.size' => 'El RFC debe tener exactamente 13 caracteres.',
        'sucursal.rfc.unique' => 'Este RFC ya esta asignada a otra sucursal.',
        'sucursal.correo.required' => 'El correo es requerido',
        'sucursal.correo.email' => 'El correo debe ser válido',
        'sucursal.telefono.required' => 'El teléfono es requerido',
        'sucursal.telefono.digits' => 'El número de telefono debe tener 10 dígitos.',
        'sucursal.status.required' => 'El status es requerido',
        'sucursal.registro_patronal_id.required' => 'El reg patronal es requerido',
        'sucursal.registro_patronal_id.exists' => 'El reg patronal seleccionado no es válida.',
        'empresa_id.required' => 'Debe seleccionar una empresa.',
        'empresa_id.exists' => 'La empresa seleccionada no es válida.',
    ];

    // Método para guardar sucursal
    public function saveSucursal()
    {
        $this->validate();

        // Crear la sucursal
        $nuevaSucursal = Sucursal::create($this->sucursal);

        // Asociar la sucursal con la empresa seleccionada en la tabla pivote
        $nuevaSucursal->empresas()->attach($this->empresa_id, [
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Limpiar los datos del formulario
        $this->reset(['sucursal', 'empresa_id']);

        //$this->emit('showAnimatedToast', 'Sucursal guardada correctamente');
        return redirect()->route('mostrarsucursal');
    }

    public function redirigirSuc()
    {
        return redirect()->route('mostrarsucursal');
    }

    public function render()
    {
        return view('livewire.portal-rh.sucursal.agregar-sucursal')->layout('layouts.client');
    }
}
