<?php

namespace App\Livewire\ActivoFijo\Reportes\Admin;

use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Reportepdfad extends Component
{
    public $asignacionId;

    public function mount($asignacionId)
    {
        $this->asignacionId = $asignacionId;
        return $this->generatePdf(); // Devolvemos la respuesta directamente
    }

    public function generatePdf()
    {
        $data = DB::table('activos_tecnologia_user')
            ->join('users', 'activos_tecnologia_user.user_id', '=', 'users.id')
            ->join('activos_tecnologias', 'activos_tecnologia_user.activos_tecnologias_id', '=', 'activos_tecnologias.id')
            ->join('sucursales', 'activos_tecnologias.sucursal_id', '=', 'sucursales.id')
            ->join('empresa_sucursal', 'sucursales.id', '=', 'empresa_sucursal.sucursal_id')
            ->join('empresas', 'empresa_sucursal.empresa_id', '=', 'empresas.id')
            ->select([
                'activos_tecnologia_user.id',
                'users.name as usuario',
                'activos_tecnologias.nombre as activo',
                'sucursales.nombre_sucursal as sucursal',
                'empresas.nombre as empresa',
                'activos_tecnologia_user.fecha_asignacion',
                'activos_tecnologia_user.fecha_devolucion',
                'activos_tecnologia_user.observaciones',
                'activos_tecnologia_user.status',
                'activos_tecnologia_user.foto1',
                'activos_tecnologia_user.foto2',
                'activos_tecnologia_user.foto3',
            ])
            ->where('activos_tecnologia_user.id', $this->asignacionId)
            ->first();

        if (!$data) {
            abort(404, 'Asignación no encontrada');
        }

        $pdf = Pdf::loadView('livewire.activo-fijo.pdf.asignacion-activo', [ // Ajustamos la referencia aquí
            'data' => $data
        ]);

        return response()->streamDownload(
            fn() => print($pdf->output()),
            "asignacion_{$data->activo}_" . Carbon::now()->format('Ymd_His') . ".pdf"
        );
    }
    public function render()
    {
        return view('livewire.activo-fijo.reportes.admin.reportepdfad')->layout('layouts.navactivos');
    }
}
