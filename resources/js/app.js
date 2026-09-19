import './bootstrap';
import './../../vendor/power-components/livewire-powergrid/dist/powergrid';
import './../../vendor/power-components/livewire-powergrid/dist/tailwind.css';
import ClipboardJS from 'clipboard';

// Inicializar clipboard.js
document.addEventListener('DOMContentLoaded', function () {
    new ClipboardJS('.btn-copiar').on('success', function (e) {
        alert("Clave copiada al portapapeles: " + e.text);
    });

    new ClipboardJS('.btn-compartir').on('success', function (e) {
        alert("Enlace copiado al portapapeles: " + e.text);
    });
});
