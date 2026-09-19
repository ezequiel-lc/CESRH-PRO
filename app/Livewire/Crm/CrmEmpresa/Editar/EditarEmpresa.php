<?php

namespace App\Livewire\Crm\CrmEmpresa\Editar;

use App\Models\Crm\CrmEmpresa;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
class EditarEmpresa extends Component
{
    use WithFileUploads;
    public $empresa_id,
    $nombre,
    $tamano_empresa,
    $pagina_web,
    $imagen;

    public $subirPortada;

    public function mount($id)
    {
        $tem = CrmEmpresa::findOrFail($id);

        $this->empresa_id = $id;
        $this->nombre = $tem->nombre;
        $this->tamano_empresa = $tem->tamano_empresa;
        $this->pagina_web = $tem->pagina_web;
        $this->imagen = $tem->imagen;
    }

    public function editEmpresa()
    {
        $this->validate([
            'nombre' => 'required',
            'tamano_empresa' => 'required',
            'pagina_web' => 'required',
            'subirPortada' => 'required|image',
        ]);

        if($this->subirPortada)
        {
            if($this->imagen && Storage::disk('subirDocs')->exists($this->imagen))
            {
                Storage::disk('subirDocs')->delete($this->imagen);
            }

            $this->subirPortada->storeAs('ImagenEmpresa', $this->nombre . "imagen.png", "subirDocs");
            $this->imagen="ImagenEmpresa/" . $this->nombre . "imagen.png";
        }

        CrmEmpresa::updateOrCreate(['id'=>$this->empresa_id], [
            'nombre' => $this->nombre,
            'tamano_empresa' => $this->tamano_empresa,
            'pagina_web' => $this->pagina_web,
            'imagen' => $this->imagen,
        ]);
        return redirect()->route('mostrarEmpresaCrm');
    }

    public function render()
    {
        return view('livewire.crm.crm-empresa.editar.editar-empresa')->layout('layouts.crm');
    }
}