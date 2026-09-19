<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\PortalCapacitacion\Inicio;
use App\Livewire\PortalCapacitacion\PerfilPuesto\AdminGeneral\MostrarPerfilPuesto;
use App\Livewire\PortalCapacitacion\PerfilPuesto\AdminGeneral\AgregarPerfilPuesto;
use App\Livewire\PortalCapacitacion\PerfilPuesto\AdminGeneral\EditarPerfilPuesto;
use App\Livewire\PortalCapacitacion\PerfilPuesto\AdminGeneral\VerMasPerfilPuesto;
use App\Livewire\PortalCapacitacion\PerfilPuesto\AdminEmpresa\MostrarPerfilPuestoEmpresa;
use App\Livewire\PortalCapacitacion\PerfilPuesto\AdminEmpresa\AgregarPerfilPuestoEmpresa;
use App\Livewire\PortalCapacitacion\PerfilPuesto\AdminEmpresa\EditarPerfilPuestoEmpresa;
use App\Livewire\PortalCapacitacion\PerfilPuesto\AdminEmpresa\VerMasPerfilPuestoEmpresa;
use App\Livewire\PortalCapacitacion\PerfilPuesto\AdminSucursal\MostrarPerfilPuestoSucursal;
use App\Livewire\PortalCapacitacion\PerfilPuesto\AdminSucursal\AgregarPerfilPuestoSucursal;
use App\Livewire\PortalCapacitacion\PerfilPuesto\AdminSucursal\EditarPerfilPuestoSucursal;
use App\Livewire\PortalCapacitacion\PerfilPuesto\AdminSucursal\VerMasPerfilPuestoSucursal;
use App\Livewire\PortalCapacitacion\FuncionesEspecificas\AdminGeneral\MostrarFunEspecificas;
use App\Livewire\PortalCapacitacion\FuncionesEspecificas\AdminGeneral\AgregarFunEspecificas;
use App\Livewire\PortalCapacitacion\FuncionesEspecificas\AdminGeneral\EditarFunEspecificas;
use App\Livewire\PortalCapacitacion\FuncionesEspecificas\AdminSucursal\MostrarFunEspecificasSucursal;
use App\Livewire\PortalCapacitacion\FuncionesEspecificas\AdminSucursal\AgregarFunEspecificasSucursal;
use App\Livewire\PortalCapacitacion\FuncionesEspecificas\AdminSucursal\EditarFunEspecificasSucursal;
use App\Livewire\PortalCapacitacion\FuncionesEspecificas\AdminEmpresa\MostrarFunEspecificasEmpresa;
use App\Livewire\PortalCapacitacion\FuncionesEspecificas\AdminEmpresa\AgregarFunEspecificasEmpresa;
use App\Livewire\PortalCapacitacion\FuncionesEspecificas\AdminEmpresa\EditarFunEspecificasEmpresa;
use App\Livewire\PortalCapacitacion\RelacionesInternas\AdminGeneral\MostrarRelacionesInternas;
use App\Livewire\PortalCapacitacion\RelacionesInternas\AdminGeneral\AgregarRelacionesInternas;
use App\Livewire\PortalCapacitacion\RelacionesInternas\AdminGeneral\EditarRelacionesInternas;
use App\Livewire\PortalCapacitacion\RelacionesInternas\AdminEmpresa\MostrarRelacionesInternasEmpresa;
use App\Livewire\PortalCapacitacion\RelacionesInternas\AdminEmpresa\AgregarRelacionesInternasEmpresa;
use App\Livewire\PortalCapacitacion\RelacionesInternas\AdminEmpresa\EditarRelacionesInternasEmpresa;
use App\Livewire\PortalCapacitacion\RelacionesInternas\AdminSucursal\MostrarRelacionesInternasSucursal;
use App\Livewire\PortalCapacitacion\RelacionesInternas\AdminSucursal\AgregarRelacionesInternasSucursal;
use App\Livewire\PortalCapacitacion\RelacionesInternas\AdminSucursal\EditarRelacionesInternasSucursal;
use App\Livewire\PortalCapacitacion\RelacionesExternas\AdminGeneral\MostrarRelacionesExternas;
use App\Livewire\PortalCapacitacion\RelacionesExternas\AdminGeneral\AgregarRelacionesExternas;
use App\Livewire\PortalCapacitacion\RelacionesExternas\AdminGeneral\EditarRelacionesExternas;
use App\Livewire\PortalCapacitacion\RelacionesExternas\AdminEmpresa\MostrarRelacionesExternasEmpresa;
use App\Livewire\PortalCapacitacion\RelacionesExternas\AdminEmpresa\AgregarRelacionesExternasEmpresa;
use App\Livewire\PortalCapacitacion\RelacionesExternas\AdminEmpresa\EditarRelacionesExternasEmpresa;
use App\Livewire\PortalCapacitacion\RelacionesExternas\AdminSucursal\MostrarRelacionesExternasSucursal;
use App\Livewire\PortalCapacitacion\RelacionesExternas\AdminSucursal\AgregarRelacionesExternasSucursal;
use App\Livewire\PortalCapacitacion\RelacionesExternas\AdminSucursal\EditarRelacionesExternasSucursal;
use App\Livewire\PortalCapacitacion\ResponsabilidadesUniversales\AdminGeneral\MostrarResponsabilidadesUniversales;
use App\Livewire\PortalCapacitacion\ResponsabilidadesUniversales\AdminGeneral\AgregarResponsabilidadesUniversales;
use App\Livewire\PortalCapacitacion\ResponsabilidadesUniversales\AdminGeneral\EditarResponsabilidadesUniversales;
use App\Livewire\PortalCapacitacion\ResponsabilidadesUniversales\AdminEmpresa\MostrarResponsabilidadesUniversalesEmpresa;
use App\Livewire\PortalCapacitacion\ResponsabilidadesUniversales\AdminEmpresa\AgregarResponsabilidadesUniversalesEmpresa;
use App\Livewire\PortalCapacitacion\ResponsabilidadesUniversales\AdminEmpresa\EditarResponsabilidadesUniversalesEmpresa;
use App\Livewire\PortalCapacitacion\ResponsabilidadesUniversales\AdminSucursal\MostrarResponsabilidadesUniversalesSucursal;
use App\Livewire\PortalCapacitacion\ResponsabilidadesUniversales\AdminSucursal\AgregarResponsabilidadesUniversalesSucursal;
use App\Livewire\PortalCapacitacion\ResponsabilidadesUniversales\AdminSucursal\EditarResponsabilidadesUniversalesSucursal;
use App\Livewire\PortalCapacitacion\HabilidadesHumanas\AdminGeneral\MostrarHabilidadesHumanas;
use App\Livewire\PortalCapacitacion\HabilidadesHumanas\AdminGeneral\AgregarHabilidadesHumanas;
use App\Livewire\PortalCapacitacion\HabilidadesHumanas\AdminGeneral\EditarHabilidadesHumanas;
use App\Livewire\PortalCapacitacion\HabilidadesHumanas\AdminEmpresa\MostrarHabilidadesHumanasEmpresa;
use App\Livewire\PortalCapacitacion\HabilidadesHumanas\AdminEmpresa\AgregarHabilidadesHumanasEmpresa;
use App\Livewire\PortalCapacitacion\HabilidadesHumanas\AdminEmpresa\EditarHabilidadesHumanasEmpresa;
use App\Livewire\PortalCapacitacion\HabilidadesHumanas\AdminSucursal\MostrarHabilidadesHumanasSucursal;
use App\Livewire\PortalCapacitacion\HabilidadesHumanas\AdminSucursal\AgregarHabilidadesHumanasSucursal;
use App\Livewire\PortalCapacitacion\HabilidadesHumanas\AdminSucursal\EditarHabilidadesHumanasSucursal;
use App\Livewire\PortalCapacitacion\HabilidadesTecnicas\AdminGeneral\MostrarHabilidadesTecnicas;
use App\Livewire\PortalCapacitacion\HabilidadesTecnicas\AdminGeneral\AgregarHabilidadesTecnicas;
use App\Livewire\PortalCapacitacion\HabilidadesTecnicas\AdminGeneral\EditarHabilidadesTecnicas;
use App\Livewire\PortalCapacitacion\HabilidadesTecnicas\AdminEmpresa\MostrarHabilidadesTecnicasEmpresa;
use App\Livewire\PortalCapacitacion\HabilidadesTecnicas\AdminEmpresa\AgregarHabilidadesTecnicasEmpresa;
use App\Livewire\PortalCapacitacion\HabilidadesTecnicas\AdminEmpresa\EditarHabilidadesTecnicasEmpresa;
use App\Livewire\PortalCapacitacion\HabilidadesTecnicas\AdminSucursal\MostrarHabilidadesTecnicasSucursal;
use App\Livewire\PortalCapacitacion\HabilidadesTecnicas\AdminSucursal\AgregarHabilidadesTecnicasSucursal;
use App\Livewire\PortalCapacitacion\HabilidadesTecnicas\AdminSucursal\EditarHabilidadesTecnicasSucursal;
use App\Livewire\PortalCapacitacion\Usuarios\AdminGeneral\MostrarUsuario;
use App\Livewire\PortalCapacitacion\Usuarios\AdminEmpresa\MostrarUsuarioEmpresa;
use App\Livewire\PortalCapacitacion\Usuarios\AdminSucursal\MostrarUsuarioSucursal;
use App\Livewire\PortalCapacitacion\Usuarios\AdminTrabajador\MostrarUsuarioTrabajador;
use App\Livewire\PortalCapacitacion\Usuarios\AdminGeneral\VerMasUsuario;
use App\Livewire\PortalCapacitacion\Usuarios\AdminEmpresa\VerMasUsuarioEmpresa;
use App\Livewire\PortalCapacitacion\Usuarios\AdminSucursal\VerMasUsuarioSucursal;
use App\Livewire\PortalCapacitacion\Usuarios\AdminTrabajador\VerMasUsuarioTrabajador;
use App\Livewire\PortalCapacitacion\Usuarios\AdminGeneral\CompararPerfilPuesto;
use App\Livewire\PortalCapacitacion\Usuarios\AdminEmpresa\CompararPerfilPuestoEmpresa;
use App\Livewire\PortalCapacitacion\Usuarios\AdminSucursal\CompararPerfilPuestoSucursal;
use App\Livewire\PortalCapacitacion\EvaluarColaborador\AdminGeneral\FormEvaluar;
use App\Livewire\PortalCapacitacion\EvaluarColaborador\AdminEmpresa\FormEvaluarEmpresa;
use App\Livewire\PortalCapacitacion\EvaluarColaborador\AdminSucursal\FormEvaluarSucursal;
use App\Livewire\PortalCapacitacion\EvaluarColaborador\AdminGeneral\HistorialEvaluaciones;
use App\Livewire\PortalCapacitacion\EvaluarColaborador\AdminEmpresa\HistorialEvaluacionesEmpresa;
use App\Livewire\PortalCapacitacion\EvaluarColaborador\AdminSucursal\HistorialEvaluacionesSucursal;
use App\Livewire\PortalCapacitacion\EvaluarColaborador\AdminTrabajador\HistorialEvaluacionesTrabajador;
use App\Livewire\PortalCapacitacion\AsociarPuestoTrabajador\AdminGeneral\AsociarPuestoTrabajador;
use App\Livewire\PortalCapacitacion\AsociarPuestoTrabajador\AdminEmpresa\AsociarPuestoTrabajadorEmpresa;
use App\Livewire\PortalCapacitacion\AsociarPuestoTrabajador\AdminSucursal\AsociarPuestoTrabajadorSucursal;
use App\Livewire\PortalCapacitacion\AsociarPuestoTrabajador\AdminGeneral\AsignarPerfilPuesto;
use App\Livewire\PortalCapacitacion\AsociarPuestoTrabajador\AdminEmpresa\AsignarPerfilPuestoEmpresa;
use App\Livewire\PortalCapacitacion\AsociarPuestoTrabajador\AdminSucursal\AsignarPerfilPuestoSucursal;
use App\Livewire\PortalCapacitacion\Cursos\Tematicas\AdminGeneral\MostrarTematica;
use App\Livewire\PortalCapacitacion\Cursos\Tematicas\AdminGeneral\AgregarTematica;
use App\Livewire\PortalCapacitacion\Cursos\Tematicas\AdminGeneral\EditarTematica;
use App\Livewire\PortalCapacitacion\Cursos\Cursos\AdminGeneral\MostrarCurso;
use App\Livewire\PortalCapacitacion\Cursos\Cursos\AdminGeneral\AgregarCurso;
use App\Livewire\PortalCapacitacion\Cursos\Cursos\AdminGeneral\EditarCurso;
use App\Livewire\PortalCapacitacion\Capacitaciones\CapIndividuales\AdminGeneral\MostrarCapacitaciones;
use App\Livewire\PortalCapacitacion\Capacitaciones\CapIndividuales\AdminGeneral\AgregarCapacitaciones;
use App\Livewire\PortalCapacitacion\Capacitaciones\CapIndividuales\AdminGeneral\EditarCapacitaciones;
use App\Livewire\PortalCapacitacion\Capacitaciones\CapIndividuales\AdminEmpresa\MostrarCapacitacionesEmpresa;
use App\Livewire\PortalCapacitacion\Capacitaciones\CapIndividuales\AdminEmpresa\AgregarCapacitacionesEmpresa;
use App\Livewire\PortalCapacitacion\Capacitaciones\CapIndividuales\AdminEmpresa\EditarCapacitacionesEmpresa;
use App\Livewire\PortalCapacitacion\Capacitaciones\CapIndividuales\AdminSucursal\MostrarCapacitacionesSucursal;
use App\Livewire\PortalCapacitacion\Capacitaciones\CapIndividuales\AdminSucursal\AgregarCapacitacionesSucursal;
use App\Livewire\PortalCapacitacion\Capacitaciones\CapIndividuales\AdminSucursal\EditarCapacitacionesSucursal;
use App\Livewire\PortalCapacitacion\Capacitaciones\CapIndividuales\AdminTrabajador\MostrarCapacitacionesTrabajador;
use App\Livewire\PortalCapacitacion\Capacitaciones\CapGrupales\AdminTrabajador\MostrarCapacitacionesGruTrabajador;
use App\Livewire\PortalCapacitacion\Capacitaciones\CapGrupales\AdminGeneral\MostrarCapacitacionesGrupales;
use App\Livewire\PortalCapacitacion\Capacitaciones\CapGrupales\AdminGeneral\MostrarCapacitacionesGrupalesGeneral;
use App\Livewire\PortalCapacitacion\Capacitaciones\CapGrupales\AdminGeneral\AgregarCapacitacionesGrupales;
use App\Livewire\PortalCapacitacion\Capacitaciones\CapGrupales\AdminGeneral\EditarCapacitacionesGrupales;
use App\Livewire\PortalCapacitacion\Capacitaciones\CapGrupales\AdminEmpresa\MostrarCapacitacionesGrupalesEmpresa;
use App\Livewire\PortalCapacitacion\Capacitaciones\CapGrupales\AdminEmpresa\AgregarCapacitacionesGrupalesEmpresa;
use App\Livewire\PortalCapacitacion\Capacitaciones\CapGrupales\AdminEmpresa\EditarCapacitacionesGrupalesEmpresa;
use App\Livewire\PortalCapacitacion\Capacitaciones\CapGrupales\AdminSucursal\MostrarCapacitacionesGrupalesSucursal;
use App\Livewire\PortalCapacitacion\Capacitaciones\CapGrupales\AdminSucursal\AgregarCapacitacionesGrupalesSucursal;
use App\Livewire\PortalCapacitacion\Capacitaciones\CapGrupales\AdminSucursal\EditarCapacitacionesGrupalesSucursal;
use App\Livewire\PortalCapacitacion\Evidencias\Individuales\AdminTrabajador\MostrarEvidenciasIndividuales;
use App\Livewire\PortalCapacitacion\Evidencias\Individuales\AdminTrabajador\AgregarEvidenciasIndividuales;
use App\Livewire\PortalCapacitacion\Evidencias\Individuales\AdminTrabajador\EditarEvidenciasIndividuales;
use App\Livewire\PortalCapacitacion\Evidencias\Grupales\AdminGeneral\MostrarEvidenciasGeneralGrupales;
use App\Livewire\PortalCapacitacion\Evidencias\Grupales\AdminTrabajador\MostrarEvidenciasTrabajadorGrupales;
use App\Livewire\PortalCapacitacion\Evidencias\Grupales\AdminTrabajador\AgregarEvidenciasTrabajadorGrupales;
use App\Livewire\PortalCapacitacion\Evidencias\Grupales\AdminTrabajador\EditarEvidenciasTrabajadorGrupales;
use App\Livewire\PortalCapacitacion\Participantes\AdminGeneral\EditarParticipantesCapacitacion;
use App\Livewire\PortalCapacitacion\Participantes\AdminGeneral\AgregarParticipantesCapacitacion;
use App\Livewire\PortalCapacitacion\Participantes\AdminEmpresa\EditarParticipantesCapacitacionEmpresa;
use App\Livewire\PortalCapacitacion\Participantes\AdminEmpresa\AgregarParticipantesCapacitacionEmpresa;
use App\Livewire\PortalCapacitacion\Participantes\AdminSucursal\EditarParticipantesCapacitacionSucursal;
use App\Livewire\PortalCapacitacion\Participantes\AdminSucursal\AgregarParticipantesCapacitacionSucursal;
use App\Livewire\PortalCapacitacion\Capacitaciones\CapGrupales\ReconocimientoController;

