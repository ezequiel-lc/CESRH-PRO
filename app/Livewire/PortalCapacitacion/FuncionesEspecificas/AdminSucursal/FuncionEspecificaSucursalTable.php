<?php

namespace App\Livewire\PortalCapacitacion\FuncionesEspecificas\AdminSucursal;

use App\Models\PortalCapacitacion\FuncionEspecifica;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Facades\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\PowerGridFields;

use Illuminate\Support\Facades\Crypt;

use PowerComponents\LivewirePowerGrid\Traits\WithExport; 
use PowerComponents\LivewirePowerGrid\Components\SetUp\Exportable; 

final class FuncionEspecificaSucursalTable extends PowerGridComponent
{
    use WithExport;

    public string $tableName = 'funcion-especifica-table';

    public function setUp(): array
    {
        $this->showCheckBox();

        return [
            PowerGrid::header()
                ->showSearchInput(),
            PowerGrid::footer()
                ->showPerPage()
                ->showRecordCount(),
            PowerGrid::exportable(fileName: 'funcionesEspecificas-export-file') 
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV), 
        ];
    }

    /**
     * Origen de datos de la tabla
     */
    public function datasource(): Builder
    {
        $user = auth()->user(); // Obtiene el usuario autenticado

        return FuncionEspecifica::query()
            ->join('empresas', 'empresas.id', 'funciones_esp.empresa_id')
            ->join('sucursales', 'sucursales.id', 'funciones_esp.sucursal_id')
            ->select(
                'funciones_esp.id', 
                'funciones_esp.nombre', 
                'empresas.nombre as empresa_nombre',
                'sucursales.nombre_sucursal as sucursal_nombre'
            )
            ->where('funciones_esp.empresa_id', $user->empresa_id) // Filtra por empresa
            ->where('funciones_esp.sucursal_id', $user->sucursal_id); // Filtra por sucursal
    }


    /**
     * Relación de búsqueda para las columnas (si aplica)
     */
    public function relationSearch(): array
    {
        return [];
    }

    /**
     * Definición de las columnas de datos
     */
    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('nombre');
    }

    /**
     * Definición de columnas y sus estilos
     */
    public function columns(): array
    {
        return [
            Column::make('Nombre', 'nombre')
                ->sortable()
                ->searchable(),

            Column::action('Action')
        ];
    }

    public function filters(): array
    {
        return [
        ];
    }

    #[\Livewire\Attributes\On('edit')]
    public function edit($rowId): void
    {
        $this->js('alert('.$rowId.')');
    }

    /**
     * Configuración de botones de acción (Editar y Eliminar)
     */
    public function actions(FuncionEspecifica $row): array
    {
        return [
            Button::add('edit')
                ->slot('Editar')
                ->class('bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded')
                ->route('editarFuncionesEspecificasSucursal', ['id' => Crypt::encrypt($row->id)]),

            Button::add('delete')
                ->slot('Eliminar')
                ->class('bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded')
                ->dispatch('confirmDelete', ['id' => $row->id]),
        ];
    }
}
