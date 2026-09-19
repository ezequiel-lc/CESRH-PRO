<?php

namespace App\Livewire\ActivoFijo\Modales;

use App\Models\ActivoFijo\Activos\ActivoTecnologia;
use App\Models\ActivoFijo\Notatecno;
use Illuminate\Support\Facades\Auth;
use LivewireUI\Modal\ModalComponent;

class AgregarNota extends ModalComponent
{
    public $notadescripcion; // Descripción de la nota
    public $activosTecnologiaSeleccionados = null; // Activo de tecnología seleccionado
    public $activosTecnologia = []; // Lista de activos de tecnología filtrados por sucursal

    public function mount()
    {
        // Cargar los activos de tecnología de la sucursal del usuario
        $this->cargarActivosTecnologia();
    }

    /**
     * Carga los activos de tecnología de la sucursal del usuario autenticado.
     */
    protected function cargarActivosTecnologia()
    {
        // Obtener el usuario autenticado
        $user = Auth::user();

        // Filtrar los activos de tecnología por la sucursal del usuario
        $this->activosTecnologia = ActivoTecnologia::where('sucursal_id', $user->sucursal_id)->get();
    }

    protected $rules = [
        'notadescripcion' => 'required|string', // La descripción es obligatoria
        'activosTecnologiaSeleccionados' => 'required|exists:activos_tecnologias,id', // El activo seleccionado debe existir
    ];

    protected $validationAttributes = [
        'notadescripcion' => 'Descripción',
        'activosTecnologiaSeleccionados' => 'Activos de Tecnología',
    ];

    /**
     * Guarda la nota y la asocia con el activo de tecnología seleccionado.
     */
    public function agregarNotatec()
    {
        // Validar los datos del formulario
        $this->validate();

        // Crear la nota
        $nota = Notatecno::create([
            'descripcion' => $this->notadescripcion,
        ]);

        // Asociar el activo de tecnología seleccionado a través de la tabla pivote
        if ($this->activosTecnologiaSeleccionados) {
            $nota->activosTecnologias()->attach($this->activosTecnologiaSeleccionados);
        }

        // Cerrar el modal y redirigir
        $this->closeModal();
        return redirect()->route('mostrarnotas');
    }
    public function render()
    {
        return view('livewire.activo-fijo.modales.agregarnota');
    }
}
