<div>
    <div class="bg-white shadow-md rounded-lg p-6 mx-4 my-6">
        <p class="text-center text-xl font-extrabold text-black md:text-3xl">
            Editar Asignación
        </p>

        <div class="mb-6">
            <label for="empresa_id" class="block text-sm font-medium text-gray-700 mb-2">
                Seleccionar Empresa
            </label>
            <select id="empresa_id"
                wire:model.live="empresa_id"
                class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                <option value="">-- Seleccione una empresa --</option>
                @foreach($empresas as $empresa)
                <option value="{{ $empresa->id }}">{{ $empresa->nombre }}</option>
                @endforeach
            </select>
            @error('empresa_id')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-6">
            <label for="sucursal_id" class="block text-sm font-medium text-gray-700 mb-2">
                Seleccionar Sucursal
            </label>
            <select id="sucursal_id"
                wire:model.live="sucursal_id"
                class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                <option value="">-- Seleccione una sucursal --</option>
                @foreach($sucursales as $sucursal)
                <option value="{{ $sucursal->id }}">{{ $sucursal->nombre_sucursal }}</option>
                @endforeach
            </select>
            @error('sucursal_id')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-6">
            <label for="tipo_user_calificador" class="block text-sm font-medium text-gray-700 mb-2">
                Tipo de Usuario Calificador
            </label>
            <select id="tipo_user_calificador"
                wire:model.live="tipo_user_calificador"
                class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                <option value="">-- Seleccione tipo de usuario --</option>
                @foreach($tipos_usuario as $tipo)
                <option value="{{ $tipo }}">{{ $tipo }}</option>
                @endforeach
            </select>
            @error('tipo_user_calificador')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-6">
            <label for="calificador_id" class="block text-sm font-medium text-gray-700 mb-2">
                Seleccionar Calificador
            </label>
            <select id="calificador_id"
                wire:model.live="calificador_id"
                class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                <option value="">-- Seleccione un calificador --</option>
                @foreach($usuarios_calificador as $usuario)
                <option value="{{ $usuario->id }}">{{ $usuario->name }}</option>
                @endforeach
            </select>
            @error('calificador_id')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-6">
            <label for="tipo_user_calificado" class="block text-sm font-medium text-gray-700 mb-2">
                Tipo de Usuario Calificado
            </label>
            <select id="tipo_user_calificado"
                wire:model.live="tipo_user_calificado"
                class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                <option value="">-- Seleccione tipo de usuario --</option>
                @foreach($tipos_usuario as $tipo)
                <option value="{{ $tipo }}">{{ $tipo }}</option>
                @endforeach
            </select>
            @error('tipo_user_calificado')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-6">
            <label for="calificado_id" class="block text-sm font-medium text-gray-700 mb-2">
                Seleccionar Calificado
            </label>
            <select id="calificado_id"
                wire:model.live="calificado_id"
                class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                <option value="">-- Seleccione un calificado --</option>
                @foreach($usuarios_calificado as $usuario)
                <option value="{{ $usuario->id }}">{{ $usuario->name }}</option>
                @endforeach
            </select>
            @error('calificado_id')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-6">
            <label for="relacion_id" class="block text-sm font-medium text-gray-700 mb-2">
                Seleccionar Relación
            </label>
            <select id="relacion_id"
                wire:model.live="relacion_id"
                class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                <option value="">-- Seleccione una relación --</option>
                @foreach($relaciones as $relacion)
                <option value="{{ $relacion->id }}">{{ $relacion->nombre }}</option>
                @endforeach
            </select>
            @error('relacion_id')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-6">
            <label for="encuesta_id" class="block text-sm font-medium text-gray-700 mb-2">
                Seleccionar Encuesta
            </label>
            <select id="encuesta_id"
                wire:model.live="encuesta_id"
                class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                <option value="">-- Seleccione una encuesta --</option>
                @foreach($encuestas as $encuesta)
                <option value="{{ $encuesta->id }}">{{ $encuesta->nombre }}</option>
                @endforeach
            </select>
            @error('encuesta_id')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-6">
            <label for="realizada" class="block text-sm font-medium text-gray-700 mb-2">
                Fecha de Realización
            </label>
            <input type="datetime-local"
                id="realizada"
                wire:model.live="realizada"
                class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            @error('realizada')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Checkbox for resetting realizada -->
        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-2">
                <input type="checkbox" wire:model.live="resetRealizada" class="mr-2 focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                Restablecer estado de la encuesta (permitir contestarla nuevamente)
            </label>
        </div>

        <div>
            <button
                wire:click="saveAsignacionAdministrador"
                type="button"
                class="w-full py-2 px-4 rounded font-medium bg-indigo-600 hover:bg-indigo-700 text-white">
                Guardar Cambios
            </button>
        </div>

        @if (session()->has('success'))
        <div class="mt-4 p-4 bg-green-100 text-green-700 rounded">
            {{ session('success') }}
        </div>
        @endif

        @if (session()->has('error'))
        <div class="mt-4 p-4 bg-red-100 text-red-700 rounded">
            {{ session('error') }}
        </div>
        @endif
    </div>
</div>