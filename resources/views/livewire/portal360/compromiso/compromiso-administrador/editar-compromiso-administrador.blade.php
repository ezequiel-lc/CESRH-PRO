<div class="p-6">
    <div class="bg-white shadow-lg rounded-lg p-6">
        <h2 class="text-xl font-bold text-gray-900 mb-6">Editar Compromiso</h2>

        <!-- Success/Error Messages -->
        @if (session()->has('message'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
            {{ session('message') }}
        </div>
        @endif
        @if (session()->has('error'))
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
            {{ session('error') }}
        </div>
        @endif

        <!-- Form -->
        <form wire:submit.prevent="save">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Alta -->
                <div>
                    <label for="alta" class="block text-sm font-medium text-gray-700">Fecha de Alta</label>
                    <input type="date" id="alta" wire:model="alta" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    @error('alta') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Vencimiento -->
                <div>
                    <label for="vencimiento" class="block text-sm font-medium text-gray-700">Fecha de Vencimiento</label>
                    <input type="date" id="vencimiento" wire:model="vencimiento" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    @error('vencimiento') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Compromiso -->
                <div class="md:col-span-2">
                    <label for="compromiso" class="block text-sm font-medium text-gray-700">Compromiso</label>
                    <textarea id="compromiso" wire:model="compromiso" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" rows="3"></textarea>
                    @error('compromiso') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Usuario (Solo calificadores y calificados de asignaciones completadas) -->
                <div>
                    <label for="users_id" class="block text-sm font-medium text-gray-700">Usuario (Calificador/Calificado)</label>
                    <select id="users_id" wire:model="users_id" wire:change="$refresh" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        <option value="">Selecciona un usuario</option>
                        @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->hasRole('calificador') ? 'Calificador' : 'Calificado' }})</option>
                        @endforeach
                    </select>
                    @error('users_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Verificado -->
                <div>
                    <label for="verificado" class="block text-sm font-medium text-gray-700">Verificado</label>
                    <div class="mt-1 flex items-center">
                        <button type="button" wire:click="$toggle('verificado')" class="relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out {{ $verificado ? 'bg-blue-600' : 'bg-gray-200' }}" role="switch">
                            <span class="sr-only">Toggle Verificado</span>
                            <span class="pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out {{ $verificado ? 'translate-x-5' : 'translate-x-0' }}"></span>
                        </button>
                        <span class="ml-2 text-gray-700">{{ $verificado ? 'Verificado' : 'No verificado' }}</span>
                    </div>
                    @error('verificado') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Pregunta (Solo preguntas contestadas) -->
                <div>
                    <label for="preguntas_id" class="block text-sm font-medium text-gray-700">Pregunta Contestada (Opcional)</label>
                    <select id="preguntas_id" wire:model="preguntas_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        <option value="">Sin pregunta</option>
                        @if ($preguntas && $preguntas->count() > 0)
                        @foreach ($preguntas as $pregunta)
                        <option value="{{ $pregunta->id }}">{{ $pregunta->texto }}</option>
                        @endforeach
                        @endif
                    </select>
                    @error('preguntas_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Submit Button -->
                <div class="mt-6 flex justify-end md:col-span-2">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg shadow">
                        Guardar Cambios
                    </button>
                    <a href="{{ route('portal360.compromiso.compromiso-administrador.mostrar-compromiso-administrador') }}" class="ml-4 bg-gray-600 hover:bg-gray-700 text-white font-semibold py-2 px-4 rounded-lg shadow">
                        Cancelar
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>