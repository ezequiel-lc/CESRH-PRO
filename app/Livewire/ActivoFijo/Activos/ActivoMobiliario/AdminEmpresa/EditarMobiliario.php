<?php

namespace App\Livewire\ActivoFijo\Activos\ActivoMobiliario\AdminEmpresa;

use App\Models\ActivoFijo\Activos\ActivoMobiliario;
use App\Models\ActivoFijo\Anioestimado;
use App\Models\ActivoFijo\Tipoactivo;
use App\Models\PortalRH\Sucursal;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;  // usamos la directiva para manejar archivos
use Illuminate\Support\Facades\Storage;

class EditarMobiliario extends Component
{
    use WithFileUploads;
    public $activotec_id, $nombre, $descripcion, $numser, $numact, $ubicacion, $fechaad, $fechaba, $tipo, $precioad, $anio, $sucursal,$status;
    public $tipos, $anios, $sucursales;
    public $foto1, $foto2, $foto3, $foto4;
    public $subirfoto1, $subirfoto2, $subirfoto3, $subirfoto4;
    

    protected $rules = [
        'nombre' => 'required',
        'descripcion' => 'required',
        'numser' => 'required',
        'numact' => 'required',
        'ubicacion' => 'required',
        'fechaad' => 'required',
        'fechaba' => 'required',
        'tipo' => 'required|exists:tipo_activos,id',
        'precioad' => 'required',
        'anio' => 'required|exists:aniosestimados,id',
        'subirfoto1' => 'nullable|image',
        'subirfoto2' => 'nullable|image',
        'subirfoto3' => 'nullable|image',
        'subirfoto4' => 'nullable|image',
        'sucursal' => 'required|exists:sucursales,id',
    ];

    public function mount($id)
    {
        $item = ActivoMobiliario::findOrFail($id);
        $this->activotec_id = $id;
        $this->nombre = $item->nombre;
        $this->descripcion = $item->descripcion;
        $this->numser = $item->num_serie;
        $this->numact = $item->num_activo;
        $this->ubicacion = $item->ubicacion_fisica;
        $this->fechaad = $item->fecha_adquisicion;
        $this->fechaba = $item->fecha_baja;
        $this->tipo = $item->tipo_activo_id;
        $this->precioad = $item->precio_adquisicion;
        $this->anio = $item->aniosestimado_id;
        $this->sucursal = $item->sucursal_id; // Asegúrate de que esto esté correcto
        $this->foto1 = $item->foto1;
        $this->foto2 = $item->foto2;
        $this->foto3 = $item->foto3;
        $this->foto4 = $item->foto4;
        $this->status = $item->status;

        $this->tipos = Tipoactivo::all()->pluck('nombre_activo', 'id');
        $this->anios = Anioestimado::all()->pluck('vida_util_año', 'id');
        $this->sucursales = Sucursal::whereHas('empresas', function ($query) {
            $query->where('empresa_id', Auth::user()->empresa_id);
        })->pluck('nombre_sucursal', 'id')->toArray();
    }

    public function editar()
    {
        if ($this->subirfoto1) {
            // eliminar la  anterior si existe
            if ($this->foto1 && Storage::disk('subirDocs')->exists($this->foto1)) {
                Storage::disk('subirDocs')->delete($this->foto1);
            }

            // guardar la nueva 
            $this->subirfoto1->storeAs('ImagenMobiliario1', $this->nombre . "-imagen.png", 'subirDocs');
            $this->foto1 = "ImagenMobiliario1/" . $this->nombre . "-imagen.png";
        }

        if ($this->subirfoto2) {
            // eliminar la  anterior si existe
            if ($this->foto2 && Storage::disk('subirDocs')->exists($this->foto2)) {
                Storage::disk('subirDocs')->delete($this->foto2);
            }

            // guardar la nueva 
            $this->subirfoto2->storeAs('ImagenMobiliario2', $this->nombre . "-imagen.png", 'subirDocs');
            $this->foto2 = "ImagenMobiliario2/" . $this->nombre . "-imagen.png";
        }

        if ($this->subirfoto3) {
            // eliminar la  anterior si existe
            if ($this->foto3 && Storage::disk('subirDocs')->exists($this->foto3)) {
                Storage::disk('subirDocs')->delete($this->foto3);
            }

            // guardar la nueva 
            $this->subirfoto3->storeAs('ImagenMobiliario3', $this->nombre . "-imagen.png", 'subirDocs');
            $this->foto3 = "ImagenMobiliario3/" . $this->nombre . "-imagen.png";
        }

        if ($this->subirfoto4) {
            // eliminar la  anterior si existe
            if ($this->foto4 && Storage::disk('subirDocs')->exists($this->foto4)) {
                Storage::disk('subirDocs')->delete($this->foto4);
            }

            // guardar la nueva 
            $this->subirfoto4->storeAs('ImagenMobiliario4', $this->nombre . "-imagen.png", 'subirDocs');
            $this->foto4 = "ImagenMobiliario4/" . $this->nombre . "-imagen.png";
        }


        // Actualizar la venta con los nuevos datos
        $activotec = ActivoMobiliario::findOrFail($this->activotec_id);
        $activotec->update([
            'nombre' => $this->nombre,
            'descripcion' => $this->descripcion,
            'num_serie' => $this->numser,
            'num_activo' => $this->numact,
            'ubicacion_fisica' => $this->ubicacion,
            'fecha_adquisicion' => $this->fechaad,
            'fecha_baja' => $this->fechaba,
            'tipo_activo_id' => $this->tipo,
            'precio_adquisicion' => $this->precioad,
            'aniosestimado_id' => $this->anio,
            'sucursal_id' => $this->sucursal,
            'foto1' => $this->foto1,
            'foto2' => $this->foto2,
            'foto3' => $this->foto3,
            'foto4' => $this->foto4,
            'status' => $this->status,
        ]);
        $this->dispatch('sucursalUpdated');
        return redirect()->route('mostrarmob');
    }
    public function render()
    {
        return view('livewire.activo-fijo.activos.activo-mobiliario.admin-empresa.editar-mobiliario')->layout('layouts.navactivos');
    }
}
