<?php

namespace App\Livewire\Portal360\Compromiso\CompromisoAdministrador;

use App\Models\Encuestas360\Asignacion;
use App\Models\Encuestas360\Compromiso;
use App\Models\Encuestas360\Pregunta;
use App\Models\Encuestas360\RespuestaUsuario;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Support\Facades\Log;

class EditarCompromisoAdministrador extends Component
{

    public $compromisoId;
    public $alta;
    public $vencimiento;
    public $compromiso;
    public $verificado = false;
    public $users_id;
    public $preguntas_id;

    public $users;
    public $preguntas;

    public function mount($id)
    {
        $this->compromisoId = $id;
        $compromiso = Compromiso::findOrFail($this->compromisoId);

        $this->alta = Carbon::parse($compromiso->alta)->format('Y-m-d');
        $this->vencimiento = Carbon::parse($compromiso->vencimiento)->format('Y-m-d');
        $this->compromiso = $compromiso->compromiso;
        $this->verificado = $compromiso->verificado;
        $this->users_id = $compromiso->users_id;
        $this->preguntas_id = $compromiso->preguntas_id;

        // Cargar usuarios (calificadores y calificados) que hayan participado en asignaciones completadas
        $asignacionesCompletadas = Asignacion::where('realizada', true)->get();
        $userIds = $asignacionesCompletadas->pluck('calificador_id')->merge($asignacionesCompletadas->pluck('calificado_id'))->unique();
        $this->users = User::whereIn('id', $userIds)->get();

        // Cargar preguntas contestadas por el usuario seleccionado
        $this->preguntas = $this->loadPreguntasByUserId($this->users_id);
    }

    public function updatedUsersId($userId)
    {
        $this->preguntas_id = null;
        if ($userId) {
            $this->preguntas = $this->loadPreguntasByUserId($userId);
        } else {
            $this->preguntas = collect();
        }
    }

    protected function loadPreguntasByUserId($userId)
    {
        $preguntasContestadasIds = RespuestaUsuario::whereHas('asignacion', function ($query) use ($userId) {
            $query->where('calificado_id', $userId);
        })
            ->with('respuesta360.pregunta')
            ->distinct()
            ->get()
            ->pluck('respuesta360.pregunta.id')
            ->unique();

        return Pregunta::whereIn('id', $preguntasContestadasIds)->get() ?? collect();
    }

    protected $rules = [
        'alta' => 'required|date',
        'vencimiento' => 'required|date|after_or_equal:alta',
        'compromiso' => 'required|string|max:255',
        'verificado' => 'boolean',
        'users_id' => 'required|exists:users,id',
        'preguntas_id' => 'nullable|exists:preguntas,id',
    ];

    protected $messages = [
        'alta.required' => 'La fecha de alta es obligatoria.',
        'vencimiento.required' => 'La fecha de vencimiento es obligatoria.',
        'vencimiento.after_or_equal' => 'El vencimiento debe ser igual o posterior a la fecha de alta.',
        'compromiso.required' => 'El compromiso es obligatorio.',
        'users_id.required' => 'Debes seleccionar un usuario.',
        'users_id.exists' => 'El usuario seleccionado no es válido.',
        'preguntas_id.exists' => 'La pregunta seleccionada no es válida.',
    ];

    public function save()
    {
        $this->validate();

        try {
            $compromiso = Compromiso::findOrFail($this->compromisoId);
            $compromiso->update([
                'alta' => $this->alta,
                'vencimiento' => $this->vencimiento,
                'compromiso' => $this->compromiso,
                'verificado' => $this->verificado,
                'users_id' => $this->users_id,
                'preguntas_id' => $this->preguntas_id,
            ]);

            $this->dispatch('toastr-success', message: 'Compromiso actualizado exitosamente.');
            return redirect()->route('portal360.compromiso.compromiso-administrador.mostrar-compromiso-administrador');
        } catch (\Exception $e) {
            Log::error('Error al actualizar compromiso: ' . $e->getMessage());
            session()->flash('error', 'Hubo un error al actualizar el compromiso. Por favor, intenta de nuevo.');
        }
    }
    public function render()
    {
        return view('livewire.portal360.compromiso.compromiso-administrador.editar-compromiso-administrador')->layout('layouts.portal360');
    }
}
