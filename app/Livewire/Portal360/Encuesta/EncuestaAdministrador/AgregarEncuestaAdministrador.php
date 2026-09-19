<?php

namespace App\Livewire\Portal360\Encuesta\EncuestaAdministrador;

use App\Models\Encuestas360\Encuesta360;
use App\Models\PortalRH\Empresa;
use App\Models\PortalRH\Sucursal;
use App\Models\User;
use Livewire\Component;

class AgregarEncuestaAdministrador extends Component
{

    public $encuesta = [
        'nombre' => '',
        'descripcion' => '',
        'indicaciones' => '',
        'empresa_id' => '',
        'sucursal_id' => '',
    ];

    protected $rules = [
        'encuesta.nombre' => 'required|string|max:255',
        'encuesta.descripcion' => 'required|string', // Cambiar de nullable a required
        'encuesta.indicaciones' => 'required|string', // Cambiar de nullable a required
        'encuesta.empresa_id' => 'required|exists:empresas,id',
        'encuesta.sucursal_id' => 'required|exists:sucursales,id',
    ];
    
    
    public $empresas = [];
    public $sucursales = [];
    public $usuarios = [];

    public function mount()
    {
        // Cargar todas las empresas al iniciar el componente
        $this->empresas = Empresa::select('id', 'nombre')->get();
        // Cargar todas las sucursales al iniciar el componente 
    }

    public function updatedEncuestaEmpresaId($value)
    {
        if (!empty($value)) {
            try {
                // Obtener la empresa con sus sucursales
                $empresa = Empresa::with('sucursales')->findOrFail($value);
                // Cargar las sucursales de la empresa
                $this->sucursales = $empresa->sucursales;

                // Reiniciar el valor de sucursal_id
                $this->encuesta['sucursal_id'] = '';
        

                // Mensaje de éxito (opcional)
                $this->dispatch('toastr-success', message: 'Sucursales cargadas correctamente.');
            } catch (\Exception $e) {
                // Manejo de errores
                $this->dispatch('toastr-error', message: 'Error al cargar las sucursales: ' . $e->getMessage());
                $this->sucursales = collect(); // Vaciar la colección de sucursales
            }
        } else {
            // Si no se selecciona una empresa, vaciar las sucursales y reiniciar sucursal_id
            $this->sucursales = collect();
            $this->encuesta['sucursal_id'] = '';
        }
    }

    public function updatedEncuestaSucursalId($value)
    {
        if (!empty($value)) {
            try {
                // Obtener los usuarios de la sucursal seleccionada
                $this->usuarios = User::where('sucursal_id', $value)
                    ->where('empresa_id', $this->encuesta['empresa_id'])
                    ->get();

                // Mensaje de éxito (opcional)
               // $this->dispatch('toastr-success', message: 'Usuarios cargados correctamente.');
            } catch (\Exception $e) {
                // Manejo de errores
                $this->dispatch('toastr-error', message: 'Error al cargar los usuarios: ' . $e->getMessage());
                $this->usuarios = collect(); // Vaciar la colección de usuarios
            }
        } else {
            // Si no se selecciona una sucursal, vaciar los usuarios
            $this->usuarios = collect();
        }
    }

   

    public function saveEncuestaAdministrador()
    {
        $this->validate();

        try {
            $nuevaEncuesta = new Encuesta360($this->encuesta);
            $nuevaEncuesta->save();

            $this->encuesta = [
                'nombre' => '',
                'descripcion' => '',
                'indicaciones' => '',
                'empresa_id' => '',
                'sucursal_id' => '',
            ];

            $this->dispatch('toastr-success', message: 'Encuesta Guardada Correctamente.');


            return redirect()->route('portal360.encuesta.encuesta-administrador.mostrar-encuesta-administrador');
        } catch (\Exception $e) {
            $this->dispatch('toastr-error', message: 'Error al guardar la encuesta: ' . $e->getMessage());
        }
    }


    public function render()
    {
        return view('livewire.portal360.encuesta.encuesta-administrador.agregar-encuesta-administrador')->layout('layouts.portal360');
    }
}
