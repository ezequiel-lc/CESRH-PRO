<?php

namespace App\Livewire\ActivoFijo\Activos\ActivoTecnologias\AdminSucursal;

use Livewire\Component;
use App\Models\ActivoFijo\Activos\ActivoTecnologia;
use App\Models\ActivoFijo\Tipoactivo;
use App\Models\ActivoFijo\Anioestimado;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class Agregaracttec extends Component
{
    use WithFileUploads;
    public $consulta, $empresa;
    public $activo = [], $tipos = [], $anios = [];
    public $subirfoto1, $subirfoto2, $subirfoto3;

    protected $rules = [
        'activo.nombre' => 'required',
        'activo.descripcion' => 'required',
        'activo.num_serie' => 'required',
        'activo.num_activo' => 'required',
        'activo.ubicacion_fisica' => 'required',
        'activo.fecha_adquisicion' => 'required',
        'activo.fecha_baja' => 'nullable|date',
        'activo.tipo_activo_id' => 'required',
        'activo.precio_adquisicion' => 'required',
        'activo.aniosestimado_id' => 'required',

    ];

    protected $messages = [
        'activo.nombre.required' => 'Nombre es requerido',
        'activo.descripcion.required' => 'Descripcion es requerido',
        'activo.num_serie.required' => 'Numero de serie es requerido',
        'activo.num_activo.required' => 'Numero activo es requerido',
        'activo.ubicacion_fisica.required' => 'Ubicacion es requerido',
        'activo.fecha_adquisicion.required' => 'Fecha es requerido',
        'activo.tipo_activo_id.required' => 'Tipo es requerido',
        'activo.precio_adquisicion.required' => 'Precio es requerido',
        'activo.aniosestimado_id.required' => 'Año es requerido',
    ];

    public function mount()
    {
        //ejemplo de consulta
        $this->consulta = ActivoTecnologia::get();
        $this->activo['tipo_activo_id'] = Tipoactivo::where('nombre_activo', 'Activo Tecnologias')->value('id');
        //dd($this->activo['tipo_activo_id']);
        $this->anios = Anioestimado::pluck('vida_util_año', 'id')->toArray();
        $this->activo['status'] ='Activo';
        // $this->activo['empresa_id'] = Auth::user()->empresa_id;
        // $this->activo['sucursal_id'] = Auth::user()->sucursal_id;
    }

    public function saveActivoTec()
    {
        $this->validate([
            'subirfoto1' => 'required|image|max:2048',
            'subirfoto2' => 'nullable|image|max:2048',
            'subirfoto3' => 'nullable|image|max:2048',
        ]);

        // Asignar sucursal del usuario autenticado
        $this->activo['empresa_id'] = Auth::user()->empresa_id;
        $this->activo['sucursal_id'] = Auth::user()->sucursal_id;

        $this->subirfoto1->storeAs('ImagenTecnologia1', $this->activo['nombre'] . "-imagen.png", 'subirDocs');
        $this->activo['foto1'] = "ImagenTecnologia1/" . $this->activo['nombre'] . "-imagen.png";

        if ($this->subirfoto2) {
            $this->subirfoto2->storeAs('ImagenTecnologia2', $this->activo['nombre'] . "-imagen.png", 'subirDocs');
            $this->activo['foto2'] = "ImagenTecnologia2/" . $this->activo['nombre'] . "-imagen.png";
        }

        if ($this->subirfoto3) {
            $this->subirfoto3->storeAs('ImagenTecnologia3', $this->activo['nombre'] . "-imagen.png", 'subirDocs');
            $this->activo['foto3'] = "ImagenTecnologia3/" . $this->activo['nombre'] . "-imagen.png";
        }

        // Guardar el activo con sucursal asignada
        $AgregarActivo = new ActivoTecnologia($this->activo);
        $AgregarActivo->save();

        // Limpiar los datos después de guardar
        $this->activo = [];
        $this->subirfoto1 = null;
        $this->subirfoto2 = null;
        $this->subirfoto3 = null;

        return redirect()->route('mostraracttec');
    }




    public function render()
    {
        return view('livewire.activo-fijo.activos.activo-tecnologias.admin-sucursal.agregaracttec')->layout('layouts.navactivos');
    }
}
