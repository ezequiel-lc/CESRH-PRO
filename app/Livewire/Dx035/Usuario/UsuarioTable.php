<?php

namespace App\Livewire\Dx035\Usuario;

use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Facades\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;

use Illuminate\Support\Facades\Crypt;
use PowerComponents\LivewirePowerGrid\Traits\WithExport;
use PowerComponents\LivewirePowerGrid\Components\SetUp\Exportable;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

final class UsuarioTable extends PowerGridComponent
{
    use WithExport;

    public string $tableName = 'usuario-table-t29jwl-table';

    public function setUp(): array
    {
        $this->showCheckBox();

        return [
            PowerGrid::header()
                ->showSearchInput(), // Habilitar búsqueda
            PowerGrid::footer()
                ->showPerPage() // Mostrar selector de items por página
                ->showRecordCount(), // Mostrar el contador de registros
        ];
    }

    public function datasource(): Builder
    {
        $user = Auth::user();

        $query = User::query()
            ->leftJoin('empresas', 'users.empresa_id', '=', 'empresas.id')
            ->leftJoin('sucursales', 'users.sucursal_id', '=', 'sucursales.id')
            ->leftJoin('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
            ->leftJoin('roles', 'model_has_roles.role_id', '=', 'roles.id')
            ->select([
                'users.*',
                DB::raw('COALESCE(empresas.nombre, "Sin Empresa") as empresa'),
                DB::raw('COALESCE(sucursales.nombre_sucursal, "Sin Sucursal") as sucursal'),
                DB::raw('COALESCE(roles.name, "Sin Rol") as rol'),
            ]);

        // 🔹 Filtrar según el rol del usuario
        if ($user->hasRole('GoldenAdmin')) {
            // GoldenAdmin puede ver todos los usuarios
        } elseif ($user->hasRole('EmpresaAdmin')) {
            $query->where('users.empresa_id', $user->empresa_id); // Solo usuarios de su empresa
        } elseif ($user->hasRole('SucursalAdmin')) {
            $query->where('users.sucursal_id', $user->sucursal_id); // Solo usuarios de su sucursal
        } elseif ($user->hasRole('Trabajador NOM035')) {
            $query->where('users.id', $user->id); // Solo el propio usuario
        }

        return $query;
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('name')
            ->add('email')
            ->add('empresa')
            ->add('sucursal')
            ->add('rol')
            ->add('created_at')
            ->add('updated_at');
    }

    public function columns(): array
    {
        return [
            Column::make('Id', 'id'),
            Column::make('Nombre', 'name')
                ->sortable()
                ->searchable(),

            Column::make('Email', 'email')
                ->sortable()
                ->searchable(),

            Column::make('Rol', 'rol')
                ->sortable()
                ->searchable(),

            Column::make('Empresa', 'empresa')
                ->sortable()
                ->searchable(),

            Column::make('Sucursal', 'sucursal')
                ->sortable()
                ->searchable(),

            Column::make('Creado el', 'created_at')
                ->sortable()
                ->searchable(),

            Column::make('Actualizado el', 'updated_at')
                ->sortable()
                ->searchable(),

            Column::action('Acciones')
        ];
    }

    public function actions(User $row): array
    {
        $actions = [];

        // Botón para asignar roles
        if (Auth::user()->hasRole('GoldenAdmin') || Auth::user()->hasRole('EmpresaAdmin')) {
            $actions[] = Button::add('asignar-roles')
                ->slot('Asignar Rol')
                ->class('bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded')
                ->route('asignarroluser', ['id' => Crypt::encrypt($row->id)]);
        }

        // Botón para eliminar
        if (Auth::user()->hasRole('GoldenAdmin')) {
            $actions[] = Button::add('delete')
                ->slot('Eliminar')
                ->class('bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded')
                ->dispatch('confirmDelete', ['id' => $row->id]);
        }

        return $actions;
    }
}