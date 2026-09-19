<?php

namespace App\Livewire\PortalRh\EmpresSucursal;

use Livewire\Component;
use App\Models\PortalRH\Empresa;
use App\Models\PortalRH\Sucursal;
use Illuminate\Support\Facades\DB;

class AgregarEmpresSucursal extends Component
{
    public $empressucursal = [];
    public $sucursales, $empresas;


    public function mount()
    {
        $this->sucursales = Sucursal::all();
        $this->empresas = Empresa::all();
    }

    // REGLAS DE VALIDACIÓN
    protected $rules = [
        'empressucursal.empresa_id' => 'required',
        'empressucursal.sucursal_id' => 'required',
        //'empressucursal.status' => 'required',
    ];

    // MENSAJES DE VALIDACIÓN
    protected $messages = [
        'empressucursal.empresa_id' => 'La empresa es requerido',
        'empressucursal.sucursal_id' => 'La sucursal es requerida',
        //'empressucursal.status.required' => 'El status es requerido',
    ];

    public function saveEmpresSucursal()
    {
        $this->validate();

        // Insertar en la tabla pivote directamente con DB::table()
        DB::table('empresa_sucursal')->insert([
            'empresa_id' => $this->empressucursal['empresa_id'],
            'sucursal_id' => $this->empressucursal['sucursal_id'],
            //'status' => $this->empressucursal['status'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $this->empressucursal = [];
        //$this->emit('showAnimatedToast', 'Sucursal guardada correctamente');
        return redirect()->route('mostrarempressucursal');
    }

    public function redirigirEmpresSuc()
    {
        return redirect()->route('mostrarempressucursal');
    }

    public function render()
    {
        return view('livewire.portal-rh.empres-sucursal.agregar-empres-sucursal', [
            'empresSucursal' => DB::table('empresa_sucursal')->get()
        ])->layout('layouts.client');
    }
}
