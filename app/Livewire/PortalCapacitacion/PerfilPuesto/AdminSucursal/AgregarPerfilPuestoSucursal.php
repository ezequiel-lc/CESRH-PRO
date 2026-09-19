<?php

namespace App\Livewire\PortalCapacitacion\PerfilPuesto\AdminSucursal;

use Livewire\Component;
use App\Models\PortalCapacitacion\FuncionEspecifica;
use App\Models\PortalCapacitacion\RelacionInterna;
use App\Models\PortalCapacitacion\RelacionExterna;
use App\Models\PortalCapacitacion\ResponsabilidadUniversal;
use App\Models\PortalCapacitacion\FormacionHabilidadHumana;
use App\Models\PortalCapacitacion\FormacionHabilidadTecnica;
use App\Models\PortalCapacitacion\PerfilPuesto;
use Illuminate\Support\Facades\DB;
use App\Models\PortalRH\Sucursal;
use App\Models\PortalRH\Empresa;
use Illuminate\Support\Facades\Auth;

class AgregarPerfilPuestoSucursal extends Component
{
    public $perfil = [];
    public $empresas = [];
    public $sucursales = [];
    public $empresa_id;
    public $sucursal_id;

    //funciones especificas
    public $numerofuncion = 1;
    public $funciones = [[]];
    public $selectFuncion;
    public $funcionesDisponibles;

    //relaciones internas
    public $internas = [[]];
    public $selectInterna;
    public $numerointerna = 1;
    public $internasDisponibles;

    //relaciones externas
    public $externas = [[]];
    public $selectExterna;
    public $numeroexterna = 1;
    public $externasDisponibles = [];

    //Rsponsabilidades universales
    public $responsabilidades = [[]];
    public $selectResponsabilidad;
    public $numeroresponsabilidad = 1;
    public $responsabilidadesDisponibles = [];

    //Habilidades Humanas
    public $humanas = [[]];
    public $selectHumana;
    public $numerohumana = 1;
    public $humanasDisponibles = [];

    //Habilidades Tecnicas
    public $tecnicas = [[]];
    public $selectTecnica;
    public $numerotecnica = 1;
    public $tecnicasDisponibles = [];

    protected $rules = [
       'perfil.nombre_puesto' => 'required',
        'perfil.area' => 'required', 
        'perfil.proceso' => 'required',
        'perfil.mision' => 'required',
        'perfil.puesto_reporta' => 'required',
        'perfil.puestos_que_le_reportan' => 'required',
        'perfil.suplencia' => 'required',
        'perfil.rango_toma_desicones' => 'required',
        'perfil.desiciones_directas' => 'required',
        'perfil.rango_edad_desable' => 'required',
        'perfil.sexo_preferente' => 'required',
        'perfil.estado_civil_deseable' => 'required',
        'perfil.escolaridad' => 'required',
        'perfil.idioma_requerido' => 'required',
        'perfil.experiencia_requerida' => 'required',
        //'perfil.disponibilidad' => 'required',
        'perfil.nivel_riesgo_fisico' => 'required',
        'perfil.elaboro_nombre' => 'required',
        'perfil.elaboro_puesto' => 'required',
        'perfil.reviso_nombre' => 'required',
        'perfil.reviso_puesto' => 'required',
        'perfil.autorizo_nombre' => 'required',
        'perfil.autorizo_puesto' => 'required',
        'perfil.status' => 'required',
        'funciones.*.id' => 'required',
        'numerofuncion' => 'required',
        'internas.*.id' => 'required',
        'numerointerna' => 'required',
        'externas.*.id' => 'required',
        'numeroexterna' => 'required',
        'responsabilidades.*.id' => 'required',
        'numeroresponsabilidad' => 'required',
        'humanas.*.id' => 'required',
        'numerohumana' => 'required',
        'tecnicas.*.id' => 'required',
        'numerotecnica' => 'required',
    ];

