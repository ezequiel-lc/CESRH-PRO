<?php

namespace App\Livewire\ActivoFijo\Activos\ActivoPapeleria\AdminAdmin;

use App\Models\ActivoFijo\Activos\ActivoPapeleria;
use App\Models\ActivoFijo\Anioestimado;
use App\Models\ActivoFijo\Tipoactivo;
use App\Models\PortalRH\Empresa;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class Editarpape extends Component
{
    use WithFileUploads;
    public $activo; // Datos del activo a editar
    public $empresas, $sucursalesFiltradas;
    public $tipos = [], $anios = [];
    public $subirfoto1, $subirfoto2, $subirfoto3;
    public $foto1, $foto2, $foto3;
    public $empresaSeleccionada;
    
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
        'activo.empresa_id' => 'required',
        'activo.sucursal_id' => 'required',
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
        'activo.empresa_id.required' => 'La empresa es requerida',
        'activo.sucursal_id.required' => 'La sucursal es requerida',
    ];

    public function mount($id)
    {
        // Cargar el activo a editar
       $this->activo = ActivoPapeleria::findOrFail($id)->toArray();
       $this->foto1 = $this->activo['foto1'];
       $this->foto2 = $this->activo['foto2'];
       $this->foto3 = $this->activo['foto3'];

       // Cargar empresas y sucursales
       $this->empresas = Empresa::all();

       // Obtener las sucursales relacionadas con la empresa del activo
       $empresa = Empresa::find($this->activo['empresa_id']);
       $this->sucursalesFiltradas = $empresa ? $empresa->sucursales : collect();

       // Cargar tipos de activo y años estimados
       $this->tipos = Tipoactivo::pluck('nombre_activo', 'id')->toArray();
       $this->anios = Anioestimado::pluck('vida_util_año', 'id')->toArray();

       // Establecer la empresa seleccionada
       $this->empresaSeleccionada = $this->activo['empresa_id'];
    }

    public function updatedEmpresaSeleccionada($empresaId)
    {
        // Filtrar sucursales según la empresa seleccionada
        $empresa = Empresa::find($empresaId);
        $this->sucursalesFiltradas = $empresa ? $empresa->sucursales : collect();
    }
    public function editar()
    {
        $this->validate([
            'subirfoto1' => 'nullable|image|max:2048',
            'subirfoto2' => 'nullable|image|max:2048',
            'subirfoto3' => 'nullable|image|max:2048',
        ]);

        $this->activo['empresa_id'] = $this->empresaSeleccionada;

        if ($this->subirfoto1) {
            // Eliminar la imagen anterior si existe
            if ($this->foto1 && Storage::disk('subirDocs')->exists($this->foto1)) {
                Storage::disk('subirDocs')->delete($this->foto1);
            }

            // Guardar la nueva imagen
            $this->subirfoto1->storeAs('ImagenPapeleria1', $this->activo['nombre'] . "-imagen1.png", 'subirDocs');
            $this->activo['foto1'] = "ImagenPapeleria1/" . $this->activo['nombre'] . "-imagen1.png";
        }

        if ($this->subirfoto2) {
            // Eliminar la imagen anterior si existe
            if ($this->foto2 && Storage::disk('subirDocs')->exists($this->foto2)) {
                Storage::disk('subirDocs')->delete($this->foto2);
            }

            // Guardar la nueva imagen
            $this->subirfoto2->storeAs('ImagenPapeleria2', $this->activo['nombre'] . "-imagen2.png", 'subirDocs');
            $this->activo['foto2'] = "ImagenPapeleria2/" . $this->activo['nombre'] . "-imagen2.png";
        }

        if ($this->subirfoto3) {
            // Eliminar la imagen anterior si existe
            if ($this->foto3 && Storage::disk('subirDocs')->exists($this->foto3)) {
                Storage::disk('subirDocs')->delete($this->foto3);
            }

            // Guardar la nueva imagen
            $this->subirfoto3->storeAs('ImagenPapeleria3', $this->activo['nombre'] . "-imagen3.png", 'subirDocs');
            $this->activo['foto3'] = "ImagenPapeleria3/" . $this->activo['nombre'] . "-imagen3.png";
        }
        // Crear una nueva instancia de Sale y asignar los valores
        // Actualizar el activo mobiliario
        ActivoPapeleria::find($this->activo['id'])->update($this->activo);

        // Redirigir a la vista de mostrar
        return redirect()->route('mostrarpapead');
    }
    public function render()
    {
        return view('livewire.activo-fijo.activos.activo-papeleria.admin-admin.editarpape')->layout('layouts.navactivos');
    }
}
