<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Dx035\Encuestas\AgregarEncuesta;
use App\Livewire\Dx035\Encuestas\MostrarEncuestas;
use App\Livewire\Dx035\Encuestas\EncuestaController;
use App\Livewire\Dx035\Encuestas\EditarEncuesta;
use App\Livewire\Dx035\Encuestas\CorreosMasivos;

use App\Livewire\Dx035\Cuestionarios\AgregarPreguntaBase;
use App\Livewire\Dx035\Cuestionarios\MostrarPreguntaBase;
use App\Livewire\Dx035\Cuestionarios\EditarPreguntaBase;

use App\Livewire\Dx035\CuestionarioUno\ResponderCuestionario;

use App\Livewire\Dx035\CuestionarioParaResponder\ResponderCuestionarioUno;

use App\Livewire\Dx035\Encuestas\InvitarEncuesta;

use App\Http\Controllers\ReporteController;

use App\Livewire\Dx035\Rol\MostrarRol;
use App\Livewire\Dx035\Rol\AgregarRol;
use App\Livewire\Dx035\Rol\EditarRol;
use App\Livewire\Dx035\Rol\AsignarRol;

use App\Livewire\Dx035\Usuario\MostrarRolUsuario;
use App\Livewire\Dx035\Usuario\AsignarRolUsuario;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Aquí puedes registrar las rutas web para tu aplicación. Estas rutas
| serán cargadas por el RouteServiceProvider dentro del grupo "web".
|
*/

// Página principal

Route::get('/', function () {
    return redirect()->route('encuesta.index'); // Redirige a MostrarEncuestas
});


Route::get('/encuestas/agregar', AgregarEncuesta::class)->name('encuesta.create');
Route::get('/encuestas', MostrarEncuestas::class)->name('encuesta.index');

// Ruta para editar una encuesta
Route::get('/encuestas/{Clave}/edit', EditarEncuesta::class)->name('encuestas.edit');
// Ruta para eliminar una encuesta


Route::get('/home<', function () {
    return view('home');
})->name('home');

Route::get('/preguntas/agregar', AgregarPreguntaBase::class)->name('preguntas.agregar');
Route::get('/preguntas', MostrarPreguntaBase::class)->name('preguntas.mostrar');
Route::get('/preguntas/{id}/editar', EditarPreguntaBase::class)->name('preguntas.editar');

Route::get('/correos-masivos', CorreosMasivos::class)->name('correos.masivos');

Route::post('/send-invitation', [SurveyInvitationController::class, 'sendInvitation'])->name('send.invitation');

Route::post('/guardar-correo', [UserEmailController::class, 'store'])->name('guardar.correo');

// Ruta para responder el cuestionario
Route::get('/dx035/responder-cuestionario', ResponderCuestionario::class)->name('responder-cuestionario');

Route::get('/survey/show/{key}', function ($key) {
    // Buscar la encuesta por su clave
    $encuesta = \App\Models\Dx035\Encuesta::where('Clave', $key)->firstOrFail();

    // Mostrar una vista simple con la información de la encuesta
    return view('survey.show', compact('encuesta'));
})->name('survey.show');

Route::get('/survey/{key}', ResponderCuestionarioUno::class)->name('survey.show');

Route::get('/encuesta/invitar/{clave}', InvitarEncuesta::class)->name('encuesta.invitar');

Route::get('/dx035/survey/thankyou', function () {
    return view('livewire.dx035.surveyuno.thankyouuno');
})->name('survey.thankyou');

Route::get('/reporte/{encuestaId}', [ReporteController::class, 'generarReporte'])->name('reporte.generar');

// Rutas para la gestión de roles
Route::get('/roles', MostrarRol::class)->name('mostrarrol'); // Mostrar tabla de roles
Route::get('/roles/agregar', AgregarRol::class)->name('agregarrol'); // Agregar un nuevo rol
Route::get('/roles/editar/{id}', EditarRol::class)->name('editarrol'); // Editar un rol existente

// Ruta para mostrar la tabla de usuarios
Route::get('/usuarios', MostrarRolUsuario::class)->name('usuarios');

// Ruta para asignar roles a un usuario
Route::get('/usuarios/{id}/asignar-rol', AsignarRolUsuario::class)->name('asignarroluser');

Route::get('/survey/{key}', [SurveyController::class, 'show'])->name('survey.show');
