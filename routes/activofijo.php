<?php

use App\Http\Controllers\ActivoFijo\Reportes\PdfExportController;
use App\Livewire\ActivoFijo\Activos\ActivoMobiliario\AdminAdmin\Agregarmob;
use App\Livewire\ActivoFijo\Activos\ActivoMobiliario\AdminAdmin\Asignarmob;
use App\Livewire\ActivoFijo\Activos\ActivoMobiliario\AdminAdmin\Editarmob;
use App\Livewire\ActivoFijo\Activos\ActivoMobiliario\AdminAdmin\Mostrarasignmob;
use App\Livewire\ActivoFijo\Activos\ActivoMobiliario\AdminAdmin\Mostrarmob;
use App\Livewire\ActivoFijo\Activos\ActivoMobiliario\AdminEmpresa\AgregarMobiliario;
use App\Livewire\ActivoFijo\Activos\ActivoMobiliario\AdminEmpresa\Asignarmobem;
use App\Livewire\ActivoFijo\Activos\ActivoMobiliario\AdminEmpresa\EditarMobiliario;
use App\Livewire\ActivoFijo\Activos\ActivoMobiliario\AdminEmpresa\Mostrarasignmobe;
use App\Livewire\ActivoFijo\Activos\ActivoMobiliario\AdminEmpresa\MostrarMobiliario;
use App\Livewire\ActivoFijo\Activos\ActivoMobiliario\AdminSucursal\Agregaractmob;
use App\Livewire\ActivoFijo\Activos\ActivoMobiliario\AdminSucursal\Editaractmob;
use App\Livewire\ActivoFijo\Activos\ActivoMobiliario\AdminSucursal\Mostraractmob;
use App\Livewire\ActivoFijo\Activos\ActivoOficina\AdminAdmin\Agregarofi;
use App\Livewire\ActivoFijo\Activos\ActivoOficina\AdminAdmin\Asignarofi;
use App\Livewire\ActivoFijo\Activos\ActivoOficina\AdminAdmin\Editarofi;
use App\Livewire\ActivoFijo\Activos\ActivoOficina\AdminAdmin\Mostrarasignofi;
use App\Livewire\ActivoFijo\Activos\ActivoOficina\AdminAdmin\Mostrarofi;
use App\Livewire\ActivoFijo\Activos\ActivoOficina\AdminEmpresa\AgregarOficina;
use App\Livewire\ActivoFijo\Activos\ActivoOficina\AdminEmpresa\Asignarofiem;
use App\Livewire\ActivoFijo\Activos\ActivoOficina\AdminEmpresa\EditarOficina;
use App\Livewire\ActivoFijo\Activos\ActivoOficina\AdminEmpresa\Mostrarasignofie;
use App\Livewire\ActivoFijo\Activos\ActivoOficina\AdminEmpresa\MostrarOficina;
use App\Livewire\ActivoFijo\Activos\ActivoOficina\AdminSucursal\Agregaractofi;
use App\Livewire\ActivoFijo\Activos\ActivoOficina\AdminSucursal\Editaractofi;
use App\Livewire\ActivoFijo\Activos\ActivoOficina\AdminSucursal\Mostraractofi;
use App\Livewire\ActivoFijo\Activos\ActivoPapeleria\AdminAdmin\Agregarpape;
use App\Livewire\ActivoFijo\Activos\ActivoPapeleria\AdminAdmin\Asignarpape;
use App\Livewire\ActivoFijo\Activos\ActivoPapeleria\AdminAdmin\Editarpape;
use App\Livewire\ActivoFijo\Activos\ActivoPapeleria\AdminAdmin\Mostrarasignpape;
use App\Livewire\ActivoFijo\Activos\ActivoPapeleria\AdminAdmin\Mostrarpape;
use App\Livewire\ActivoFijo\Activos\ActivoPapeleria\AdminEmpresa\AgregarPapeleria;
use App\Livewire\ActivoFijo\Activos\ActivoPapeleria\AdminEmpresa\Asignarpapeem;
use App\Livewire\ActivoFijo\Activos\ActivoPapeleria\AdminEmpresa\EditarPapeleria;
use App\Livewire\ActivoFijo\Activos\ActivoPapeleria\AdminEmpresa\Mostrarasignpapee;
use App\Livewire\ActivoFijo\Activos\ActivoPapeleria\AdminEmpresa\MostrarPapeleria;
use App\Livewire\ActivoFijo\Activos\ActivoPapeleria\AdminSucursal\Agregaractpape;
use App\Livewire\ActivoFijo\Activos\ActivoPapeleria\AdminSucursal\Editaractpape;
use App\Livewire\ActivoFijo\Activos\ActivoPapeleria\AdminSucursal\Mostraractpape;
use App\Livewire\ActivoFijo\Activos\ActivoSouvenir\AdminAdmin\Agregarsou;
use App\Livewire\ActivoFijo\Activos\ActivoSouvenir\AdminAdmin\Asignarsou;
use App\Livewire\ActivoFijo\Activos\ActivoSouvenir\AdminAdmin\Editarsou;
use App\Livewire\ActivoFijo\Activos\ActivoSouvenir\AdminAdmin\Mostrarasignsou;
use App\Livewire\ActivoFijo\Activos\ActivoSouvenir\AdminAdmin\Mostrarsou;
use App\Livewire\ActivoFijo\Activos\ActivoSouvenir\AdminEmpresa\AgregarSouvenir;
use App\Livewire\ActivoFijo\Activos\ActivoSouvenir\AdminEmpresa\Asignarsouem;
use App\Livewire\ActivoFijo\Activos\ActivoSouvenir\AdminEmpresa\EditarSouvenir;
use App\Livewire\ActivoFijo\Activos\ActivoSouvenir\AdminEmpresa\Mostrarasignsoue;
use App\Livewire\ActivoFijo\Activos\ActivoSouvenir\AdminEmpresa\MostrarSouvenir;
use App\Livewire\ActivoFijo\Activos\ActivoSouvenir\AdminSucursal\Agregaractsou;
use App\Livewire\ActivoFijo\Activos\ActivoSouvenir\AdminSucursal\Editaractsou;
use App\Livewire\ActivoFijo\Activos\ActivoSouvenir\AdminSucursal\Mostraractsou;
use App\Livewire\ActivoFijo\Activos\ActivoTecnologias\AdminAdmin\Agregartec;
use App\Livewire\ActivoFijo\Activos\ActivoTecnologias\AdminAdmin\Asignartec;
use App\Livewire\ActivoFijo\Activos\ActivoTecnologias\AdminAdmin\Editartec;
use App\Livewire\ActivoFijo\Activos\ActivoTecnologias\AdminAdmin\Mostrarasig;
use App\Livewire\ActivoFijo\Activos\ActivoTecnologias\AdminAdmin\Mostrartec;
use App\Livewire\ActivoFijo\Activos\ActivoTecnologias\AdminEmpresa\AgregarTecnologia;
use App\Livewire\ActivoFijo\Activos\ActivoTecnologias\AdminEmpresa\Asignartecem;
use App\Livewire\ActivoFijo\Activos\ActivoTecnologias\AdminEmpresa\EditarTecnologia;
use App\Livewire\ActivoFijo\Activos\ActivoTecnologias\AdminEmpresa\Mostrarasigntec;
use App\Livewire\ActivoFijo\Activos\ActivoTecnologias\AdminEmpresa\MostrarTecnologia;
use App\Livewire\ActivoFijo\Activos\ActivoTecnologias\AdminSucursal\Agregaracttec;
use App\Livewire\ActivoFijo\Activos\ActivoTecnologias\AdminSucursal\Asignartecsu;
use App\Livewire\ActivoFijo\Activos\ActivoTecnologias\AdminSucursal\Editaracttec;
use App\Livewire\ActivoFijo\Activos\ActivoTecnologias\AdminSucursal\Mostraracttec;
use App\Livewire\ActivoFijo\Activos\ActivoTecnologias\AdminSucursal\Mostrartecsu;
use App\Livewire\ActivoFijo\Activos\ActivoUniforme\AdminAdmin\Agregaruni;
use App\Livewire\ActivoFijo\Activos\ActivoUniforme\AdminAdmin\Asignaruni;
use App\Livewire\ActivoFijo\Activos\ActivoUniforme\AdminAdmin\Editaruni;
use App\Livewire\ActivoFijo\Activos\ActivoUniforme\AdminAdmin\Mostrarasignuni;
use App\Livewire\ActivoFijo\Activos\ActivoUniforme\AdminAdmin\Mostraruni;
use App\Livewire\ActivoFijo\Activos\ActivoUniforme\AdminEmpresa\AgregarUniforme;
use App\Livewire\ActivoFijo\Activos\ActivoUniforme\AdminEmpresa\Asignaruniem;
use App\Livewire\ActivoFijo\Activos\ActivoUniforme\AdminEmpresa\EditarUniforme;
use App\Livewire\ActivoFijo\Activos\ActivoUniforme\AdminEmpresa\Mostrarasignunie;
use App\Livewire\ActivoFijo\Activos\ActivoUniforme\AdminEmpresa\MostrarUniforme;
use App\Livewire\ActivoFijo\Activos\ActivoUniforme\AdminSucursal\Agregaractuni;
use App\Livewire\ActivoFijo\Activos\ActivoUniforme\AdminSucursal\Editaractuni;
use App\Livewire\ActivoFijo\Activos\ActivoUniforme\AdminSucursal\Mostraractuni;
use App\Livewire\ActivoFijo\InicioActivo;
use App\Livewire\ActivoFijo\TipoActivo\Agregartipoactivo;
use App\Livewire\ActivoFijo\TipoActivo\Editartipoactivo;
use App\Livewire\ActivoFijo\TipoActivo\Mostrartipoactivo;

