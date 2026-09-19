<?php

namespace App\Http\Controllers\ActivoFijo\Reportes;

use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PdfExportController extends Controller
{
    public function exportAsignacion($asignacionId)
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
                'users.email as correo', // Agregamos el correo
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
            ->where('activos_tecnologia_user.id', $asignacionId)
            ->first();

        if (!$data) {
            abort(404, 'Asignación no encontrada');
        }

        $pdf = Pdf::loadView('livewire.activo-fijo.pdf.asignacion-activo', [
            'data' => $data
        ]);

        return $pdf->download("asignacion_{$data->activo}_" . Carbon::now()->format('Ymd_His') . ".pdf");
    }
}
