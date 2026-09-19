<?php 

namespace App\Livewire\PortalCapacitacion\Participantes\AdminSucursal;

use Illuminate\Support\Facades\Crypt;
use Livewire\Component;
use App\Models\PortalCapacitacion\GrupocursoCapacitacion;
use App\Models\User;
use App\Models\PortalCapacitacion\Participante;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class EditarParticipantesCapacitacionSucursal extends Component
{
    public $capacitacion;
    public $participantes;
    public $estadoCapacitacion;
    public $usuarios;
    public $statusOptions = ['activo', 'inactivo', 'pendiente'];

    public function mount($id)
    {
        // Desencriptar el ID de la capacitación
        $id = Crypt::decrypt($id);
        
        // Obtener la capacitación
        $this->capacitacion = GrupocursoCapacitacion::findOrFail($id);

        // Obtener el estado general de la capacitación
        $this->estadoCapacitacion = Participante::where('grupocursos_capacitaciones_id', $this->capacitacion->id)
            ->value('status'); // Tomamos un único estado (asumiendo que todos tienen el mismo)

        // Obtener todos los participantes de la capacitación con sus usuarios relacionados
        $this->participantes = DB::table('participante_user')
            ->join('participantes', 'participante_user.participantes_id', '=', 'participantes.id')
            ->join('users', 'participante_user.users_id', '=', 'users.id')
            ->where('participantes.grupocursos_capacitaciones_id', $this->capacitacion->id)
            ->select('participantes.id as participante_id', 'users.id as user_id', 'users.name', 'users.tipo_user')
            ->get();
    }

    public function actualizarEstadoCapacitacion()
    {
        // Actualizar el estado de la capacitación en la tabla participantes
        Participante::where('grupocursos_capacitaciones_id', $this->capacitacion->id)
            ->update(['status' => $this->estadoCapacitacion]);

        // Mensaje de éxito
        Session::flash('message', 'Estado de la capacitación actualizado correctamente.');
    }

    public function eliminarParticipante($participanteId, $userId)
    {
    // 1. Eliminar la relación del usuario con el participante en la tabla pivote
    DB::table('participante_user')
        ->where('participantes_id', $participanteId)
        ->where('users_id', $userId)
        ->delete();

    // 2. Verificar si el participante aún tiene relaciones en la tabla pivote
    $tieneRelacion = DB::table('participante_user')
        ->where('participantes_id', $participanteId)
        ->exists();

    // 3. Si ya no tiene más relaciones, eliminar el participante de la tabla 'participantes'
    if (!$tieneRelacion) {
        Participante::where('id', $participanteId)->delete();
    }

    // 4. Recargar la lista de participantes para actualizar la vista
    $this->participantes = DB::table('participante_user')
        ->join('participantes', 'participante_user.participantes_id', '=', 'participantes.id')
        ->join('users', 'participante_user.users_id', '=', 'users.id')
        ->where('participantes.grupocursos_capacitaciones_id', $this->capacitacion->id)
        ->select('participantes.id as participante_id', 'users.id as user_id', 'users.name', 'users.tipo_user')
        ->get();

    // 5. Mensaje de éxito
    Session::flash('message', 'Participante eliminado correctamente.');
    }


    public function render()
    {
        return view('livewire.portal-capacitacion.participantes.admin-sucursal.editar-participantes-capacitacion-sucursal', [
            'participantes' => $this->participantes,
            'nombreCapacitacion' => $this->capacitacion->nombreCapacitacion,
            'nombreGrupo' => $this->capacitacion->nombreGrupo
        ])->layout("layouts.portal_capacitacion");
    }
}
