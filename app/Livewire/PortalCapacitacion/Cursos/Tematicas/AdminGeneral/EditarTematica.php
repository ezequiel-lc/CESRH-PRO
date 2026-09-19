<?php

namespace App\Livewire\PortalCapacitacion\Cursos\Tematicas\AdminGeneral;

use Livewire\Component;
use App\Models\PortalCapacitacion\Tematica;
use App\Models\PortalRh\Empresa;
use App\Models\PortalRh\Sucursal;
use Illuminate\Support\Facades\Crypt;

class EditarTematica extends Component
{
    public $tematicas_id, $nombre;
    public $empresa_id, $sucursal_id;
    public $empresas = [], $sucursales = [];

    public function mount($id)
    {
        $id = Crypt::decrypt($id);
        $tematica = Tematica::findOrFail($id);

        // Asignar datos al componente
        $this->tematicas_id = $tematica->id;
        $this->nombre = $tematica->nombre;
        $this->empresa_id = $tematica->empresa_id;

        // Cargar todas las empresas
        $this->empresas = Empresa::all();

        // Cargar sucursales correspondientes a la empresa seleccionada
        $this->sucursales = Empresa::find($this->empresa_id)?->sucursales ?? [];

        // Asignar la sucursal correspondiente
        $this->sucursal_id = $tematica->sucursal_id;

    }

    public function updatedEmpresaId()
    {
        // Obtener sucursales relacionadas a la empresa seleccionada
        $this->sucursales = Empresa::find($this->empresa_id)?->sucursales ?? [];
        $this->sucursal_id = null; // Resetear selección de sucursal
    }

    public function store()
    {
        $this->validate([
            'nombre' => 'required',
            'empresa_id' => 'required',
            'sucursal_id' => 'required',
        ]);

        // Buscar la tematica existente y actualizarla
        Tematica::updateOrCreate(['id' => $this->tematicas_id], [
            'nombre' => $this->nombre,
            'empresa_id' => $this->empresa_id,
            'sucursal_id' => $this->sucursal_id,
        ]);

        session()->flash('success', 'Temática actualizada exitosamente.');

        return redirect()->route('verTematicas');
    }


    public function render()
    {
        return view('livewire.portal-capacitacion.cursos.tematicas.admin-general.editar-tematica')->layout("layouts.portal_capacitacion");
    }
}
