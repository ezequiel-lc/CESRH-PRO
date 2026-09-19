<?php

namespace App\Livewire\PortalRh\Sucursal;

use Livewire\Component;
use App\Models\PortalRH\Sucursal;
use Illuminate\Support\Facades\Crypt;
use App\Models\PortalRH\RegistroPatronal;
use Illuminate\Support\Facades\DB;
use App\Models\PortalRH\Empresa;

class EditarSucursal extends Component
{
    public $sucursal_id, $clave_sucursal, $nombre_sucursal, $zona_economica, $estado, $cuenta_contable, $rfc, $correo, $telefono, $status, $registro_patronal_id;
    public $regpatronales, $empresas, $empresa_id;


    public function mount($id)
    {
        $id = Crypt::decrypt($id);
        $sucursal = Sucursal::findOrFail($id);
        
        $this->sucursal_id = $id;
        $this->clave_sucursal = $sucursal->clave_sucursal;
        $this->nombre_sucursal = $sucursal->nombre_sucursal;
        $this->zona_economica = $sucursal->zona_economica;
        $this->estado = $sucursal->estado;
        $this->cuenta_contable = $sucursal->cuenta_contable;
        $this->rfc = $sucursal->rfc;
        $this->correo = $sucursal->correo;
        $this->telefono = $sucursal->telefono;
        $this->status = $sucursal->status;
        $this->registro_patronal_id = $sucursal->registro_patronal_id;

        $this->regpatronales = RegistroPatronal::all();
        $this->empresas = Empresa::all();

        // Cargar empresa asociada desde la tabla pivote
        $this->empresa_id = $sucursal->empresas()->first()->id ?? null;
    }

    public function actualizarSucursal()
    {
        $this->validate([
            'clave_sucursal' => 'required',
            'nombre_sucursal' => 'required',
            'zona_economica' => 'required',
            'estado' => 'required',
            'cuenta_contable' => 'required',
            'rfc' => 'required',
            'correo' => 'required|email',
            'telefono' => 'required|digits:10',
            'status' => 'required',
            'registro_patronal_id' => 'required|integer',
            'empresa_id' => 'required|exists:empresas,id',
        ]);

        $sucursal = Sucursal::findOrFail($this->sucursal_id);
        $sucursal->update([
            'clave_sucursal' => $this->clave_sucursal,
            'nombre_sucursal' => $this->nombre_sucursal,
            'zona_economica' => $this->zona_economica,
            'estado' => $this->estado,
            'cuenta_contable' => $this->cuenta_contable,
            'rfc' => $this->rfc,
            'correo' => $this->correo,
            'telefono' => $this->telefono,
            'status' => $this->status,
            'registro_patronal_id' => $this->registro_patronal_id,
        ]);

        // Actualizar relación en la tabla pivote 
        $sucursal->empresas()->sync([
            $this->empresa_id => [
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        return redirect()->route('mostrarsucursal')->with('message', 'Sucursal actualizada correctamente.');
    }


    public function render()
    {
        return view('livewire.portal-rh.sucursal.editar-sucursal')->layout('layouts.client');
    }
}