    protected $messages = [
        'perfil.nombre_puesto.required' => 'El nombre del puesto es obligatorio.',
        'perfil.area.required' => 'El área es obligatoria.',
        'perfil.proceso.required' => 'El proceso es obligatorio.',
        'perfil.mision.required' => 'La misión es obligatoria.',
        'perfil.puesto_reporta.required' => 'El puesto que reporta es obligatorio.',
        'perfil.puestos_que_le_reportan.required' => 'Los puestos que le reportan es obligatorio.',
        'perfil.suplencia.required' => 'La suplencia es obligatoria.',
        'perfil.rango_toma_desiciones.required' => 'El rango de toma de desiciones es obligatorio.',
        'perfil.desiciones_directas.required' => 'Las desiciones directas es obligatoria.',
        'perfil.rango_edad_desable.required' => 'El rango de edad deseable es obligatorio.',
        'perfil.sexo_preferente.required' => 'El sexo preferente es obligatorio.',
        'perfil.estado_civil_deseable.required' => 'El estado civil deseable es obligatorio.',
        'perfil.escolaridad.required' => 'La escolaridad es obligatoria.',
        'perfil.idioma_requerido.required' => 'El idioma requerido es obligatorio.',
        'perfil.experiencia_requerida.required' => 'La experiencia requerida es obligatoria.',
        'perfil.nivel_riesgo_fisico.required' => 'El nivel de riesgo físico es obligatorio.',
        'perfil.elaboro_nombre.required' => 'El nombre del elaborador es obligatorio.',
        'perfil.elaboro_puesto.required' => 'El puesto del elaborador es obligatorio.',
        'perfil.reviso_nombre.required' => 'El nombre del revisor es obligatorio.',
        'perfil.reviso_puesto.required' => 'El puesto del revisor es obligatorio.',
        'perfil.autorizo_nombre.required' => 'El nombre del autorizador es obligatorio.',
        'perfil.autorizo_puesto.required' => 'El puesto del autorizador es obligatorio.',
        
    ];

    public function cerrar()
    {
        return redirect()->route('mostrarPerfilPuesto');
    }

    public function mount(){
        $this -> selectFuncion = FuncionEspecifica::get();
        $this -> selectInterna = RelacionInterna::get();
        $this -> selectExterna = RelacionExterna::get();
        $this -> selectResponsabilidad = ResponsabilidadUniversal::get();
        $this -> selectHumana = FormacionHabilidadHumana::get();
        $this -> selectTecnica = FormacionHabilidadTecnica::get();

        $this->empresa_id = auth()->user()->empresa_id; 
        $this->sucursal_id = auth()->user()->sucursal_id;

        // Obtener las funciones filtradas por empresa y sucursal
        $this->selectFuncion = FuncionEspecifica::where('empresa_id', $this->empresa_id)
        ->where('sucursal_id', $this->sucursal_id)
        ->get();

        $this->selectInterna = RelacionInterna::where('empresa_id', $this->empresa_id)
        ->where('sucursal_id', $this->sucursal_id)
        ->get();

        $this->selectExterna = RelacionExterna::where('empresa_id', $this->empresa_id)
        ->where('sucursal_id', $this->sucursal_id)
        ->get();

        $this->selectResponsabilidad = ResponsabilidadUniversal::where('empresa_id', $this->empresa_id)
        ->where('sucursal_id', $this->sucursal_id)
        ->get();

        $this->selectHumana = FormacionHabilidadHumana::where('empresa_id', $this->empresa_id)
        ->where('sucursal_id', $this->sucursal_id)
        ->get();

        $this->selectTecnica = FormacionHabilidadTecnica::where('empresa_id', $this->empresa_id)
        ->where('sucursal_id', $this->sucursal_id)
        ->get();
        
    }


    public function updatedNumerofuncion(){

        if (count($this->funciones) < $this->numerofuncion) {
            // Si hay menos elementos de los necesarios, agregar los que faltan
            for ($i = count($this->funciones); $i < $this->numerofuncion; $i++) {
                $this->funciones[] = []; // Añadir un nuevo array vacío por cada nuevo familiar
            }
        } elseif (count($this->funciones) > $this->numerofuncion) {
            // Si hay más funciones de los necesarios, eliminar los sobrantes
            $this->funciones = array_slice($this->funciones, 0, $this->numerofuncion);
        }
    }

