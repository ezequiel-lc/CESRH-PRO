<?php 

namespace App\Livewire\PortalCapacitacion\Participantes\AdminGeneral;

use Illuminate\Support\Facades\Crypt;
use Livewire\Component;
use App\Models\PortalCapacitacion\GrupocursoCapacitacion;
use App\Models\User;
use App\Models\PortalCapacitacion\Participante; // Importa el modelo de Participantes
use Illuminate\Support\Facades\Session;

class AgregarParticipantesCapacitacion extends Component
{
    public $capacitacion;
    public $usuarios;
    public $usuariosSeleccionados = [];
    public $nombreCapacitacion;
    public $nombreGrupo;

    public function mount($id)
    {
        // Desencriptar el id recibido
        $id = Crypt::decrypt($id);

        // Obtener la capacitación
        $this->capacitacion = GrupocursoCapacitacion::findOrFail($id);

        // Obtener los usuarios con el mismo empresa_id y sucursal_id
        $this->usuarios = User::where('empresa_id', $this->capacitacion->empresa_id)
            ->where('sucursal_id', $this->capacitacion->sucursal_id)
            ->get();
    }

    public function toggleSeleccion($userId)
    {
        if (in_array($userId, $this->usuariosSeleccionados)) {
            $this->usuariosSeleccionados = array_diff($this->usuariosSeleccionados, [$userId]);
        } else {
            $this->usuariosSeleccionados[] = $userId;
        }
    }

    public function guardarParticipantes()
    {
        foreach ($this->usuariosSeleccionados as $usuarioId) {
            // Crear o actualizar el participante
            $participante = Participante::updateOrCreate([
                'grupocursos_capacitaciones_id' => $this->capacitacion->id,
            ], [
                'status' => 'activo'
            ]);

            // Insertar en la tabla pivote participante_user
            \DB::table('participante_user')->insert([
                'participantes_id' => $participante->id,
                'grupocursos_capacitaciones_id' => $this->capacitacion->id,
                'users_id' => $usuarioId
            ]);
        }

        // Limpiar selección después de guardar
        $this->usuariosSeleccionados = [];
        
        // Mensaje de éxito
        Session::flash('message', 'Participantes asignados correctamente.');
    }


    public function render()
    {
        return view('livewire.portal-capacitacion.participantes.admin-general.agregar-participantes-capacitacion', [
            'usuarios' => $this->usuarios,
            'nombreCapacitacion' => $this->capacitacion->nombreCapacitacion,
            'nombreGrupo' => $this->capacitacion->nombreGrupo
        ])->layout("layouts.portal_capacitacion");
    }

}
