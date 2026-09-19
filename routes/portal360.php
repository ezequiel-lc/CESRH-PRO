<?php


use App\Livewire\Portal360\Asignaciones\AsignacionesAdministrador\AgregarAsignacionesAdministrador;
use App\Livewire\Portal360\Asignaciones\AsignacionesAdministrador\EditarAsignacionesAdministrador;
use App\Livewire\Portal360\Asignaciones\AsignacionesAdministrador\MostrarAsignacionesAdministrador;
use App\Livewire\Portal360\Asignaciones\AsignacionesEmpresa\AgregarAsignacionesEmpresa;
use App\Livewire\Portal360\Asignaciones\AsignacionesEmpresa\EditarAsignacionesEmpresa;
use App\Livewire\Portal360\Asignaciones\AsignacionesEmpresa\MostrarAsignacionesEmpresa;
use App\Livewire\Portal360\Asignaciones\AsignacionesSucursal\AgregarAsignacionSucursal;
use App\Livewire\Portal360\Asignaciones\AsignacionesSucursal\EditarAsignacionSucursal;
use App\Livewire\Portal360\Asignaciones\AsignacionesSucursal\MostrarAsignacionSucursal;
use App\Livewire\Portal360\Bienvenido;
use App\Livewire\Portal360\Compromiso\CompromisoAdministrador\AgregarCompromisoAdministrador;
use App\Livewire\Portal360\Compromiso\CompromisoAdministrador\EditarCompromisoAdministrador;
use App\Livewire\Portal360\Compromiso\CompromisoAdministrador\MostrarCompromisoAdministrador;
use App\Livewire\Portal360\Compromiso\CompromisoTrabajador\AgregarCompromisoTrabajador;
use App\Livewire\Portal360\Compromiso\CompromisoTrabajador\MostrarCompromisoTrabajador;
use App\Livewire\Portal360\Empresa\EmpresaAdministrador\MostrarEmpresaAdministrador;
use App\Livewire\Portal360\Empresa\EmpresaEmpresa\MostrarEmpresaEmpresa;
use App\Livewire\Portal360\Empresa\EmpresaSucursal\MostrarEmpresaSucursal;
use App\Livewire\Portal360\Encpre\EncuestaPreguntaEncpreAdministrador\AgregarEncuestaPreguntaEncpreAdministrador;
use App\Livewire\Portal360\Encpre\EncuestaPreguntaEncpreAdministrador\EditarEncuestaPreguntaEncpreAdministrador;
use App\Livewire\Portal360\Encpre\EncuestaPreguntaEncpreAdministrador\MostrarEncuestaPreguntaEncpreAdministrador;
use App\Livewire\Portal360\Encpre\EncuestaPreguntaEncpreEmpresa\AgregarEncuestaPreguntaEncpreEmpresa;
use App\Livewire\Portal360\Encpre\EncuestaPreguntaEncpreEmpresa\EditarEncuestaPreguntaEncpreEmpresa;
use App\Livewire\Portal360\Encpre\EncuestaPreguntaEncpreEmpresa\MostrarEncuestaPreguntaEncpreEmpresa;
use App\Livewire\Portal360\Encpre\EncuestaPreguntaEncpreSucursal\AgregarEncuestaPreguntaEncpreSucursal;
use App\Livewire\Portal360\Encpre\EncuestaPreguntaEncpreSucursal\EditarEncuestaPreguntaEncpreSucursal;
use App\Livewire\Portal360\Encpre\EncuestaPreguntaEncpreSucursal\MostrarEncuestaPreguntaEncpreSucursal;
use App\Livewire\Portal360\Encuesta\EncuestaAdministrador\AgregarEncuestaAdministrador;
use App\Livewire\Portal360\Encuesta\EncuestaAdministrador\EditarEncuestaAdministrador;
use App\Livewire\Portal360\Encuesta\EncuestaAdministrador\MostrarEncuestaAdministrador;
use App\Livewire\Portal360\Encuesta\EncuestaEmpresa\AgregarEncuestaEmpresa;
use App\Livewire\Portal360\Encuesta\EncuestaEmpresa\EditarEncuestaEmpresa;
use App\Livewire\Portal360\Encuesta\EncuestaEmpresa\MostrarEncuestaEmpresa;
use App\Livewire\Portal360\Encuesta\EncuestaSucursal\AgregarEncuestaSucursal;
use App\Livewire\Portal360\Encuesta\EncuestaSucursal\EditarEncuestaSucursal;
use App\Livewire\Portal360\Encuesta\EncuestaSucursal\MostrarEncuestaSucursal;
use App\Livewire\Portal360\Envaluaciones\EnvalaucionesTrabajador\AsignacionesPendientes;
use App\Livewire\Portal360\Envaluaciones\EnvalaucionesTrabajador\EncuestaEnvaluacionPregunta;
use App\Livewire\Portal360\Envaluaciones\EnvaluacionAdministrador\MostrarResultadosAdministrador;
use App\Livewire\Portal360\Envaluaciones\EnvaluacionAdministrador\VerResultadosGeneralesAdminis;
use App\Livewire\Portal360\Envaluaciones\ResultadosTrabajador\ResultadosTrabajadorMostrar;
use App\Livewire\Portal360\Envaluaciones\VerResultadosPorUsuarioAdmin\VerResultadosPorUsuario;
use App\Livewire\Portal360\Inicio;
use App\Livewire\Portal360\NavigationMenu;
use App\Livewire\Portal360\Preguntas\PreguntasAdministrador\AgregarPreguntasAdministrador;
use App\Livewire\Portal360\Preguntas\PreguntasAdministrador\EditarPreguntasAdministrador;
use App\Livewire\Portal360\Preguntas\PreguntasAdministrador\EliminarPreguntasAdministrador;
use App\Livewire\Portal360\Preguntas\PreguntasAdministrador\MostrarPreguntasAdministrador;
use App\Livewire\Portal360\Preguntas\PreguntasEmpresa\AgregarPreguntasEmpresa;
use App\Livewire\Portal360\Preguntas\PreguntasEmpresa\EditarPreguntasEmpresa;
use App\Livewire\Portal360\Preguntas\PreguntasEmpresa\EliminarPreguntasEmpresa;
use App\Livewire\Portal360\Preguntas\PreguntasEmpresa\MostrarPreguntasEmpresa;
use App\Livewire\Portal360\Preguntas\PreguntasSucursal\AgregarPreguntaSucursal;
use App\Livewire\Portal360\Preguntas\PreguntasSucursal\EditarPreguntaSucursal;
use App\Livewire\Portal360\Preguntas\PreguntasSucursal\EliminarPreguntaSucursal;
use App\Livewire\Portal360\Preguntas\PreguntasSucursal\MostrarPreguntaSucursal;
use App\Livewire\Portal360\Relaciones\RelacionesAdministrador\AgregarRelacionAdministrador;
use App\Livewire\Portal360\Relaciones\RelacionesAdministrador\EditarRelacionAdministrador;
use App\Livewire\Portal360\Relaciones\RelacionesAdministrador\EliminarRelacionAdministrador;
use App\Livewire\Portal360\Relaciones\RelacionesAdministrador\MostrarRelacionAdministrador;
use App\Livewire\Portal360\Relaciones\RelacionesEmpresa\MostrarRelacionesEmpresa;
use App\Livewire\Portal360\Relaciones\RelacionesEmpresa\AgregarRelacionesEmpresa;
use App\Livewire\Portal360\Relaciones\RelacionesEmpresa\EditarRelacionesEmpresa;
use App\Livewire\Portal360\Relaciones\RelacionesEmpresa\EliminarRelacionesEmpresa;
use App\Livewire\Portal360\Relaciones\RelacionesSucursal\AgregarRelacionesSucursales;
use App\Livewire\Portal360\Relaciones\RelacionesSucursal\EditarRelacionesSucursales;
use App\Livewire\Portal360\Relaciones\RelacionesSucursal\EliminarRelacionesSucursales;
use App\Livewire\Portal360\Relaciones\RelacionesSucursal\MostrarRelacionesSucursales;
use App\Livewire\Portal360\Resultados\AdministradorResultados\MostrarEmpresaAdministradorResultadosvs;
use App\Livewire\Portal360\Resultados\AdministradorResultados\MostrarSucursalesAdministradorResultadosvs;
use App\Livewire\Portal360\Resultados\EmpresaResultados\MostrarEmpresaResultado;
use App\Livewire\Portal360\Resultados\EmpresaResultados\MostrarResultadosEmpresasv;
use Illuminate\Support\Facades\Route;


