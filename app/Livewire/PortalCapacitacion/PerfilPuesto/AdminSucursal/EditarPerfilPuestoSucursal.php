<?php

namespace App\Livewire\PortalCapacitacion\PerfilPuesto\AdminSucursal;

use App\Models\PortalCapacitacion\PerfilPuesto;
use App\Models\PortalCapacitacion\FuncionEspecifica;
use App\Models\PortalCapacitacion\RelacionInterna;
use App\Models\PortalCapacitacion\RelacionExterna;
use App\Models\PortalCapacitacion\ResponsabilidadUniversal;
use App\Models\PortalCapacitacion\FormacionHabilidadHumana;
use App\Models\PortalCapacitacion\FormacionHabilidadTecnica;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class EditarPerfilPuestoSucursal extends Component
{

    public $nombre_puesto,
        $area, 
        $proceso,
        $mision,
        $puesto_reporta,
        $puestos_que_le_reportan,
        $suplencia,
        $rango_toma_desicones,
        $desiciones_directas,
        $rango_edad_desable,
        $sexo_preferente,
        $estado_civil_deseable,
        $escolaridad,
        $idioma_requerido,
        $experiencia_requerida,
        $nivel_riesgo_fisico,
        $elaboro_nombre,
        $elaboro_puesto,
        $reviso_nombre,
        $reviso_puesto,
        $autorizo_nombre,
        $autorizo_puesto,
        $status,
        $perfil_puesto_id;

    public $perfil = [];   

    // Variables para Funciones Específicas
    public $funciones = [[]];
    public $numerofuncion = 1;
    public $selectFuncion;

    //relaciones internas
    public $internas = [[]];
    public $selectInterna;
    public $numerointerna = 1;

    //relaciones externas
    public $externas = [[]];
    public $selectExterna;
    public $numeroexterna = 1;

    //Rsponsabilidades universales
    public $responsabilidades = [[]];
    public $selectResponsabilidad;
    public $numeroresponsabilidad = 1;

    //Habilidades Humanas
    public $humanas = [[]];
    public $selectHumana;
    public $numerohumana = 1;

    //Habilidades Tecnicas
    public $tecnicas = [[]];
    public $selectTecnica;
    public $numerotecnica = 1;

    public function cerrar()
    {
        return redirect()->route('mostrarPerfilPuesto');
    }

    public function mount($id){
        $id = Crypt::decrypt($id);
        $tem = PerfilPuesto::findOrFail($id);

        $this->perfil = $tem->toArray();

        $this->nombre_puesto = $tem->nombre_puesto;
        $this->area = $tem->area;
        $this->proceso = $tem->proceso;
        $this->mision = $tem->mision;
        $this->puesto_reporta = $tem->puesto_reporta;
        $this->puestos_que_le_reportan = $tem->puestos_que_le_reportan;
        $this->suplencia = $tem->suplencia;
        $this->rango_toma_desicones = $tem->rango_toma_desicones;
        $this->desiciones_directas = $tem->desiciones_directas;
        $this->rango_edad_desable = $tem->rango_edad_desable;
        $this->sexo_preferente = $tem->sexo_preferente;
        $this->estado_civil_deseable = $tem->estado_civil_deseable;
        $this->escolaridad = $tem->escolaridad;
        $this->idioma_requerido = $tem->idioma_requerido;
        $this->experiencia_requerida = $tem->experiencia_requerida;
        $this->nivel_riesgo_fisico = $tem->nivel_riesgo_fisico;
        $this->elaboro_nombre = $tem->elaboro_nombre;
        $this->elaboro_puesto = $tem->elaboro_puesto;
        $this->reviso_nombre = $tem->reviso_nombre;
        $this->reviso_puesto = $tem->reviso_puesto;
        $this->autorizo_nombre = $tem->autorizo_nombre;
        $this->autorizo_puesto = $tem->autorizo_puesto;
        $this->status = $tem->status;
        $this->perfil_puesto_id = $id;

        // Cargar funciones específicas asociadas al perfil
        $this->funciones = DB::table('funcion_esp_perfil_puesto')
            ->where('perfiles_puestos_id', $id)
            ->pluck('funciones_esp_id')
            ->map(fn($id) => ['id' => $id])
            ->toArray();
        $this->numerofuncion = count($this->funciones) ?: 1;
        $this->selectFuncion = FuncionEspecifica::all();

        // Cargar relación interna asociadas al perfil
        $this->internas = DB::table('relacion_interna_perfil_puesto')
            ->where('perfiles_puestos_id', $id)
            ->pluck('relaciones_internas_id')
            ->map(fn($id) => ['id' => $id])
            ->toArray();
        $this->numerointerna = count($this->internas)?: 1;
        $this->selectInterna = RelacionInterna::all();

        // Cargar relación externa asociadas al perfil
        $this->externas = DB::table('relacion_externa_perfil_puesto')
            ->where('perfiles_puestos_id', $id)
            ->pluck('relaciones_externas_id')
            ->map(fn($id) => ['id' => $id])
            ->toArray();
        $this->numeroexterna = count($this->externas)?: 1;
        $this->selectExterna = RelacionExterna::all();

        // Cargar responsabilidades universales asociadas al perfil
        $this->responsabilidades = DB::table('respon_univ_perfil_puesto')
            ->where('perfiles_puestos_id', $id)
            ->pluck('respons_univ_id')
            ->map(fn($id) => ['id' => $id])
            ->toArray();
        $this->numeroresponsabilidad = count($this->responsabilidades)?: 1;
        $this->selectResponsabilidad = ResponsabilidadUniversal::all();

        // Cargar habilidades humanas asociadas al perfil
        $this->humanas = DB::table('formacion_humana_perfil_puesto')
            ->where('perfiles_puestos_id', $id)
            ->pluck('formaciones_humanas_id')
            ->map(fn($id) => ['id' => $id])
            ->toArray();
        $this->numerohumana = count($this->humanas)?: 1;
        $this->selectHumana = FormacionHabilidadHumana::all();

        // Cargar habilidades técnicas asociadas al perfil
        $this->tecnicas = DB::table('formacion_tecnica_perfil_puesto')
            ->where('perfiles_puestos_id', $id)
            ->pluck('formaciones_tecnicas_id')
            ->map(fn($id) => ['id' => $id])
            ->toArray();
        $this->numerotecnica = count($this->tecnicas)?: 1;
        $this->selectTecnica = FormacionHabilidadTecnica::all();
    }    

    public function agregarFuncion()
    {
        $this->numerofuncion++;
        $this->funciones[] = [];
    }

    public function agregarInterna()
    {
        $this->numerointerna++; 
        $this->internas[] = [];
    }

    public function agregarExterna()
    {
        $this->numeroexterna++; 
        $this->externas[] = [];
    }

    public function agregarResponsabilidades(){
        $this->numeroresponsabilidad++; 
        $this->responsabilidades[] = [];
    }

    public function agregarHumanas(){
        $this->numerohumana++; 
        $this->humanas[] = [];
    }

    public function agregarTecnicas(){
        $this->numerotecnica++;
        $this->tecnicas[] = [];
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


    public function save(){
        $this->validate([
            'nombre_puesto' =>'required',
            'area' =>'required',
            'proceso' =>'required',
            'mision' =>'required',
            'puesto_reporta' =>'required',
            'puestos_que_le_reportan' =>'required',
            'suplencia' =>'required',
            'rango_toma_desicones' =>'required',
            'desiciones_directas' =>'required',
            'rango_edad_desable' =>'required',
            'sexo_preferente' =>'required',
            'estado_civil_deseable' =>'required',
            'escolaridad' =>'required',
            'idioma_requerido' =>'required',
            'experiencia_requerida' =>'required',
            'nivel_riesgo_fisico' =>'required',
            'elaboro_nombre' =>'required',
            'elaboro_puesto' =>'required',
            'reviso_nombre' =>'required',
            'reviso_puesto' =>'required',
            'autorizo_nombre' =>'required',
            'autorizo_puesto' =>'required',
            'status' =>'required',
            'funciones.*.id' => 'required',
            'internas.*.id' => 'required',
            'externas.*.id' => 'required',
            'responsabilidades.*.id' => 'required', 
            'humanas.*.id' => 'required',
            'tecnicas.*.id' => 'required',
        ]);

        $guardar = PerfilPuesto::updateOrCreate(['id' => $this->perfil_puesto_id],
        [
            'nombre_puesto' => $this->nombre_puesto,
            'area' => $this->area,
            'proceso' => $this->proceso,
            'mision' => $this->mision,
            'puesto_reporta' => $this->puesto_reporta,
            'puestos_que_le_reportan' => $this->puestos_que_le_reportan,
            'suplencia' => $this->suplencia,
            'rango_toma_desicones' => $this->rango_toma_desicones,
            'desiciones_directas' => $this->desiciones_directas,
            'rango_edad_desable' => $this->rango_edad_desable,
            'sexo_preferente' => $this->sexo_preferente,
            'estado_civil_deseable' => $this->estado_civil_deseable,
            'escolaridad' => $this->escolaridad,
            'idioma_requerido' => $this->idioma_requerido,
            'experiencia_requerida' => $this->experiencia_requerida,
            'nivel_riesgo_fisico' => $this->nivel_riesgo_fisico,
            'elaboro_nombre' => $this->elaboro_nombre,
            'elaboro_puesto' => $this->elaboro_puesto,
            'reviso_nombre' => $this->reviso_nombre,
            'reviso_puesto' => $this->reviso_puesto,
            'autorizo_nombre' => $this->autorizo_nombre,
            'autorizo_puesto' => $this->autorizo_puesto,
            'status' => $this->status,
        ]);

        // Actualizar funciones específicas
        DB::table('funcion_esp_perfil_puesto')->where('perfiles_puestos_id', $guardar->id)->delete();
        foreach ($this->funciones as $funcion) {
            if (!empty($funcion['id'])) {
                DB::table('funcion_esp_perfil_puesto')->insert([
                    'funciones_esp_id' => $funcion['id'],
                    'perfiles_puestos_id' => $guardar->id,
                ]);
            }
        }

        DB::table('relacion_interna_perfil_puesto')->where('perfiles_puestos_id', $guardar->id)->delete();
        foreach ($this->internas as $interna) {
            if (!empty($interna['id'])) {
                DB::table('relacion_interna_perfil_puesto')->insert([
                   'relaciones_internas_id' => $interna['id'],
                    'perfiles_puestos_id' => $guardar->id,
                ]);
            }
        }

        DB::table('relacion_externa_perfil_puesto')->where('perfiles_puestos_id', $guardar->id)->delete();
        foreach ($this->externas as $externa) {
            if (!empty($externa['id'])) {
                DB::table('relacion_externa_perfil_puesto')->insert([
                    'relaciones_externas_id' => $externa['id'],
                    'perfiles_puestos_id' => $guardar->id,
                ]);
            }
        }

        DB::table('respon_univ_perfil_puesto')->where('perfiles_puestos_id', $guardar->id)->delete();
        foreach ($this->responsabilidades as $responsabilidad) {
            if (!empty($responsabilidad['id'])) {
                DB::table('respon_univ_perfil_puesto')->insert([
                    'respons_univ_id' => $responsabilidad['id'],
                    'perfiles_puestos_id' => $guardar->id,
                ]);
            }
        }

        DB::table('formacion_humana_perfil_puesto')->where('perfiles_puestos_id', $guardar->id)->delete();
        foreach ($this->humanas as $humana) {
            if (!empty($humana['id'])) {
                DB::table('formacion_humana_perfil_puesto')->insert([
                    'formaciones_humanas_id' => $humana['id'],
                    'perfiles_puestos_id' => $guardar->id,
                ]);
            }
        }

        DB::table('formacion_tecnica_perfil_puesto')->where('perfiles_puestos_id', $guardar->id)->delete();
        foreach ($this->tecnicas as $tecnica) {
            if (!empty($tecnica['id'])) {
                DB::table('formacion_tecnica_perfil_puesto')->insert([
                    'formaciones_tecnicas_id' => $tecnica['id'],
                    'perfiles_puestos_id' => $guardar->id,
                ]);
            }
        }

        return redirect()->route('mostrarPerfilPuestoSucursal');
    }

    public function render()
    {
        return view('livewire.portal-capacitacion.perfil-puesto.admin-sucursal.editar-perfil-puesto-sucursal')->layout("layouts.portal_capacitacion");
    }
}
