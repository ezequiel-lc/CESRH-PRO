<?php

namespace App\Livewire\Portal360\Encuesta\EncuestaSucursal;

use App\Models\Encuestas360\Encuesta360;
use App\Models\PortalRH\Empresa;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Livewire\Component;

class EditarEncuestaSucursal extends Component
{
    public $encuesta = [
        'nombre' => '',
        'descripcion' => '',
        'indicaciones' => '',
    ];

    public $encuestaId;
    public $sucursales = []; // Definir la propiedad para sucursales

    public function mount($id)
    {
        // Descifrar el ID de la encuesta
        $this->encuestaId = Crypt::decrypt($id);

        // Cargar la encuesta existente
        $encuesta = Encuesta360::findOrFail($this->encuestaId);

        // Verificar que la encuesta pertenezca a la empresa y sucursal del usuario
        if ($encuesta->empresa_id !== Auth::user()->empresa_id || 
            $encuesta->sucursal_id !== Auth::user()->sucursal_id) {
            abort(403, 'No tienes permiso para editar esta encuesta');
        }

        // Llenar los datos de la encuesta en el formulario
        $this->encuesta = $encuesta->toArray();

        // Cargar sucursales de la empresa del usuario autenticado
        $empresa = Empresa::find(Auth::user()->empresa_id);
        $this->sucursales = $empresa->sucursales()
            ->select('sucursales.id', 'sucursales.nombre_sucursal')
            ->get();
    }

    protected $rules = [
        'encuesta.nombre' => 'required|min:3',
        'encuesta.descripcion' => 'required|min:5',
        'encuesta.indicaciones' => 'required|min:5',
    ];

    protected $messages = [
        'encuesta.nombre.required' => 'El nombre es obligatorio y debe tener al menos 3 caracteres.',
        'encuesta.descripcion.required' => 'La descripción es obligatoria y debe tener al menos 5 caracteres.',
        'encuesta.indicaciones.required' => 'Las indicaciones son obligatorias y deben tener al menos 5 caracteres.',
    ];

    public function updateEncuestaSucursal()
    {
        $this->validate();

        try {
            // Buscar la encuesta existente
            $encuestaExistente = Encuesta360::findOrFail($this->encuestaId);

            // Actualizar la encuesta
            $encuestaExistente->update([
                'nombre' => $this->encuesta['nombre'],
                'descripcion' => $this->encuesta['descripcion'],
                'indicaciones' => $this->encuesta['indicaciones'],
            ]);

            // Mostrar mensaje de éxito
            $this->dispatch('toastr-success', message: 'Encuesta Actualizada Correctamente.');

            // Redirigir a la lista de encuestas
            return redirect()->route('portal360.encuesta.encuesta-sucursal.mostrar-encuesta-sucursal');
        } catch (\Exception $e) {
            // Mostrar mensaje de error
            $this->dispatch('toastr-error', message: 'Error al actualizar la encuesta: ' . $e->getMessage());
        }
    }
    
    public function render()
    {
        return view('livewire.portal360.encuesta.encuesta-sucursal.editar-encuesta-sucursal')->layout('layouts.portal360');
    }
}