Route::get('/inicio', Inicio::class)->name('portal360.inicio');
Route::get('/navigation-menu',  NavigationMenu::class)->name('portal360.navigation-menu');


//Relaciones Laborales para Administrador  // Route::get('/mostrar-relaciones', MostrarRelaciones::class)->middleware('can:Relaciones Laborales Mostrar')->name('portal360.mostrarUser');
Route::get('/mostrar-relacion-administrador', MostrarRelacionAdministrador::class)->middleware('can:Mostrar Relaciones Laborales ADMIN')->name('portal360.relaciones.relaciones-administrador.mostrar-relacion-administrador');
Route::get('/agregar-relacion-administrador', AgregarRelacionAdministrador::class)->middleware('can:Agregar Relaciones Laborales ADMIN')->name('agregarRealacionAdministrador');
Route::get('/editar-relacion-administrador/{id}', EditarRelacionAdministrador::class)->middleware('can:Editar Relaciones Laborales ADMIN')->name('editarRelacionesAdministrador');
Route::get('/eliminar-relacion-administrador', EliminarRelacionAdministrador::class)->middleware('can:Eliminar Relaciones Laborales ADMIN')->name('eliminarRelacionesAdministrador');

//Relaciones Laborales para Empresas 
Route::get('/mostrar-relaciones-empresa', MostrarRelacionesEmpresa::class)->middleware('can:Mostrar Relaciones Laborales ADMIN EMPRESA')->name('portal360.relaciones.relaciones-empresa.mostrar-relaciones-empresa');
Route::get('/agregar-relaciones-empresa', AgregarRelacionesEmpresa::class)->middleware('can:Agregar Relaciones Laborales ADMIN EMPRESA')->name('agregarRealacionEmpresa');
Route::get('/editar-relaciones-empresa/{id}', EditarRelacionesEmpresa::class)->middleware('can:Editar Relaciones Laborales ADMIN EMPRESA')->name('editarRelacionesEmpleados');
Route::get('/eliminar-relaciones-empresa', EliminarRelacionesEmpresa::class)->middleware('can:Eliminar Relaciones Laborales ADMIN EMPRESA')->name('eliminarRelacionesEmpresas');