    public function updatedNumerointerna(){
        if (count($this->internas) < $this->numerointerna) {
            // Si hay menos elementos de los necesarios, agregar los que faltan
            for ($i = count($this->internas); $i < $this->numerointerna; $i++) {
                $this->internas[] = []; // Añadir un nuevo array vacío por cada nuevo familiar
            }
        } elseif (count($this->internas) > $this->numerointerna) {
            // Si hay más funciones de los necesarios, eliminar los sobrantes
            $this->internas = array_slice($this->internas, 0, $this->numerointerna);
        }
    }

    public function updatedNumeroexterna(){
        if (count($this->externas) < $this->numeroexterna) {
            // Si hay menos elementos de los necesarios, agregar los que faltan
            for ($i = count($this->externas); $i < $this->numeroexterna; $i++) {
                $this->externas[] = []; // Añadir un nuevo array vacío por cada nuevo familiar
            }
        } elseif (count($this->externas) > $this->numeroexterna) {
            // Si hay más funciones de los necesarios, eliminar los sobrantes
            $this->externas = array_slice($this->externas, 0, $this->numeroexterna);
        }
    }

    public function updatedNumeroresponsabilidad(){
        if (count($this->responsabilidades) < $this->numeroresponsabilidad) {
            // Si hay menos elementos de los necesarios, agregar los que faltan
            for ($i = count($this->responsabilidades); $i < $this->numeroresponsabilidad; $i++) {
                $this->responsabilidades[] = []; // Añadir un nuevo array vacío por cada nuevo familiar
            }
        } elseif (count($this->responsabilidades) > $this->numeroresponsabilidad) {
            // Si hay más funciones de los necesarios, eliminar los sobrantes
            $this->responsabilidades = array_slice($this->responsabilidades, 0, $this->numeroresponsabilidad);
        }
    }

    public function updatedNumerohumana(){
        if (count($this->humanas) < $this->numerohumana) {
            // Si hay menos elementos de los necesarios, agregar los que faltan
            for ($i = count($this->humanas); $i < $this->numerohumana; $i++) {
                $this->humanas[] = []; // Añadir un nuevo array vacío por cada nuevo familiar
            }
        } elseif (count($this->humanas) > $this->numerohumana){
            // Si hay más funciones de los necesarios, eliminar los sobrantes
            $this->humanas = array_slice($this->humanas, 0, $this->numerohumana);
        } 
    }

    public function updatedNumerotecnica(){
        if(count($this->tecnicas) < $this->numerotecnica){
            for ($i = count($this->tecnicas); $i < $this->numerotecnica; $i++){
                $this->tecnicas[] = []; // Añadir un nuevo array vacío por cada nuevo familiar
            } 
        }elseif (count($this->tecnicas) > $this->numerotecnica){
            // Si hay más funciones de los necesarios, eliminar los sobrantes
            $this->tecnicas = array_slice($this->tecnicas, 0, $this->numerotecnica);
        }
    }

    public function agregarFuncion()
    {
        $this->numerofuncion++; // Aumentar el número de familiares
        $this->funciones[] = []; // Agregar un familiar vacío al array
    }

    public function agregarInterna()
    {
        $this->numerointerna++; // Aumentar el número de familiares
        $this->internas[] = []; // Agregar un familiar vacío al array
    }

    public function agregarExterna()
    {
        $this->numeroexterna++; // Aumentar el número de familiares
        $this->externas[] = []; // Agregar un familiar vacío al array
    }

    public function agregarResponsabilidades(){
        $this->numeroresponsabilidad++; // Aumentar el número de familiares
        $this->responsabilidades[] = []; // Agregar un familiar vacío al array
    }

    public function agregarHumanas(){
        $this->numerohumana++; // Aumentar el número de familiares
        $this->humanas[] = []; // Agregar un familiar vacío al array
    }

    public function agregarTecnicas(){
        $this->numerotecnica++;
        $this->tecnicas[] = []; // Agregar un familiar vacío al array
    }