Route::get('/inicio', Inicio::class)->name('inicio-capacitacion');

 //perfiles de puesto
Route::get('/mostrar-perfil-puesto', MostrarPerfilPuesto::class)->middleware('can:Mostrar Perfil Puesto')->name('mostrarPerfilPuesto');
Route::get('/agregar-perfil-puesto', AgregarPerfilPuesto::class)->middleware('can:Agregar Perfil Puesto')->name('agregarPerfilPuesto');
Route::get('/editar-perfil-puesto/{id}', EditarPerfilPuesto::class)->middleware('can:Editar Perfil Puesto')->name('editarPerfilPuesto');
Route::get('/ver-mas/{id}', VerMasPerfilPuesto::class)->middleware('can:Ver Mas Perfil Puesto')->name('vermasPerfilPuesto');
//------------------------------------------------------------------------------------------------
Route::get('/mostrar-perfil-puesto-empresa', MostrarPerfilPuestoEmpresa::class)->middleware('can:Mostrar Perfil Puesto Empresa')->name('mostrarPerfilPuestoEmpresa');
Route::get('/agregar-perfil-puesto-empresa', AgregarPerfilPuestoEmpresa::class)->middleware('can:Agregar Perfil Puesto Empresa')->name('agregarPerfilPuestoEmpresa');
Route::get('/editar-perfil-puesto-empresa/{id}', EditarPerfilPuestoEmpresa::class)->middleware('can:Editar Perfil Puesto Empresa')->name('editarPerfilPuestoEmpresa');
//------------------------------------------------------------------------------------------------
Route::get('/mostrar-perfil-puesto-sucursal', MostrarPerfilPuestoSucursal::class)->middleware('can:Mostrar Perfil Puesto Sucursal')->name('mostrarPerfilPuestoSucursal');
Route::get('/agregar-perfil-puesto-sucursal', AgregarPerfilPuestoSucursal::class)->middleware('can:Agregar Perfil Puesto Sucursal')->name('agregarPerfilPuestoSucursal');
Route::get('/editar-perfil-puesto-sucursal/{id}', EditarPerfilPuestoSucursal::class)->middleware('can:Editar Perfil Puesto Sucursal')->name('editarPerfilPuestoSucursal');

