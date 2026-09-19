<?php

namespace App\Livewire\ActivoFijo\Activos\ActivoPapeleria\AdminAdmin;

use Livewire\Component;
use App\Models\ActivoFijo\Activos\ActivoPapeleria;
use App\Models\ActivoFijo\Anioestimado;
use App\Models\ActivoFijo\Tipoactivo;
use App\Models\PortalRH\Empresa;
use App\Models\PortalRH\Sucursal;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;

class Agregarpape extends Component
{
    use WithFileUploads;
    public $consulta, $empresas, $sucursales;
    public $activo=[],$tipos=[],$anios=[];
    public $subirfoto1,$subirfoto2,$subirfoto3;
    public $empresaSeleccionada;
    public $sucursalesFiltradas = [];
    
    protected $rules = [
        'activo.codigo_producto'=>'required',
        'activo.nombre'=>'required',
        'activo.marca'=>'required',
        'activo.tipo'=>'required',
        'activo.cantidad'=>'required',
        'activo.estado'=>'required',
        'activo.disponible'=>'required',
        'activo.fecha_adquisicion'=>'required',
        'activo.fecha_baja' => 'nullable|date',
        'activo.tipo_activo_id'=>'required',
        'activo.aniosestimado_id'=>'required',
        'activo.color'=>'required',
        'activo.precio_unitario'=>'required',
    ];

    protected $messages = [
        'activo.codigo_producto.required'=>'El codigo es requerido',
        'activo.nombre.required'=>'El nombre es requerido',
        'activo.marca.required'=>'La marca es requerida',
        'activo.tipo.required'=>'El tipo es requerido',
        'activo.cantidad.required'=>'La cantidad es requerida',
        'activo.estado.required'=>'El estado es requerido',
        'activo.disponible.required'=>'La disponiblidad es requerida',
        'activo.fecha_adquisicion.required'=>'La fecha es requerida',
        'activo.tipo_activo_id.required'=>'El tipo es requerido',
        'activo.aniosestimado_id.required'=>'El año es requerido',
        'activo.color.required'=>'El color es requerido',
        'activo.precio_unitario.required'=>'El precio es requerido',
    ];

    public function mount()
    {
        $this->empresas = Empresa::all();
        $this->consulta = ActivoPapeleria::get();
        $this->activo['tipo_activo_id'] = Tipoactivo::where('nombre_activo', 'Activo Papelerias')->value('id');
        $this->anios = Anioestimado::pluck('vida_util_año', 'id')->toArray();
    
        // Inicializar empresaSeleccionada con la empresa del usuario autenticado
        $this->empresaSeleccionada = Auth::user()->empresa_id;

        $this->updatedEmpresaSeleccionada($this->empresaSeleccionada);
        $this->activo['status'] ='Activo';
    }

    public function hydrate()
    {
        $this->dispatch('render-select2'); // Dispara el evento para reinicializar Select2
    }
    public function updatedEmpresaSeleccionada($empresaId)
    {
        $this->sucursalesFiltradas = Sucursal::join('empresa_sucursal', 'sucursales.id', '=', 'empresa_sucursal.sucursal_id')
            ->where('empresa_sucursal.empresa_id', $empresaId)
            ->get();

        $this->activo['sucursal_id'] = '';

        // Emitir un evento al frontend para reinicializar Select2
        $this->dispatch('sucursales-actualizadas');
    }
    public function saveActivoPape()
    {
        $this->validate([
            'subirfoto1' => 'required|image|max:2048',
            'subirfoto2' => 'nullable|image|max:2048',
            'subirfoto3' => 'nullable|image|max:2048',
        ]);

        $this->activo['empresa_id'] = $this->empresaSeleccionada;

        $this->subirfoto1->storeAs('ImagenPapeleria1',$this->activo['nombre']."-imagen.png",'subirDocs');
        $this->activo['foto1']="ImagenPapeleria1/".$this->activo['nombre']."-imagen.png";

        $this->subirfoto2->storeAs('ImagenPapeleria2',$this->activo['nombre']."-imagen.png",'subirDocs');
        $this->activo['foto2']="ImagenPapeleria2/".$this->activo['nombre']."-imagen.png";

        $this->subirfoto3->storeAs('ImagenPapeleria3',$this->activo['nombre']."-imagen.png",'subirDocs');
        $this->activo['foto3']="ImagenPapeleria3/".$this->activo['nombre']."-imagen.png";
        // Crear una nueva instancia de Sale y asignar los valores
        $AgregarActivo = new ActivoPapeleria($this->activo);
        $AgregarActivo->save();
    
        // Limpiar los datos de la venta después de guardar
        $this->activo = [];
        $this->subirfoto1=NULL ;
        $this->subirfoto2=NULL ;
        $this->subirfoto3=NULL ;
        
        return redirect()->route('mostrarpapead');
    }
    public function render()
    {
        return view('livewire.activo-fijo.activos.activo-papeleria.admin-admin.agregarpape')->layout('layouts.navactivos');
    }
}
