<?php

namespace App\Livewire\PortalCapacitacion\Usuarios\AdminSucursal;

use Livewire\Component;
use App\Models\PortalCapacitacion\PerfilPuesto;
use App\Models\PortalCapacitacion\FuncionEspecifica;
use App\Models\PortalCapacitacion\RelacionInterna;
use App\Models\PortalCapacitacion\RelacionExterna;
use App\Models\PortalCapacitacion\ResponsabilidadUniversal;
use App\Models\PortalCapacitacion\FormacionHabilidadHumana;
use App\Models\PortalCapacitacion\FormacionHabilidadTecnica;
use App\Models\User;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Database\Eloquent\Builder;

class VerMasUsuarioSucursal extends Component
{
    public $userSeleccionado;
    public $users_id;
    public $perfilPuesto;
    public $funcionesEspecificas, 
            $relacionesInternas, 
            $relacionesExternas, 
            $responsabilidadesUniversales,
            $habilidadesHumanas, 
            $habilidadesTecnicas,
            $perfilactual;

    public function mount($id)
    {
        $id = Crypt::decrypt($id);
         $this->userSeleccionado = User::with('perfilesPuestos')->find($id);
                
        $this->perfilactual = null;
            
        foreach ($this->userSeleccionado->perfilesPuestos as $perfiles) {
            if ($perfiles->pivot->status === "1") {
                $this->perfilactual = $perfiles;
                break;
            }
        }
            
        if ($this->perfilactual) {
            $this->funcionesEspecificas = $this->perfilactual->funcionesEspecificas()->get();
            $this->relacionesInternas = $this->perfilactual->relacionesInternas()->get();
            $this->relacionesExternas = $this->perfilactual->relacionesExternas()->get();
            $this->responsabilidadesUniversales = $this->perfilactual->responsabilidadesUniversales()->get();
            $this->habilidadesHumanas = $this->perfilactual->habilidadesHumanas()->get();
            $this->habilidadesTecnicas = $this->perfilactual->habilidadesTecnicas()->get();
        } else {
            $this->funcionesEspecificas = collect();
            $this->relacionesInternas = collect();
            $this->relacionesExternas = collect();
            $this->responsabilidadesUniversales = collect();
            $this->habilidadesHumanas = collect();
            $this->habilidadesTecnicas = collect();
        }
            $this->users_id = $id;
        }
            

    public function render()
    {
        return view('livewire.portal-capacitacion.usuarios.admin-sucursal.ver-mas-usuario-sucursal')->layout("layouts.portal_capacitacion");
    }
    
}
 

        
        /*
        $this->userSeleccionado=User::with(['perfilesPuestos' => function (Builder $query) {
            $query->where('perfilesPuestos.pivot.status', 1);
        }])->find($id);*/
        
        //$this->perfilPuesto = $this->userSeleccionado->perfilActual();
        
        