//funciones especificas
Route::get('/mostrar-funciones-especificas', MostrarFunEspecificas::class)->middleware('can:Mostrar Funciones Especificas')->name('mostrarFuncionesEspecificas');
Route::get('/agregar-funciones-especificas', AgregarFunEspecificas::class)->middleware('can:Agregar Funciones Especificas')->name('agregarFuncionesEspecificas');
Route::get('/editar-funciones-especificas/{id}', EditarFunEspecificas::class)->middleware('can:Editar Funciones Especificas')->name('editarFuncionesEspecificas');
//------------------------------------------------------------------------------------------------
Route::get('/mostrar-funciones-especificas-sucursal', MostrarFunEspecificasSucursal::class)->middleware('can:Mostrar Funciones Especificas Sucursal')->name('mostrarFuncionesEspecificasSucursal');
Route::get('/agregar-funciones-especificas-sucursal', AgregarFunEspecificasSucursal::class)->middleware('can:Agregar Funciones Especificas Sucursal')->name('agregarFuncionesEspecificasSucursal');
Route::get('/editar-funciones-especificas-sucursal/{id}', EditarFunEspecificasSucursal::class)->middleware('can:Editar Funciones Especificas Sucursal')->name('editarFuncionesEspecificasSucursal');
//------------------------------------------------------------------------------------------------
Route::get('/mostrar-funciones-especificas-empresa', MostrarFunEspecificasEmpresa::class)->middleware('can:Mostrar Funciones Especificas Empresa')->name('mostrarFuncionesEspecificasEmpresa');
Route::get('/agregar-funciones-especificas-empresa', AgregarFunEspecificasEmpresa::class)->middleware('can:Agregar Funciones Especificas Empresa')->name('agregarFuncionesEspecificasEmpresa');
Route::get('/editar-funciones-especificas-empresa/{id}', EditarFunEspecificasEmpresa::class)->middleware('can:Editar Funciones Especificas Empresa')->name('editarFuncionesEspecificasEmpresa');

