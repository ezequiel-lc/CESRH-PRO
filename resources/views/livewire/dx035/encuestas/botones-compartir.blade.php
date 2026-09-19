<div class="flex space-x-2">
    <button class="btn-copiar text-blue-500 hover:text-blue-700" data-clipboard-text="{{ $row->encuesta_clave }}">
        <i class="fas fa-copy"></i> Copiar
    </button>
    <button class="btn-compartir text-green-500 hover:text-green-700" data-clipboard-text="{{ route('survey.show', ['key' => $row->encuesta_clave]) }}">
        <i class="fas fa-share"></i> Compartir
    </button>
</div>