use App\Livewire\ActivoFijo\Notas\Agregarnotas;
use App\Livewire\ActivoFijo\Notas\Editarnotas;
use App\Livewire\ActivoFijo\Notas\Mostrarnotaem;
use App\Livewire\ActivoFijo\Notas\Mostrarnotas;
use App\Livewire\ActivoFijo\Reportes\Admin\Reportepdfad;
use Illuminate\Support\Facades\Route;

Route::get('/principal', function () {
    return view('principal');
})->name('dashboardaf');

Route::get('af/inicio',InicioActivo::class)->name('inicio-activo');

Route::get('af/agregartipoactivo', Agregartipoactivo::class)->middleware('can:Tipo activo')->name('agregartipoactivo');
Route::get('af/mostrartipoactivo', Mostrartipoactivo::class)->middleware('can:Tipo activo')->name('mostrartipoactivo');
Route::get('af/editartipoactivo/{id}', Editartipoactivo::class)->middleware('can:Tipo activo')->name('editartipoactivo');

//Admin general Tecnologia
Route::get('af/agregaractivoad', Agregartec::class)->middleware('can:Activo tecnologia Admin')->name('agregartecad');
Route::get('af/mostraractivoad', Mostrartec::class)->middleware('can:Activo tecnologia Admin')->name('mostrartecad');
Route::get('af/editaractivoad/{id}', Editartec::class)->middleware('can:Activo tecnologia Admin')->name('editartecad');
Route::get('af/mostrarasigad', Mostrarasig::class)->middleware('can:Activo tecnologia Admin')->name('mostrarasignaad');
Route::get('af/asignartecad', Asignartec::class)->middleware('can:Activo tecnologia Admin')->name('asignartecad');


