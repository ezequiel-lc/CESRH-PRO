<?php

namespace App\Livewire\ActivoFijo\Activos\ActivoSouvenir\AdminAdmin;

use App\Models\ActivoFijo\Activos\ActivoSouvenir;
use App\Models\ActivoFijo\Anioestimado;
use App\Models\ActivoFijo\Tipoactivo;
use App\Models\PortalRH\Empresa;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage; 


class Editarsou extends Component
{
    use WithFileUploads;
    public $activo; // Datos del activo a editar
    public $empresas, $sucursalesFiltradas;
    public $tipos = [], $anios = [];
    public $subirfoto1, $subirfoto2, $subirfoto3;
    public $foto1, $foto2, $foto3;
    public $empresaSeleccionada;

    protected $rules = [
        'activo.codigo' => 'required',
        'activo.productos' => 'required',
        'activo.descripcion' => 'required',
        'activo.color' => 'required',
        'activo.medida' => 'required',
        'activo.marca' => 'required',
        'activo.precio' => 'required',
        'activo.estado' => 'required',
        'activo.disponible' => 'required',
        'activo.fecha_adquisicion' => 'required',
        'activo.tipo_activo_id' => 'required',
        'activo.aniosestimado_id' => 'required',
        'activo.empresa_id' => 'required',
        'activo.sucursal_id' => 'required',

    ];

    protected $messages = [
        'activo.codigo.required' => 'Codigo es requerido',
        'activo.productos.required' => 'Producto es requerido',
        'activo.descripcion.required' => 'Descripcion es requerida',
        'activo.color.required' => 'Color es requerido',
        'activo.medida.required' => 'Medida es requerida',
        'activo.marca.required' => 'Marca es requerida',
        'activo.precio.required' => 'Precio es requerido',
        'activo.estado.required' => 'Estado es requerido',
        'activo.disponible.required' => 'Disponible es requerido',
        'activo.fecha_adquisicion.required' => 'Fecha es requerido',
        'activo.tipo_activo_id.required' => 'Tipo es requerido',
        'activo.aniosestimado_id.required' => 'Año es requerido',
        'activo.empresa_id.required' => 'La empresa es requerida',
        'activo.sucursal_id.required' => 'La sucursal es requerida',
    ];

    public function mount($id)
    {
        // Cargar el activo a editar
        $this->activo = ActivoSouvenir::findOrFail($id)->toArray();
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
        // Asignar la empresa seleccionada al activo
        $this->activo['empresa_id'] = $this->empresaSeleccionada;
        // Guardar imágenes si fueron subidas
        // Manejo de imágenes
        if ($this->subirfoto1) {
            // Eliminar la imagen anterior si existe
            if ($this->foto1 && Storage::disk('subirDocs')->exists($this->foto1)) {
                Storage::disk('subirDocs')->delete($this->foto1);
            }

            // Guardar la nueva imagen
            $this->subirfoto1->storeAs('ImagenSouvenir1', $this->activo['productos'] . "-imagen1.png", 'subirDocs');
            $this->activo['foto1'] = "ImagenSouvenir1/" . $this->activo['productos'] . "-imagen1.png";
        }

        if ($this->subirfoto2) {
            // Eliminar la imagen anterior si existe
            if ($this->foto2 && Storage::disk('subirDocs')->exists($this->foto2)) {
                Storage::disk('subirDocs')->delete($this->foto2);
            }

            // Guardar la nueva imagen
            $this->subirfoto2->storeAs('ImagenSouvenir2', $this->activo['productos'] . "-imagen2.png", 'subirDocs');
            $this->activo['foto2'] = "ImagenSouvenir2/" . $this->activo['productos'] . "-imagen2.png";
        }

        if ($this->subirfoto3) {
            // Eliminar la imagen anterior si existe
            if ($this->foto3 && Storage::disk('subirDocs')->exists($this->foto3)) {
                Storage::disk('subirDocs')->delete($this->foto3);
            }

            // Guardar la nueva imagen
            $this->subirfoto3->storeAs('ImagenSouvenir3', $this->activo['productos'] . "-imagen3.png", 'subirDocs');
            $this->activo['foto3'] = "ImagenSouvenir3/" . $this->activo['productos'] . "-imagen3.png";
        }
        // Crear una nueva instancia de Sale y asignar los valores
        ActivoSouvenir::find($this->activo['id'])->update($this->activo);

        // Redirigir a la vista de mostrar
        return redirect()->route('mostrarsouad');
    }
    public function render()
    {
        return view('livewire.activo-fijo.activos.activo-souvenir.admin-admin.editarsou')->layout('layouts.navactivos');
    }
}
