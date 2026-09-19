<?php

namespace App\Livewire\PortalCapacitacion\Cursos\Cursos\AdminGeneral;

use Livewire\Component;
use App\Models\PortalCapacitacion\Curso;
use App\Models\PortalCapacitacion\Tematica;
use App\Models\PortalRH\Sucursal;
use App\Models\PortalRH\Empresa;

class AgregarCurso extends Component
{
    public $empresas = [];
    public $empresa_id;
    public $sucursales = [];
    public $sucursal_id; 
    public $tematicas = [];
    public $tematicas_id;
    public $curso = [];

    protected $rules = [
        'empresa_id' => 'required',
        'sucursal_id' => 'required',
        'curso.nombre' => 'required',
        'curso.horas' => 'required', 
        'curso.precio' => 'required', 
        'curso.tipoestatus' => 'required', 
        'tematicas_id' => 'required', 
        'curso.modalidad' => 'required',
    ];

    protected $messages = [
        'empresa_id.required' => 'Debe seleccionar una empresa.',
        'sucursal_id.required' => 'Debe seleccionar una sucursal.',
        'curso.nombre.required' => 'La función específica es obligatoria.',
        'curso.horas.required' => 'Las horas son obligatorias.',
        'curso.precio.required' => 'El precio es obligatorio.',
        'curso.tipoestatus.required' => 'El tipo de status es obligatorio.',
        'tematicas_id.required' => 'Debe seleccionar una temática.',
        'curso.modalidad.required' => 'La modalidad es obligatoria.',
    ];

    public function mount()
    {
        // Obtener todas las empresas
        $this->empresas = Empresa::all();
        // Iniciar las sucursales vacías hasta que se seleccione una empresa
        $this->sucursales = [];

        $this->tematicas = []; // Asegúrate de importar el modelo

    }

    public function updatedEmpresaId()
    {
        // Obtener las sucursales de la empresa seleccionada usando la tabla pivote
        $this->sucursales = Empresa::find($this->empresa_id)?->sucursales ?? [];
        // Resetear la sucursal seleccionada al cambiar de empresa
        $this->sucursal_id = null;
        $this->tematicas_id = null;
    }

    public function updatedSucursalId()
    {
        // Cargar temáticas basadas en la empresa y sucursal seleccionadas
        if ($this->empresa_id && $this->sucursal_id) {
            $this->tematicas = Tematica::where('empresa_id', $this->empresa_id)
                                       ->where('sucursal_id', $this->sucursal_id)
                                       ->get();
        } else {
            $this->tematicas = [];
        }
    }

    public function agregarCurso()
    {
        $this->validate();

        Curso::create([
            'empresa_id' => $this->empresa_id,
            'sucursal_id' => $this->sucursal_id,
            'nombre' => $this->curso['nombre'],
            'horas' => $this->curso['horas'],
            'precio' => $this->curso['precio'],
            'tipoestatus' => $this->curso['tipoestatus'],
            'tematicas_id' => $this->tematicas_id,
            'modalidad' => $this->curso['modalidad'],
        ]);

        // Resetear valores después de guardar
        $this->empresa_id = null;
        $this->sucursal_id = null;
        $this->curso = [];
        $this->sucursales = [];
        $this->tematicas_id = null;      

        session()->flash('message', 'Curso creado correctamente.');
    }

    public function render()
    {
        return view('livewire.portal-capacitacion.cursos.cursos.admin-general.agregar-curso')->layout("layouts.portal_capacitacion");
    }
}
