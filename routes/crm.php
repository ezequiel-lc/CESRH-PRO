<?php

use App\Livewire\Crm\CrmEmpresa\Agregar\AgregarEmpresa;
use App\Livewire\Crm\CrmEmpresa\Editar\EditarEmpresa;
use App\Livewire\Crm\CrmEmpresa\Eliminar\EliminarEmpresa;
use App\Livewire\Crm\CrmEmpresa\Mostrar\MostrarEmpre;
use App\Livewire\Crm\DatosFiscale\Agregar\AgregarDatosFiscale;
use App\Livewire\Crm\DatosFiscale\Editar\EditarDatosFisc;
use App\Livewire\Crm\DatosFiscale\Eliminar\EliminarDatosFisc;
use App\Livewire\Crm\DatosFiscale\Mostrar\MostrarDatosFisc;
use App\Livewire\Crm\Inicio;
use App\Livewire\Crm\Leads\Vistaprincipal;
use App\Livewire\DatosFiscalesTable;
use App\Livewire\LeadsCliente;
use App\Livewire\Portal360\EliminarRolesDev;
use App\Livewire\PortalRh\Empres\MostrarEmpres;
use App\Models\Crm\DatosFiscale;
use Illuminate\Support\Facades\Route;

Route::get(
    '/crm-inicio',
        Inicio::class
)->name('InicioCrm');

Route::get(
    '/crm-createempresa',
    AgregarEmpresa::class
)->name('Createcrm');

Route::get(
    '/crm-mostrarEmpresa',
        MostrarEmpre::class
)->name('mostrarEmpresaCrm');

Route::get(
    '/crm-editempresa/{id}',
    EditarEmpresa::class
)->name('EditEmpresa');

Route::post(
    '/crm-deleteEmpresa/{id}',
    EliminarEmpresa::class
)->name('EliminarEmpresa');

Route::get(
    '/crm-registrarDatosFiscales',
    AgregarDatosFiscale::class
)->name('registra_datos_fiscales');

Route::get(
    '/crm-mostrarDatosFiscales',
    MostrarDatosFisc::class
)->name('mostrarDatosFiscales');

Route::get(
    '/crm-editarDatosFiscales/{id}',
    EditarDatosFisc::class
)->name('editDato');

Route::post(
    '/crm-deleteDato/{id}',
    EliminarDatosFisc::class,
)->name('EliminarDato');

Route::get('/crm-deleteDato', [MostrarDatosFisc::class, 'deleteDato'])->name('confirmDeleteDato');

Route::get(
    '/crm-leads',
    Vistaprincipal::class,
)->name('Leads');