<div>
    <h1 class="text-2xl font-semibold text-gray-800 mb-6">Enviar Invitación a Encuesta: {{ $encuesta->Empresa }}</h1>

    <form wire:submit.prevent="enviarInvitacion">
        <!-- Campo para ingresar correos electrónicos -->
        <div class="mb-4">
            <label for="emails" class="block text-sm font-medium text-gray-700">Correos Electrónicos</label>
            <input
                type="text"
                wire:model="emails"
                id="emails"
                class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md"
                placeholder="Ingresa los correos separados por comas"
            >
            @error('emails') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Mensaje predeterminado (no editable) -->
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Mensaje predeterminado</label>
            <div class="mt-1 p-4 bg-gray-100 border border-gray-300 rounded-md">
                <p class="text-gray-700">
                    ¡Hola! Has sido invitado a participar en una encuesta. Por favor, haz clic en el siguiente enlace para acceder a la encuesta:
                    <a href="{{ route('survey.show', ['key' => $encuesta->Clave]) }}" class="text-blue-500 underline">
                        {{ route('survey.show', ['key' => $encuesta->Clave]) }}
                    </a>.
                </p>
            </div>
        </div>

        <!-- Campo para mensaje adicional (opcional) -->
        <div class="mb-4">
            <label for="mensaje" class="block text-sm font-medium text-gray-700">Mensaje adicional (opcional)</label>
            <textarea
                wire:model="mensaje"
                id="mensaje"
                class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md"
                rows="4"
                placeholder="Escribe un mensaje adicional si lo deseas"
            ></textarea>
        </div>

        <!-- Botón para enviar -->
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">Enviar Invitaciones</button>
    </form>
</div>