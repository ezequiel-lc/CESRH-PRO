<?php

namespace App\Livewire\PortalCapacitacion\Cursos\Cursos\AdminGeneral;

use App\Models\PortalCapacitacion\Curso;
use Illuminate\Support\Carbon;
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

final class CursoTable extends PowerGridComponent
{
    public string $tableName = 'curso-table';

    public function setUp(): array
    {
        $this->showCheckBox();

        return [
            PowerGrid::header()
                ->showSearchInput(),
            PowerGrid::footer()
                ->showPerPage()
                ->showRecordCount(),
            PowerGrid::exportable(fileName: 'cursos-export-file') 
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV), 
        ];
    }

    public function datasource(): Builder
    {
        return Curso::query()
            ->join('empresas', 'empresas.id', '=', 'cursos.empresa_id')
            ->join('sucursales', 'sucursales.id', '=', 'cursos.sucursal_id')
            ->join('tematicas', 'tematicas.id', '=', 'cursos.tematicas_id') // 🔹 Usa LEFT JOIN por si hay cursos sin temática
            ->select([
                'cursos.id',
                'cursos.nombre',
                'cursos.horas',
                'cursos.precio',
                'cursos.tipoestatus',
                'cursos.modalidad',
                'empresas.nombre as empresa_nombre',
                'sucursales.nombre_sucursal as sucursal_nombre',
                'tematicas.nombre as tematicas_nombre' // 🔹 Asegúrate de que el campo existe
            ]);
    }


    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('nombre')
            ->add('horas')
            ->add('precio')
            ->add('tipoestatus')
            ->add('modalidad')
            ->add('empresa_nombre')
            ->add('sucursal_nombre')
            ->add('tematica_nombre'); // 🔹 Agregar el nombre de la temática en lugar del ID
    }

    public function columns(): array
    {
        return [
            Column::make('Nombre', 'nombre')
                ->sortable()
                ->searchable(),
            Column::make('Horas', 'horas')
                ->sortable()
                ->searchable(),
            Column::make('Precio', 'precio')
                ->sortable()
                ->searchable(),
            Column::make('Tipo Estatus', 'tipoestatus')
                ->sortable()
                ->searchable(),
            Column::make('Tematicas id', 'tematicas_nombre')
                ->sortable()
                ->searchable(),
            Column::make('Modalidad', 'modalidad')
                ->sortable(),
            Column::make('Empresa id', 'empresa_nombre')
                ->sortable(),
            Column::make('Sucursal id', 'sucursal_nombre')
                ->sortable(),
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

    public function actions(Curso $row): array
    {
        return [
            Button::add('edit')
                ->slot('Editar')
                ->class('bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded')
                ->route('editarCursos', ['id' => Crypt::encrypt($row->id)]),

            Button::add('delete')
                ->slot('Eliminar')
                ->class('bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded')
                ->dispatch('confirmDelete', ['id' => $row->id]),
        ];
    }

    /*
    public function actionRules($row): array
    {
       return [
            // Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($row) => $row->id === 1)
                ->hide(),
        ];
    }
    */
}
