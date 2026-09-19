<?php

namespace App\Livewire\ActivoFijo\Activos\ActivoUniforme\AdminAdmin;

use App\Models\ActivoFijo\Activos\ActivoUniforme;
use App\Models\ActivoFijo\Tipoactivo;
use App\Models\PortalRH\Empresa;
use App\Models\PortalRH\Sucursal;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;


class Editaruni extends Component
{
    use WithFileUploads;
    public $activo; // Datos del activo a editar
    public $empresas, $sucursalesFiltradas;
    public $tipos = [], $anios = [];
    public $subirfoto1, $subirfoto2, $subirfoto3;
    public $foto1, $foto2, $foto3;
    public $empresaSeleccionada;


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
        'activo.empresa_id' => 'required',
        'activo.sucursal_id' => 'required',
        'activo.empresa_id.required' => 'La empresa es requerida',
        'activo.sucursal_id.required' => 'La sucursal es requerida',

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
        'activo.empresa_id.required' => 'La empresa es requerida',
        'activo.sucursal_id.required' => 'La sucursal es requerida',
    ];

    public function mount($id)
    {
        $this->activo = ActivoUniforme::findOrFail($id)->toArray();
        $this->foto1 = $this->activo['foto1'];
        $this->foto2 = $this->activo['foto2'];
        $this->foto3 = $this->activo['foto3'];

        $this->empresas = Empresa::all();
        $this->empresaSeleccionada = $this->activo['empresa_id'];

        // Usar la misma lógica para sucursales que en Agregartec
        $this->updatedEmpresaSeleccionada($this->empresaSeleccionada);

        $this->tipos = Tipoactivo::pluck('nombre_activo', 'id')->toArray();
    }

    public function updatedEmpresaSeleccionada($empresaId)
    {
        $this->sucursalesFiltradas = Sucursal::join('empresa_sucursal', 'sucursales.id', '=', 'empresa_sucursal.sucursal_id')
            ->where('empresa_sucursal.empresa_id', $empresaId)
            ->get();
        $this->activo['sucursal_id'] = $this->activo['sucursal_id'] ?? ''; // Mantener sucursal si ya está seleccionada
        $this->dispatch('sucursales-actualizadas');
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
            if ($this->foto1 && Storage::disk('subirDocs')->exists($this->foto1)) {
                Storage::disk('subirDocs')->delete($this->foto1);
            }
            $this->subirfoto1->storeAs('ImagenUniforme1', $this->activo['descripcion'] . "-imagen1.png", 'subirDocs');
            $this->activo['foto1'] = "ImagenUniforme1/" . $this->activo['descripcion'] . "-imagen1.png";
        }

        if ($this->subirfoto2) {
            if ($this->foto2 && Storage::disk('subirDocs')->exists($this->foto2)) {
                Storage::disk('subirDocs')->delete($this->foto2);
            }
            $this->subirfoto2->storeAs('ImagenUniforme2', $this->activo['descripcion'] . "-imagen2.png", 'subirDocs');
            $this->activo['foto2'] = "ImagenUniforme2/" . $this->activo['descripcion'] . "-imagen2.png";
        }

        if ($this->subirfoto3) {
            if ($this->foto3 && Storage::disk('subirDocs')->exists($this->foto3)) {
                Storage::disk('subirDocs')->delete($this->foto3);
            }
            $this->subirfoto3->storeAs('ImagenUniforme3', $this->activo['descripcion'] . "-imagen3.png", 'subirDocs');
            $this->activo['foto3'] = "ImagenUniforme3/" . $this->activo['descripcion'] . "-imagen3.png";
        }

        ActivoUniforme::find($this->activo['id'])->update($this->activo);
        return redirect()->route('mostraruniad');
    }
    public function render()
    {
        return view('livewire.activo-fijo.activos.activo-uniforme.admin-admin.editaruni')->layout('layouts.navactivos');
    }
}
