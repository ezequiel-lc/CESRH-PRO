<?php

namespace App\Livewire\Dx035\Encuestas;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Dx035\Encuesta;
use App\Models\Dx035\Cuestionario;
use App\Models\PortalRH\SucursalDepartament;
use Illuminate\Support\Facades\Storage;

class EditarEncuesta extends Component
{
    use WithFileUploads;

    public $encuesta;
    public $Empresa, $Actividades, $sucursalDepartamentId;
    public $FechaInicio, $FechaFinal, $NumeroEncuestas;
    public $cuestionariosSeleccionados = [];
    public $logo;
    public $nuevoLogo;

    protected $rules = [
        'Empresa' => 'required|string',
        'Actividades' => 'required|string',
        'sucursalDepartamentId' => 'required|exists:sucursal_departament,id',
        'FechaInicio' => 'required|date',
        'FechaFinal' => 'required|date|after_or_equal:FechaInicio',
        'NumeroEncuestas' => 'required|integer|min:1',
        'cuestionariosSeleccionados' => 'required|array|min:1',
        'nuevoLogo' => 'nullable|image|max:1024',
    ];

    public function mount($Clave)
    {
        // Obtener la encuesta por su clave
        $this->encuesta = Encuesta::findOrFail($Clave);

        // Inicializar los valores del formulario
        $this->Empresa = $this->encuesta->Empresa;
        $this->Actividades = $this->encuesta->Actividades;
        $this->sucursalDepartamentId = $this->encuesta->sucursal_departament_id;
        $this->FechaInicio = $this->encuesta->FechaInicio;
        $this->FechaFinal = $this->encuesta->FechaFinal;
        $this->NumeroEncuestas = $this->encuesta->NumeroEncuestas;
        $this->logo = $this->encuesta->RutaLogo;

        // Inicializar los cuestionarios seleccionados
        $cuestionarios = Cuestionario::all();
        $cuestionariosSeleccionados = $this->encuesta->cuestionarios->pluck('id')->toArray();
        foreach ($cuestionarios as $cuestionario) {
            $this->cuestionariosSeleccionados[$cuestionario->id] = in_array($cuestionario->id, $cuestionariosSeleccionados);
        }
    }

    public function submit()
    {
        $this->validate();
    
        // Actualizar el logo si se proporciona uno nuevo
        if ($this->nuevoLogo) {
            // Eliminar el logo anterior si existe
            if ($this->logo) {
                Storage::disk('public')->delete($this->logo);
            }
            $this->logo = $this->nuevoLogo->store('logos', 'public');
        }
    
        // Obtener los IDs de los cuestionarios seleccionados
        $cuestionariosSeleccionadosIds = [];
        foreach ($this->cuestionariosSeleccionados as $cuestionarioId => $seleccionado) {
            if ($seleccionado) {
                $cuestionariosSeleccionadosIds[] = $cuestionarioId;
            }
        }
    
        // Actualizar la encuesta
        $this->encuesta->update([
            'Empresa' => $this->Empresa,
            'Actividades' => $this->Actividades,
            'sucursal_departament_id' => $this->sucursalDepartamentId,
            'FechaInicio' => $this->FechaInicio,
            'FechaFinal' => $this->FechaFinal,
            'NumeroEncuestas' => $this->NumeroEncuestas,
            'RutaLogo' => $this->logo,
        ]);
    
        // Sincronizar los cuestionarios seleccionados en la tabla pivote
        $this->encuesta->cuestionarios()->sync($cuestionariosSeleccionadosIds);
    
        session()->flash('message', 'Encuesta actualizada correctamente.');
        return redirect()->route('encuesta.index');
    }

    public function render()
    {
        // Obtener todas las relaciones sucursal-departamento
        $sucursalDepartamentos = SucursalDepartament::all();

        // Obtener las sucursales y departamentos relacionados manualmente
        foreach ($sucursalDepartamentos as $sucursalDepartamento) {
            $sucursal = \App\Models\PortalRH\Sucursal::find($sucursalDepartamento->sucursal_id);
            $departamento = \App\Models\PortalRH\Departament::find($sucursalDepartamento->departamento_id);

            if ($sucursal && $departamento) {
                $sucursalDepartamento->sucursal_nombre = $sucursal->nombre_sucursal;
                $sucursalDepartamento->departamento_nombre = $departamento->nombre_departamento;
            } else {
                $sucursalDepartamento->sucursal_nombre = 'Desconocido';
                $sucursalDepartamento->departamento_nombre = 'Desconocido';
            }
        }

        $cuestionarios = Cuestionario::all();

        return view('livewire.dx035.encuestas.editar-encuesta', compact('sucursalDepartamentos', 'cuestionarios'))
            ->layout('layouts.dx035');
    }
}
