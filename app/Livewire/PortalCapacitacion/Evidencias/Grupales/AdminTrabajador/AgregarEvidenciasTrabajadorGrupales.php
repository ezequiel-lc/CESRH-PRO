<?php 

namespace App\Livewire\PortalCapacitacion\Evidencias\Grupales\AdminTrabajador;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\PortalCapacitacion\Evidencia;
use App\Models\PortalCapacitacion\Escaneardc;
use App\Models\PortalCapacitacion\GrupocursoCapacitacion;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AgregarEvidenciasTrabajadorGrupales extends Component
{
    use WithFileUploads;

    public $evidencias = []; // Almacena los archivos seleccionados
    public $evidenciasPreview = []; // Almacena las URLs temporales para previsualización
    public $documento; // Para el archivo PDF
    public $documentoPreview; // URL temporal para previsualización
    public $caps_individuales_id;
    public $participantes_id;

    public function mount($id)
    {
        $this->caps_individuales_id = Crypt::decrypt($id);
        $this->participantes_id = Auth::id(); // Obtener ID del usuario autenticado
    }

    public function updatedEvidencias()
    {
        $this->evidenciasPreview = []; // Limpiar previsualización
        foreach ($this->evidencias as $file) {
            $this->evidenciasPreview[] = $file->temporaryUrl(); // Genera la vista previa
        }
    }

    public function removeImage($index)
    {
        unset($this->evidencias[$index]);
        unset($this->evidenciasPreview[$index]);

        // Restablecer los arrays sin activar una recarga automática
        $this->evidencias = array_values($this->evidencias);
        $this->evidenciasPreview = array_values($this->evidenciasPreview);

        $this->dispatch('refreshPreview');

    }


    public function save()
    {
        $this->validate([
            'evidencias' => 'required|array', // Asegurar que es un array de archivos
            'evidencias.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validar cada imagen
            'documento' => 'nullable|file|mimes:pdf|max:5120',
        ]);

        // Verificar que la capacitación existe
        $capsIndividual = GrupocursoCapacitacion::find($this->caps_individuales_id);
        if (!$capsIndividual) {
            session()->flash('error', 'Error: La capacitación no existe.');
            return;
        }

        // Guardar cada imagen en almacenamiento y en la base de datos
        $evidencias = [];
        foreach ($this->evidencias as $imagen) {
            $path = $imagen->store('evidencias', 'public');

            // Crear evidencia con estado "pendiente"
            $evidencia = Evidencia::create([
                'evidencias' => $path,
                'status' => 'pendiente', // Estado inicial
            ]);

            // Asociar evidencia con el usuario
            $participanteId = DB::table('participante_user')
                ->where('users_id', Auth::id())
                ->value('participantes_id');

            if ($participanteId) {
                DB::table('participante_evidencia')->insert([
                    'participantes_id' => $participanteId,
                    'grupocursos_capacitaciones_id' => $this->caps_individuales_id,
                    'evidencias_id' => $evidencia->id,
                ]);
            }

            $evidencias[] = $evidencia; // Almacenar para asociar con el PDF
        }

        // Guardar el PDF si se subió y vincularlo con la primera evidencia cargada
        if ($this->documento) {
            $pdfPath = $this->documento->store('documentos', 'public');

            if (!empty($evidencias)) {
                Escaneardc::create([
                    'urlEsca' => $pdfPath,
                    'grupocursos_capacitaciones_id' => $this->caps_individuales_id,
                    'evidencia_id' => $evidencias[0]->id, // Vincular al primer archivo de evidencia
                ]);
            }
        }

        session()->flash('message', 'Evidencias y documento agregados exitosamente.');
        $this->reset();
    }

    public function render()
    {
        return view('livewire.portal-capacitacion.evidencias.grupales.admin-trabajador.agregar-evidencias-grupales')
            ->layout("layouts.portal_capacitacion");
    }
}