//Admin Empresa Tecnologia
Route::get('af/agregaractivoae', AgregarTecnologia::class)->middleware('can:Activo tecnologia Empresa')->name('agregartec');
Route::get('af/mostraractivoae', MostrarTecnologia::class)->middleware('can:Activo tecnologia Empresa')->name('mostrartec');
Route::get('af/editaractivoae/{id}', EditarTecnologia::class)->middleware('can:Activo tecnologia Empresa')->name('editartec');
Route::get('af/asignartecem', Asignartecem::class)->middleware('can:Activo tecnologia Empresa')->name('asignartecem');
Route::get('af/mostrarasigntecem', Mostrarasigntec::class)->middleware('can:Activo tecnologia Empresa')->name('mostrarasigntecem');



//Admin Sucursal Tecnologia
Route::get('af/mostraractivotec', Mostraracttec::class)->middleware('can:Activo tecnologia Sucursal')->name('mostraracttec');
Route::get('af/agregaractivotec', Agregaracttec::class)->middleware('can:Activo tecnologia Sucursal')->name('agregaracttec');
Route::get('af/editaractivotec/{id}', Editaracttec::class)->middleware('can:Activo tecnologia Sucursal')->name('editaracttec');
Route::get('af/asignartecsu', Asignartecsu::class)->middleware('can:Activo tecnologia Sucursal')->name('asignartecsu');
Route::get('af/mostrarasigntecsu', Mostrartecsu::class)->middleware('can:Activo tecnologia Sucursal')->name('mostrarasigntecsu');

