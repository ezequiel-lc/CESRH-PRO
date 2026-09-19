<?php

namespace App\Livewire\ActivoFijo\Activos\ActivoMobiliario\AdminAdmin;

use App\Models\ActivoFijo\Activos\ActivoMobiliario;
use App\Models\ActivoFijo\Anioestimado;
use App\Models\ActivoFijo\Tipoactivo;
use App\Models\PortalRH\Empresa;
use App\Models\PortalRH\Sucursal;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage; 

class Editarmob extends Component
{
    use WithFileUploads;

    public $activo; // Datos del activo a editar
    public $empresas, $sucursalesFiltradas;
    public $tipos = [], $anios = [];
    public $subirfoto1, $subirfoto2, $subirfoto3, $subirfoto4;
    public $foto1, $foto2, $foto3, $foto4;
    public $empresaSeleccionada;

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
        'activo.empresa_id' => 'required',
        'activo.sucursal_id' => 'required',
    ];

    protected $messages = [
        'activo.nombre.required' => 'El nombre es requerido',
        'activo.descripcion.required' => 'La descripción es requerida',
        'activo.num_serie.required' => 'El número de serie es requerido',
        'activo.num_activo.required' => 'El número de activo es requerido',
        'activo.ubicacion_fisica.required' => 'La ubicación física es requerida',
        'activo.fecha_adquisicion.required' => 'La fecha de adquisición es requerida',
        'activo.tipo_activo_id.required' => 'El tipo de activo es requerido',
        'activo.precio_adquisicion.required' => 'El precio de adquisición es requerido',
        'activo.aniosestimado_id.required' => 'El año estimado es requerido',
        'activo.empresa_id.required' => 'La empresa es requerida',
        'activo.sucursal_id.required' => 'La sucursal es requerida',
    ];

    public function mount($id)
    {
        // Cargar el activo a editar
        $this->activo = ActivoMobiliario::findOrFail($id)->toArray();
        $this->foto1 = $this->activo['foto1'];
        $this->foto2 = $this->activo['foto2'];
        $this->foto3 = $this->activo['foto3'];
        $this->foto4 = $this->activo['foto4'];

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
        $this->validate();

        $this->activo['empresa_id'] = $this->empresaSeleccionada;

        // Manejo de imágenes
        if ($this->subirfoto1) {
            // Eliminar la imagen anterior si existe
            if ($this->foto1 && Storage::disk('subirDocs')->exists($this->foto1)) {
                Storage::disk('subirDocs')->delete($this->foto1);
            }

            // Guardar la nueva imagen
            $this->subirfoto1->storeAs('ImagenMobiliario1', $this->activo['nombre'] . "-imagen1.png", 'subirDocs');
            $this->activo['foto1'] = "ImagenMobiliario1/" . $this->activo['nombre'] . "-imagen1.png";
        }

        if ($this->subirfoto2) {
            // Eliminar la imagen anterior si existe
            if ($this->foto2 && Storage::disk('subirDocs')->exists($this->foto2)) {
                Storage::disk('subirDocs')->delete($this->foto2);
            }

            // Guardar la nueva imagen
            $this->subirfoto2->storeAs('ImagenMobiliario2', $this->activo['nombre'] . "-imagen2.png", 'subirDocs');
            $this->activo['foto2'] = "ImagenMobiliario2/" . $this->activo['nombre'] . "-imagen2.png";
        }

        if ($this->subirfoto3) {
            // Eliminar la imagen anterior si existe
            if ($this->foto3 && Storage::disk('subirDocs')->exists($this->foto3)) {
                Storage::disk('subirDocs')->delete($this->foto3);
            }

            // Guardar la nueva imagen
            $this->subirfoto3->storeAs('ImagenMobiliario3', $this->activo['nombre'] . "-imagen3.png", 'subirDocs');
            $this->activo['foto3'] = "ImagenMobiliario3/" . $this->activo['nombre'] . "-imagen3.png";
        }

        if ($this->subirfoto4) {
            // Eliminar la imagen anterior si existe
            if ($this->foto4 && Storage::disk('subirDocs')->exists($this->foto4)) {
                Storage::disk('subirDocs')->delete($this->foto4);
            }

            // Guardar la nueva imagen
            $this->subirfoto4->storeAs('ImagenMobiliario4', $this->activo['nombre'] . "-imagen4.png", 'subirDocs');
            $this->activo['foto4'] = "ImagenMobiliario4/" . $this->activo['nombre'] . "-imagen4.png";
        }

        // Actualizar el activo mobiliario
        ActivoMobiliario::find($this->activo['id'])->update($this->activo);

        // Redirigir a la vista de mostrar
        return redirect()->route('mostrarmobad');
    }

    public function render()
    {
        return view('livewire.activo-fijo.activos.activo-mobiliario.admin-admin.editarmob')->layout('layouts.navactivos');
    }
}