//Relaciones Laborales para Sucursales 
Route::get('/mostrar-relaciones-sucursales', MostrarRelacionesSucursales::class)->middleware('can:Mostrar Relaciones Laborales ADMIN SUCURSAL')->name('portal360.relaciones.relaciones-sucursal.mostrar-relaciones-sucursales');
Route::get('/agregar-relaciones-sucursales', AgregarRelacionesSucursales::class)->middleware('can:Agregar Relaciones Laborales ADMIN SUCURSAL')->name('agregarRealacionSucursales');
Route::get('/editar-relaciones-sucursales/{id}', EditarRelacionesSucursales::class)->middleware('can:Editar Relaciones Laborales ADMIN SUCURSAL')->name('editarRelacionesSucursales');
Route::get('/eliminar-relaciones-sucursales', EliminarRelacionesSucursales::class)->middleware('can:Eliminar Relaciones Laborales ADMIN SUCURSAL')->name('eliminarRelacionesSucursales');


//Mostrar Empresas Administrador 
Route::get('/mostrar-empresa-administrador', MostrarEmpresaAdministrador::class)->middleware('can:Mostrar Empresa ADMIN')->name('portal360.empresa.empresa-administrador.mostrar-empresa-administrador');

//Mostrar Empresa Empresa 
Route::get('/mostrar-empresa-empresa', MostrarEmpresaEmpresa::class)->middleware('can:Mostrar Empresa ADMIN EMPRESA')->name('portal360.empresa.empresa-empresa.mostrar-empresa-empresa');

