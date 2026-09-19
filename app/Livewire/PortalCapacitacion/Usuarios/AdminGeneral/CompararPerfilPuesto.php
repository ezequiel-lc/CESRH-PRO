<?php

namespace App\Livewire\PortalCapacitacion\Usuarios\AdminGeneral;

use Livewire\Component;
use App\Models\PortalCapacitacion\PerfilPuesto;
use App\Models\PortalCapacitacion\FuncionEspecifica;
use App\Models\PortalCapacitacion\RelacionInterna;
use App\Models\PortalCapacitacion\RelacionExterna;
use App\Models\PortalCapacitacion\ResponsabilidadUniversal;
use App\Models\PortalCapacitacion\FormacionHabilidadHumana;
use App\Models\PortalCapacitacion\FormacionHabilidadTecnica;
use App\Models\User;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Database\Eloquent\Builder;
use App\Models\PortalCapacitacion\ComparacionPuesto;

class CompararPerfilPuesto extends Component
{
    public $puestos; // Lista de puestos disponibles
    public $detallePuesto; // Datos del puesto seleccionado
    public $perfil;

    public $userSeleccionado;
    public $users_id;
    public $perfilPuesto;
    public $funcionesEspecificas, 
            $relacionesInternas, 
            $relacionesExternas, 
            $responsabilidadesUniversales,
            $habilidadesHumanas, 
            $habilidadesTecnicas,
            $perfilactual;
    public $habilidadesComparadas = [];
    public $mostrarTabla = false; // Inicialmente oculta la tabla

    public function mount($id)
    {
        $id = Crypt::decrypt($id);
        $this->userSeleccionado = User::with('perfilesPuestos')->find($id);
        foreach($this->userSeleccionado->perfilesPuestos as $perfiles)
        {
            
            if($perfiles->pivot->status === "1")
            {
                $this->perfilactual= $perfiles;
                break;
            }
            else
            {
                $perfilactual="No existe";
                
            }
        }

        $this->funcionesEspecificas=$this->perfilactual->funcionesEspecificas()->get();
        $this->relacionesInternas=$this->perfilactual->relacionesInternas()->get();
        $this->relacionesExternas=$this->perfilactual->relacionesExternas()->get();
        $this->responsabilidadesUniversales=$this->perfilactual->responsabilidadesUniversales()->get();
        $this->habilidadesHumanas=$this->perfilactual->habilidadesHumanas()->get();
        $this->habilidadesTecnicas=$this->perfilactual->habilidadesTecnicas()->get();
        $this->users_id = $id;

        $this->puestos = PerfilPuesto::select('id', 'nombre_puesto')->get();
        $this->detallePuesto = null; // Inicialmente vacío
    }

    public function generarConclusion()
    {
        if (!$this->perfilactual || !$this->detallePuesto) {
            return;
        }
    
        // Obtener todas las habilidades humanas y técnicas de ambos perfiles
        $habilidadesHumanasActual = $this->perfilactual->habilidadesHumanas()->get();
        $habilidadesTecnicasActual = $this->perfilactual->habilidadesTecnicas()->get();
    
        $habilidadesHumanasNuevo = $this->detallePuesto->habilidadesHumanas ?? collect();
        $habilidadesTecnicasNuevo = $this->detallePuesto->habilidadesTecnicas ?? collect();
    
        // Combinar y obtener una lista única de descripciones de habilidades
        $habilidadesUnicas = $habilidadesHumanasActual->pluck('descripcion')
            ->merge($habilidadesHumanasNuevo->pluck('descripcion'))
            ->merge($habilidadesTecnicasActual->pluck('descripcion'))
            ->merge($habilidadesTecnicasNuevo->pluck('descripcion'))
            ->unique();
    
        $this->habilidadesComparadas = [];
    
        // Comparar habilidades una por una
        foreach ($habilidadesUnicas as $habilidadDescripcion) {
            $habilidadActual = $habilidadesHumanasActual->firstWhere('descripcion', $habilidadDescripcion) 
                            ?? $habilidadesTecnicasActual->firstWhere('descripcion', $habilidadDescripcion);
            $habilidadNuevo = $habilidadesHumanasNuevo->firstWhere('descripcion', $habilidadDescripcion) 
                            ?? $habilidadesTecnicasNuevo->firstWhere('descripcion', $habilidadDescripcion);
    
            $nivelActual = $habilidadActual ? $habilidadActual->nivel : null; // Si no existe, será null
            $nivelNuevo = $habilidadNuevo ? $habilidadNuevo->nivel : null; 
    
            // Si el nivel es null, mostrar "N/A" en la tabla
            $nivelActualTexto = $nivelActual !== null ? $nivelActual : 'N/A';
            $nivelNuevoTexto = $nivelNuevo !== null ? $nivelNuevo : 'N/A';
    
            // Calcular diferencia tomando N/A como 0
            $diferencia = ($nivelActual ?? 0) - ($nivelNuevo ?? 0);
    
            $this->habilidadesComparadas[] = [
                'nombre' => $habilidadDescripcion,
                'nivel_puesto' => $nivelNuevoTexto,  // Nuevo perfil
                'nivel_usuario' => $nivelActualTexto, // Perfil actual
                'diferencia' => $diferencia
            ];
        }
    
        $this->mostrarTabla = true; // Ahora se muestra la tabla con todas las habilidades
    }

    public function guardarConclusion()
    {
        if (!$this->perfilactual || !$this->detallePuesto || empty($this->habilidadesComparadas)) {
            session()->flash('error', 'No hay datos para guardar.');
            return;
        }

        // Recorrer cada competencia evaluada y guardarla como un nuevo registro
        foreach ($this->habilidadesComparadas as $habilidad) {
            ComparacionPuesto::create([
                'fecha_comparacion' => now()->toDateString(),
                'competencias_requeridas' => $habilidad['nombre'], // Se guarda cada competencia individualmente
                'nivel_actual' => $habilidad['nivel_usuario'] !== 'N/A' ? $habilidad['nivel_usuario'] : null,
                'nivel_nuevo' => $habilidad['nivel_puesto'] !== 'N/A' ? $habilidad['nivel_puesto'] : null,
                'diferencia' => $habilidad['diferencia'],
                'puesto_nuevo' => $this->detallePuesto->id,
                'perfiles_puestos_id' => $this->perfilactual->id,
            ]);
        }

        session()->flash('success', 'Conclusión guardada exitosamente.');
    }



    public function updatedPerfil($puestoId)
    {
        $this->detallePuesto = PerfilPuesto::with([
            'funcionesEspecificas',
            'relacionesInternas',
            'relacionesExternas',
            'responsabilidadesUniversales',
            'habilidadesHumanas',
            'habilidadesTecnicas'
        ])->find($puestoId);
    }

    public function render()
    {
        return view('livewire.portal-capacitacion.usuarios.admin-general.comparar-perfil-puesto')
            ->layout("layouts.portal_capacitacion");
    }
}
