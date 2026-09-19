<?php

namespace App\Livewire\PortalRh\EmpresSucursal;

use Livewire\Component;
use App\Models\PortalRH\Empresa;
use App\Models\PortalRH\Sucursal;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class EditarEmpresSucursal extends Component
{
    public $empresSucursal_id, $sucursal_id, $empresa_id, $status;
    public $sucursales, $empresas;

    public function mount($empresa_sucursal_id)
    {
        $id = Crypt::decrypt($empresa_sucursal_id);
        dd($id);
        //$id = base64_decode($empresa_sucursal_id);

        // // Obtener SOLO el registro correspondiente
        // $empresaSucursal = DB::table('empresa_sucursal')->where('id', $id)->first();
        
        // //dd($empresa_sucursal_id, $id);
        // dd($id, $empresaSucursal); 

        // // Depuración para ver el valor encriptado y desencriptado
        // //dd($empresa_sucursal_id, Crypt::decrypt($empresa_sucursal_id));

        // if (!$empresaSucursal) {
        //     abort(404, 'Registro no encontrado');
        // }

        // // Asignar valores correctos
        // $this->empresSucursal_id = $empresaSucursal->id; // Asegurar que se usa el ID correcto
        // $this->empresa_id = $empresaSucursal->empresa_id;
        // $this->sucursal_id = $empresaSucursal->sucursal_id;
        // $this->status = $empresaSucursal->status;
        // Asignar valores correctos
        $this->empresSucursal_id = $empresaSucursal->id; // Asegurar que se usa el ID correcto
        $this->empresa_id = $empresaSucursal->empresa_id;
        $this->sucursal_id = $empresaSucursal->sucursal_id;
        //$this->status = $empresaSucursal->status;

        // // Obtener todas las empresas y sucursales para los selects en la vista
        // $this->empresas = Empresa::all();
        // $this->sucursales = Sucursal::all();
    }



    public function actualizarEmpresSucursal()
    {
        $this->validate([
            'empresa_id' => 'required|integer',
            'sucursal_id' => 'required|integer',
            //'status' => 'required',
        ]);
    
        // Actualizar la tabla intermedia
        DB::table('empresa_sucursal')
            ->where('id', $this->empresSucursal_id)
            ->update([
                'empresa_id' => $this->empresa_id,
                'sucursal_id' => $this->sucursal_id,
                //'status' => $this->status,
                'updated_at' => now(),
            ]);

        return redirect()->route('mostrarempressucursal')->with('message', 'Asignación actualizada correctamente.');
    }

    public function render()
    {
        return view('livewire.portal-rh.empres-sucursal.editar-empres-sucursal', [
            'empresSucursal' => DB::table('empresa_sucursal')->get()
        ])->layout('layouts.client');
    }
}