//Mostrar Empresa Sucursal 
Route::get('/mostrar-empresa-sucursal', MostrarEmpresaSucursal::class)->middleware('can:Mostrar Empresa  ADMIN SUCURSAL')->name('portal360.empresa.empresa-sucursal.mostrar-empresa-sucursal');


//Mostrar Preguntas Administrador 
Route::get('/mostrar-preguntas-administrador', MostrarPreguntasAdministrador::class)->middleware('can:Mostrar Preguntas ADMIN')->name('portal360.preguntas.preguntas-administrador.mostrar-preguntas-administrador');
Route::get('/agregar-preguntas-administrador', AgregarPreguntasAdministrador::class)->middleware('can:Agregar Preguntas ADMIN')->name('agregarPreguntaAdministrador');
Route::get('/editar-preguntas-administrador/{id}', EditarPreguntasAdministrador::class)->middleware('can:Editar Preguntas ADMIN')->name('editarPreguntaAdmin');
Route::get('/eliminar-preguntas-administrador', EliminarPreguntasAdministrador::class)->middleware('can:Eliminar Preguntas ADMIN')->name('eliminarPregunta');

//Mostrar Preguntas Empresa 
Route::get('/mostrar-preguntas-empresa', MostrarPreguntasEmpresa::class)->middleware('can:Mostrar Preguntas ADMIN EMPRESA')->name('portal360.preguntas.preguntas-empresa.mostrar-preguntas-empresa');
Route::get('/agregar-preguntas-empresa', AgregarPreguntasEmpresa::class)->middleware('can:Agregar Preguntas ADMIN EMPRESA')->name('agregarPreguntaEmpresa');
Route::get('/editar-preguntas-empresa/{id}', EditarPreguntasEmpresa::class)->middleware('can:Editar Preguntas ADMIN EMPRESA')->name('editarPreguntaEmpre');
Route::get('/eliminar-preguntas-empresa', EliminarPreguntasEmpresa::class)->middleware('can:Eliminar Preguntas ADMIN EMPRESA')->name('eliminarPreguntaEmpresa');


//Mostrar Preguntas Sucursal  
Route::get('/mostrar-pregunta-sucursal', MostrarPreguntaSucursal::class)->middleware('can:Mostrar Preguntas ADMIN SUCURSAL')->name('portal360.preguntas.preguntas-sucursal.mostrar-pregunta-sucursal');
Route::get('/agregar-pregunta-sucursal', AgregarPreguntaSucursal::class)->name('agregarPreguntaSucursal');
// Route::get('/agregar-pregunta-sucursal', AgregarPreguntaSucursal::class)->middleware('can:Agregar Preguntas ADMIN SUCURSAL')->name('agregarPreguntaSucursal');
Route::get('/editar-pregunta-sucursal/{id}', EditarPreguntaSucursal::class)->name('editarSucursaldx');
Route::get('/eliminar-pregunta-sucursal', EliminarPreguntaSucursal::class)->middleware('can:Eliminar Preguntas ADMIN SUCURSAL')->name('eliminarPreguntaSucursal');





//Mostrar Encuesta Administrador 
Route::get('/mostrar-encuesta-administrador', MostrarEncuestaAdministrador::class)->middleware('can:Mostrar Encuesta ADMIN')->name('portal360.encuesta.encuesta-administrador.mostrar-encuesta-administrador');
Route::get('/agregar-encuesta-administrador', AgregarEncuestaAdministrador::class)->middleware('can:Agregar Encuesta ADMIN')->name('agregarEncuestaAdministrador');
Route::get('/editar-encuesta-administrador/{id}', EditarEncuestaAdministrador::class)->middleware('can:Editar Encuesta ADMIN')->name('editarEncuestaAdministradordevpro');
Route::get('/eliminar-encuesta-administrador', [MostrarEncuestaAdministrador::class, 'deleteEncuesta'])->middleware('can:Eliminar Encuesta ADMIN')->name('eliminarEncuesta');


