<?php

namespace App\Livewire\ActivoFijo\Activos\ActivoSouvenir\AdminAdmin;

use App\Models\ActivoFijo\Activos\ActivoMobiliario;
use App\Models\ActivoFijo\Activos\ActivoSouvenir;
use App\Models\ActivoFijo\Anioestimado;
use App\Models\ActivoFijo\Tipoactivo;
use App\Models\PortalRH\Empresa;
use App\Models\PortalRH\Sucursal;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class Agregarsou extends Component
{
    use WithFileUploads;
    public $consulta, $empresas, $sucursales;
    public $activo = [], $tipos = [], $anios = [];
    public $subirfoto1, $subirfoto2, $subirfoto3;
    public $empresaSeleccionada;
    public $sucursalesFiltradas = [];

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
    ];

    public function mount()
    {
        $this->empresas = Empresa::all();
        $this->consulta = ActivoSouvenir::get();
        $this->activo['tipo_activo_id'] = Tipoactivo::where('nombre_activo', 'Activo Souvenirs')->value('id');
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

    public function saveActivoSou()
    {
        $this->validate([
            'subirfoto1' => 'required|image|max:2048',
            'subirfoto2' => 'nullable|image|max:2048',
            'subirfoto3' => 'nullable|image|max:2048',
        ]);
        // Asignar la empresa seleccionada al activo
        $this->activo['empresa_id'] = $this->empresaSeleccionada;
        // Guardar imágenes si fueron subidas
        if ($this->subirfoto1) {
            $this->subirfoto1->storeAs('ImagenSouvenir1', "{$this->activo['productos']}-imagen1.png", 'subirDocs');
            $this->activo['foto1'] = "ImagenSouvenir1/{$this->activo['productos']}-imagen1.png";
        }

        if ($this->subirfoto2) {
            $this->subirfoto2->storeAs('ImagenSouvenir2', "{$this->activo['productos']}-imagen2.png", 'subirDocs');
            $this->activo['foto2'] = "ImagenSouvenir2/{$this->activo['productos']}-imagen2.png";
        }

        if ($this->subirfoto3) {
            $this->subirfoto3->storeAs('ImagenSouvenir3', "{$this->activo['productos']}-imagen3.png", 'subirDocs');
            $this->activo['foto3'] = "ImagenSouvenir3/{$this->activo['productos']}-imagen3.png";
        }
        // Crear una nueva instancia de Sale y asignar los valores
        $AgregarActivo = new ActivoSouvenir($this->activo);
        $AgregarActivo->save();

        // Limpiar los datos de la venta después de guardar
        $this->activo = [];
        $this->subirfoto1 = NULL;
        $this->subirfoto2 = NULL;
        $this->subirfoto3 = NULL;

        return redirect()->route('mostrarsouad');
    }
    public function render()
    {
        return view('livewire.activo-fijo.activos.activo-souvenir.admin-admin.agregarsou')->layout('layouts.navactivos');
    }
}
