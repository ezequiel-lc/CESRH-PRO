<div class="bg-white shadow-lg rounded-lg p-8 max-w-5xl mx-auto">
    <h1 class="text-2xl font-semibold text-gray-800 mb-6">Editar Encuesta</h1>

    <!-- Mensaje de éxito -->
    @if (session()->has('message'))
        <div class="bg-green-100 text-green-700 px-4 py-3 rounded mb-6">
            {{ session('message') }}
        </div>
    @endif

    <!-- Formulario de edición -->
    <div class="space-y-6">
        <!-- Campo: Empresa -->
        <div>
            <label for="Empresa" class="block text-sm font-semibold text-gray-700">Empresa</label>
            <input type="text" id="Empresa" wire:model="Empresa" required
                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            @error('Empresa') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Campo: Actividades -->
        <div>
            <label for="Actividades" class="block text-sm font-semibold text-gray-700">Actividades</label>
            <textarea id="Actividades" wire:model="Actividades" required
                      class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"></textarea>
            @error('Actividades') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Campo: Sucursal y Departamento -->
        <div>
            <label for="sucursalDepartamentId" class="block text-sm font-semibold text-gray-700">Sucursal y Departamento</label>
            <select id="sucursalDepartamentId" wire:model="sucursalDepartamentId" required
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                <option value="">Seleccione una sucursal y departamento</option>
                @foreach($sucursalDepartamentos as $sucursalDepartamento)
                    <option value="{{ $sucursalDepartamento->id }}">
                        {{ $sucursalDepartamento->sucursal_nombre }} - {{ $sucursalDepartamento->departamento_nombre }}
                    </option>
                @endforeach
            </select>
            @error('sucursalDepartamentId') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Fechas -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Fecha de Inicio -->
            <div>
                <label for="FechaInicio" class="block text-sm font-semibold text-gray-700">Fecha de Inicio</label>
                <input type="date" id="FechaInicio" wire:model="FechaInicio" required
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                @error('FechaInicio') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Fecha de Cierre -->
            <div>
                <label for="FechaFinal" class="block text-sm font-semibold text-gray-700">Fecha de Cierre</label>
                <input type="date" id="FechaFinal" wire:model="FechaFinal" required
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                @error('FechaFinal') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
        </div>

        <!-- Número de Encuestas -->
        <div>
            <label for="NumeroEncuestas" class="block text-sm font-semibold text-gray-700">Número de Encuestas</label>
            <input type="number" id="NumeroEncuestas" wire:model="NumeroEncuestas" required
                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                   min="1">
            @error('NumeroEncuestas') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Cuestionarios -->
        <div>
            <label class="block text-sm font-semibold text-gray-700">Seleccionar Cuestionarios</label>
            <div class="space-y-4">
                @foreach($cuestionarios as $cuestionario)
                    <div class="flex items-center space-x-3">
                        <label for="cuestionario{{ $cuestionario->id }}" class="flex items-center cursor-pointer">
                            <input
                                type="checkbox"
                                id="cuestionario{{ $cuestionario->id }}"
                                wire:model="cuestionariosSeleccionados.{{ $cuestionario->id }}"
                                class="form-checkbox h-5 w-5 text-blue-600 rounded focus:ring-blue-500"
                            >
                            <span class="ml-2 text-gray-700">{{ $cuestionario->Nombre }}</span>
                        </label>
                    </div>
                @endforeach
            </div>
            @error('cuestionariosSeleccionados') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Logo de la Empresa -->
        <div>
            <label for="nuevoLogo" class="block text-sm font-semibold text-gray-700">Logo de la Empresa</label>
            <input type="file" id="nuevoLogo" wire:model="nuevoLogo"
                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            @error('nuevoLogo') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

            <!-- Vista previa del logo -->
            @if ($logo)
                <div class="mt-4">
                    <img src="{{ asset('storage/' . $logo) }}" alt="Vista previa del logo"
                         class="max-h-32 rounded border">
                </div>
            @endif
        </div>

        <!-- Botón de Guardar cambios -->
        <div class="mt-6 flex justify-center">
            <button type="button" wire:click="submit"
                    class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 focus:outline-none">
                Guardar cambios
            </button>
        </div>
    </div>
</div>