//Administrador general Oficina
Route::get('af/mostraractivoofiad', Mostrarofi::class)->middleware('can:Activo oficina Admin')->name('mostrarofiad');
Route::get('af/agregaractivoofiad', Agregarofi::class)->middleware('can:Activo oficina Admin')->name('agregarofiad');
Route::get('af/editaractivoofiad/{id}', Editarofi::class)->middleware('can:Activo oficina Admin')->name('editarofiad');
Route::get('af/asignarofiad', Asignarofi::class)->middleware('can:Activo oficina Admin')->name('asignarofiad');
Route::get('af/mostrarasignofiad', Mostrarasignofi::class)->middleware('can:Activo oficina Admin')->name('mostrarasignofiad');


//Admin Empresa Oficina
Route::get('af/mostraractivoofiae', MostrarOficina::class)->middleware('can:Activo oficina Empresa')->name('mostrarofi');
Route::get('af/agregaractivoofiae', AgregarOficina::class)->middleware('can:Activo oficina Empresa')->name('agregarofi');
Route::get('af/editaractivoofiae/{id}', EditarOficina::class)->middleware('can:Activo oficina Empresa')->name('editarofi');
Route::get('af/asignarofiem', Asignarofiem::class)->middleware('can:Activo oficina Empresa')->name('asignarofiem');
Route::get('af/mostrarasignofiem', Mostrarasignofie::class)->middleware('can:Activo oficina Empresa')->name('mostrarasignofiem');


Route::get('af/mostraractivoofi', Mostraractofi::class)->middleware('can:Activo oficina Sucursal')->name('mostraractofi');
Route::get('af/agregaractivoofi', Agregaractofi::class)->middleware('can:Activo oficina Sucursal')->name('agregaractofi');
Route::get('af/editaractivoofi/{id}', Editaractofi::class)->middleware('can:Activo oficina Sucursal')->name('editaractofi');

//Administrador general Mobiliario
Route::get('af/agregaractivomobad', Agregarmob::class)->middleware('can:Activo mobiliario Admin')->name('agregarmobad');
Route::get('af/mostraractivomobad', Mostrarmob::class)->middleware('can:Activo mobiliario Admin')->name('mostrarmobad');
Route::get('af/editaractivomobad/{id}', Editarmob::class)->middleware('can:Activo mobiliario Admin')->name('editarmobad');
Route::get('af/mostraractivomobad', Mostrarmob::class)->middleware('can:Activo mobiliario Admin')->name('mostrarmobad');
Route::get('af/asignarmobad', Asignarmob::class)->middleware('can:Activo mobiliario Admin')->name('asignarmobad');
Route::get('af/mostrarasignmobad', Mostrarasignmob::class)->middleware('can:Activo mobiliario Admin')->name('mostrarasignmobad');

