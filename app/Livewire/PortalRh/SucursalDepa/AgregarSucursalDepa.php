<?php

namespace App\Livewire\PortalRh\SucursalDepa;

use Livewire\Component;
use App\Models\PortalRH\Departamento;
use App\Models\PortalRH\Sucursal;
use App\Models\PortalRH\SucursalDepartamento;
use Illuminate\Support\Facades\DB;

class AgregarSucursalDepa extends Component
{
    public $sucursaldepa = [];
    public $sucursales, $departamentos;


    public function mount()
    {
        $this->sucursales = Sucursal::all();
        $this->departamentos = Departamento::all();
    }

    // REGLAS DE VALIDACIÓN
    protected $rules = [
        'sucursaldepa.sucursal_id' => 'required',
        'sucursaldepa.departamento_id' => 'required',
        //'sucursaldepa.status' => 'required',
    ];

    // MENSAJES DE VALIDACIÓN
    protected $messages = [
        'sucursaldepa.sucursal_id' => 'La sucursal es requerida',
        'sucursaldepa.departamento_id' => 'El departamento es requerido',
        //'sucursaldepa.status.required' => 'El status es requerido',
    ];

    public function saveSucursalDepa()
    {
        $this->validate();

        // Insertar en la tabla pivote directamente con DB::table()
        DB::table('sucursal_departament')->insert([
            'sucursal_id' => $this->sucursaldepa['sucursal_id'],
            'departamento_id' => $this->sucursaldepa['departamento_id'],
            //'status' => $this->sucursaldepa['status'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $this->sucursaldepa = [];
        //$this->emit('showAnimatedToast', 'Sucursal guardada correctamente');
        return redirect()->route('mostrarsucursaldepa');
    }

    public function redirigirSucDepa()
    {
        return redirect()->route('mostrarsucursaldepa');
    }

    public function render()
    {
        return view('livewire.portal-rh.sucursal-depa.agregar-sucursal-depa', [
            'sucursaldepartament' => DB::table('sucursal_departament')->get()
        ])->layout('layouts.client');
    }
}