//relaciones internas
Route::get('/mostrar-relaciones-internas', MostrarRelacionesInternas::class)->middleware('can:Mostrar Relaciones Internas')->name('mostrarRelacionesInternas');
Route::get('/agregar-relaciones-internas', AgregarRelacionesInternas::class)->middleware('can:Agregar Relaciones Internas')->name('agregarRelacionesInternas');
Route::get('/editar-relaciones-internas/{id}', EditarRelacionesInternas::class)->middleware('can:Editar Relaciones Internas')->name('editarRelacionesInternas');
//------------------------------------------------------------------------------------------------
Route::get('/mostrar-relaciones-internas-empresa', MostrarRelacionesInternasEmpresa::class)->middleware('can:Mostrar Relaciones Internas Empresa')->name('mostrarRelacionesInternasEmpresa');
Route::get('/agregar-relaciones-internas-empresa', AgregarRelacionesInternasEmpresa::class)->middleware('can:Agregar Relaciones Internas Empresa')->name('agregarRelacionesInternasEmpresa');
Route::get('/editar-relaciones-internas-empresa/{id}', EditarRelacionesInternasEmpresa::class)->middleware('can:Editar Relaciones Internas Empresa')->name('editarRelacionesInternasEmpresa');
//------------------------------------------------------------------------------------------------
Route::get('/mostrar-relaciones-internas-sucursal', MostrarRelacionesInternasSucursal::class)->middleware('can:Mostrar Relaciones Internas Sucursal')->name('mostrarRelacionesInternasSucursal');
Route::get('/agregar-relaciones-internas-sucursal', AgregarRelacionesInternasSucursal::class)->middleware('can:Agregar Relaciones Internas Sucursal')->name('agregarRelacionesInternasSucursal');
Route::get('/editar-relaciones-internas-sucursal/{id}', EditarRelacionesInternasSucursal::class)->middleware('can:Editar Relaciones Internas Sucursal')->name('editarRelacionesInternasSucursal');