//Admin Empresa Mobiliario
Route::get('af/mostraractivomobae', MostrarMobiliario::class)->middleware('can:Activo mobiliario Empresa')->name('mostrarmob');
Route::get('af/agregaractivomobae', AgregarMobiliario::class)->middleware('can:Activo mobiliario Empresa')->name('agregarmob');
Route::get('af/editaractivomobae/{id}', EditarMobiliario::class)->middleware('can:Activo mobiliario Empresa')->name('editarmob');
Route::get('af/asignarmobem', Asignarmobem::class)->middleware('can:Activo mobiliario Empresa')->name('asignarmobem');
Route::get('af/mostrarasignmobem', Mostrarasignmobe::class)->middleware('can:Activo mobiliario Empresa')->name('mostrarasignmobem');

Route::get('af/mostraractivomob', Mostraractmob::class)->middleware('can:Activo mobiliario Sucursal')->name('mostraractmob');
Route::get('af/agregaractivomob', Agregaractmob::class)->middleware('can:Activo mobiliario Sucursal')->name('agregaractmob');
Route::get('af/editaractivomob/{id}', Editaractmob::class)->middleware('can:Activo mobiliario Sucursal')->name('editaractmob');

//Admin General Papeleria
Route::get('af/mostraractivopapead', Mostrarpape::class)->middleware('can:Activo papeleria Admin')->name('mostrarpapead');
Route::get('af/agregaractivopapead', Agregarpape::class)->middleware('can:Activo papeleria Admin')->name('agregarpapead');
Route::get('af/editaractivopapead/{id}', Editarpape::class)->middleware('can:Activo papeleria Admin')->name('editarpapead');
Route::get('af/asignarpapead', Asignarpape::class)->middleware('can:Activo papeleria Admin')->name('asignarpapead');
Route::get('af/mostrarasignpapead', Mostrarasignpape::class)->middleware('can:Activo papeleria Admin')->name('mostrarasignpapead');


//Admin Empresa Papeleria
Route::get('af/mostraractivopapeae', MostrarPapeleria::class)->middleware('can:Activo papeleria Empresa')->name('mostrarpape');
Route::get('af/agregaractivopapeae', AgregarPapeleria::class)->middleware('can:Activo papeleria Empresa')->name('agregarpape');
Route::get('af/editaractivopapeae/{id}', EditarPapeleria::class)->middleware('can:Activo papeleria Empresa')->name('editarpape');
Route::get('af/asignarpapeem', Asignarpapeem::class)->middleware('can:Activo papeleria Empresa')->name('asignarpapeem');
Route::get('af/mostrarasignpapeem', Mostrarasignpapee::class)->middleware('can:Activo papeleria Empresa')->name('mostrarasignpapeem');

Route::get('af/mostraractivopape', Mostraractpape::class)->middleware('can:Activo papeleria Sucursal')->name('mostraractpape');
Route::get('af/agregaractivopape', Agregaractpape::class)->middleware('can:Activo papeleria Sucursal')->name('agregaractpape');
Route::get('af/editaractivopape/{id}', Editaractpape::class)->middleware('can:Activo papeleria Sucursal')->name('editaractpape');

//Admin general Uniforme
Route::get('af/mostraractivouniad', Mostraruni::class)->middleware('can:Activo uniforme Admin')->name('mostraruniad');
Route::get('af/agregaractivouniad', Agregaruni::class)->middleware('can:Activo uniforme Admin')->name('agregaruniad');
Route::get('af/editaractivouniad/{id}', Editaruni::class)->middleware('can:Activo uniforme Admin')->name('editaruniad');
Route::get('af/asignaruniad', Asignaruni::class)->middleware('can:Activo uniforme Admin')->name('asignaruniad');
Route::get('af/mostrarasignuniad', Mostrarasignuni::class)->middleware('can:Activo uniforme Admin')->name('mostrarasignuniad');