    public function eliminarFunciones($index)
    {
        unset($this->funciones[$index]);
        $this->funciones = array_values($this->funciones);
        $this->numerofuncion--;
    }

    public function eliminarInternas($index)
    {
        unset($this->internas[$index]);
        $this->internas = array_values($this->internas);
        $this->numerointerna--;
    }

    public function eliminarExternas($index)
    {
        unset($this->externas[$index]);
        $this->externas = array_values($this->externas);
        $this->numeroexterna--;
    }

    public function eliminarResponsabilidades($index)
    {
        unset($this->responsabilidades[$index]);
        $this->responsabilidades = array_values($this->responsabilidades);
        $this->numeroresponsabilidad--;
    }

    public function eliminarHumanas($index){
        unset($this->humanas[$index]);
        $this->humanas = array_values($this->humanas);
        $this->numerohumana--;
    }

    public function eliminarTecnicas($index){
        unset($this->tecnicas[$index]);
        $this->tecnicas = array_values($this->tecnicas);
        $this->numerotecnica--;
    }

    public function savePerfil()
{
    $this->validate();

    // Guardar el perfil principal
    $guardar = new PerfilPuesto($this->perfil);
    $guardar->empresa_id = $this->empresa_id;
    $guardar->sucursal_id = $this->sucursal_id;
    $guardar->save();

    // Guardar las funciones específicas asociadas al perfil
    foreach ($this->funciones as $funcion) {
        if (!empty($funcion['id']) && $funcion['id']) {
            DB::table('funcion_esp_perfil_puesto')->insert([
                'funciones_esp_id' => $funcion['id'],
                'perfiles_puestos_id' => $guardar->id,
            ]);
        }
    }

    // Guardar relaciones internas asociadas al perfil
    foreach ($this->internas as $interna) {
        if (!empty($interna['id']) && $interna['id']) {
            DB::table('relacion_interna_perfil_puesto')->insert([
                'relaciones_internas_id' => $interna['id'],
                'perfiles_puestos_id' => $guardar->id,
            ]);
        }
    }

    // Guardar relaciones externas asociadas al perfil
    foreach ($this->externas as $externa) {
        if (!empty($externa['id']) && $externa['id']) {
            DB::table('relacion_externa_perfil_puesto')->insert([
                'relaciones_externas_id' => $externa['id'],
                'perfiles_puestos_id' => $guardar->id,
            ]);
        }
    }

    // Guardar responsabilidades universales asociadas al perfil
    foreach ($this->responsabilidades as $responsabilidad) {
        if (!empty($responsabilidad['id']) && $responsabilidad['id']) {
            DB::table('respon_univ_perfil_puesto')->insert([
                'respons_univ_id' => $responsabilidad['id'],
                'perfiles_puestos_id' => $guardar->id,
            ]);
        }
    }

    // Guardar habilidades humanas asociadas al perfil
    foreach ($this->humanas as $humana) {
        if (!empty($humana['id']) && $humana['id']) {
            DB::table('formacion_humana_perfil_puesto')->insert([
                'formaciones_humanas_id' => $humana['id'],
                'perfiles_puestos_id' => $guardar->id,
            ]);
        }
    }

    // Guardar habilidades técnicas asociadas al perfil
    foreach ($this->tecnicas as $tecnica) {
        if (!empty($tecnica['id']) && $tecnica['id']) {
            DB::table('formacion_tecnica_perfil_puesto')->insert([
                'formaciones_tecnicas_id' => $tecnica['id'],
                'perfiles_puestos_id' => $guardar->id,
            ]);
        }
    }

    $this->banner('Paquete guardado correctamente');
    $this->pack = [];
    // Reiniciar los valores del formulario después de guardar
    $this->reset(['perfil', 'funciones', 'internas', 'externas', 'responsabilidades', 'humanas', 'tecnicas']);
    session()->flash('message', 'Perfil de Puesto creado con exito');
}


    public function render()
    {
        return view('livewire.portal-capacitacion.perfil-puesto.admin-sucursal.agregar-perfil-puesto-sucursal')->layout("layouts.portal_capacitacion");
    }
}
