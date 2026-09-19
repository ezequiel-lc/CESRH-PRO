<?php

namespace App\Livewire\ActivoFijo\Activos\ActivoOficina\AdminAdmin;

use App\Models\ActivoFijo\Activos\ActivoOficina;
use App\Models\ActivoFijo\Anioestimado;
use App\Models\ActivoFijo\Tipoactivo;
use App\Models\PortalRH\Empresa;
use App\Models\PortalRH\Sucursal;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage; 

class Editarofi extends Component
{
    use WithFileUploads;
    public $activo; // Datos del activo a editar
    public $empresas, $sucursalesFiltradas;
    public $tipos = [], $anios = [];
    public $subirfoto1, $subirfoto2, $subirfoto3;
    public $foto1, $foto2, $foto3;
    public $empresaSeleccionada;

    protected $rules = [
        'activo.nombre' => 'required',
        'activo.descripcion' => 'required',
        'activo.numero_activo' => 'required',
        'activo.ubicacion_fisica' => 'required',
        'activo.fecha_adquisicion' => 'required',
        'activo.fecha_baja' => 'nullable|date',
        'activo.tipo_activo_id' => 'required',
        'activo.precio_adquisicion' => 'required',
        'activo.aniosestimado_id' => 'required',
        'activo.empresa_id' => 'required',
        'activo.sucursal_id' => 'required',

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
        'activo.empresa_id.required' => 'La empresa es requerida',
        'activo.sucursal_id.required' => 'La sucursal es requerida',
    ];

    public function mount($id)
    {
       // Cargar el activo a editar
       $this->activo = ActivoOficina::findOrFail($id)->toArray();
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
            $this->subirfoto1->storeAs('ImagenOficina1', $this->activo['nombre'] . "-imagen1.png", 'subirDocs');
            $this->activo['foto1'] = "ImagenOficina1/" . $this->activo['nombre'] . "-imagen1.png";
        }

        if ($this->subirfoto2) {
            // Eliminar la imagen anterior si existe
            if ($this->foto2 && Storage::disk('subirDocs')->exists($this->foto2)) {
                Storage::disk('subirDocs')->delete($this->foto2);
            }

            // Guardar la nueva imagen
            $this->subirfoto2->storeAs('ImagenOficina2', $this->activo['nombre'] . "-imagen2.png", 'subirDocs');
            $this->activo['foto2'] = "ImagenOficina2/" . $this->activo['nombre'] . "-imagen2.png";
        }

        if ($this->subirfoto3) {
            // Eliminar la imagen anterior si existe
            if ($this->foto3 && Storage::disk('subirDocs')->exists($this->foto3)) {
                Storage::disk('subirDocs')->delete($this->foto3);
            }

            // Guardar la nueva imagen
            $this->subirfoto3->storeAs('ImagenOficina3', $this->activo['nombre'] . "-imagen3.png", 'subirDocs');
            $this->activo['foto3'] = "ImagenOficina3/" . $this->activo['nombre'] . "-imagen3.png";
        }


        // Actualizar el activo mobiliario
        ActivoOficina::find($this->activo['id'])->update($this->activo);

        // Redirigir a la vista de mostrar
        return redirect()->route('mostrarofiad');
    }
    public function render()
    {
        return view('livewire.activo-fijo.activos.activo-oficina.admin-admin.editarofi')->layout('layouts.navactivos');
    }
}
