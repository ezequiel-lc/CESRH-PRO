<?php

namespace App\Livewire\PortalRh\Cumpleanios;

use Livewire\Component;
use App\Models\User;
use App\Models\PortalRH\Trabajador;
use App\Models\PortalRH\Becario;
use App\Models\PortalRH\Practicante;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class VerCumpleanios extends Component
{
    public $cumpleaniosCalendario = [];

    public function mount()
    {
        $user = Auth::user();

        // Obtener el rol del usuario autenticado desde model_has_roles
        $rol = DB::table('model_has_roles')
            ->join('roles', 'model_has_roles.role_id', '=', 'roles.id') // Aquí se usa role_id en vez de roles_id
            ->where('model_has_roles.model_id', $user->id)
            ->value('roles.name');

        // Dependiendo del rol, obtener los usuarios adecuados
        $query = User::query()
            ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
            ->join('roles', 'model_has_roles.role_id', '=', 'roles.id');

        if ($rol !== 'GoldenAdmin') {
            if ($rol === 'EmpresaAdmin') {
                // Filtrar usuarios de la misma empresa
                $query->where('users.empresa_id', $user->empresa_id);
            } elseif ($rol === 'SucursalAdmin') {
                // Filtrar usuarios que pertenezcan a la misma empresa y misma sucursal
                $query->where('users.empresa_id', $user->empresa_id)
                      ->where('users.sucursal_id', $user->sucursal_id);
            }
        }

        // Obtener los usuarios según el rol
        $usuarios = $query->select('users.*')->get();

        // Obtener cumpleaños de trabajadores, becarios y practicantes
        $cumpleanios = [];

        foreach ($usuarios as $usuario) {
            $trabajador = Trabajador::where('user_id', $usuario->id)->first();
            $becario = Becario::where('user_id', $usuario->id)->first();
            $practicante = Practicante::where('user_id', $usuario->id)->first();

            $fecha_nacimiento = $trabajador?->fecha_nacimiento ?? $becario?->fecha_nacimiento ?? $practicante?->fecha_nacimiento;

            if ($fecha_nacimiento) {
                $cumpleanios[] = [
                    'title' => "🎂 {$usuario->name}",
                    'start' => date('Y') . '-' . date('m-d', strtotime($fecha_nacimiento)), // Fecha en el año actual
                    'color' => '#FFD700', // Amarillo dorado para cumpleaños
                    'name' => $usuario->name // Nombre del usuario para mostrar en tooltip
                ];
            }
        }

        $this->cumpleaniosCalendario = $cumpleanios;
    }

    public function render()
    {
        return view('livewire.portal-rh.cumpleanios.ver-cumpleanios', [
            'eventosCalendario' => $this->cumpleaniosCalendario,
        ])->layout('layouts.client');
    }
}