//Mostrar Encuesta Empresa 
Route::get('/mostrar-encuesta-empresa', MostrarEncuestaEmpresa::class)->middleware('can:Mostrar Encuesta ADMIN EMPRESA')->name('portal360.encuesta.encuesta-empresa.mostrar-encuesta-empresa');
Route::get('/agregar-encuesta-empresa', AgregarEncuestaEmpresa::class)->middleware('can:Agregar Encuesta ADMIN EMPRESA')->name('agregarEncuestaEmpresa');
Route::get('/editar-encuesta-empresa/{id}', EditarEncuestaEmpresa::class)->middleware('can:Editar Encuesta ADMIN EMPRESA')->name('editarEncuestadevEmpresa');
Route::get('/eliminar-encuesta-empresa', [MostrarEncuestaEmpresa::class, 'deleteEncuestaEmpresa'])->middleware('can:Eliminar Encuesta ADMIN EMPRESA')->name('eliminarEncuestaEmpresa');


//Mostrar Encuesta Sucursal 
Route::get('/mostrar-encuesta-sucursal', MostrarEncuestaSucursal::class)->middleware('can:Mostrar Encuesta ADMIN SUCURSAL')->name('portal360.encuesta.encuesta-sucursal.mostrar-encuesta-sucursal');
Route::get('/agregar-encuesta-sucursal', AgregarEncuestaSucursal::class)->name('agregarEncuestaSucursal');
Route::get('/editar-encuesta-sucursal/{id}',  EditarEncuestaSucursal::class)->name('editarEncuestaSucursalpro');
Route::get('/eliminar-encuesta-sucursal', [MostrarEncuestaSucursal::class, 'deleteEncuestaSucursal'])->middleware('can:Eliminar Encuesta ADMIN SUCURSAL')->name('eliminarEncuestaSucursal');

// Route::get('/eliminar-pregunta', [EncuestaDev::class, 'deleteEncuesta'])->middleware('can:Eliminar Encuesta')->name('eliminarEncuesta');

//Mostrar Asignaciones Administrador 
Route::get('/mostrar-asignaciones-administrador', MostrarAsignacionesAdministrador::class)->middleware('can:Mostrar Asignaciones ADMIN')->name('portal360.asignaciones.asignaciones-administrador.mostrar-asignaciones-administrador');
Route::get('/agregar-asignaciones-administrador', AgregarAsignacionesAdministrador::class)->middleware('can:Agregar Asignaciones ADMIN')->name('agregarAsignacionAdministrador');
Route::get('/editar-asignaciones-administrador/{id}', EditarAsignacionesAdministrador::class)->middleware('can:Editar Asignaciones ADMIN')->name('editarAsignacionadministradordev');
Route::get('/eliminar-asignacion-administrador', [MostrarAsignacionesAdministrador::class, 'deleteAsignacionAdministrador'])->middleware('can:Eliminar Asignaciones ADMIN')->name('eliminarAsignacionAdministrador');


//Mostrar Asignaciones empresa 
Route::get('/mostrar-asignaciones-empresa', MostrarAsignacionesEmpresa::class)->middleware('can:Mostrar Asignaciones ADMIN EMPRESA')->name('portal360.asignaciones.asignaciones-empresa.mostrar-asignaciones-empresa');
Route::get('/agregar-asignaciones-empresa', AgregarAsignacionesEmpresa::class)->middleware('can:Agregar Asignaciones ADMIN EMPRESA')->name('agregarAsignacionEmpresa');
Route::get('/editar-asignaciones-empresa/{id}', EditarAsignacionesEmpresa::class)->middleware('can:Editar Asignaciones ADMIN EMPRESA')->name('editarAsignacionEmpresa');
Route::get('/eliminar-asignaciones-empresa', [MostrarAsignacionesEmpresa::class, 'deleteAsignacionEmpresa'])->middleware('can:Eliminar Asignaciones ADMIN EMPRESA')->name('eliminarAsignacionEmpresa');


