<?php

namespace App\Livewire\ActivoFijo\Activos\ActivoOficina\AdminSucursal;

use App\Models\ActivoFijo\Activos\ActivoOficina;
use Livewire\Component;
use App\Models\ActivoFijo\Anioestimado;
use App\Models\ActivoFijo\Tipoactivo;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;

class Agregaractofi extends Component
{
    use WithFileUploads;
    public $consulta;
    public $activo=[],$tipos=[],$anios=[];
    public $subirfoto1,$subirfoto2,$subirfoto3;

    protected $rules = [
        'activo.nombre'=>'required',
        'activo.descripcion'=>'required',
        'activo.numero_activo'=>'required',
        'activo.ubicacion_fisica'=>'required',
        'activo.fecha_adquisicion'=>'required',
        'activo.fecha_baja' => 'nullable|date',
        'activo.tipo_activo_id'=>'required',
        'activo.precio_adquisicion'=>'required',
        'activo.aniosestimado_id'=>'required',

    ];

    protected $messages = [
        'activo.nombre.required' => 'Nombre es requerido',
        'activo.descripcion.required' => 'Descripcion es requerido',
        'activo.numero_activo.required' => 'Numero activo es requerido',
        'activo.ubicacion_fisica.required' => 'Ubicacion es requerido',
        'activo.fecha_adquisicion.required' => 'Fecha es requerido',
        'activo.tipo_activo_id.required' => 'Tipo es requerido',
        'activo.precio_adquisicion.required' => 'Precio es requerido',
        'activo.aniosestimado_id.required' => 'Año es requerido',
    ];

    public function mount()
    {
        //ejemplo de consulta
        $this->consulta = ActivoOficina::get();
        $this->activo['tipo_activo_id'] = Tipoactivo::where('nombre_activo', 'Activo Oficinas')->value('id');
        //dd($this->activo['tipo_activo_id']);
        $this->anios = Anioestimado::pluck('vida_util_año', 'id')->toArray();
        $this->activo['status'] ='Activo';
    }

    public function saveActivoOf()
    {
        $this->validate([
            'subirfoto1' => 'required|image|max:2048',
            'subirfoto2' => 'nullable|image|max:2048',
            'subirfoto3' => 'nullable|image|max:2048',
        ]);

        $this->activo['empresa_id'] = Auth::user()->empresa_id;
        $this->activo['sucursal_id'] = Auth::user()->sucursal_id;

        $this->subirfoto1->storeAs('ImagenOficina1',$this->activo['nombre']."-imagen.png",'subirDocs');
        $this->activo['foto1']="ImagenOficina1/".$this->activo['nombre']."-imagen.png";

        $this->subirfoto2->storeAs('ImagenOficina2',$this->activo['nombre']."-imagen.png",'subirDocs');
        $this->activo['foto2']="ImagenOficina2/".$this->activo['nombre']."-imagen.png";

        $this->subirfoto3->storeAs('ImagenOficina3',$this->activo['nombre']."-imagen.png",'subirDocs');
        $this->activo['foto3']="ImagenOficina3/".$this->activo['nombre']."-imagen.png";
        // Crear una nueva instancia de Sale y asignar los valores
        $AgregarActivo = new ActivoOficina($this->activo);
        $AgregarActivo->save();
    
        // Limpiar los datos de la venta después de guardar
        $this->activo = [];
        $this->subirfoto1=NULL ;
        $this->subirfoto2=NULL ;
        $this->subirfoto3=NULL ;
        
        return redirect()->route('mostraractofi');
    }
    public function render()
    {
        return view('livewire.activo-fijo.activos.activo-oficina.admin-sucursal.agregaractofi')->layout('layouts.navactivos');
    }
}
