<?php

namespace App\Livewire\Dx035\Encuestas;

use Livewire\Component;
use Livewire\WithFileUploads;

use App\Models\Dx035\Encuesta;
use App\Models\Dx035\Cuestionario;

use App\Models\PortalRH\Empresa;
use App\Models\PortalRH\Sucursal;
use App\Models\PortalRH\SucursalDepartamento;
use App\Models\PortalRH\EmpresSucursal;
use App\Models\PortalRH\Departamento;

use Illuminate\Support\Str;

class AgregarEncuesta extends Component
{
    use WithFileUploads;

    // Propiedades para empresa, sucursal y departamento
    public $empresa; // Declarar la propiedad empresa
    public $sucursal; // Declarar la propiedad sucursal
    public $departamento; // Declarar la propiedad departamento

    public $sucursales = [];
    public $empresas = [];
    public $departamentos = [];

    public $cuestionariosSeleccionados = []; // Array para almacenar los IDs de los cuestionarios seleccionados

    public $cuestionarios;
    public $muestra = 0;
    public $selectoruno;
    public $selectordos;
    public $totaltrabajadoresmuestra;

    public $mensajemostrar;

    public $Actividades, $sucursalDepartamentoId;
    public $FechaInicio, $FechaFinal, $numtrabajadores;
    public $logo;

    // Reglas de validación
    protected $rules = [
        'empresa' => 'required|exists:empresas,id',
        'sucursal' => 'required|exists:sucursales,id',
        'departamento' => 'required|exists:departamentos,id',
        'Actividades' => 'required|string',
        'FechaInicio' => 'required|date',
        'FechaFinal' => 'required|date|after_or_equal:FechaInicio',
        'numtrabajadores' => 'required|integer|min:1',
        'cuestionariosSeleccionados' => 'required|array|min:1', // Validar que al menos un cuestionario esté seleccionado
        'logo' => 'nullable|image|max:1024',
    ];

    public function mount()
    {
        // Inicializar el array de cuestionarios seleccionados
        $this->cuestionarios = Cuestionario::get();
        foreach ($this->cuestionarios as $cuestionario) {
            $this->cuestionariosSeleccionados[$cuestionario->id] = false; // Inicializar como no seleccionado
        }
        $this->empresas = Empresa::get();
    }

    public function submit()
    {
        $this->validate();
    
        // Obtener la relación sucursal-departamento
        $sucursalDepartamento = SucursalDepartamento::where('sucursal_id', $this->sucursal)
            ->where('departamento_id', $this->departamento)
            ->first();
    
        if (!$sucursalDepartamento) {
            session()->flash('error', 'No se encontró la relación sucursal-departamento.');
            return;
        }
    
        // Generar la clave automáticamente
        $clave = Str::uuid()->toString();
    
        // Guardar el logo si se proporciona
        $rutaLogo = null;
        if ($this->logo) {
            $rutaLogo = $this->logo->store('logos', 'public');
        }
    
        // Crear la encuesta
        $encuesta = Encuesta::create([
            'Clave' => $clave,
            'Empresa' => Empresa::find($this->empresa)->nombre,
            'Actividades' => $this->Actividades,
            'sucursal_departament_id' => $sucursalDepartamento->id,
            'FechaInicio' => $this->FechaInicio,
            'FechaFinal' => $this->FechaFinal,
            'NumeroEncuestas' => $this->numtrabajadores,
            'RutaLogo' => $rutaLogo,
            'Estado' => 1,
        ]);
    
        // Obtener los IDs de los cuestionarios seleccionados
        $cuestionariosSeleccionadosIds = [];
        foreach ($this->cuestionariosSeleccionados as $cuestionarioId => $seleccionado) {
            if ($seleccionado) {
                $cuestionariosSeleccionadosIds[] = $cuestionarioId;
            }
        }
    
        // Guardar los cuestionarios seleccionados en la tabla pivote
        $encuesta->cuestionarios()->attach($cuestionariosSeleccionadosIds);
    
        session()->flash('message', 'Encuesta creada correctamente.');
        return redirect()->route('encuesta.index');
    }

    public function updatedEmpresa()
    {
        $this->sucursales = Empresa::with('sucursales')->where('id', $this->empresa)->get();
    }

    public function updatedSucursal()
    {
        $this->departamentos = Sucursal::with('departamentos')->where('id', $this->sucursal)->get();
    }

    public function updatedNumtrabajadores()
    {
        if ($this->numtrabajadores >= 100) {
            $this->muestra = 1;
            $RestaTotal = $this->numtrabajadores - 1;

            $PrimeraParte = 0.9604 * $this->numtrabajadores;
            $SegundaParte = 0.0025 * $RestaTotal;
            $TerceraParte = $SegundaParte + 0.9604;
            $UltimaParte = $PrimeraParte / $TerceraParte;
            $this->totaltrabajadoresmuestra = $UltimaParte;
        } else {
            $this->muestra = 0;
        }

        if ($this->numtrabajadores <= 50) {
            $this->mensajemostrar = 1;
        } else {
            $this->mensajemostrar = 2;
        }
    }

    public function updatedSelectoruno()
    {
        
    }

    public function updatedSelectordos()
    {
        $this->numtrabajadores = round($this->totaltrabajadoresmuestra);
    }

    public function render()
    {
        return view('livewire.dx035.encuestas.agregar-encuesta')
            ->layout('layouts.dx035');
    }
}