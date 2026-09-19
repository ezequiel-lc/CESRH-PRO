<?php

namespace App\Livewire\ActivoFijo\Activos\ActivoUniforme\AdminSucursal;

use App\Models\ActivoFijo\Activos\ActivoUniforme;
use App\Models\ActivoFijo\Anioestimado;
use App\Models\ActivoFijo\Tipoactivo;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage; 

class Editaractuni extends Component
{
    use WithFileUploads;
    public $activotec_id,$descripcion,$talla,$cantidad,$estado,$disponible,$fechaad,$obser,$tipo,$color;
    public $tipos,$anios;
    public $foto1,$foto2,$foto3;
    public $subirfoto1,$subirfoto2,$subirfoto3;

    protected $rules = [
        'descripcion' => 'required',
        'talla' => 'required',
        'cantidad' => 'required',
        'estado' => 'required',
        'disponible' => 'required',
        'fechaad' => 'required',
        'obser' => 'required',
        'tipo' => 'required|exists:tipo_activos,id',
        'color' => 'required',
        'subirfoto1' =>'nullable|image',
        'subirfoto2' =>'nullable|image', 
        'subirfoto3' =>'nullable|image',  
    ];
    public function mount($id)
    {
        $item = ActivoUniforme::findOrFail($id);
        $this->activotec_id= $id;
        $this->descripcion= $item->descripcion;
        $this->talla=$item->talla;
        $this->cantidad=$item->cantidad;
        $this->estado=$item->estado;
        $this->disponible=$item->disponible;
        $this->fechaad=$item->fecha_adquisicion;
        $this->obser=$item->observaciones;
        $this->tipo=$item->tipo_activo_id;
        $this->color=$item->color;
        $this->foto1=$item->foto1;
        $this->foto2=$item->foto2;
        $this->foto3=$item->foto3;

        $this->tipos = Tipoactivo::all()->pluck('nombre_activo', 'id');
        $this->anios = Anioestimado::all()->pluck('vida_util_año', 'id');
    }

    public function editar()
    {
        if ($this->subirfoto1) {
            // eliminar la  anterior si existe
            if ($this->foto1 && Storage::disk('subirDocs')->exists($this->descripcion)) {
                Storage::disk('subirDocs')->delete($this->descripcion);
            }

            // guardar la nueva 
            $this->subirfoto1->storeAs('ImagenUniforme1', $this->descripcion . "-imagen.png", 'subirDocs');
            $this->foto1 = "ImagenUniforme1/" . $this->descripcion . "-imagen.png";
        }

        if ($this->subirfoto2) {
            // eliminar la  anterior si existe
            if ($this->foto2 && Storage::disk('subirDocs')->exists($this->foto2)) {
                Storage::disk('subirDocs')->delete($this->foto2);
            }

            // guardar la nueva 
            $this->subirfoto2->storeAs('ImagenUniforme2', $this->descripcion . "-imagen.png", 'subirDocs');
            $this->foto2 = "ImagenUniforme2/" . $this->descripcion . "-imagen.png";
        }

        if ($this->subirfoto3) {
            // eliminar la  anterior si existe
            if ($this->foto3 && Storage::disk('subirDocs')->exists($this->foto3)) {
                Storage::disk('subirDocs')->delete($this->foto3);
            }

            // guardar la nueva 
            $this->subirfoto3->storeAs('ImagenUniforme3', $this->descripcion . "-imagen.png", 'subirDocs');
            $this->foto3 = "ImagenUniforme3/" . $this->descripcion . "-imagen.png";
        }


        // Actualizar la venta con los nuevos datos
        $activotec = ActivoUniforme::findOrFail($this->activotec_id); 
        $activotec->update([
            'descripcion' => $this->descripcion,
            'talla' => $this->talla,
            'cantidad' => $this->cantidad,
            'estado' => $this->estado,
            'disponible' => $this->disponible,
            'fecha_adquisicion' => $this->fechaad,
            'observaciones' => $this->obser,
            'tipo_activo_id' => $this->tipo,
            'color' => $this->color,
            'foto1'=>$this->foto1,
            'foto2'=>$this->foto2,
            'foto3'=>$this->foto3,
        ]);
        
        return redirect()->route('mostraractuni');
    }
    public function render()
    {
        return view('livewire.activo-fijo.activos.activo-uniforme.admin-sucursal.editaractuni')->layout('layouts.navactivos');
    }
}
