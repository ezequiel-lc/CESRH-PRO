<?php

namespace App\Livewire\ActivoFijo\Activos\ActivoMobiliario\AdminAdmin;

use App\Models\ActivoFijo\Activos\ActivoMobiliario;
use App\Models\ActivoFijo\Anioestimado;
use App\Models\ActivoFijo\Tipoactivo;
use App\Models\PortalRH\Empresa;
use App\Models\PortalRH\Sucursal;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class Agregarmob extends Component
{
    use WithFileUploads;

    public $consulta, $empresas, $sucursales;
    public $activo = [], $tipos = [], $anios = [];
    public $subirfoto1, $subirfoto2, $subirfoto3, $subirfoto4;
    public $empresaSeleccionada;
    public $sucursalesFiltradas = [];

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
        'activo.nombre.required' => 'El nombre es requerido',
        'activo.descripcion.required' => 'La descripción es requerida',
        'activo.num_serie.required' => 'El número de serie es requerido',
        'activo.num_activo.required' => 'El número de activo es requerido',
        'activo.ubicacion_fisica.required' => 'La ubicación física es requerida',
        'activo.fecha_adquisicion.required' => 'La fecha de adquisición es requerida',
        'activo.tipo_activo_id.required' => 'El tipo de activo es requerido',
        'activo.precio_adquisicion.required' => 'El precio de adquisición es requerido',
        'activo.aniosestimado_id.required' => 'El año estimado es requerido',
    ];

    public function mount()
    {
        $this->empresas = Empresa::all();
        $this->consulta = ActivoMobiliario::get();
        $this->activo['tipo_activo_id'] = Tipoactivo::where('nombre_activo', 'Activo Mobiliarios')->value('id');
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

    public function saveActivoMob()
    {
        $this->validate([
            'subirfoto1' => 'required|image|max:2048',
            'subirfoto2' => 'nullable|image|max:2048',
            'subirfoto3' => 'nullable|image|max:2048',
            'subirfoto4' => 'nullable|image|max:2048',
        ]);

        // Asignar la empresa seleccionada al activo
        $this->activo['empresa_id'] = $this->empresaSeleccionada;
        // Guardar imágenes si fueron subidas
        if ($this->subirfoto1) {
            $this->subirfoto1->storeAs('ImagenMobiliario1', "{$this->activo['nombre']}-imagen1.png", 'subirDocs');
            $this->activo['foto1'] = "ImagenMobiliario1/{$this->activo['nombre']}-imagen1.png";
        }

        if ($this->subirfoto2) {
            $this->subirfoto2->storeAs('ImagenMobiliario2', "{$this->activo['nombre']}-imagen2.png", 'subirDocs');
            $this->activo['foto2'] = "ImagenMobiliario2/{$this->activo['nombre']}-imagen2.png";
        }

        if ($this->subirfoto3) {
            $this->subirfoto3->storeAs('ImagenMobiliario3', "{$this->activo['nombre']}-imagen3.png", 'subirDocs');
            $this->activo['foto3'] = "ImagenMobiliario3/{$this->activo['nombre']}-imagen3.png";
        }

        if ($this->subirfoto4) {
            $this->subirfoto4->storeAs('ImagenMobiliario4', "{$this->activo['nombre']}-imagen4.png", 'subirDocs');
            $this->activo['foto4'] = "ImagenMobiliario4/{$this->activo['nombre']}-imagen4.png";
        }

        // Guardar el activo mobiliario
        $AgregarActivo = new ActivoMobiliario($this->activo);
        $AgregarActivo->save();

        // Limpiar los datos después de guardar
        $this->reset(['activo', 'subirfoto1', 'subirfoto2', 'subirfoto3', 'subirfoto4']);

        return redirect()->route('mostrarmobad');
    }

    public function render()
    {
        return view('livewire.activo-fijo.activos.activo-mobiliario.admin-admin.agregarmob')->layout('layouts.navactivos');
    }
}
