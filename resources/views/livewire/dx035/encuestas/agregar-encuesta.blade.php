<div class="bg-white shadow-lg rounded-lg p-8 max-w-5xl mx-auto">
    <div>
        <!-- Título centrado y con color personalizado -->
        <h2 class="text-4xl font-bold text-blue-600 mb-8 text-center">Agregar Encuesta</h2>

        <!-- Mensaje de éxito -->
        @if (session()->has('message'))
            <div class="bg-green-100 text-green-700 px-4 py-3 rounded mb-6">
                {{ session('message') }}
            </div>
        @endif

        <div class="space-y-6">

            <!-- Empresa -->
            <div>
                <label for="empresa" class="block text-sm font-semibold text-gray-700">Empresa</label>
                <select id="empresa" wire:model.live="empresa" required
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Seleccione una empresa</option>
                    @forelse($empresas as $empresa)
                        <option value="{{ $empresa->id }}">{{ $empresa->nombre }}</option>
                    @empty
                    @endforelse
                </select>
                @error('empresa') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Sucursal -->
            <div>
                <label for="sucursal" class="block text-sm font-semibold text-gray-700">Sucursal</label>
                <select id="sucursal" wire:model.live="sucursal" required
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Seleccione una sucursal</option>
                    @forelse($sucursales as $sucursal)
                        @foreach($sucursal->sucursales as $sucursal2)
                            <option value="{{ $sucursal2->id }}">{{ $sucursal2->nombre_sucursal }}</option>
                        @endforeach
                    @empty
                    @endforelse
                </select>
                @error('sucursal') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Departamento -->
            <div>
                <label for="departamento" class="block text-sm font-semibold text-gray-700">Departamento</label>
                <select id="departamento" wire:model.live="departamento" required
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Seleccione un departamento</option>
                    @forelse($departamentos as $departamento)
                        @foreach($departamento->departamentos as $departamento2)
                            <option value="{{ $departamento2->id }}">{{ $departamento2->nombre_departamento }}</option>
                        @endforeach
                    @empty
                    @endforelse
                </select>
                @error('departamento') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Actividades -->
            <div>
                <label for="Actividades" class="block text-sm font-semibold text-gray-700">Actividades</label>
                <textarea id="Actividades" wire:model="Actividades" required
                          class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"></textarea>
                @error('Actividades') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Cuestionarios (Checkboxes) -->
            <div>
                <label class="block text-sm font-semibold text-gray-700">Cuestionarios</label>
                <div class="mt-2 space-y-2">
                    @forelse($cuestionarios as $cuestionario)
                        <label class="flex items-center">
                            <input
                                type="checkbox"
                                wire:model="cuestionariosSeleccionados.{{ $cuestionario->id }}"
                                class="form-checkbox h-4 w-4 text-blue-600 transition duration-150 ease-in-out"
                            />
                            <span class="ml-2 text-sm text-gray-700">{{ $cuestionario->Nombre }}</span>
                        </label>
                    @empty
                        <p class="text-sm text-gray-500">No hay cuestionarios disponibles.</p>
                    @endforelse
                </div>
                @error('cuestionariosSeleccionados') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>


            <!-- Fechas -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="FechaInicio" class="block text-sm font-semibold text-gray-700">Fecha de Inicio</label>
                    <input type="date" id="FechaInicio" wire:model="FechaInicio" required
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    @error('FechaInicio') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="FechaFinal" class="block text-sm font-semibold text-gray-700">Fecha de Finalización</label>
                    <input type="date" id="FechaFinal" wire:model="FechaFinal" required
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    @error('FechaFinal') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>

            <!-- Número de Trabajadores -->
            <div>
                <label for="numtrabajadores" class="block text-sm font-semibold text-gray-700">Número de Trabajadores</label>
                <input type="number" id="numtrabajadores" wire:model="numtrabajadores" required
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                @error('numtrabajadores') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Logo -->
            <div>
                <label for="logo" class="block text-sm font-semibold text-gray-700">Logo (Opcional)</label>
                <input type="file" id="logo" wire:model="logo"
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                @error('logo') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Botón de Enviar -->
            <div class="flex justify-end">
                <button type="button" wire:click="submit"
                        class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                    Guardar Encuesta
                </button>
            </div>
        </div>
    </div>
</div>