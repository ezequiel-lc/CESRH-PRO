<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SurveyInvitation;
use App\Models\User; // importar el modelo de usuario

class SurveyInvitationController extends Controller
{
    public function sendInvitation(Request $request)
    {
        $user = User::find($request->user_id); // Obtén el usuario al que se le enviará la invitación
        $surveyLink = route('survey.show', ['key' => $this->generateKey()]); // Genera el enlace de la encuesta

        // Envía el correo
        Mail::to($user->email)->send(new SurveyInvitation($surveyLink));

        return redirect()->back()->with('success', 'Invitación enviada correctamente.');
    }

    private function generateKey()
    {
        return substr(md5(uniqid(rand(), true)), 0, 10); // Genera una clave única
    }
}
