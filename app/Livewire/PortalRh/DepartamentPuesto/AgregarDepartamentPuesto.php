<?php

namespace App\Livewire\PortalRh\DepartamentPuesto;

use Livewire\Component;
use App\Models\PortalRH\Departamento;
use App\Models\PortalRH\Puesto;
use App\Models\PortalRH\DepartamentoPuesto;
use Illuminate\Support\Facades\DB;

class AgregarDepartamentPuesto extends Component
{
    public $depaPuest = [];
    public $departamentos, $puestos;


    public function mount()
    { 
        $this->departamentos = Departamento::all();
        $this->puestos = Puesto::all();
    }

    // REGLAS DE VALIDACIÓN
    protected $rules = [
        'depaPuest.departamento_id' => 'required',
        'depaPuest.puesto_id' => 'required',
        //'depaPuest.status' => 'required',
        
    ];

    // MENSAJES DE VALIDACIÓN
    protected $messages = [
        'depaPuest.departamento_id' => 'El departamento es requerido',
        'depaPuest.puesto_id' => 'El puesto es requerido',
        //'depaPuest.status.required' => 'El status es requerido',
    ];

    public function saveDepaPuest()
    {
        $this->validate();

        // Insertar en la tabla pivote directamente con DB::table()
        DB::table('departamento_puesto')->insert([
            'departamento_id' => $this->depaPuest['departamento_id'],
            'puesto_id' => $this->depaPuest['puesto_id'],
            //'status' => $this->depaPuest['status'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $this->depaPuest = [];
        //$this->emit('showAnimatedToast', 'Sucursal guardada correctamente');
        return redirect()->route('mostrardepapuesto');
    }

    public function redirigirDepaPuest()
    {
        return redirect()->route('mostrardepapuesto');
    }

    public function render()
    {
        return view('livewire.portal-rh.departament-puesto.agregar-departament-puesto', [
            'departamentpuest' => DB::table('departamento_puesto')->get()
        ])->layout('layouts.client');
    }
}