//relaciones externas
Route::get('/mostrar-relaciones-externas', MostrarRelacionesExternas::class)->middleware('can:Mostrar Relaciones Externas')->name('mostrarRelacionesExternas');
Route::get('/agregar-relaciones-externas', AgregarRelacionesExternas::class)->middleware('can:Agregar Relaciones Externas')->name('agregarRelacionesExternas');
Route::get('/editar-relaciones-externas/{id}', EditarRelacionesExternas::class)->middleware('can:Editar Relaciones Externas')->name('editarRelacionesExternas');
//------------------------------------------------------------------------------------------------
Route::get('/mostrar-relaciones-externas-empresa', MostrarRelacionesExternasEmpresa::class)->middleware('can:Mostrar Relaciones Externas Empresa')->name('mostrarRelacionesExternasEmpresa');
Route::get('/agregar-relaciones-externas-empresa', AgregarRelacionesExternasEmpresa::class)->middleware('can:Agregar Relaciones Externas Empresa')->name('agregarRelacionesExternasEmpresa');
Route::get('/editar-relaciones-externas-empresa/{id}', EditarRelacionesExternasEmpresa::class)->middleware('can:Editar Relaciones Externas Empresa')->name('editarRelacionesExternasEmpresa');
//--------------------------------------------------------------------------------------------------------------------
Route::get('/mostrar-relaciones-externas-sucursal', MostrarRelacionesExternasSucursal::class)->middleware('can:Mostrar Relaciones Externas Sucursal')->name('mostrarRelacionesExternasSucursal');
Route::get('/agregar-relaciones-externas-sucursal', AgregarRelacionesExternasSucursal::class)->middleware('can:Agregar Relaciones Externas Sucursal')->name('agregarRelacionesExternasSucursal');
Route::get('/editar-relaciones-externas-sucursal/{id}', EditarRelacionesExternasSucursal::class)->middleware('can:Editar Relaciones Externas Sucursal')->name('editarRelacionesExternasSucursal');

//responsabilidades universales
Route::get('/mostrar-responsabilidades-universales', MostrarResponsabilidadesUniversales::class)->middleware('can:Mostrar Responsabilidades Universales')->name('mostrarResponsabilidadesUniversales');
Route::get('/agregar-responsabilidades-universales', AgregarResponsabilidadesUniversales::class)->middleware('can:Agregar Responsabilidades Universales')->name('agregarResponsabilidadesUniversales');
Route::get('/editar-responsabilidades-universales/{id}', EditarResponsabilidadesUniversales::class)->middleware('can:Editar Responsabilidades Universales')->name('editarResponsabilidadesUniversales');
//------------------------------------------------------------------------------------------------
Route::get('/mostrar-responsabilidades-universales-empresa', MostrarResponsabilidadesUniversalesEmpresa::class)->middleware('can:Mostrar Responsabilidades Universales Empresa')->name('mostrarResponsabilidadesUniversalesEmpresa');
Route::get('/agregar-responsabilidades-universales-empresa', AgregarResponsabilidadesUniversalesEmpresa::class)->middleware('can:Agregar Responsabilidades Universales Empresa')->name('agregarResponsabilidadesUniversalesEmpresa');
Route::get('/editar-responsabilidades-universale-empresa/{id}', EditarResponsabilidadesUniversalesEmpresa::class)->middleware('can:Editar Responsabilidades Universales Empresa')->name('editarResponsabilidadesUniversalesEmpresa');
//------------------------------------------------------------------------------------------------
Route::get('/mostrar-responsabilidades-universales-sucursal', MostrarResponsabilidadesUniversalesSucursal::class)->middleware('can:Mostrar Responsabilidades Universales Sucursal')->name('mostrarResponsabilidadesUniversalesSucursal');
Route::get('/agregar-responsabilidades-universales-sucursal', AgregarResponsabilidadesUniversalesSucursal::class)->middleware('can:Agregar Responsabilidades Universales Sucursal')->name('agregarResponsabilidadesUniversalesSucursal');
Route::get('/editar-responsabilidades-universales-sucursal/{id}', EditarResponsabilidadesUniversalesSucursal::class)->middleware('can:Editar Responsabilidades Universales Sucursal')->name('editarResponsabilidadesUniversalesSucursal');

