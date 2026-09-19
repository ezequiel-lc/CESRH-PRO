<?php

namespace App\Livewire\PortalCapacitacion\EvaluarColaborador\AdminSucursal;

use Livewire\Component;
use Illuminate\Support\Facades\Crypt;
use App\Models\PortalCapacitacion\PerfilPuesto;
use App\Models\PortalCapacitacion\Evaluacion;
use App\Models\User;
use App\Models\PortalCapacitacion\FormacionHabilidadHumana;
use App\Models\PortalCapacitacion\FormacionHabilidadTecnica;
use App\Models\PortalCapacitacion\FuncionEspecifica;

class FormEvaluarSucursal extends Component
{
    public $userSeleccionado;
    public $perfilactual;
    public $funcionesEspecificas, $habilidadesHumanas, $habilidadesTecnicas;
    public $tiempoPuesto, $criterio, $comentarios, $recomendaciones;
    public $evaluaciones = []; // Ahora será un array asociativo [criterio => calificación]
    public $calificacionFinal = 0;

    public function mount($id)
    {
        $id = Crypt::decrypt($id);
        $this->userSeleccionado = User::with('perfilesPuestos')->find($id);

        foreach ($this->userSeleccionado->perfilesPuestos as $perfiles) {
            if ($perfiles->pivot->status === "1") {
                $this->perfilactual = $perfiles;
                break;
            }
        }

        if ($this->perfilactual) {
            $this->funcionesEspecificas = $this->perfilactual->funcionesEspecificas()->get();
            $this->habilidadesHumanas = $this->perfilactual->habilidadesHumanas()->get();
            $this->habilidadesTecnicas = $this->perfilactual->habilidadesTecnicas()->get();
        }
    }

    public function calcularCalificacion()
    {
        $total = array_sum($this->evaluaciones);
        $count = count($this->evaluaciones);
        $this->calificacionFinal = $count ? round($total / $count, 2) : 0;
    }

    public function guardarEvaluacion()
    {
        if (empty($this->evaluaciones)) {
            session()->flash('error', 'Debe calificar al menos un criterio.');
            return;
        }

        foreach ($this->evaluaciones as $criterioId => $calificacion) {
            // Separar el prefijo (tipo) del ID numérico
            [$tipo, $id] = explode('_', $criterioId);
        
            // Buscar el nombre real según el tipo
            $criterioNombre = match ($tipo) {
                'tec' => FormacionHabilidadTecnica::find($id)?->descripcion,
                'hum' => FormacionHabilidadHumana::find($id)?->descripcion,
                'func' => FuncionEspecifica::find($id)?->nombre,
                default => 'Desconocido'
            };
        
            // Guardar la evaluación con el nombre real del criterio
            $evaluacion = Evaluacion::create([
                'fecha_evaluacion' => now()->toDateString(),
                'criterio' => $criterioNombre, // Ahora almacena el nombre real
                'calificacion_desempeno' => $calificacion,
                'comentarios' => $this->comentarios,
                'recomendaciones' => $this->recomendaciones,
                'tiempo_puesto_actual' => $this->tiempoPuesto,
                'users_id' => $this->userSeleccionado->id,
            ]);


            if ($this->perfilactual) {
                $evaluacion->perfilesPuestos()->attach($this->perfilactual->id);
            }
        }

        $this->reset(['evaluaciones', 'comentarios', 'recomendaciones', 'tiempoPuesto']);

        session()->flash('message', 'Evaluación guardada exitosamente.');
    }


    public function render()
    {
        return view('livewire.portal-capacitacion.evaluar-colaborador.admin-sucursal.form-evaluar-sucursal')
            ->layout("layouts.portal_capacitacion");
    }
}


