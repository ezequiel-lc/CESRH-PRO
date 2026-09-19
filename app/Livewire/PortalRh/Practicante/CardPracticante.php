<?php

namespace App\Livewire\PortalRh\Practicante;

use Livewire\Component;
use App\Models\PortalRH\Practicante;
use App\Models\User;
use App\Models\PortalRH\RegistroPatronal;
use App\Models\PortalRH\Empresa;
use App\Models\PortalRH\Sucursal;
use App\Models\PortalRH\Departamento;
use App\Models\PortalRH\Puesto;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Response;
use Barryvdh\DomPDF\Facade\Pdf;

class CardPracticante extends Component
{
    public $practicante, $usuario, $empresa, $sucursal, $departamento,
    $puesto, $registro_patronal, $incapacidades, $incidencias;

    public function mount($id)
    {
        $id = Crypt::decrypt($id);
        $this->practicante = Practicante::findOrFail($id);
        $this->usuario = User::find($this->practicante->user_id);
        $this->empresa = Empresa::find($this->usuario->empresa_id);
        $this->sucursal = Sucursal::find($this->usuario->sucursal_id);
        $this->departamento = Departamento::find($this->usuario->departamento_id);
        $this->puesto = Puesto::find($this->usuario->puesto_id);
        $this->registro_patronal = RegistroPatronal::find($this->practicante->registro_patronal_id);
        $this->incapacidades = $this->usuario->incapacidades()->with('users')->get();
        $this->incidencias = $this->usuario->incidencias()->with('users')->get();

    } 

    public function generatePDF($id)
    {
        // Obtener el practicante
        $practicante = Practicante::findOrFail($id);

        // Obtener las relaciones
        $usuario = User::find($practicante->user_id);
        $empresa = Empresa::find($usuario->empresa_id);
        $sucursal = Sucursal::find($usuario->sucursal_id);
        $departamento = Departamento::find($usuario->departamento_id);
        $puesto = Puesto::find($usuario->puesto_id);
        $registro_patronal = RegistroPatronal::find($practicante->registro_patronal_id);
        $incapacidades = $this->usuario->incapacidades()->with('users')->get();
        $incidencias = $this->usuario->incidencias()->with('users')->get();

        // Generar el PDF con todos los datos
        $pdf = Pdf::setPaper('letter')
            ->setOptions([
                'dpi' => 150,
                'isRemoteEnabled' => true,
            ])
            ->loadView('livewire.portal-rh.practicante.reporte-practicante', [
                'practicante' => $practicante,
                'usuario' => $usuario,
                'empresa' => $empresa,
                'sucursal' => $sucursal,
                'departamento' => $departamento,
                'puesto' => $puesto,
                'registro_patronal' => $registro_patronal,
                'incapacidades' => $incapacidades,
                'incidencias' => $incidencias
            ]);

        return Response::stream(
            function () use ($pdf) {
                echo $pdf->output();
            },
            200,
            [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline; filename=Reporte_' . $practicante->clave_practicante . '.pdf',
            ]
        );

        return redirect()->refresh();
    }

    public function render()
    {
        return view('livewire.portal-rh.practicante.card-practicante')->layout('layouts.client');
    }
}
