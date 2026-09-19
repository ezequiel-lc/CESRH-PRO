<?php

namespace App\Livewire\PortalRh\Empres;

use Livewire\Component;
use App\Models\PortalRH\Empresa;
use Illuminate\Support\Facades\Crypt;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class EditarEmpres extends Component
{
    use WithFileUploads;
    public $empres_id, $nombre, $razon_social, $rfc, $nombre_comercial, $pais_origen, $representante_legal, 
    $url_constancia_situacion_fiscal, $subirPdf;

    public function mount($id)
    {
        $id = Crypt::decrypt($id);
        $tem = Empresa::findOrFail($id);
        
        $this->empres_id = $id;
        $this->nombre = $tem->nombre;
        $this->razon_social = $tem->razon_social;
        $this->rfc = $tem->rfc;
        $this->nombre_comercial = $tem->nombre_comercial;
        $this->pais_origen = $tem->pais_origen;
        $this->representante_legal = $tem->representante_legal;
        $this->url_constancia_situacion_fiscal = $tem->url_constancia_situacion_fiscal;
    }

    public function actualizarEmpresa()
    {
        $this->validate([
            'nombre' => 'required',
            'razon_social' => 'required',
            'rfc' => 'required',
            'nombre_comercial' => 'required',
            'pais_origen' => 'required',
            'representante_legal' => 'required',
            'subirPdf' => 'nullable|file|mimes:pdf',
        ]);

        // si se subio un nuevo archivo PDF
        if ($this->subirPdf) {
            // eliminar el archivo PDF anterior si existe
            if ($this->url_constancia_situacion_fiscal && Storage::disk('subirDocs')->exists($this->url_constancia_situacion_fiscal)) {
                Storage::disk('subirDocs')->delete($this->url_constancia_situacion_fiscal);
            }

            // guardar el nuevo archivo PDF
            $this->subirPdf->storeAs('PortalRH/Empresas', $this->nombre . ".pdf", 'subirDocs');
            $this->url_constancia_situacion_fiscal = "PortalRH/Empresas/" . $this->nombre . ".pdf";
        }

        Empresa::updateOrCreate(['id' => $this->empres_id], [
            'nombre' => $this->nombre,
            'razon_social' => $this->razon_social,
            'rfc' => $this->rfc,
            'nombre_comercial' => $this->nombre_comercial,
            'pais_origen' => $this->pais_origen,
            'representante_legal' => $this->representante_legal,
            'url_constancia_situacion_fiscal' => $this->url_constancia_situacion_fiscal,
        ]);

        
        //$this->emit('editBann', 'Empresa editada correctamente');
        return redirect()->route('mostrarempresas');
    }

    public function redirigir()
    {
        return redirect()->route('mostrarempresas');
    }

    public function render()
    {
        return view('livewire.portal-rh.empres.editar-empres')->layout('layouts.client');
    }
}
