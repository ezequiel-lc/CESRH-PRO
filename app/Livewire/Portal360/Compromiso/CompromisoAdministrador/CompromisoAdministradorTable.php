<?php

namespace App\Livewire\Portal360\Compromiso\CompromisoAdministrador;

use App\Models\Encuestas360\Compromiso;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Crypt;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Components\SetUp\Exportable;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Facades\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\Traits\WithExport;

final class CompromisoAdministradorTable extends PowerGridComponent
{
    public string $tableName = 'compromiso-administrador-table-qhvs6b-table';
    use WithExport; // Agregar el trait WithExport

    public function setUp(): array
    {
        $this->showCheckBox();

        return [
            PowerGrid::exportable('Compromisos_Administrador_' . now()->format('Ymd_His')) // Configurar exportación
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV), // Formatos XLS y CSV
            PowerGrid::header()
                ->showSearchInput(),
            PowerGrid::footer()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    public function datasource(): Builder
    {
        // return Compromiso::query();
        return Compromiso::query()
            ->with(['user', 'pregunta']);
    }

    public function relationSearch(): array
    {
        return [
            'user' => ['name'], // Buscar en la relación user por nombre
            'pregunta' => ['texto'], // Buscar en la relación pregunta por texto
        ];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
        ->add('id')
        ->add('alta_formatted', fn(Compromiso $model) => Carbon::parse($model->alta)->format('d/m/Y'))
        ->add('vencimiento_formatted', fn(Compromiso $model) => Carbon::parse($model->vencimiento)->format('d/m/Y'))
        ->add('compromiso')
        ->add('verificado', fn(Compromiso $model) => $model->verificado ? 'Sí' : 'No') // Transforma 0/1 a No/Sí
        ->add('user_name', fn(Compromiso $model) => $model->user ? $model->user->name : 'Sin usuario')
        ->add('pregunta_texto', fn(Compromiso $model) => $model->pregunta ? $model->pregunta->texto : 'Sin pregunta')
        ->add('created_at');
    }

    public function columns(): array
    {
        return [
            Column::make('Id', 'id'),
            Column::make('Alta', 'alta_formatted', 'alta')
                ->sortable(),

            Column::make('Vencimiento', 'vencimiento_formatted', 'vencimiento')
                ->sortable(),

            Column::make('Compromiso', 'compromiso')
                ->sortable()
                ->searchable(),

            Column::make('Verificado', 'verificado')
                ->sortable()
                ->searchable(),

            Column::make('Usuario', 'user_name') // Mostrar el nombre del usuario
                ->sortable()
                ->searchable(),

            Column::make('Pregunta', 'pregunta_texto') // Mostrar el texto de la pregunta
                ->sortable()
                ->searchable(),

            Column::make('Created at', 'created_at')
                ->sortable()
                ->searchable(),

            Column::action('Action')
        ];
    }

    public function filters(): array
    {
        return [
            // Filter::datepicker('alta'),
            // Filter::datepicker('vencimiento'),
        ];
    }

    #[\Livewire\Attributes\On('edit')]
    public function edit($rowId): void
    {
        $this->js('alert(' . $rowId . ')');
    }

    public function actions(Compromiso $row): array
    {
        return [
            Button::add('edit')
                ->slot('<svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 inline-block mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M17.414 2.586a2 2 0 0 1 0 2.828l-10 10A2 2 0 0 1 6 16H4a1 1 0 0 1-1-1v-2a2 2 0 0 1 .586-1.414l10-10a2 2 0 0 1 2.828 0zM5 13v2h2l10-10-2-2L5 13z"/>
                        </svg> Editar')
                ->class('bg-blue-500 hover:bg-blue-700 text-white font-semibold py-2 px-3 rounded-lg shadow-md transition-all duration-300 flex items-center')
                ->route('editarCompromisoAdministrador', ['id' => $row->id]),

                Button::add('delete')
                ->slot('<svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 inline-block mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M6 2a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v1h3a1 1 0 1 1 0 2h-1v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5H2a1 1 0 1 1 0-2h3V2zm2 1v1h4V3H8zM5 5v11h10V5H5zm3 3a1 1 0 0 1 2 0v5a1 1 0 0 1-2 0V8zm4 0a1 1 0 0 1 2 0v5a1 1 0 0 1-2 0V8z" clip-rule="evenodd"/>
                        </svg> Eliminar')
                ->class('bg-red-500 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded-lg shadow-md transition-all duration-300 flex items-center')
                ->dispatch('confirmarEliminarCompromisoAdministrador', ['id' => Crypt::encrypt($row->id)]),
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
