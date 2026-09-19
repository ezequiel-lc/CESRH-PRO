<?php

namespace App\Livewire\ActivoFijo\Activos\ActivoSouvenir\AdminEmpresa;

use App\Models\ActivoFijo\Activos\ActivoSouvenir;
use App\Models\ActivoFijo\Anioestimado;
use App\Models\ActivoFijo\Tipoactivo;
use App\Models\PortalRH\Sucursal;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class EditarSouvenir extends Component
{
    use WithFileUploads;
    public $activosou_id, $codigo, $productos, $descripcion, $color, $medida, $marca, $precio, $estado, $disponible, $fechaad, $tipo, $anio, $sucursal,$status;
    public $tipos, $anios, $sucursales;
    public $foto1, $foto2, $foto3;
    public $subirfoto1, $subirfoto2, $subirfoto3;

    protected $rules = [
        'codigo' => 'required',
        'productos' => 'required',
        'descripcion' => 'required',
        'color' => 'required',
        'medida' => 'required',
        'marca' => 'required',
        'precio' => 'required',
        'estado' => 'required',
        'disponible' => 'required',
        'fechaad' => 'required',
        'tipo' => 'required|exists:tipo_activos,id',
        'anio' => 'required|exists:aniosestimados,id',
        'subirfoto1' => 'nullable|image',
        'subirfoto2' => 'nullable|image',
        'subirfoto3' => 'nullable|image',
        'sucursal' => 'required|exists:sucursales,id',

    ];
    public function mount($id)
    {
        $item = ActivoSouvenir::findOrFail($id);
        $this->activosou_id = $id;
        $this->codigo = $item->codigo;
        $this->productos = $item->productos;
        $this->descripcion = $item->descripcion;
        $this->color = $item->color;
        $this->medida = $item->medida;
        $this->marca = $item->marca;
        $this->precio = $item->precio;
        $this->estado = $item->estado;
        $this->disponible = $item->disponible;
        $this->fechaad = $item->fecha_adquisicion;
        $this->tipo = $item->tipo_activo_id;
        $this->anio = $item->aniosestimado_id;
        $this->foto1 = $item->foto1;
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
            $this->subirfoto1->storeAs('ImagenSouvenir1', $this->productos . "-imagen.png", 'subirDocs');
            $this->foto1 = "ImagenSouvenir1/" . $this->productos . "-imagen.png";
        }

        if ($this->subirfoto2) {
            // eliminar la  anterior si existe
            if ($this->foto2 && Storage::disk('subirDocs')->exists($this->foto2)) {
                Storage::disk('subirDocs')->delete($this->foto2);
            }

            // guardar la nueva 
            $this->subirfoto2->storeAs('ImagenSouvenir2', $this->productos . "-imagen.png", 'subirDocs');
            $this->foto2 = "ImagenSouvenir2/" . $this->productos . "-imagen.png";
        }

        if ($this->subirfoto3) {
            // eliminar la  anterior si existe
            if ($this->foto3 && Storage::disk('subirDocs')->exists($this->foto3)) {
                Storage::disk('subirDocs')->delete($this->foto3);
            }

            // guardar la nueva 
            $this->subirfoto3->storeAs('ImagenSouvenir3', $this->productos . "-imagen.png", 'subirDocs');
            $this->foto3 = "ImagenSouvenir3/" . $this->productos . "-imagen.png";
        }


        // Actualizar la venta con los nuevos datos
        $activotec = ActivoSouvenir::findOrFail($this->activosou_id);
        $activotec->update([
            'codigo' => $this->codigo,
            'productos' => $this->productos,
            'descripcion' => $this->descripcion,
            'color' => $this->color,
            'medida' => $this->medida,
            'marca' => $this->marca,
            'precio' => $this->precio,
            'estado' => $this->estado,
            'disponible' => $this->disponible,
            'fecha_adquisicion' => $this->fechaad,
            'tipo_activo_id' => $this->tipo,
            'aniosestimado_id' => $this->anio,
            'sucursal_id' => $this->sucursal,
            'foto1' => $this->foto1,
            'foto2' => $this->foto2,
            'foto3' => $this->foto3,
            'status' => $this->status,  // agregar la imagen3 al modelo activosouvenir.php para que funcione con el storage
        ]);

        $this->dispatch('sucursalUpdated');

        return redirect()->route('mostrarsou');
    }
    public function render()
    {
        return view('livewire.activo-fijo.activos.activo-souvenir.admin-empresa.editar-souvenir')->layout('layouts.navactivos');
    }
}