//Mostrar Asignaciones Sucursal 
Route::get('/mostrar-asignacion-sucursal', MostrarAsignacionSucursal::class)->middleware('can:Mostrar Asignaciones ADMIN SUCURSAL')->name('portal360.asignaciones.asignaciones-sucursal.mostrar-asignacion-sucursal');
Route::get('/agregar-asignacion-sucursal', AgregarAsignacionSucursal::class)->middleware('can:Agregar Asignaciones ADMIN SUCURSA')->name('agregarAsignacionSucursal');
Route::get('/editar-asignacion-sucursal/{id}', EditarAsignacionSucursal::class)->middleware('can:Editar Asignaciones ADMIN SUCURSAL')->name('editarAsignacionesSocursal');
Route::get('/eliminar-asignacion-sucursal', [MostrarAsignacionSucursal::class, 'deleteAsignacionSucursal'])->middleware('can:Eliminar Asignaciones ADMIN SUCURSAL')->name('eliminarAsignacionSucursal');



//Mostrar Encpre Administrador 
Route::get('/mostrar-encuesta-pregunta-encpre-administrador', MostrarEncuestaPreguntaEncpreAdministrador::class)->middleware('can:Mostrar Encpre ADMIN')->name('portal360.encpre.encuesta-pregunta-encpre-administrador.mostrar-encuesta-pregunta-encpre-administrador');
Route::get('/agregar-encuesta-pregunta-encpre-administrador', AgregarEncuestaPreguntaEncpreAdministrador::class)->middleware('can:Agregar Encpre ADMIN')->name('agregarEncpreAdministrador');
Route::get('/editar-encuesta-pregunta-encpre-administrador/{id}', EditarEncuestaPreguntaEncpreAdministrador::class)->middleware('can:Editar Encpre ADMIN')->name('editarEncuestaAdministrador');
Route::get('/eliminar-encuesta-pregunta-encpre-administrador', [MostrarEncuestaPreguntaEncpreAdministrador::class, 'deleteEncpreAdministrador'])->middleware('can:Eliminar Encpre ADMIN')->name('eliminarEncpreAdministrador');


//Mostrar Encpre Empresa 
Route::get('/mostrar-encuesta-pregunta-encpre-empresa', MostrarEncuestaPreguntaEncpreEmpresa::class)->middleware('can:Mostrar Encpre ADMIN EMPRESA')->name('portal360.encpre.encuesta-pregunta-encpre-empresa.mostrar-encuesta-pregunta-encpre-empresa');
Route::get('/agregar-encuesta-pregunta-encpre-empresa', AgregarEncuestaPreguntaEncpreEmpresa::class)->middleware('can:Agregar Encpre ADMIN EMPRESA')->name('agregarEncpreEmpresa');
Route::get('/editar-encuesta-pregunta-encpre-empresa/{id}', EditarEncuestaPreguntaEncpreEmpresa::class)->middleware('can:Editar Encpre ADMIN EMPRESA')->name('editarEncuestaEmpresa');
Route::get('/eliminar-encuesta-pregunta-encpre-empresa', [MostrarEncuestaPreguntaEncpreEmpresa::class, 'deleteEncpreEmpresa'])->middleware('can:Eliminar Encpre ADMIN EMPRESA')->name('eliminarEncpreEmpresa');