//habilidades humanas
Route::get('/mostrar-habilidades-humanas', MostrarHabilidadesHumanas::class)->middleware('can:Mostrar Habilidades Humanas')->name('mostrarHabilidadesHumanas');
Route::get('/agregar-habilidades-humanas', AgregarHabilidadesHumanas::class)->middleware('can:Agregar Habilidades Humanas')->name('agregarHabilidadesHumanas');
Route::get('/editar-habilidades-humanas/{id}', EditarHabilidadesHumanas::class)->middleware('can:Editar Habilidades Humanas')->name('editarHabilidadesHumanas');
//------------------------------------------------------------------------------------------------
Route::get('/mostrar-habilidades-humanas-empresa', MostrarHabilidadesHumanasEmpresa::class)->middleware('can:Mostrar Habilidades Humanas Empresa')->name('mostrarHabilidadesHumanasEmpresa');
Route::get('/agregar-habilidades-humanas-empresa', AgregarHabilidadesHumanasEmpresa::class)->middleware('can:Agregar Habilidades Humanas Empresa')->name('agregarHabilidadesHumanasEmpresa');
Route::get('/editar-habilidades-humanas-empresa/{id}', EditarHabilidadesHumanasEmpresa::class)->middleware('can:Editar Habilidades Humanas Empresa')->name('editarHabilidadesHumanasEmpresa');
//------------------------------------------------------------------------------------------------
Route::get('/mostrar-habilidades-humanas-sucursal', MostrarHabilidadesHumanasSucursal::class)->middleware('can:Mostrar Habilidades Humanas Sucursal')->name('mostrarHabilidadesHumanasSucursal');
Route::get('/agregar-habilidades-humanas-sucursal', AgregarHabilidadesHumanasSucursal::class)->middleware('can:Agregar Habilidades Humanas Sucursal')->name('agregarHabilidadesHumanasSucursal');
Route::get('/editar-habilidades-humanas-sucursal/{id}', EditarHabilidadesHumanasSucursal::class)->middleware('can:Editar Habilidades Humanas Sucursal')->name('editarHabilidadesHumanasSucursal');

//habilidades tecnicas
Route::get('/mostrar-habilidades-tecnicas', MostrarHabilidadesTecnicas::class)->middleware('can:Mostrar Habilidades Tecnicas')->name('mostrarHabilidadesTecnicas');
Route::get('/agregar-habilidades-tecnicas', AgregarHabilidadesTecnicas::class)->middleware('can:Agregar Habilidades Tecnicas')->name('agregarHabilidadesTecnicas');
Route::get('/editar-habilidades-tecnicas/{id}', EditarHabilidadesTecnicas::class)->middleware('can:Editar Habilidades Tecnicas')->name('editarHabilidadesTecnicas');
//------------------------------------------------------------------------------------------------
Route::get('/mostrar-habilidades-tecnicas-empresa', MostrarHabilidadesTecnicasEmpresa::class)->middleware('can:Mostrar Habilidades Tecnicas Empresa')->name('mostrarHabilidadesTecnicasEmpresa');
Route::get('/agregar-habilidades-tecnicas-empresa', AgregarHabilidadesTecnicasEmpresa::class)->middleware('can:Agregar Habilidades Tecnicas Empresa')->name('agregarHabilidadesTecnicasEmpresa');
Route::get('/editar-habilidades-tecnicas-empresa/{id}', EditarHabilidadesTecnicasEmpresa::class)->middleware('can:Editar Habilidades Tecnicas Empresa')->name('editarHabilidadesTecnicasEmpresa');
//------------------------------------------------------------------------------------------------
Route::get('/mostrar-habilidades-tecnicas-sucursal', MostrarHabilidadesTecnicasSucursal::class)->middleware('can:Mostrar Habilidades Tecnicas Sucursal')->name('mostrarHabilidadesTecnicasSucursal');
Route::get('/agregar-habilidades-tecnicas-sucursal', AgregarHabilidadesTecnicasSucursal::class)->middleware('can:Agregar Habilidades Tecnicas Sucursal')->name('agregarHabilidadesTecnicasSucursal');
Route::get('/editar-habilidades-tecnicas-sucursal/{id}', EditarHabilidadesTecnicasSucursal::class)->middleware('can:Editar Habilidades Tecnicas Sucursal')->name('editarHabilidadesTecnicasSucursal');

//trabajadores
Route::get('/users', MostrarUsuario::class)->middleware('can:Mostrar Usuarios')->name('mostrarUsuarios');
Route::get('/users-empresa', MostrarUsuarioEmpresa::class)->middleware('can:Mostrar Usuarios Empresa')->name('mostrarUsuariosEmpresa');
Route::get('/users-sucursal', MostrarUsuarioSucursal::class)->middleware('can:Mostrar Usuarios Sucursal')->name('mostrarUsuariosSucursal');
Route::get('/users-trabajador', MostrarUsuarioTrabajador::class)->middleware('can:Mostrar Usuarios Trabajador')->name('mostrarUsuariosTrabajador');
//------------------------------------------------------------------------------------------------
Route::get('/users/{id}', VerMasUsuario::class)->middleware('can:Ver Mas Usuarios')->name('vermasUsuarios');
Route::get('/users-empresa/{id}', VerMasUsuarioEmpresa::class)->middleware('can:Ver Mas Usuarios Empresa')->name('vermasUsuariosEmpresa');
Route::get('/users-sucursal/{id}', VerMasUsuarioSucursal::class)->middleware('can:Ver Mas Usuarios Sucursal')->name('vermasUsuariosSucursal');
Route::get('/users-trabajador/{id}', VerMasUsuarioTrabajador::class)->middleware('can:Ver Mas Usuarios Trabajador')->name('vermasUsuariosTrabajador');
//------------------------------------------------------------------------------------------------
Route::get('/user/comparar/{id}', CompararPerfilPuesto::class)->middleware('can:Comparar Perfil Puesto')->name('compararPerfilPuesto');
Route::get('/user/comparar-empresa/{id}', CompararPerfilPuestoEmpresa::class)->middleware('can:Comparar Perfil Puesto Empresa')->name('compararPerfilPuestoEmpresa');
Route::get('/user/comparar-sucursal/{id}', CompararPerfilPuestoSucursal::class)->middleware('can:Comparar Perfil Puesto Sucursal')->name('compararPerfilPuestoSucursal');