//Admin Empresa Uniforme
Route::get('af/mostraractivouniae', MostrarUniforme::class)->middleware('can:Activo uniforme Empresa')->name('mostraruni');
Route::get('af/agregaractivouniae', AgregarUniforme::class)->middleware('can:Activo uniforme Empresa')->name('agregaruni');
Route::get('af/editaractivouniae/{id}', EditarUniforme::class)->middleware('can:Activo uniforme Empresa')->name('editaruni');
Route::get('af/asignaruniem', Asignaruniem::class)->middleware('can:Activo uniforme Empresa')->name('asignaruniem');
Route::get('af/mostrarasignuniem', Mostrarasignunie::class)->middleware('can:Activo uniforme Empresa')->name('mostrarasignuniem');

Route::get('af/mostraractivouni', Mostraractuni::class)->middleware('can:Activo uniforme Sucursal')->name('mostraractuni');
Route::get('af/agregaractivouni', Agregaractuni::class)->middleware('can:Activo uniforme Sucursal')->name('agregaractuni');
Route::get('af/editaractivouni/{id}', Editaractuni::class)->middleware('can:Activo uniforme Sucursal')->name('editaractuni');

//Admin general Souvenir
Route::get('af/mostraractivosouad', Mostrarsou::class)->middleware('can:Activo souvenir Admin')->name('mostrarsouad');
Route::get('af/agregaractivosouad', Agregarsou::class)->middleware('can:Activo souvenir Admin')->name('agregarsouad');
Route::get('af/editaractivosouad/{id}', Editarsou::class)->middleware('can:Activo souvenir Admin')->name('editarsouad');
Route::get('af/asignarsouad', Asignarsou::class)->middleware('can:Activo souvenir Admin')->name('asignarsouad');
Route::get('af/mostrarasignsouad', Mostrarasignsou::class)->middleware('can:Activo souvenir Admin')->name('mostrarasignsouad');

//Admin Empresa Souvenir
Route::get('af/mostraractivosouae', MostrarSouvenir::class)->middleware('can:Activo souvenir Empresa')->name('mostrarsou');
Route::get('af/agregaractivosouae', AgregarSouvenir::class)->middleware('can:Activo souvenir Empresa')->name('agregarsou');
Route::get('af/editaractivosouae/{id}', EditarSouvenir::class)->middleware('can:Activo souvenir Empresa')->name('editarsou');
Route::get('af/asignarsouem', Asignarsouem::class)->middleware('can:Activo souvenir Empresa')->name('asignarsouem');
Route::get('af/mostrarasignsouem', Mostrarasignsoue::class)->middleware('can:Activo souvenir Empresa')->name('mostrarasignsouem');

Route::get('af/mostraractivosou', Mostraractsou::class)->middleware('can:Activo souvenir Sucursal')->name('mostraractsou');
Route::get('af/agregaractivosou', Agregaractsou::class)->middleware('can:Activo souvenir Sucursal')->name('agregaractsou');
Route::get('af/editaractivosou/{id}', Editaractsou::class)->middleware('can:Activo souvenir Sucursal')->name('editaractsou');

// Route::get('af/agregarnotatec', Agregarnotas::class)->name('agregarnotas');
Route::get('af/mostrarnotatec', Mostrarnotas::class)->name('mostrarnotas');
Route::get('af/mostrarnotatecem', Mostrarnotaem::class)->name('mostrarnotaem');
Route::get('af/mostrarnotatecad', Mostrarnotaem::class)->name('mostrarnotaad');
Route::get('af/editarnotatec', Editarnotas::class)->name('editarnotas');

//Reportes PDF
Route::get('/export-asignacion-pdf/{asignacionId}', [PdfExportController::class, 'exportAsignacion'])
    ->name('export.asignacion.pdf');