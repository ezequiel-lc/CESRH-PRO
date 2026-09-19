<div class="flex space-x-2">
    <button onclick="copiarClave('{{ $row->encuesta_clave }}')" class="text-blue-500 hover:text-blue-700">
        <i class="fas fa-copy"></i>
    </button>
    <button onclick="compartirClave('{{ $row->encuesta_clave }}')" class="text-green-500 hover:text-green-700">
        <i class="fas fa-share"></i>
    </button>
</div>

<script>
    document.addEventListener('livewire:load', function () {
        // Inicializar clipboard.js para el botón de copiar
        new ClipboardJS('.btn-copiar').on('success', function (e) {
            alert("Clave copiada al portapapeles: " + e.text);
        });

        // Inicializar clipboard.js para el botón de compartir
        new ClipboardJS('.btn-compartir').on('success', function (e) {
            alert("Enlace copiado al portapapeles: " + e.text);
        });
    });
</script>