//evaluar colaborador
Route::get('/evaluar-colaborador/{id}', FormEvaluar::class)->middleware('can:Evaluar Trabajador')->name('evaluarColaborador');
Route::get('/evaluar-colaborador-empresa/{id}', FormEvaluarEmpresa::class)->middleware('can:Evaluar Trabajador Empresa')->name('evaluarColaboradorEmpresa');
Route::get('/evaluar-colaborador-sucursal/{id}', FormEvaluarSucursal::class)->middleware('can:Evaluar Trabajador Sucursal')->name('evaluarColaboradorSucursal');
//------------------------------------------------------------------------------------------------
Route::get('/historial-evaluaciones/{id}', HistorialEvaluaciones::class)->name('historialEvalaciones');
Route::get('/historial-evaluaciones-empresa/{id}', HistorialEvaluacionesEmpresa::class)->name('historialEvalacionesEmpresa');
Route::get('/historial-evaluaciones-sucursal/{id}', HistorialEvaluacionesSucursal::class)->name('historialEvalacionesSucursal');
Route::get('/historial-evaluaciones-trabajador/{id}', HistorialEvaluacionesTrabajador::class)->name('historialEvalacionesTrabajador');

//asociar puesto para trabajadores
Route::get('/asociar-perfil-puesto', AsociarPuestoTrabajador::class)->middleware('can:Asociar Puesto Trabajador')->name('asociarPuestoTrabajador');
Route::get('/asociar-perfil-puesto-empresa', AsociarPuestoTrabajadorEmpresa::class)->middleware('can:Asociar Puesto Trabajador Empresa')->name('asociarPuestoTrabajadorEmpresa');
Route::get('/asociar-perfil-puesto-sucursal', AsociarPuestoTrabajadorSucursal::class)->middleware('can:Asociar Puesto Trabajador Sucursal')->name('asociarPuestoTrabajadorSucursal');
//--------------------------------------------------------------------------------------------------------------------
Route::get('/asignar-perfil-puesto/{id}/{tipoUsuario}', AsignarPerfilPuesto::class)->middleware('can:Asociar Puesto Trabajador')->name('asignarPerfilPuesto');
Route::get('/asignar-perfil-puesto-empresa/{id}/{tipoUsuario}', AsignarPerfilPuestoEmpresa::class)->middleware('can:Asociar Puesto Trabajador Empresa')->name('asignarPerfilPuestoEmpresa');
Route::get('/asignar-perfil-puesto-sucursal/{id}/{tipoUsuario}', AsignarPerfilPuestoSucursal::class)->middleware('can:Asociar Puesto Trabajador Sucursal')->name('asignarPerfilPuestoSucursal');

//tematicas
Route::get('/tematicas', MostrarTematica::class)->middleware('can:Ver tematicas')->name('verTematicas');
Route::get('/agregar-tematicas', AgregarTematica::class)->middleware('can:Agregar tematicas')->name('agregarTematicas');
Route::get('/editar-tematicas/{id}', EditarTematica::class)->middleware('can:Editar tematicas')->name('editarTematicas');

//Cursos
Route::get('/curso', MostrarCurso::class)->middleware('can:Ver cursos')->name('verCursos');
Route::get('/agregar-curso', AgregarCurso::class)->middleware('can:Agregar cursos')->name('agregarCursos');
Route::get('/editar-curso/{id}', EditarCurso::class)->middleware('can:Editar cursos')->name('editarCursos');

//Capacitaciones INDIVIDUALES
Route::get('/ver-capacitaciones-ind/{id}', MostrarCapacitaciones::class)->middleware('can:Ver capacitaciones')->name('verCapacitacionesInd');
Route::get('/agregar-capacitaciones-ind/{id}', AgregarCapacitaciones::class)->middleware('can:Agregar capacitaciones')->name('agregarCapacitacionesInd');
Route::get('/editar-capacitaciones-ind/{id}', EditarCapacitaciones::class)->middleware('can:Editar capacitaciones')->name('editarCapacitacionesInd');
//--------------------------------------------------------------------------------------------------------
Route::get('/ver-capacitaciones-ind-empresa/{id}', MostrarCapacitacionesEmpresa::class)->middleware('can:Ver capacitaciones Empresa')->name('verCapacitacionesIndEmpresa');
Route::get('/agregar-capacitaciones-ind-empresa/{id}', AgregarCapacitacionesEmpresa::class)->middleware('can:Agregar capacitaciones Empresa')->name('agregarCapacitacionesIndEmpresa');
Route::get('/editar-capacitaciones-ind-empresa/{id}', EditarCapacitacionesEmpresa::class)->middleware('can:Editar capacitaciones Empresa')->name('editarCapacitacionesIndEmpresa');
//--------------------------------------------------------------------------------------------------------
Route::get('/ver-capacitaciones-ind-sucursal/{id}', MostrarCapacitacionesSucursal::class)->middleware('can:Ver capacitaciones Sucursal')->name('verCapacitacionesIndSucursal');
Route::get('/agregar-capacitaciones-ind-sucursal/{id}', AgregarCapacitacionesSucursal::class)->middleware('can:Agregar capacitaciones Sucursal')->name('agregarCapacitacionesIndSucursal');
Route::get('/editar-capacitaciones-ind-sucursal/{id}', EditarCapacitacionesSucursal::class)->middleware('can:Editar capacitaciones Sucursal')->name('editarCapacitacionesIndSucursal');
//--------------------------------------------------------------------------------------------------------
Route::get('/ver-capacitaciones-ind-trabajador/{id}', MostrarCapacitacionesTrabajador::class)->middleware('can:Ver capacitaciones Trabajador')->name('verCapacitacionesIndTrabajador');

