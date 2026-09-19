<?php

namespace App\Livewire\ActivoFijo\Activos\ActivoPapeleria\AdminSucursal;

use App\Models\ActivoFijo\Activos\ActivoPapeleria;
use Livewire\Component;
use Livewire\WithFileUploads;  // usamos la directiva para manejar archivos
use Illuminate\Support\Facades\Storage;
use App\Models\ActivoFijo\Anioestimado;
use App\Models\ActivoFijo\Tipoactivo;

class Editaractpape extends Component
{
    use WithFileUploads;
    public $activopape_id, $codigo, $nombre, $marca, $tipo, $cantidad, $estado, $disponible, $fechaad, $fechaba, $tipoact, $anio, $color, $preciouni;
    public $tipos, $anios;
    public $foto1, $foto2, $foto3;
    public $subirfoto1, $subirfoto2, $subirfoto3;

    protected $rules = [
        'codigo' => 'required',
        'nombre' => 'required',
        'marca' => 'required',
        'tipo' => 'required',
        'cantidad' => 'required',
        'estado' => 'required',
        'disponible' => 'required',
        'fechaad' => 'required',
        'fechaba' => 'required',
        'tipoact' => 'required|exists:tipo_activos,id',
        'anio' => 'required|exists:aniosestimados,id',
        'color' => 'required',
        'preciouni' => 'required',
        'subirfoto1' => 'nullable|image',
        'subirfoto2' => 'nullable|image',
        'subirfoto3' => 'nullable|image',
    ];

    public function mount($id)
    {
        $item = ActivoPapeleria::findOrFail($id);
        $this->activopape_id = $id;
        $this->codigo = $item->codigo_producto;
        $this->nombre = $item->nombre;
        $this->marca = $item->marca;
        $this->tipo = $item->tipo;
        $this->cantidad = $item->cantidad;
        $this->estado = $item->estado;
        $this->disponible = $item->disponible;
        $this->fechaad = $item->fecha_adquisicion;
        $this->fechaba = $item->fecha_baja;
        $this->tipoact = $item->tipo_activo_id;
        $this->anio = $item->aniosestimado_id;
        $this->color = $item->color;
        $this->preciouni = $item->precio_unitario;
        $this->foto1 = $item->foto1;
        $this->foto2 = $item->foto2;
        $this->foto3 = $item->foto3;

        $this->tipos = Tipoactivo::all()->pluck('nombre_activo', 'id');
        $this->anios = Anioestimado::all()->pluck('vida_util_año', 'id');
    }

    public function editar()
    {
        if ($this->subirfoto1) {
            // eliminar la  anterior si existe
            if ($this->foto1 && Storage::disk('subirDocs')->exists($this->foto1)) {
                Storage::disk('subirDocs')->delete($this->foto1);
            }

            // guardar la nueva 
            $this->subirfoto1->storeAs('ImagenPapeleria1', $this->nombre . "-imagen.png", 'subirDocs');
            $this->foto1 = "ImagenPapeleria1/" . $this->nombre . "-imagen.png";
        }

        if ($this->subirfoto2) {
            // eliminar la  anterior si existe
            if ($this->foto2 && Storage::disk('subirDocs')->exists($this->foto2)) {
                Storage::disk('subirDocs')->delete($this->foto2);
            }

            // guardar la nueva 
            $this->subirfoto2->storeAs('ImagenPapeleria2', $this->nombre . "-imagen.png", 'subirDocs');
            $this->foto2 = "ImagenPapeleria2/" . $this->nombre . "-imagen.png";
        }

        if ($this->subirfoto3) {
            // eliminar la  anterior si existe
            if ($this->foto3 && Storage::disk('subirDocs')->exists($this->foto3)) {
                Storage::disk('subirDocs')->delete($this->foto3);
            }

            // guardar la nueva 
            $this->subirfoto3->storeAs('ImagenPapeleria3', $this->nombre . "-imagen.png", 'subirDocs');
            $this->foto3 = "ImagenPapeleria3/" . $this->nombre . "-imagen.png";
        }


        // Actualizar la venta con los nuevos datos
        $activotec = ActivoPapeleria::findOrFail($this->activopape_id);
        $activotec->update([
            'codigo_producto'=> $this->codigo,
            'nombre'=> $this->nombre,
            'marca'=> $this->marca,
            'tipo'=> $this->tipo,
            'cantidad'=> $this->cantidad,
            'estado'=> $this->estado,
            'disponible'=> $this->disponible,
            'fecha_adquisicion'=> $this->fechaad,
            'fecha_baja'=> $this->fechaba,
            'tipo_activo_id'=> $this->tipoact,
            'aniosestimado_id'=> $this->anio,
            'color'=> $this->color,
            'precio_unitario'=> $this->preciouni,
            'foto1'=> $this->foto1,
            'foto2'=> $this->foto2,
            'foto3'=> $this->foto3,
        ]);

        return redirect()->route('mostraractpape');
    }
    public function render()
    {
        return view('livewire.activo-fijo.activos.activo-papeleria.admin-sucursal.editaractpape')->layout('layouts.navactivos');
    }
}
