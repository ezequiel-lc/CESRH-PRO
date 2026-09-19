<?php

namespace App\Livewire\ActivoFijo\Activos\ActivoUniforme\AdminAdmin;

use App\Models\ActivoFijo\Activos\ActivoUniforme;
use App\Models\ActivoFijo\Tipoactivo;
use App\Models\PortalRH\Empresa;
use App\Models\PortalRH\Sucursal;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;


class Agregaruni extends Component
{
    use WithFileUploads;
    public $consulta, $empresas, $sucursales;
    public $activo = [], $tipos = [];
    public $subirfoto1, $subirfoto2, $subirfoto3;
    public $empresaSeleccionada;
    public $sucursalesFiltradas = [];

    protected $rules = [
        'activo.descripcion'=>'required',
        'activo.talla'=>'required',
        'activo.cantidad'=>'required',
        'activo.estado'=>'required',
        'activo.disponible'=>'required',
        'activo.fecha_adquisicion' => 'required',
        'activo.observaciones'=>'required',
        'activo.tipo_activo_id'=>'required',
        'activo.color'=>'required',

    ];

    protected $messages = [
        'activo.descripcion.required' => 'Descripcion es requerido',
        'activo.talla.required' => 'Numero activo es requerido',
        'activo.cantidad.required' => 'Ubicacion es requerido',
        'activo.estado.required' => 'Fecha es requerido',
        'activo.disponible.required' => 'Tipo es requerido',
        'activo.fecha_adquisicion.required' => 'Precio es requerido',
        'activo.observaciones.required' => 'Año es requerido',
        'activo.tipo_activo_id.required' => 'Año es requerido',
        'activo.color.required' => 'Año es requerido',
    ];

    public function mount()
    {
        $this->empresas = Empresa::all();
        $this->consulta = ActivoUniforme::get();
        $this->activo['tipo_activo_id'] = Tipoactivo::where('nombre_activo', 'Activo Uniformes')->value('id');

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
    public function saveActivoUni()
    {
        $this->validate([
            'subirfoto1' => 'required|image|max:2048',
            'subirfoto2' => 'nullable|image|max:2048',
            'subirfoto3' => 'nullable|image|max:2048',
        ]);

        $this->activo['empresa_id'] = $this->empresaSeleccionada;


        if ($this->subirfoto1) {
            $this->subirfoto1->storeAs('ImagenOficina1', "{$this->activo['descripcion']}-imagen1.png", 'subirDocs');
            $this->activo['foto1'] = "ImagenOficina1/{$this->activo['descripcion']}-imagen1.png";
        }

        if ($this->subirfoto2) {
            $this->subirfoto2->storeAs('ImagenOficina2', "{$this->activo['descripcion']}-imagen2.png", 'subirDocs');
            $this->activo['foto2'] = "ImagenOficina2/{$this->activo['descripcion']}-imagen2.png";
        }

        if ($this->subirfoto3) {
            $this->subirfoto3->storeAs('ImagenOficina3', "{$this->activo['descripcion']}-imagen3.png", 'subirDocs');
            $this->activo['foto3'] = "ImagenOficina3/{$this->activo['descripcion']}-imagen3.png";
        }
        // Crear una nueva instancia de Sale y asignar los valores
        $AgregarActivo = new ActivoUniforme($this->activo);
        $AgregarActivo->save();
    
        // Limpiar los datos de la venta después de guardar
        $this->activo = [];
        $this->subirfoto1=NULL ;
        $this->subirfoto2=NULL ;
        $this->subirfoto3=NULL ;
        
        return redirect()->route('mostraruniad');
    }
    public function render()
    {
        return view('livewire.activo-fijo.activos.activo-uniforme.admin-admin.agregaruni')->layout('layouts.navactivos');
    }
}
