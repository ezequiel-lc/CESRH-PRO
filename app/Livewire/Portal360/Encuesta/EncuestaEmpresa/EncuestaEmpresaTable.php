<?php

namespace App\Livewire\Portal360\Encuesta\EncuestaEmpresa;

use App\Models\Encuestas360\Encuesta360;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Crypt;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Facades\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use Illuminate\Support\Facades\Auth;
use PowerComponents\LivewirePowerGrid\Components\SetUp\Exportable;
use PowerComponents\LivewirePowerGrid\Traits\WithExport; // Agregado para exportación

final class EncuestaEmpresaTable extends PowerGridComponent
{
    public string $tableName = 'encuesta-empresa-table-1ffata-table';
    use WithExport; // Agrega el trait para habilitar la exportación

    public function setUp(): array
    {
        $this->showCheckBox();

        return [
            PowerGrid::header()
                ->showSearchInput(),
            PowerGrid::footer()
                ->showPerPage()
                ->showRecordCount(),
            PowerGrid::exportable('encuestas_empresa') // Agrega exportación con nombre de archivo
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV), // Formatos Excel y CSV
        ];
    }

    public function datasource(): Builder
    {
        return Encuesta360::query()
            ->join('sucursales', 'sucursales.id', '=', '360_encuestas.sucursal_id')
            ->select('360_encuestas.*', 'sucursales.nombre_sucursal as sucursal_nombre')
            ->where('360_encuestas.empresa_id', Auth::user()->empresa_id);
    }

    public function relationSearch(): array
    {
        return [
            'sucursal' => [
                'nombre_sucursal',
            ],
        ];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('nombre')
            ->add('descripcion')
            ->add('indicaciones')
            ->add('sucursal_nombre')
            ->add('created_at');
    }

    public function columns(): array
    {
        return [
            Column::make('Id', 'id'),
            Column::make('Nombre', 'nombre')
                ->sortable()
                ->searchable(),

            Column::make('Descripcion', 'descripcion')
                ->sortable()
                ->searchable(),

            Column::make('Indicaciones', 'indicaciones')
                ->sortable()
                ->searchable(),

            Column::make('Sucursal', 'sucursal_nombre')
                ->sortable()
                ->searchable(),

            Column::action('Action')
        ];
    }

    public function filters(): array
    {
        return [];
    }

    #[\Livewire\Attributes\On('edit')]
    public function edit($rowId): void
    {
        $this->js('alert(' . $rowId . ')');
    }

    public function actions(Encuesta360 $row): array
    {
        
        return [
            Button::add('edit')
                ->slot('<svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 inline-block mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M17.414 2.586a2 2 0 0 1 0 2.828l-10 10A2 2 0 0 1 6 16H4a1 1 0 0 1-1-1v-2a2 2 0 0 1 .586-1.414l10-10a2 2 0 0 1 2.828 0zM5 13v2h2l10-10-2-2L5 13z"/>
                        </svg> Editar') 
                ->class('bg-blue-500 hover:bg-blue-700 text-white font-semibold py-2 px-3 rounded-lg shadow-md transition-all duration-300 flex items-center')
                ->route('editarEncuestadevEmpresa', ['id' => Crypt::encrypt($row->id)]),
    
            Button::add('delete')
                ->slot('<svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 inline-block mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M6 2a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v1h3a1 1 0 1 1 0 2h-1v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5H2a1 1 0 1 1 0-2h3V2zm2 1v1h4V3H8zM5 5v11h10V5H5zm3 3a1 1 0 0 1 2 0v5a1 1 0 0 1-2 0V8zm4 0a1 1 0 0 1 2 0v5a1 1 0 0 1-2 0V8z" clip-rule="evenodd"/>
                        </svg> Eliminar') 
                ->class('bg-red-500 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded-lg shadow-md transition-all duration-300 flex items-center')
                ->dispatch('confirmarEliminarEncuestaEmpresa', ['id' => Crypt::encrypt($row->id)]),
        ];
    }

    
}