//Mostrar Encpre Sucursal 
Route::get('/mostrar-encuesta-pregunta-encpre-sucursal', MostrarEncuestaPreguntaEncpreSucursal::class)->middleware('can:Mostrar Encpre ADMIN SUCURSAL')->name('portal360.encpre.encuesta-pregunta-encpre-sucursal.mostrar-encuesta-pregunta-encpre-sucursal');
Route::get('/agregar-encuesta-pregunta-encpre-sucursal', AgregarEncuestaPreguntaEncpreSucursal::class)->name('agregarEncpreSucursal');
Route::get('/editar-encuesta-pregunta-encpre-sucursal/{id}', EditarEncuestaPreguntaEncpreSucursal::class)->name('editarEncuestaSucursal');
Route::get('/eliminar-encuesta-pregunta-sucursal', [MostrarEncuestaPreguntaEncpreSucursal::class, 'deleteEncpreSucursal'])->middleware('can:Eliminar Encpre ADMIN SUCURSAL')->name('eliminarEncpreSucursal');

//Mostrar Trabajadores 360 
Route::get('/portal360.envaluaciones.envalauciones-trabajador.asignaciones-pendientes', AsignacionesPendientes::class)->name('portal360.envaluaciones.envalauciones-trabajador.asignaciones-pendientes');

//Mostrar Resultados de 360 
Route::get('/portal360.envaluaciones.resultados-trabajador.resultados-trabajador-mostrar',ResultadosTrabajadorMostrar::class)->name('portal360.envaluaciones.resultados-trabajador.resultados-trabajador-mostrar'); 

//Despues elimino los roles 
// Route::get('/mostrar-roles-dev', MostrarRolesDev::class)->name('portal360.mostrarRoles');
// Route::get('/agregar-roles-dev', AgregarRolesDev::class)->name('agregarRoles');
// Route::get('/eliminar-roles-dev', EliminarRolesDev::class)->name('eliminarRoles');
// Route::get('/editar-roles-dev{id}', EditarRolesDev::class)->name('editRolesdev');

//Mostrar la Bienvenida para trabajadores 360 
Route::get('/bienvenido', Bienvenido::class)->name('bienvenido');

Route::get('/encuesta-envaluacion-pregunta/{asignacionId}', EncuestaEnvaluacionPregunta::class)
    ->name('encuesta-envaluacion-pregunta')
    ->middleware('auth');





Route::get('/ver-resultados-por-usuario/{asignacionId}', VerResultadosPorUsuario::class)->name('VizualizarResultadosGeneralesUsuario');
Route::get('/mostrar-compromiso-administrador', MostrarCompromisoAdministrador::class)->name('portal360.compromiso.compromiso-administrador.mostrar-compromiso-administrador');
Route::get('/agregar-compromiso-administrador', AgregarCompromisoAdministrador::class)->name('agregarCompromisoAdministrador');
Route::get('/editar-compromiso-administrador/{id}', EditarCompromisoAdministrador::class)->name('editarCompromisoAdministrador');
Route::get('/eliminar-compromiso-administrador', [MostrarCompromisoAdministrador::class, 'deleteCompromisoAdministrador'])->name('eliminarCompromisoAdministrador');

Route::get('/mostrar-compromiso-trabajador', MostrarCompromisoTrabajador::class)->name('portal360.compromiso.compromiso-trabajador.mostrar-compromiso-trabajador');
Route::get('/agregar-compromiso-trabajador', AgregarCompromisoTrabajador::class)->name('agregarCompromisoTrabajador');

// Route::get('/mostrar-empresa-administrador', MostrarEmpresaAdministrador)
Route::get('/mostrar-empresa-administrador-resultadosvs', MostrarEmpresaAdministradorResultadosvs::class)->name('portal360.resultados.administrador-resultados.mostrar-empresa-administrador-resultadosvs');
Route::get('/mostrar-sucursales-administrador-resultadosvs/{SucursalId}', MostrarSucursalesAdministradorResultadosvs::class)->name('VizualizarResultadosGeneralesAdministrador');

Route::get('/mostrar-empresa-resultado', MostrarEmpresaResultado::class)->name('portal360.resultados.empresa-resultados.mostrar-empresa-resultado');
Route::get('/mostrar-resultados-empresasv/{SucursalId}', MostrarResultadosEmpresasv::class)->name('VizualizarResultadosGeneralesEmpresa');
