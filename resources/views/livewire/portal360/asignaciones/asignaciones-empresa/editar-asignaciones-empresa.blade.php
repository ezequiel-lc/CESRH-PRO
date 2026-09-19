<div>
    <div class="bg-white shadow-md rounded-lg p-6 mx-4 my-6">
        <p class="text-center text-xl font-extrabold text-black md:text-3xl">
            Editar Asignación
        </p>

        {{-- Select de Sucursal (Preseleccionado) --}}
        <div class="mb-6">
            <label for="sucursal_id" class="block text-sm font-medium text-gray-700 mb-2">
                Seleccionar Sucursal
            </label>
            <div class="relative">
                <select id="sucursal_id"
                    wire:model.live="sucursal_id"
                    class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 appearance-none bg-white">
                    <option value="">-- Seleccione una sucursal --</option>
                    @foreach($sucursales as $sucursal)
                    <option value="{{ $sucursal->id }}">
                        {{ $sucursal->nombre_sucursal }}
                    </option>
                    @endforeach
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                </div>
            </div>
            @error('sucursal_id')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        {{-- Select de Tipo Usuario Calificador (Preseleccionado) --}}
        <div class="mb-6">
            <label for="tipo_user_calificador" class="block text-sm font-medium text-gray-700 mb-2">
                Tipo de Usuario Calificador
            </label>
            <div class="relative">
                <select id="tipo_user_calificador"
                    wire:model.live="tipo_user_calificador"
                    class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 appearance-none bg-white">
                    <option value="">-- Seleccione tipo de usuario --</option>
                    @foreach($tipos_usuario as $tipo)
                    <option value="{{ $tipo }}">
                        {{ $tipo }}
                    </option>
                    @endforeach
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                </div>
            </div>
            @error('tipo_user_calificador')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        {{-- Select de Calificador (Preseleccionado) --}}
        <div class="mb-6">
            <label for="calificador_id" class="block text-sm font-medium text-gray-700 mb-2">
                Seleccionar Calificador
            </label>
            <div class="relative">
                <select id="calificador_id"
                    wire:model.live="calificador_id"
                    class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 appearance-none bg-white">
                    <option value="">-- Seleccione un calificador --</option>
                    @forelse($usuarios_calificador as $usuario)
                    <option value="{{ $usuario->id }}">
                        {{ $usuario->name }}
                    </option>
                    @empty
                    <option disabled>No hay usuarios disponibles</option>
                    @endforelse
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                </div>
            </div>
            @error('calificador_id')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        {{-- Select de Tipo Usuario Calificado (Preseleccionado) --}}
        <div class="mb-6">
            <label for="tipo_user_calificado" class="block text-sm font-medium text-gray-700 mb-2">
                Tipo de Usuario Calificado
            </label>
            <div class="relative">
                <select id="tipo_user_calificado"
                    wire:model.live="tipo_user_calificado"
                    class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 appearance-none bg-white">
                    <option value="">-- Seleccione tipo de usuario --</option>
                    @foreach($tipos_usuario as $tipo)
                    <option value="{{ $tipo }}">
                        {{ $tipo }}
                    </option>
                    @endforeach
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                </div>
            </div>
            @error('tipo_user_calificado')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        {{-- Select de Calificado (Preseleccionado) --}}
        <div class="mb-6">
            <label for="calificado_id" class="block text-sm font-medium text-gray-700 mb-2">
                Seleccionar Calificado
            </label>
            <div class="relative">
                <select id="calificado_id"
                    wire:model.live="calificado_id"
                    class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 appearance-none bg-white">
                    <option value="">-- Seleccione un calificado --</option>
                    @forelse($usuarios_calificado as $usuario)
                    <option value="{{ $usuario->id }}">
                        {{ $usuario->name }}
                    </option>
                    @empty
                    <option disabled>No hay usuarios disponibles</option>
                    @endforelse
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                </div>
            </div>
            @error('calificado_id')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        {{-- Select de Relación (Preseleccionado) --}}
        <div class="mb-6">
            <label for="relacion_id" class="block text-sm font-medium text-gray-700 mb-2">
                Seleccionar Relación
            </label>
            <div class="relative">
                <select id="relacion_id"
                    wire:model.live="relacion_id"
                    class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 appearance-none bg-white">
                    <option value="">-- Seleccione una relación --</option>
                    @foreach($relaciones as $relacion)
                    <option value="{{ $relacion->id }}">
                        {{ $relacion->nombre }}
                    </option>
                    @endforeach
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                </div>
            </div>
            @error('relacion_id')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        {{-- Select de Encuesta (Preseleccionado) --}}
        <div class="mb-6">
            <label for="encuesta_id" class="block text-sm font-medium text-gray-700 mb-2">
                Seleccionar Encuesta
            </label>
            <div class="relative">
                <select id="encuesta_id"
                    wire:model.live="encuesta_id"
                    class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 appearance-none bg-white">
                    <option value="">-- Seleccione una encuesta --</option>
                    @forelse($encuestas as $encuesta)
                    <option value="{{ $encuesta->id }}">
                        {{ $encuesta->nombre }}
                    </option>
                    @empty
                    <option disabled>No hay encuestas disponibles</option>
                    @endforelse
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                </div>
            </div>
            @error('encuesta_id')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        {{-- Fecha de Realización (Preseleccionada) --}}
        <div class="mb-6">
            <label for="realizada" class="block text-sm font-medium text-gray-700 mb-2">
                Fecha de Realización
            </label>
            <div class="relative">
                <input type="datetime-local"
                    id="realizada"
                    wire:model.live="realizada"
                    class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                    <svg class="w-5 h-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                    </svg>
                </div>
            </div>
            @error('realizada')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Checkbox para restablecer realizada -->
        <div class="mb-6">
            <label class="flex items-center text-sm font-medium text-gray-700">
                <input type="checkbox" wire:model.live="resetRealizada" class="mr-2 focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                Restablecer estado de la encuesta (permitir contestarla nuevamente)
            </label>
        </div>

        {{-- Botones --}}
        <div class="flex space-x-4">
            <a href="{{ route('portal360.asignaciones.asignaciones-empresa.mostrar-asignaciones-empresa') }}" 
               class="flex-1 py-2 px-4 rounded font-medium bg-gray-500 hover:bg-gray-600 text-white text-center">
                Cancelar
            </a>
            <button
                wire:click="saveAsignacionEmpresa"
                type="button"
                class="flex-1 py-2 px-4 rounded font-medium bg-indigo-600 hover:bg-indigo-700 text-white">
                Guardar Cambios
            </button>
        </div>
    </div>
</div>