//Capacitaciones GRUPALES
Route::get('/ver-capacitaciones-gru', MostrarCapacitacionesGrupales::class)->middleware('can:Ver capacitaciones')->name('verCapacitacionesGru');
Route::get('/ver-capacitaciones-gru-general/{id}', MostrarCapacitacionesGrupalesGeneral::class)->middleware('can:Ver capacitaciones')->name('verCapacitacionesGruGeneral');
Route::get('/agregar-capacitaciones-gru', AgregarCapacitacionesGrupales::class)->middleware('can:Agregar capacitaciones')->name('agregarCapacitacionesGru');
Route::get('/editar-capacitaciones-gru/{id}', EditarCapacitacionesGrupales::class)->middleware('can:Editar capacitaciones')->name('editarCapacitacionesGru');
//------------------------------------------------------------------------------------------------------------------------------------
Route::get('/ver-capacitaciones-gru-empresa', MostrarCapacitacionesGrupalesEmpresa::class)->middleware('can:Ver capacitaciones Empresa')->name('verCapacitacionesGruEmpresa');
Route::get('/agregar-capacitaciones-gru-empresa', AgregarCapacitacionesGrupalesEmpresa::class)->middleware('can:Agregar capacitaciones Empresa')->name('agregarCapacitacionesGruEmpresa');
Route::get('/editar-capacitaciones-gru-empresa/{id}', EditarCapacitacionesGrupalesEmpresa::class)->middleware('can:Editar capacitaciones Empresa')->name('editarCapacitacionesGruEmpresa');
//------------------------------------------------------------------------------------------------------------------------------------
Route::get('/ver-capacitaciones-gru-sucursal', MostrarCapacitacionesGrupalesSucursal::class)->middleware('can:Ver capacitaciones Sucursal')->name('verCapacitacionesGruSucursal');
Route::get('/agregar-capacitaciones-gru-sucursal', AgregarCapacitacionesGrupalesSucursal::class)->middleware('can:Agregar capacitaciones Sucursal')->name('agregarCapacitacionesGruSucursal');
Route::get('/editar-capacitaciones-gru-sucursal/{id}', EditarCapacitacionesGrupalesSucursal::class)->middleware('can:Editar capacitaciones Sucursal')->name('editarCapacitacionesGruSucursal');
//------------------------------------------------------------------------------------------------------------------------------------
Route::get('/ver-capacitaciones-gru-trabajador/{id}', MostrarCapacitacionesGruTrabajador::class)->middleware('can:Ver capacitaciones Trabajador')->name('verCapacitacionesGruTrabajador');

//Participantes
Route::get('/agregar-trabajador-capacitacion-grupal/{id}', AgregarParticipantesCapacitacion::class)->middleware('can:Ver capacitaciones')->name('agregarTrabajadorCapacitacionGrupal');
Route::get('/editar-trabajador-capacitacion-grupal/{id}', EditarParticipantesCapacitacion::class)->middleware('can:Ver capacitaciones')->name('editarTrabajadorCapacitacionGrupal');
//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------
Route::get('/agregar-trabajador-capacitacion-grupal-empresa/{id}', AgregarParticipantesCapacitacionEmpresa::class)->middleware('can:Ver capacitaciones Empresa')->name('agregarTrabajadorCapacitacionGrupalEmpresa');
Route::get('/editar-trabajador-capacitacion-grupal-empresa/{id}', EditarParticipantesCapacitacionEmpresa::class)->middleware('can:Ver capacitaciones Empresa')->name('editarTrabajadorCapacitacionGrupalEmpresa');
//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------
Route::get('/agregar-trabajador-capacitacion-grupal-sucursal/{id}', AgregarParticipantesCapacitacionSucursal::class)->middleware('can:Ver capacitaciones Sucursal')->name('agregarTrabajadorCapacitacionGrupalSucursal');
Route::get('/editar-trabajador-capacitacion-grupal-sucursal/{id}', EditarParticipantesCapacitacionSucursal::class)->middleware('can:Ver capacitaciones Sucursal')->name('editarTrabajadorCapacitacionGrupalSucursal');


//Evidencias individuales
Route::get('/ver-evidencias-ind/{id}', MostrarEvidenciasIndividuales::class)->middleware('can:Ver evidencias Trabajador')->name('verEvidenciasIndTrabajador');
Route::get('/agregar-evidencias-ind/{id}', AgregarEvidenciasIndividuales::class)->name('agregarEvidenciasIndTrabajador');

//Evidencias Grupales
Route::get('/ver-evidencias-gru-general/{id}', MostrarEvidenciasGeneralGrupales::class)->middleware('can:Ver evidencias')->name('verEvidenciasGruGeneral');
//--------------------------------------------------------------------------------------------------------------------------------
Route::get('/ver-evidencias-gru/{id}', MostrarEvidenciasTrabajadorGrupales::class)->middleware('can:Ver evidencias Trabajador')->name('verEvidenciasGruTrabajador');
Route::get('/agregar-evidencias-gru/{id}', AgregarEvidenciasTrabajadorGrupales::class)->name('agregarEvidenciasGruTrabajador');

Route::get('/descargar-reconocimiento/{id}', [ReconocimientoController::class, 'descargar'])->name('descargar.reconocimiento');
