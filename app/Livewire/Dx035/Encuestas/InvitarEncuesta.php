<?php

namespace App\Livewire\Dx035\Encuestas;

use Livewire\Component;
use App\Models\Dx035\Encuesta;
use Illuminate\Support\Facades\Mail;
use App\Mail\InvitacionEncuesta;

class InvitarEncuesta extends Component
{
    public $clave;
    public $encuesta;
    public $emails;
    public $mensaje;

    public function mount($clave)
    {
        $this->clave = $clave;
        $this->encuesta = Encuesta::where('Clave', $clave)->firstOrFail();
    }

    public function enviarInvitacion()
    {
        $this->validate([
            'emails' => 'required|string',
            'mensaje' => 'nullable|string',
        ]);

        $emails = array_map('trim', explode(',', $this->emails));

        // Mensaje predeterminado
        $mensajePredeterminado = "¡Hola! Has sido invitado a participar en una encuesta. Por favor, haz clic en el siguiente enlace para acceder a la encuesta: " . route('survey.show', ['key' => $this->encuesta->Clave]);

        // Combinar el mensaje predeterminado con el mensaje adicional (si existe)
        $mensajeCompleto = $mensajePredeterminado;
        if (!empty($this->mensaje)) {
            $mensajeCompleto .= "\n\n" . $this->mensaje;
        }

        foreach ($emails as $email) {
            Mail::to($email)->send(new InvitacionEncuesta($mensajeCompleto, $this->encuesta));
        }

        session()->flash('message', 'Invitaciones enviadas correctamente.');
        return redirect()->route('encuesta.index');
    }

    public function render()
    {
        return view('livewire.dx035.encuestas.invitar-encuesta')
            ->layout('layouts.dx035');
    }
}