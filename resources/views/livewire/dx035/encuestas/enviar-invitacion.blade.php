<div>
    <h1 class="text-2xl font-semibold text-gray-800 mb-6">Enviar Invitación a Encuesta</h1>

    <form wire:submit.prevent="enviarInvitacion">
        <div class="mb-4">
            <label for="emails" class="block text-sm font-medium text-gray-700">Correos Electrónicos</label>
            <input type="text" wire:model="emails" id="emails" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md" placeholder="Ingresa los correos separados por comas">
        </div>

        <div class="mb-4">
            <label for="mensaje" class="block text-sm font-medium text-gray-700">Mensaje</label>
            <textarea wire:model="mensaje" id="mensaje" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md" rows="4" placeholder="Escribe un mensaje opcional"></textarea>
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">Enviar Invitación</button>
    </form>
</div>