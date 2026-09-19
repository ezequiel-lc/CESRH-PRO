<?php

namespace App\Livewire\ActivoFijo\Activos\ActivoTecnologias\AdminEmpresa;

use App\Models\ActivoFijo\Activos\ActivoTecnologia;
use App\Models\ActivoFijo\Anioestimado;
use App\Models\ActivoFijo\Tipoactivo;
use App\Models\PortalRH\Sucursal;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditarTecnologia extends Component
{
    use WithFileUploads;

    public $activotec_id, $nombre, $descripcion, $numser, $numact, $ubicacion, $fechaad, $fechaba, $tipo, $precioad, $anio, $sucursal,$status;
    public $tipos, $anios, $sucursales;
    public $foto1, $foto2, $foto3;
    public $subirfoto1, $subirfoto2, $subirfoto3;

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
        'sucursal' => 'required|exists:sucursales,id',
    ];

    public function mount($id)
    {
        $item = ActivoTecnologia::findOrFail($id);
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
        $this->status = $item->status;

        $this->tipos = Tipoactivo::all()->pluck('nombre_activo', 'id');
        $this->anios = Anioestimado::all()->pluck('vida_util_año', 'id');
        $this->sucursales = Sucursal::whereHas('empresas', function ($query) {
            $query->where('empresa_id', Auth::user()->empresa_id);
        })->pluck('nombre_sucursal', 'id')->toArray();

        //dd($this->sucursal); // Verifica el valor de sucursal
    }

    public function editar()
    {
        if ($this->subirfoto1) {
            if ($this->foto1 && Storage::disk('subirDocs')->exists($this->foto1)) {
                Storage::disk('subirDocs')->delete($this->foto1);
            }
            $this->subirfoto1->storeAs('ImagenTecnologia1', $this->nombre . "-imagen.png", 'subirDocs');
            $this->foto1 = "ImagenTecnologia1/" . $this->nombre . "-imagen.png";
        }

        if ($this->subirfoto2) {
            if ($this->foto2 && Storage::disk('subirDocs')->exists($this->foto2)) {
                Storage::disk('subirDocs')->delete($this->foto2);
            }
            $this->subirfoto2->storeAs('ImagenTecnologia2', $this->nombre . "-imagen.png", 'subirDocs');
            $this->foto2 = "ImagenTecnologia2/" . $this->nombre . "-imagen.png";
        }

        if ($this->subirfoto3) {
            if ($this->foto3 && Storage::disk('subirDocs')->exists($this->foto3)) {
                Storage::disk('subirDocs')->delete($this->foto3);
            }
            $this->subirfoto3->storeAs('ImagenTecnologia3', $this->nombre . "-imagen.png", 'subirDocs');
            $this->foto3 = "ImagenTecnologia3/" . $this->nombre . "-imagen.png";
        }

        $activotec = ActivoTecnologia::findOrFail($this->activotec_id);
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
            'status' => $this->status,
        ]);

        $this->dispatch('sucursalUpdated');

        return redirect()->route('mostrartec');
    }

    public function render()
    {
        return view('livewire.activo-fijo.activos.activo-tecnologias.admin-empresa.editar-tecnologia')->layout('layouts.navactivos');
    }
}
