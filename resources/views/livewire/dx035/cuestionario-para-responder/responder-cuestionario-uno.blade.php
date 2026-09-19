<div>

    <div class="bg-white shadow-lg rounded-lg p-8 max-w-5xl mx-auto">
        <!-- Paso 0: Datos personales -->
        @if ($currentStep == 0)
            <h1 class="text-3xl font-bold text-blue-600 mb-8 text-center">Información del Trabajador</h1>

            <!-- Nombre, Apellido Paterno, Apellido Materno -->
            <div class="bg-blue-50 p-4 rounded-lg mb-6">
                <h2 class="text-xl font-semibold text-blue-800 mb-4">Ingresa tu nombre</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label for="nombre" class="block text-sm font-semibold text-gray-700">Nombre</label>
                        <input type="text" id="nombrewire:model.live" wire:model.live="nombre" required
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        @error('nombre') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label for="apellidoPaterno" class="block text-sm font-semibold text-gray-700">Apellido Paterno</label>
                        <input type="text" id="apellidoPaterno" wire:model.live="apellidoPaterno" required
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        @error('apellidoPaterno') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label for="apellidoMaterno" class="block text-sm font-semibold text-gray-700">Apellido Materno</label>
                        <input type="text" id="apellidoMaterno" wire:model.live="apellidoMaterno"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        @error('apellidoMaterno') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>

            <!-- Sexo -->
            <div class="bg-blue-50 p-4 rounded-lg mb-6">
                <h2 class="text-xl font-semibold text-blue-800 mb-4">Selecciona tu sexo</h2>
                <div class="flex space-x-4">
                    <label class="inline-flex items-center">
                        <input type="radio" wire:model.live="sexo" value="Masculino" class="form-radio">
                        <span class="ml-2 text-gray-700">Masculino</span>
                    </label>
                    <label class="inline-flex items-center">
                        <input type="radio" wire:model.live="sexo" value="Femenino" class="form-radio">
                        <span class="ml-2 text-gray-700">Femenino</span>
                    </label>
                </div>
                @error('sexo') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Edad -->
            <div class="bg-blue-50 p-4 rounded-lg mb-6">
                <h2 class="text-xl font-semibold text-blue-800 mb-4">Edad en años</h2>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="inline-flex items-center">
                            <input type="radio" wire:model.live="edad" value="15-19" class="form-radio">
                            <span class="ml-2 text-gray-700">15-19</span>
                        </label>
                        <label class="inline-flex items-center mt-2">
                            <input type="radio" wire:model.live="edad" value="20-24" class="form-radio">
                            <span class="ml-2 text-gray-700">20-24</span>
                        </label>
                        <label class="inline-flex items-center mt-2">
                            <input type="radio" wire:model.live="edad" value="25-29" class="form-radio">
                            <span class="ml-2 text-gray-700">25-29</span>
                        </label>
                        <label class="inline-flex items-center mt-2">
                            <input type="radio" wire:model.live="edad" value="30-34" class="form-radio">
                            <span class="ml-2 text-gray-700">30-34</span>
                        </label>
                    </div>
                    <div>
                        <label class="inline-flex items-center">
                            <input type="radio" wire:model.live="edad" value="35-39" class="form-radio">
                            <span class="ml-2 text-gray-700">35-39</span>
                        </label>
                        <label class="inline-flex items-center mt-2">
                            <input type="radio" wire:model.live="edad" value="40-44" class="form-radio">
                            <span class="ml-2 text-gray-700">40-44</span>
                        </label>
                        <label class="inline-flex items-center mt-2">
                            <input type="radio" wire:model.live="edad" value="45-49" class="form-radio">
                            <span class="ml-2 text-gray-700">45-49</span>
                        </label>
                        <label class="inline-flex items-center mt-2">
                            <input type="radio" wire:model.live="edad" value="50-54" class="form-radio">
                            <span class="ml-2 text-gray-700">50-54</span>
                        </label>
                        <label class="inline-flex items-center mt-2">
                            <input type="radio" wire:model.live="edad" value="55-59" class="form-radio">
                            <span class="ml-2 text-gray-700">55-59</span>
                        </label>
                        <label class="inline-flex items-center mt-2">
                            <input type="radio" wire:model.live="edad" value="60-64" class="form-radio">
                            <span class="ml-2 text-gray-700">60-64</span>
                        </label>
                        <label class="inline-flex items-center mt-2">
                            <input type="radio" wire:model.live="edad" value="65-69" class="form-radio">
                            <span class="ml-2 text-gray-700">65-69</span>
                        </label>
                        <label class="inline-flex items-center mt-2">
                            <input type="radio" wire:model.live="edad" value="70 o más" class="form-radio">
                            <span class="ml-2 text-gray-700">70 o más</span>
                        </label>
                    </div>
                </div>
                @error('edad') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Estado Civil -->
            <div class="bg-blue-50 p-4 rounded-lg mb-6">
                <h2 class="text-xl font-semibold text-blue-800 mb-4">Estado Civil</h2>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="inline-flex items-center">
                            <input type="radio" wire:model.live="estadoCivil" value="Casado" class="form-radio">
                            <span class="ml-2 text-gray-700">Casado</span>
                        </label>
                        <label class="inline-flex items-center mt-2">
                            <input type="radio" wire:model.live="estadoCivil" value="Soltero" class="form-radio">
                            <span class="ml-2 text-gray-700">Soltero</span>
                        </label>
                        <label class="inline-flex items-center mt-2">
                            <input type="radio" wire:model.live="estadoCivil" value="Unión libre" class="form-radio">
                            <span class="ml-2 text-gray-700">Unión libre</span>
                        </label>
                    </div>
                    <div>
                        <label class="inline-flex items-center">
                            <input type="radio" wire:model.live="estadoCivil" value="Divorciado" class="form-radio">
                            <span class="ml-2 text-gray-700">Divorciado</span>
                        </label>
                        <label class="inline-flex items-center mt-2">
                            <input type="radio" wire:model.live="estadoCivil" value="Viudo" class="form-radio">
                            <span class="ml-2 text-gray-700">Viudo</span>
                        </label>
                    </div>
                </div>
                @error('estadoCivil') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Nivel de Estudios -->
            <div class="bg-blue-50 p-4 rounded-lg mb-6">
                <h2 class="text-xl font-semibold text-blue-800 mb-4">Nivel de Estudios</h2>
                <div>
                    <label class="inline-flex items-center">
                        <input type="checkbox" wire:model.live="sinFormacion" class="form-checkbox">
                        <span class="ml-2 text-gray-700">Sin Formación</span>
                    </label>
                </div>
                <div class="mt-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700">Primaria</label>
                            <div class="flex space-x-4 mt-1">
                                <label class="inline-flex items-center">
                                    <input type="radio" wire:model.live="estudiosPrimaria" value="Terminada" class="form-radio">
                                    <span class="ml-2 text-gray-700">Terminada</span>
                                </label>
                                <label class="inline-flex items-center">
                                    <input type="radio" wire:model.live="estudiosPrimaria" value="Incompleta" class="form-radio">
                                    <span class="ml-2 text-gray-700">Incompleta</span>
                                </label>
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700">Secundaria</label>
                            <div class="flex space-x-4 mt-1">
                                <label class="inline-flex items-center">
                                    <input type="radio" wire:model.live="estudiosSecundaria" value="Terminada" class="form-radio">
                                    <span class="ml-2 text-gray-700">Terminada</span>
                                </label>
                                <label class="inline-flex items-center">
                                    <input type="radio" wire:model.live="estudiosSecundaria" value="Incompleta" class="form-radio">
                                    <span class="ml-2 text-gray-700">Incompleta</span>
                                </label>
                            </div>
                        </div>
                        <!-- Repetir para Preparatoria, Técnico Superior, Licenciatura, Maestría, Doctorado -->
                    </div>
                </div>
                @error('estudios') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Datos Laborales -->
            <div class="bg-blue-50 p-4 rounded-lg mb-6">
                <h2 class="text-xl font-semibold text-blue-800 mb-4">Datos Laborales</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="ocupacion" class="block text-sm font-semibold text-gray-700">Ocupación/Profesión/Puesto</label>
                        <input type="text" id="ocupacion" wire:model.live="ocupacion" required
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        @error('ocupacion') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label for="departamento" class="block text-sm font-semibold text-gray-700">Departamento/Sección/Área</label>
                        <select id="departamento" wire:model.live="departamento" required
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Seleccione</option>
                            @foreach ($departamentos as $departamento)
                                <option value="{{ $departamento->id }}">{{ $departamento->nombre_departamento }}</option>
                            @endforeach
                        </select>
                        @error('departamento') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>

            <!-- Tipo de Puesto -->
            <div class="bg-blue-50 p-4 rounded-lg mb-6">
                <h2 class="text-xl font-semibold text-blue-800 mb-4">Tipo de Puesto</h2>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="inline-flex items-center">
                            <input type="radio" wire:model.live="tipoPuesto" value="Operativo" class="form-radio">
                            <span class="ml-2 text-gray-700">Operativo</span>
                        </label>
                        <label class="inline-flex items-center mt-2">
                            <input type="radio" wire:model.live="tipoPuesto" value="Profesional o técnico" class="form-radio">
                            <span class="ml-2 text-gray-700">Profesional o técnico</span>
                        </label>
                    </div>
                    <div>
                        <label class="inline-flex items-center">
                            <input type="radio" wire:model.live="tipoPuesto" value="Superior" class="form-radio">
                            <span class="ml-2 text-gray-700">Superior</span>
                        </label>
                        <label class="inline-flex items-center mt-2">
                            <input type="radio" wire:model.live="tipoPuesto" value="Gerente" class="form-radio">
                            <span class="ml-2 text-gray-700">Gerente</span>
                        </label>
                    </div>
                </div>
                @error('tipoPuesto') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Tipo de Contratación -->
            <div class="bg-blue-50 p-4 rounded-lg mb-6">
                <h2 class="text-xl font-semibold text-blue-800 mb-4">Tipo de Contratación</h2>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="inline-flex items-center">
                            <input type="radio" wire:model.live="contratacion" value="Por obra o proyecto" class="form-radio">
                            <span class="ml-2 text-gray-700">Por obra o proyecto</span>
                        </label>
                        <label class="inline-flex items-center mt-2">
                            <input type="radio" wire:model.live="contratacion" value="Por tiempo determinado (temporal)" class="form-radio">
                            <span class="ml-2 text-gray-700">Por tiempo determinado (temporal)</span>
                        </label>
                    </div>
                    <div>
                        <label class="inline-flex items-center">
                            <input type="radio" wire:model.live="contratacion" value="Tiempo indeterminado" class="form-radio">
                            <span class="ml-2 text-gray-700">Tiempo indeterminado</span>
                        </label>
                        <label class="inline-flex items-center mt-2">
                            <input type="radio" wire:model.live="contratacion" value="Honorarios" class="form-radio">
                            <span class="ml-2 text-gray-700">Honorarios</span>
                        </label>
                    </div>
                </div>
                @error('contratacion') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Tipo de Personal -->
            <div class="bg-blue-50 p-4 rounded-lg mb-6">
                <h2 class="text-xl font-semibold text-blue-800 mb-4">Tipo de Personal</h2>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="inline-flex items-center">
                            <input type="radio" wire:model.live="tipoPersonal" value="Sindicalizado" class="form-radio">
                            <span class="ml-2 text-gray-700">Sindicalizado</span>
                        </label>
                        <label class="inline-flex items-center mt-2">
                            <input type="radio" wire:model.live="tipoPersonal" value="Confianza" class="form-radio">
                            <span class="ml-2 text-gray-700">Confianza</span>
                        </label>
                    </div>
                    <div>
                        <label class="inline-flex items-center">
                            <input type="radio" wire:model.live="tipoPersonal" value="Ninguno" class="form-radio">
                            <span class="ml-2 text-gray-700">Ninguno</span>
                        </label>
                    </div>
                </div>
                @error('tipoPersonal') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Tipo de Jornada de Trabajo -->
            <div class="bg-blue-50 p-4 rounded-lg mb-6">
                <h2 class="text-xl font-semibold text-blue-800 mb-4">Tipo de Jornada de Trabajo</h2>
                <div class="grid grid-cols-1 gap-4">
                    <label class="inline-flex items-center">
                        <input type="radio" wire:model.live="jornadaTrabajo" value="Fijo Nocturno (entre las 20:00 y 6:00 hrs)" class="form-radio">
                        <span class="ml-2 text-gray-700">Fijo Nocturno (entre las 20:00 y 6:00 hrs)</span>
                    </label>
                    <label class="inline-flex items-center">
                        <input type="radio" wire:model.live="jornadaTrabajo" value="Fijo Diurno (entre las 6:00 y 20:00 hrs)" class="form-radio">
                        <span class="ml-2 text-gray-700">Fijo Diurno (entre las 6:00 y 20:00 hrs)</span>
                    </label>
                    <label class="inline-flex items-center">
                        <input type="radio" wire:model.live="jornadaTrabajo" value="Fijo mixto (combinación de nocturno y diurno)" class="form-radio">
                        <span class="ml-2 text-gray-700">Fijo mixto (combinación de nocturno y diurno)</span>
                    </label>
                </div>
                @error('jornadaTrabajo') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Rotación de Turnos -->
            <div class="bg-blue-50 p-4 rounded-lg mb-6">
                <h2 class="text-xl font-semibold text-blue-800 mb-4">Realiza rotación de turnos</h2>
                <div class="flex space-x-4">
                    <label class="inline-flex items-center">
                        <input type="radio" wire:model.live="rotacionTurnos" value="Si" class="form-radio">
                        <span class="ml-2 text-gray-700">Sí</span>
                    </label>
                    <label class="inline-flex items-center">
                        <input type="radio" wire:model.live="rotacionTurnos" value="No" class="form-radio">
                        <span class="ml-2 text-gray-700">No</span>
                    </label>
                </div>
                @error('rotacionTurnos') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Experiencia -->
            <div class="bg-blue-100 p-4 rounded-lg mb-6">
                <h2 class="text-xl font-semibold text-blue-800 mb-4">Experiencia (Años)</h2>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="inline-flex items-center">
                            <input type="radio" wire:model.live="experiencia" value="Menos de 6 meses" class="form-radio">
                            <span class="ml-2 text-gray-700">Menos de 6 meses</span>
                        </label>
                        <label class="inline-flex items-center mt-2">
                            <input type="radio" wire:model.live="experiencia" value="Entre 6 meses y 1 año" class="form-radio">
                            <span class="ml-2 text-gray-700">Entre 6 meses y 1 año</span>
                        </label>
                        <label class="inline-flex items-center mt-2">
                            <input type="radio" wire:model.live="experiencia" value="Entre 1 y 4 años" class="form-radio">
                            <span class="ml-2 text-gray-700">Entre 1 y 4 años</span>
                        </label>
                        <label class="inline-flex items-center mt-2">
                            <input type="radio" wire:model.live="experiencia" value="Entre 5 y 9 años" class="form-radio">
                            <span class="ml-2 text-gray-700">Entre 5 y 9 años</span>
                        </label>
                    </div>
                    <div>
                        <label class="inline-flex items-center">
                            <input type="radio" wire:model.live="experiencia" value="Entre 10 y 14 años" class="form-radio">
                            <span class="ml-2 text-gray-700">Entre 10 y 14 años</span>
                        </label>
                        <label class="inline-flex items-center mt-2">
                            <input type="radio" wire:model.live="experiencia" value="Entre 15 y 19 años" class="form-radio">
                            <span class="ml-2 text-gray-700">Entre 15 y 19 años</span>
                        </label>
                        <label class="inline-flex items-center mt-2">
                            <input type="radio" wire:model.live="experiencia" value="Entre 20 y 24 años" class="form-radio">
                            <span class="ml-2 text-gray-700">Entre 20 y 24 años</span>
                        </label>
                        <label class="inline-flex items-center mt-2">
                            <input type="radio" wire:model.live="experiencia" value="25 años o más" class="form-radio">
                            <span class="ml-2 text-gray-700">25 años o más</span>
                        </label>
                    </div>
                </div>
                @error('experiencia') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Tiempo en el Puesto Actual -->
            <div class="bg-blue-100 p-4 rounded-lg mb-6">
                <h2 class="text-xl font-semibold text-blue-800 mb-4">Tiempo en el Puesto Actual</h2>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="inline-flex items-center">
                            <input type="radio" wire:model.live="tiempoPuesto" value="Menos de 6 meses" class="form-radio">
                            <span class="ml-2 text-gray-700">Menos de 6 meses</span>
                        </label>
                        <label class="inline-flex items-center mt-2">
                            <input type="radio" wire:model.live="tiempoPuesto" value="Entre 6 meses y 1 año" class="form-radio">
                            <span class="ml-2 text-gray-700">Entre 6 meses y 1 año</span>
                        </label>
                        <label class="inline-flex items-center mt-2">
                            <input type="radio" wire:model.live="tiempoPuesto" value="Entre 1 y 4 años" class="form-radio">
                            <span class="ml-2 text-gray-700">Entre 1 y 4 años</span>
                        </label>
                        <label class="inline-flex items-center mt-2">
                            <input type="radio" wire:model.live="tiempoPuesto" value="Entre 5 y 9 años" class="form-radio">
                            <span class="ml-2 text-gray-700">Entre 5 y 9 años</span>
                        </label>
                    </div>
                    <div>
                        <label class="inline-flex items-center">
                            <input type="radio" wire:model.live="tiempoPuesto" value="Entre 10 y 14 años" class="form-radio">
                            <span class="ml-2 text-gray-700">Entre 10 y 14 años</span>
                        </label>
                        <label class="inline-flex items-center mt-2">
                            <input type="radio" wire:model.live="tiempoPuesto" value="Entre 15 y 19 años" class="form-radio">
                            <span class="ml-2 text-gray-700">Entre 15 y 19 años</span>
                        </label>
                        <label class="inline-flex items-center mt-2">
                            <input type="radio" wire:model.live="tiempoPuesto" value="Entre 20 y 24 años" class="form-radio">
                            <span class="ml-2 text-gray-700">Entre 20 y 24 años</span>
                        </label>
                        <label class="inline-flex items-center mt-2">
                            <input type="radio" wire:model.live="tiempoPuesto" value="25 años o más" class="form-radio">
                            <span class="ml-2 text-gray-700">25 años o más</span>
                        </label>
                    </div>
                </div>
                @error('tiempoPuesto') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Botón de Registrar -->
            <!-- <div class="flex justify-end mt-6">
                        <button type="button" wire:click="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                            Registrar
                        </button>
                    </div>
                @endif
            </div> -->


    <h1 class="text-2xl font-semibold text-gray-800 mb-6">Encuesta: {{ $encuesta->Empresa }}</h1>

    <form wire:submit.prevent="submit">
        <!-- Paso 1: Sección I -->
        @if ($currentStep == 1 && $encuesta->cuestionarios->contains(1))
            <div class="mb-8">
                <h2 class="text-xl font-semibold text-gray-700 mb-4">Sección I: Acontecimiento traumático severo</h2>
                <table class="min-w-full bg-white border border-gray-200">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="py-2 px-4 border-b">Pregunta</th>
                            <th class="py-2 px-4 border-b">Respuesta</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($preguntas->where('Seccion', 'Acontecimiento traumático severo') as $pregunta)
                        <tr wire:key="pregunta-{{ $pregunta->id }}">
                                <td class="py-2 px-4 border-b">{{ $pregunta->Pregunta }}</td>
                                <td class="py-2 px-4 border-b">
                                    <div class="flex space-x-4">
                                        <label class="inline-flex items-center">
                                            <input type="radio" wire:model.live.live="respuestas.{{ $pregunta->id }}" value="1" class="form-radio">
                                            <span class="ml-2">Sí</span>
                                        </label>
                                        <label class="inline-flex items-center">
                                            <input type="radio" wire:model.live.live="respuestas.{{ $pregunta->id }}" value="0" class="form-radio">
                                            <span class="ml-2">No</span>
                                        </label>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif

        <!-- Paso 2: Secciones adicionales (II, III, IV) -->
        @if ($currentStep == 2 && $mostrarSeccionesAdicionales && $encuesta->cuestionarios->contains(1))
            <div class="mb-8">
                <h2 class="text-xl font-semibold text-gray-700 mb-4">Sección II: Recuerdos persistentes sobre el acontecimiento</h2>
                <table class="min-w-full bg-white border border-gray-200">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="py-2 px-4 border-b">Pregunta</th>
                            <th class="py-2 px-4 border-b">Respuesta</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($preguntas->where('Seccion', 'Recuerdos persistentes sobre el acontecimiento (durante el último mes)') as $pregunta)
                        <tr wire:key="pregunta-{{ $pregunta->id }}">
                                <td class="py-2 px-4 border-b">{{ $pregunta->Pregunta }}</td>
                                <td class="py-2 px-4 border-b">
                                    <div class="flex space-x-4">
                                        <label class="inline-flex items-center">
                                            <input type="radio" wire:model.live.live="respuestas.{{ $pregunta->id }}" value="1" class="form-radio">
                                            <span class="ml-2">Sí</span>
                                        </label>
                                        <label class="inline-flex items-center">
                                            <input type="radio" wire:model.live.live="respuestas.{{ $pregunta->id }}" value="0" class="form-radio">
                                            <span class="ml-2">No</span>
                                        </label>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mb-8">
                <h2 class="text-xl font-semibold text-gray-700 mb-4">Sección III: Esfuerzo por evitar circunstancias parecidas o asociadas al acontecimiento</h2>
                <table class="min-w-full bg-white border border-gray-200">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="py-2 px-4 border-b">Pregunta</th>
                            <th class="py-2 px-4 border-b">Respuesta</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($preguntas->where('Seccion', 'Esfuerzo por evitar circunstancias parecidas o asociadas al acontecimiento (durante el último mes)') as $pregunta)
                        <tr wire:key="pregunta-{{ $pregunta->id }}">
                                <td class="py-2 px-4 border-b">{{ $pregunta->Pregunta }}</td>
                                <td class="py-2 px-4 border-b">
                                    <div class="flex space-x-4">
                                        <label class="inline-flex items-center">
                                            <input type="radio" wire:model.live.live="respuestas.{{ $pregunta->id }}" value="1" class="form-radio">
                                            <span class="ml-2">Sí</span>
                                        </label>
                                        <label class="inline-flex items-center">
                                            <input type="radio" wire:model.live.live="respuestas.{{ $pregunta->id }}" value="0" class="form-radio">
                                            <span class="ml-2">No</span>
                                        </label>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mb-8">
                <h2 class="text-xl font-semibold text-gray-700 mb-4">Sección IV: Afectación</h2>
                <table class="min-w-full bg-white border border-gray-200">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="py-2 px-4 border-b">Pregunta</th>
                            <th class="py-2 px-4 border-b">Respuesta</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($preguntas->where('Seccion', 'Afectación (durante el último mes)') as $pregunta)
                        <tr wire:key="pregunta-{{ $pregunta->id }}">
                                <td class="py-2 px-4 border-b">{{ $pregunta->Pregunta }}</td>
                                <td class="py-2 px-4 border-b">
                                    <div class="flex space-x-4">
                                        <label class="inline-flex items-center">
                                            <input type="radio" wire:model.live.live="respuestas.{{ $pregunta->id }}" value="1" class="form-radio">
                                            <span class="ml-2">Sí</span>
                                        </label>
                                        <label class="inline-flex items-center">
                                            <input type="radio" wire:model.live.live="respuestas.{{ $pregunta->id }}" value="0" class="form-radio">
                                            <span class="ml-2">No</span>
                                        </label>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @elseif ($currentStep == 2 && !$mostrarSeccionesAdicionales && $encuesta->cuestionarios->contains(1))
            <div class="mb-8">
                <p>No es necesario completar las secciones adicionales.</p>
                <button wire:click="nextStep" class="bg-blue-500 text-white px-4 py-2 rounded-md">Siguiente</button>
            </div>
        @endif

        <!-- Paso 3: Cuestionario 2 -->
                @if ($currentStep == 3)
                    @if ($encuesta->cuestionarios->contains(2))
                        <div class="mb-8">
                            <h2 class="text-xl font-semibold text-gray-700 mb-4">Cuestionario 2: Condiciones de trabajo</h2>

                            <!-- Indicación 1: Condiciones de trabajo -->
                            <div class="mb-8">
                                <h3 class="text-lg font-semibold text-gray-700 mb-4">
                                    Para responder las preguntas siguientes considere las condiciones de su centro de trabajo, así como la cantidad y ritmo de trabajo.
                                </h3>
                                <table class="min-w-full bg-white border border-gray-200">
                                    <thead>
                                        <tr class="bg-gray-100">
                                            <th class="py-2 px-4 border-b">Pregunta</th>
                                            <th class="py-2 px-4 border-b">Respuesta</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($preguntas->where('cuestionarios_id', 2)->whereIn('id', [23, 22, 24, 25, 27, 28, 29, 30, 26]) as $pregunta)
                                            <tr wire:key="pregunta-{{ $pregunta->id }}">
                                                <td class="py-2 px-4 border-b">{{ $pregunta->Pregunta }}</td>
                                                <td class="py-2 px-4 border-b">
                                                    <div class="flex space-x-4">
                                                        @foreach (['Siempre' => 0, 'Casi siempre' => 1, 'Algunas veces' => 2, 'Casi nunca' => 3, 'Nunca' => 4] as $opcion => $valor)
                                                            <label class="inline-flex items-center">
                                                                <input type="radio" wire:model.live.live="respuestas.{{ $pregunta->id }}" value="{{ $valor }}" class="form-radio">
                                                                <span class="ml-2">{{ $opcion }}</span>
                                                            </label>
                                                        @endforeach
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <!-- Indicación 2: Actividades y responsabilidades -->
                            <div class="mb-8">
                                <h3 class="text-lg font-semibold text-gray-700 mb-4">
                                    Las preguntas siguientes están relacionadas con las actividades que realiza en su trabajo y las responsabilidades que tiene.
                                </h3>
                                <table class="min-w-full bg-white border border-gray-200">
                                    <thead>
                                        <tr class="bg-gray-100">
                                            <th class="py-2 px-4 border-b">Pregunta</th>
                                            <th class="py-2 px-4 border-b">Respuesta</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($preguntas->whereIn('id', [31, 32, 33, 34]) as $pregunta)
                                            <tr wire:key="pregunta-{{ $pregunta->id }}">
                                                <td class="py-2 px-4 border-b">{{ $pregunta->Pregunta }}</td>
                                                <td class="py-2 px-4 border-b">
                                                    <div class="flex space-x-4">
                                                        @foreach (['Siempre' => 0, 'Casi siempre' => 1, 'Algunas veces' => 2, 'Casi nunca' => 3, 'Nunca' => 4] as $opcion => $valor)
                                                            <label class="inline-flex items-center">
                                                                <input type="radio" wire:model.live.live="respuestas.{{ $pregunta->id }}" value="{{ $valor }}" class="form-radio">
                                                                <span class="ml-2">{{ $opcion }}</span>
                                                            </label>
                                                        @endforeach
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <!-- Indicación 3: Tiempo y responsabilidades familiares -->
                            <div class="mb-8">
                                <h3 class="text-lg font-semibold text-gray-700 mb-4">
                                    Las preguntas siguientes están relacionadas con el tiempo destinado a su trabajo y sus responsabilidades familiares.
                                </h3>
                                <table class="min-w-full bg-white border border-gray-200">
                                    <thead>
                                        <tr class="bg-gray-100">
                                            <th class="py-2 px-4 border-b">Pregunta</th>
                                            <th class="py-2 px-4 border-b">Respuesta</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($preguntas->whereIn('id', [35, 36, 37, 38]) as $pregunta)
                                            <tr wire:key="pregunta-{{ $pregunta->id }}">
                                                <td class="py-2 px-4 border-b">{{ $pregunta->Pregunta }}</td>
                                                <td class="py-2 px-4 border-b">
                                                    <div class="flex space-x-4">
                                                        @foreach (['Siempre' => 0, 'Casi siempre' => 1, 'Algunas veces' => 2, 'Casi nunca' => 3, 'Nunca' => 4] as $opcion => $valor)
                                                            <label class="inline-flex items-center">
                                                                <input type="radio" wire:model.live.live="respuestas.{{ $pregunta->id }}" value="{{ $valor }}" class="form-radio">
                                                                <span class="ml-2">{{ $opcion }}</span>
                                                            </label>
                                                        @endforeach
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <!-- Indicación 4: Decisiones en el trabajo -->
                            <div class="mb-8">
                                <h3 class="text-lg font-semibold text-gray-700 mb-4">
                                    Las preguntas siguientes están relacionadas con las decisiones que puede tomar en su trabajo.
                                </h3>
                                <table class="min-w-full bg-white border border-gray-200">
                                    <thead>
                                        <tr class="bg-gray-100">
                                            <th class="py-2 px-4 border-b">Pregunta</th>
                                            <th class="py-2 px-4 border-b">Respuesta</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($preguntas->whereIn('id', [39, 40, 41, 42, 43]) as $pregunta)
                                            <tr wire:key="pregunta-{{ $pregunta->id }}">
                                                <td class="py-2 px-4 border-b">{{ $pregunta->Pregunta }}</td>
                                                <td class="py-2 px-4 border-b">
                                                    <div class="flex space-x-4">
                                                        @foreach (['Siempre' => 0, 'Casi siempre' => 1, 'Algunas veces' => 2, 'Casi nunca' => 3, 'Nunca' => 4] as $opcion => $valor)
                                                            <label class="inline-flex items-center">
                                                                <input type="radio" wire:model.live.live="respuestas.{{ $pregunta->id }}" value="{{ $valor }}" class="form-radio">
                                                                <span class="ml-2">{{ $opcion }}</span>
                                                            </label>
                                                        @endforeach
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <!-- Indicación 5: Capacitación e información -->
                            <div class="mb-8">
                                <h3 class="text-lg font-semibold text-gray-700 mb-4">
                                    Las preguntas siguientes están relacionadas con la capacitación e información que recibe sobre su trabajo.
                                </h3>
                                <table class="min-w-full bg-white border border-gray-200">
                                    <thead>
                                        <tr class="bg-gray-100">
                                            <th class="py-2 px-4 border-b">Pregunta</th>
                                            <th class="py-2 px-4 border-b">Respuesta</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($preguntas->whereIn('id', [44, 45, 46, 47, 48]) as $pregunta)
                                            <tr wire:key="pregunta-{{ $pregunta->id }}">
                                                <td class="py-2 px-4 border-b">{{ $pregunta->Pregunta }}</td>
                                                <td class="py-2 px-4 border-b">
                                                    <div class="flex space-x-4">
                                                        @foreach (['Siempre' => 0, 'Casi siempre' => 1, 'Algunas veces' => 2, 'Casi nunca' => 3, 'Nunca' => 4] as $opcion => $valor)
                                                            <label class="inline-flex items-center">
                                                                <input type="radio" wire:model.live.live="respuestas.{{ $pregunta->id }}" value="{{ $valor }}" class="form-radio">
                                                                <span class="ml-2">{{ $opcion }}</span>
                                                            </label>
                                                        @endforeach
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <!-- Indicación 6: Relaciones con compañeros y jefe -->
                            <div class="mb-8">
                                <h3 class="text-lg font-semibold text-gray-700 mb-4">
                                    Las preguntas siguientes se refieren a las relaciones con sus compañeros de trabajo y su jefe.
                                </h3>
                                <table class="min-w-full bg-white border border-gray-200">
                                    <thead>
                                        <tr class="bg-gray-100">
                                            <th class="py-2 px-4 border-b">Pregunta</th>
                                            <th class="py-2 px-4 border-b">Respuesta</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($preguntas->whereIn('id', [49, 50, 51, 52, 53, 54, 58, 59, 60, 61, 62]) as $pregunta)
                                            <tr wire:key="pregunta-{{ $pregunta->id }}">
                                                <td class="py-2 px-4 border-b">{{ $pregunta->Pregunta }}</td>
                                                <td class="py-2 px-4 border-b">
                                                    <div class="flex space-x-4">
                                                        @foreach (['Siempre' => 0, 'Casi siempre' => 1, 'Algunas veces' => 2, 'Casi nunca' => 3, 'Nunca' => 4] as $opcion => $valor)
                                                            <label class="inline-flex items-center">
                                                                <input type="radio" wire:model.live.live="respuestas.{{ $pregunta->id }}" value="{{ $valor }}" class="form-radio">
                                                                <span class="ml-2">{{ $opcion }}</span>
                                                            </label>
                                                        @endforeach
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Preguntas clave al final del Cuestionario 2 -->
                        <div class="mb-8">
                            <h2 class="text-xl font-semibold text-gray-700 mb-4">Preguntas clave</h2>

                            <!-- Pregunta: Atención a clientes -->
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700">
                                    En mi trabajo debo brindar servicio a clientes o usuarios:
                                </label>
                                <div class="mt-1">
                                    <label class="inline-flex items-center">
                                        <input type="radio" wire:model.live.live="atencionClientes" value="1" class="form-radio">
                                        <span class="ml-2">Sí</span>
                                    </label>
                                    <label class="inline-flex items-center ml-6">
                                        <input type="radio" wire:model.live.live="atencionClientes" value="0" class="form-radio">
                                        <span class="ml-2">No</span>
                                    </label>
                                </div>
                            </div>

                            <!-- Preguntas adicionales si atiende clientes -->
                            @if ($atencionClientes == 1)
                                <div class="mb-8">
                                    <h3 class="text-lg font-semibold text-gray-700 mb-4">
                                        Las preguntas siguientes están relacionadas con la atención a clientes y usuarios.
                                    </h3>
                                    <table class="min-w-full bg-white border border-gray-200">
                                        <thead>
                                            <tr class="bg-gray-100">
                                                <th class="py-2 px-4 border-b">Pregunta</th>
                                                <th class="py-2 px-4 border-b">Respuesta</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($preguntas->whereIn('id', [41, 42, 43]) as $pregunta)
                                                <tr wire:key="pregunta-{{ $pregunta->id }}">
                                                    <td class="py-2 px-4 border-b">{{ $pregunta->Pregunta }}</td>
                                                    <td class="py-2 px-4 border-b">
                                                        <div class="flex space-x-4">
                                                            @foreach (['Siempre' => 0, 'Casi siempre' => 1, 'Algunas veces' => 2, 'Casi nunca' => 3, 'Nunca' => 4] as $opcion => $valor)
                                                                <label class="inline-flex items-center">
                                                                    <input type="radio" wire:model.live.live="respuestas.{{ $pregunta->id }}" value="{{ $valor }}" class="form-radio">
                                                                    <span class="ml-2">{{ $opcion }}</span>
                                                                </label>
                                                            @endforeach
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif

                            <!-- Pregunta: Es jefe -->
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700">
                                    Soy jefe de otros trabajadores:
                                </label>
                                <div class="mt-1">
                                    <label class="inline-flex items-center">
                                        <input type="radio" wire:model.live.live="esJefe" value="1" class="form-radio">
                                        <span class="ml-2">Sí</span>
                                    </label>
                                    <label class="inline-flex items-center ml-6">
                                        <input type="radio" wire:model.live.live="esJefe" value="0" class="form-radio">
                                        <span class="ml-2">No</span>
                                    </label>
                                </div>
                            </div>

                            <!-- Preguntas adicionales si es jefe -->
                            @if ($esJefe == 1)
                                <div class="mb-8">
                                    <h3 class="text-lg font-semibold text-gray-700 mb-4">
                                        Las siguientes preguntas están relacionadas con las actitudes de los trabajadores que supervisa.
                                    </h3>
                                    <table class="min-w-full bg-white border border-gray-200">
                                        <thead>
                                            <tr class="bg-gray-100">
                                                <th class="py-2 px-4 border-b">Pregunta</th>
                                                <th class="py-2 px-4 border-b">Respuesta</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($preguntas->whereIn('id', [44, 45, 46]) as $pregunta)
                                                <tr wire:key="pregunta-{{ $pregunta->id }}">
                                                    <td class="py-2 px-4 border-b">{{ $pregunta->Pregunta }}</td>
                                                    <td class="py-2 px-4 border-b">
                                                        <div class="flex space-x-4">
                                                            @foreach (['Siempre' => 0, 'Casi siempre' => 1, 'Algunas veces' => 2, 'Casi nunca' => 3, 'Nunca' => 4] as $opcion => $valor)
                                                                <label class="inline-flex items-center">
                                                                    <input type="radio" wire:model.live.live="respuestas.{{ $pregunta->id }}" value="{{ $valor }}" class="form-radio">
                                                                    <span class="ml-2">{{ $opcion }}</span>
                                                                </label>
                                                            @endforeach
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        </div>
                     @else
                        <div class="mb-8">
                            <p>No es necesario completar el cuestionario 2.</p>
                            <button wire:click="nextStep" class="bg-blue-500 text-white px-4 py-2 rounded-md">Siguiente</button>
                        </div>
                    @endif
                @endif



<!-- Paso 4: Cuestionario 3 -->
@if ($currentStep == 4)
@if ($encuesta->cuestionarios->contains(3))
    <div class="mb-8">
        <h2 class="text-xl font-semibold text-gray-700 mb-4">Cuestionario 3: Condiciones de trabajo</h2>

        <!-- Indicación 1: Condiciones ambientales -->
        <div class="mb-8">
            <h3 class="text-lg font-semibold text-gray-700 mb-4">
                Para responder las preguntas siguientes considere las condiciones ambientales de su centro de trabajo.
            </h3>
            <table class="min-w-full bg-white border border-gray-200">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="py-2 px-4 border-b">Pregunta</th>
                        <th class="py-2 px-4 border-b">Respuesta</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($preguntas->whereIn('id', [68, 70, 69, 71, 72]) as $pregunta)
                        <tr wire:key="pregunta-{{ $pregunta->id }}">
                            <td class="py-2 px-4 border-b">{{ $pregunta->Pregunta }}</td>
                            <td class="py-2 px-4 border-b">
                                <div class="flex space-x-4">
                                    @foreach (['Siempre' => 0, 'Casi siempre' => 1, 'Algunas veces' => 2, 'Casi nunca' => 3, 'Nunca' => 4] as $opcion => $valor)
                                        <label class="inline-flex items-center">
                                            <input type="radio" wire:model.live.live="respuestas.{{ $pregunta->id }}" value="{{ $valor }}" class="form-radio">
                                            <span class="ml-2">{{ $opcion }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Indicación 2: Cantidad y ritmo de trabajo -->
        <div class="mb-8">
            <h3 class="text-lg font-semibold text-gray-700 mb-4">
                Para responder a las preguntas siguientes piense en la cantidad y ritmo de trabajo que tiene.
            </h3>
            <table class="min-w-full bg-white border border-gray-200">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="py-2 px-4 border-b">Pregunta</th>
                        <th class="py-2 px-4 border-b">Respuesta</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($preguntas->whereIn('id', [73, 74, 75]) as $pregunta)
                        <tr wire:key="pregunta-{{ $pregunta->id }}">
                            <td class="py-2 px-4 border-b">{{ $pregunta->Pregunta }}</td>
                            <td class="py-2 px-4 border-b">
                                <div class="flex space-x-4">
                                    @foreach (['Siempre' => 0, 'Casi siempre' => 1, 'Algunas veces' => 2, 'Casi nunca' => 3, 'Nunca' => 4] as $opcion => $valor)
                                        <label class="inline-flex items-center">
                                            <input type="radio" wire:model.live.live="respuestas.{{ $pregunta->id }}" value="{{ $valor }}" class="form-radio">
                                            <span class="ml-2">{{ $opcion }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Indicación 3: Esfuerzo mental -->
        <div class="mb-8">
            <h3 class="text-lg font-semibold text-gray-700 mb-4">
                Las preguntas siguientes están relacionadas con el esfuerzo mental que le exige su trabajo.
            </h3>
            <table class="min-w-full bg-white border border-gray-200">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="py-2 px-4 border-b">Pregunta</th>
                        <th class="py-2 px-4 border-b">Respuesta</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($preguntas->whereIn('id', [76, 77, 78, 79]) as $pregunta)
                        <tr wire:key="pregunta-{{ $pregunta->id }}">
                            <td class="py-2 px-4 border-b">{{ $pregunta->Pregunta }}</td>
                            <td class="py-2 px-4 border-b">
                                <div class="flex space-x-4">
                                    @foreach (['Siempre' => 0, 'Casi siempre' => 1, 'Algunas veces' => 2, 'Casi nunca' => 3, 'Nunca' => 4] as $opcion => $valor)
                                        <label class="inline-flex items-center">
                                            <input type="radio" wire:model.live.live="respuestas.{{ $pregunta->id }}" value="{{ $valor }}" class="form-radio">
                                            <span class="ml-2">{{ $opcion }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Indicación 4: Actividades y responsabilidades -->
        <div class="mb-8">
            <h3 class="text-lg font-semibold text-gray-700 mb-4">
                Las preguntas siguientes están relacionadas con las actividades que realiza en su trabajo y las responsabilidades que tiene.
            </h3>
            <table class="min-w-full bg-white border border-gray-200">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="py-2 px-4 border-b">Pregunta</th>
                        <th class="py-2 px-4 border-b">Respuesta</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($preguntas->whereIn('id', [80, 81, 82, 83]) as $pregunta)
                        <tr wire:key="pregunta-{{ $pregunta->id }}">
                            <td class="py-2 px-4 border-b">{{ $pregunta->Pregunta }}</td>
                            <td class="py-2 px-4 border-b">
                                <div class="flex space-x-4">
                                    @foreach (['Siempre' => 0, 'Casi siempre' => 1, 'Algunas veces' => 2, 'Casi nunca' => 3, 'Nunca' => 4] as $opcion => $valor)
                                        <label class="inline-flex items-center">
                                            <input type="radio" wire:model.live.live="respuestas.{{ $pregunta->id }}" value="{{ $valor }}" class="form-radio">
                                            <span class="ml-2">{{ $opcion }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Indicación 5: Jornada de trabajo -->
        <div class="mb-8">
            <h3 class="text-lg font-semibold text-gray-700 mb-4">
                Las preguntas siguientes están relacionadas con su jornada de trabajo.
            </h3>
            <table class="min-w-full bg-white border border-gray-200">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="py-2 px-4 border-b">Pregunta</th>
                        <th class="py-2 px-4 border-b">Respuesta</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($preguntas->whereIn('id', [84, 85, 86, 87, 88, 89]) as $pregunta)
                        <tr wire:key="pregunta-{{ $pregunta->id }}">
                            <td class="py-2 px-4 border-b">{{ $pregunta->Pregunta }}</td>
                            <td class="py-2 px-4 border-b">
                                <div class="flex space-x-4">
                                    @foreach (['Siempre' => 0, 'Casi siempre' => 1, 'Algunas veces' => 2, 'Casi nunca' => 3, 'Nunca' => 4] as $opcion => $valor)
                                        <label class="inline-flex items-center">
                                            <input type="radio" wire:model.live.live="respuestas.{{ $pregunta->id }}" value="{{ $valor }}" class="form-radio">
                                            <span class="ml-2">{{ $opcion }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Indicación 6: Decisiones en el trabajo -->
        <div class="mb-8">
            <h3 class="text-lg font-semibold text-gray-700 mb-4">
                Las preguntas siguientes están relacionadas con las decisiones que puede tomar en su trabajo.
            </h3>
            <table class="min-w-full bg-white border border-gray-200">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="py-2 px-4 border-b">Pregunta</th>
                        <th class="py-2 px-4 border-b">Respuesta</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($preguntas->whereIn('id', [90, 91, 92, 93, 94]) as $pregunta)
                        <tr wire:key="pregunta-{{ $pregunta->id }}">
                            <td class="py-2 px-4 border-b">{{ $pregunta->Pregunta }}</td>
                            <td class="py-2 px-4 border-b">
                                <div class="flex space-x-4">
                                    @foreach (['Siempre' => 0, 'Casi siempre' => 1, 'Algunas veces' => 2, 'Casi nunca' => 3, 'Nunca' => 4] as $opcion => $valor)
                                        <label class="inline-flex items-center">
                                            <input type="radio" wire:model.live.live="respuestas.{{ $pregunta->id }}" value="{{ $valor }}" class="form-radio">
                                            <span class="ml-2">{{ $opcion }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Indicación 7: Cambios en el trabajo -->
        <div class="mb-8">
            <h3 class="text-lg font-semibold text-gray-700 mb-4">
                Las preguntas siguientes están relacionadas con cualquier tipo de cambio que ocurra en su trabajo.
            </h3>
            <table class="min-w-full bg-white border border-gray-200">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="py-2 px-4 border-b">Pregunta</th>
                        <th class="py-2 px-4 border-b">Respuesta</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($preguntas->whereIn('id', [95, 96]) as $pregunta)
                        <tr wire:key="pregunta-{{ $pregunta->id }}">
                            <td class="py-2 px-4 border-b">{{ $pregunta->Pregunta }}</td>
                            <td class="py-2 px-4 border-b">
                                <div class="flex space-x-4">
                                    @foreach (['Siempre' => 0, 'Casi siempre' => 1, 'Algunas veces' => 2, 'Casi nunca' => 3, 'Nunca' => 4] as $opcion => $valor)
                                        <label class="inline-flex items-center">
                                            <input type="radio" wire:model.live.live="respuestas.{{ $pregunta->id }}" value="{{ $valor }}" class="form-radio">
                                            <span class="ml-2">{{ $opcion }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Indicación 8: Capacitación e información -->
        <div class="mb-8">
            <h3 class="text-lg font-semibold text-gray-700 mb-4">
                Las preguntas siguientes están relacionadas con la capacitación e información que se le proporciona sobre su trabajo.
            </h3>
            <table class="min-w-full bg-white border border-gray-200">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="py-2 px-4 border-b">Pregunta</th>
                        <th class="py-2 px-4 border-b">Respuesta</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($preguntas->whereIn('id', [97, 98, 99, 100, 101, 102]) as $pregunta)
                        <tr wire:key="pregunta-{{ $pregunta->id }}">
                            <td class="py-2 px-4 border-b">{{ $pregunta->Pregunta }}</td>
                            <td class="py-2 px-4 border-b">
                                <div class="flex space-x-4">
                                    @foreach (['Siempre' => 0, 'Casi siempre' => 1, 'Algunas veces' => 2, 'Casi nunca' => 3, 'Nunca' => 4] as $opcion => $valor)
                                        <label class="inline-flex items-center">
                                            <input type="radio" wire:model.live.live="respuestas.{{ $pregunta->id }}" value="{{ $valor }}" class="form-radio">
                                            <span class="ml-2">{{ $opcion }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Indicación 9: Liderazgo -->
        <div class="mb-8">
            <h3 class="text-lg font-semibold text-gray-700 mb-4">
                Las preguntas siguientes están relacionadas con el o los jefes con quien tiene contacto.
            </h3>
            <table class="min-w-full bg-white border border-gray-200">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="py-2 px-4 border-b">Pregunta</th>
                        <th class="py-2 px-4 border-b">Respuesta</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($preguntas->whereIn('id', [103, 104, 105, 106, 107]) as $pregunta)
                        <tr wire:key="pregunta-{{ $pregunta->id }}">
                            <td class="py-2 px-4 border-b">{{ $pregunta->Pregunta }}</td>
                            <td class="py-2 px-4 border-b">
                                <div class="flex space-x-4">
                                    @foreach (['Siempre' => 0, 'Casi siempre' => 1, 'Algunas veces' => 2, 'Casi nunca' => 3, 'Nunca' => 4] as $opcion => $valor)
                                        <label class="inline-flex items-center">
                                            <input type="radio" wire:model.live.live="respuestas.{{ $pregunta->id }}" value="{{ $valor }}" class="form-radio">
                                            <span class="ml-2">{{ $opcion }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Indicación 10: Relaciones con compañeros -->
        <div class="mb-8">
            <h3 class="text-lg font-semibold text-gray-700 mb-4">
                Las preguntas siguientes se refieren a las relaciones con sus compañeros.
            </h3>
            <table class="min-w-full bg-white border border-gray-200">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="py-2 px-4 border-b">Pregunta</th>
                        <th class="py-2 px-4 border-b">Respuesta</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($preguntas->whereIn('id', [108, 109, 110, 111, 112]) as $pregunta)
                        <tr wire:key="pregunta-{{ $pregunta->id }}">
                            <td class="py-2 px-4 border-b">{{ $pregunta->Pregunta }}</td>
                            <td class="py-2 px-4 border-b">
                                <div class="flex space-x-4">
                                    @foreach (['Siempre' => 0, 'Casi siempre' => 1, 'Algunas veces' => 2, 'Casi nunca' => 3, 'Nunca' => 4] as $opcion => $valor)
                                        <label class="inline-flex items-center">
                                            <input type="radio" wire:model.live.live="respuestas.{{ $pregunta->id }}" value="{{ $valor }}" class="form-radio">
                                            <span class="ml-2">{{ $opcion }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Indicación 11: Reconocimiento del desempeño -->
        <div class="mb-8">
            <h3 class="text-lg font-semibold text-gray-700 mb-4">
                Las preguntas siguientes están relacionadas con la información que recibe sobre su rendimiento en el trabajo, el reconocimiento, el sentido de pertenencia y la estabilidad que le ofrece su trabajo.
            </h3>
            <table class="min-w-full bg-white border border-gray-200">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="py-2 px-4 border-b">Pregunta</th>
                        <th class="py-2 px-4 border-b">Respuesta</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($preguntas->whereIn('id', [113, 114, 115, 116, 117, 118, 119, 120, 121, 122]) as $pregunta)
                        <tr wire:key="pregunta-{{ $pregunta->id }}">
                            <td class="py-2 px-4 border-b">{{ $pregunta->Pregunta }}</td>
                            <td class="py-2 px-4 border-b">
                                <div class="flex space-x-4">
                                    @foreach (['Siempre' => 0, 'Casi siempre' => 1, 'Algunas veces' => 2, 'Casi nunca' => 3, 'Nunca' => 4] as $opcion => $valor)
                                        <label class="inline-flex items-center">
                                            <input type="radio" wire:model.live.live="respuestas.{{ $pregunta->id }}" value="{{ $valor }}" class="form-radio">
                                            <span class="ml-2">{{ $opcion }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Indicación 12: Violencia laboral -->
        <div class="mb-8">
            <h3 class="text-lg font-semibold text-gray-700 mb-4">
                Las preguntas siguientes están relacionadas con actos de violencia laboral (malos tratos, acoso, hostigamiento, acoso psicológico).
            </h3>
            <table class="min-w-full bg-white border border-gray-200">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="py-2 px-4 border-b">Pregunta</th>
                        <th class="py-2 px-4 border-b">Respuesta</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($preguntas->whereIn('id', [123, 124, 125, 126, 127, 128, 129, 130, 131]) as $pregunta)
                        <tr wire:key="pregunta-{{ $pregunta->id }}">
                            <td class="py-2 px-4 border-b">{{ $pregunta->Pregunta }}</td>
                            <td class="py-2 px-4 border-b">
                                <div class="flex space-x-4">
                                    @foreach (['Siempre' => 0, 'Casi siempre' => 1, 'Algunas veces' => 2, 'Casi nunca' => 3, 'Nunca' => 4] as $opcion => $valor)
                                        <label class="inline-flex items-center">
                                            <input type="radio" wire:model.live.live="respuestas.{{ $pregunta->id }}" value="{{ $valor }}" class="form-radio">
                                            <span class="ml-2">{{ $opcion }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Preguntas clave al final del Cuestionario 3 -->
    <div class="mb-8">
        <h2 class="text-xl font-semibold text-gray-700 mb-4">Preguntas clave</h2>

        <!-- Pregunta: Atención a clientes -->
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">
                En mi trabajo debo brindar servicio a clientes o usuarios:
            </label>
            <div class="mt-1">
                <label class="inline-flex items-center">
                    <input type="radio" wire:model.live.live="atencionClientes" value="1" class="form-radio">
                    <span class="ml-2">Sí</span>
                </label>
                <label class="inline-flex items-center ml-6">
                    <input type="radio" wire:model.live.live="atencionClientes" value="0" class="form-radio">
                    <span class="ml-2">No</span>
                </label>
            </div>
        </div>

        <!-- Preguntas adicionales si atiende clientes -->
        @if ($atencionClientes == 1)
            <div class="mb-8">
                <h3 class="text-lg font-semibold text-gray-700 mb-4">
                    Las preguntas siguientes están relacionadas con la atención a clientes y usuarios.
                </h3>
                <table class="min-w-full bg-white border border-gray-200">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="py-2 px-4 border-b">Pregunta</th>
                            <th class="py-2 px-4 border-b">Respuesta</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($preguntas->whereIn('id', [132, 133, 134, 135]) as $pregunta)
                            <tr wire:key="pregunta-{{ $pregunta->id }}">
                                <td class="py-2 px-4 border-b">{{ $pregunta->Pregunta }}</td>
                                <td class="py-2 px-4 border-b">
                                    <div class="flex space-x-4">
                                        @foreach (['Siempre' => 0, 'Casi siempre' => 1, 'Algunas veces' => 2, 'Casi nunca' => 3, 'Nunca' => 4] as $opcion => $valor)
                                            <label class="inline-flex items-center">
                                                <input type="radio" wire:model.live.live="respuestas.{{ $pregunta->id }}" value="{{ $valor }}" class="form-radio">
                                                <span class="ml-2">{{ $opcion }}</span>
                                            </label>
                                        @endforeach
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif

        <!-- Pregunta: Es jefe -->
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">
                Soy jefe de otros trabajadores:
            </label>
            <div class="mt-1">
                <label class="inline-flex items-center">
                    <input type="radio" wire:model.live.live="esJefe" value="1" class="form-radio">
                    <span class="ml-2">Sí</span>
                </label>
                <label class="inline-flex items-center ml-6">
                    <input type="radio" wire:model.live.live="esJefe" value="0" class="form-radio">
                    <span class="ml-2">No</span>
                </label>
            </div>
        </div>

        <!-- Preguntas adicionales si es jefe -->
        @if ($esJefe == 1)
            <div class="mb-8">
                <h3 class="text-lg font-semibold text-gray-700 mb-4">
                    Las siguientes preguntas están relacionadas con las actitudes de las personas que supervisa.
                </h3>
                <table class="min-w-full bg-white border border-gray-200">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="py-2 px-4 border-b">Pregunta</th>
                            <th class="py-2 px-4 border-b">Respuesta</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($preguntas->whereIn('id', [136, 137, 138, 139]) as $pregunta)
                            <tr wire:key="pregunta-{{ $pregunta->id }}">
                                <td class="py-2 px-4 border-b">{{ $pregunta->Pregunta }}</td>
                                <td class="py-2 px-4 border-b">
                                    <div class="flex space-x-4">
                                        @foreach (['Siempre' => 0, 'Casi siempre' => 1, 'Algunas veces' => 2, 'Casi nunca' => 3, 'Nunca' => 4] as $opcion => $valor)
                                            <label class="inline-flex items-center">
                                                <input type="radio" wire:model.live.live="respuestas.{{ $pregunta->id }}" value="{{ $valor }}" class="form-radio">
                                                <span class="ml-2">{{ $opcion }}</span>
                                            </label>
                                        @endforeach
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
    @else
                        <div class="mb-8">
                            <p>No es necesario completar el cuestionario 3.</p>
                            <button wire:click="nextStep" class="bg-blue-500 text-white px-4 py-2 rounded-md">Siguiente</button>
                        </div>
                    @endif
                @endif

                <!-- Paso 5: Resumen y enviar respuestas -->
        @if ($currentStep == 5)
            <div class="mb-8">
                <h2 class="text-xl font-semibold text-gray-700 mb-4">Resumen</h2>
                <p>Por favor, revisa tus respuestas antes de enviarlas.</p>
                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-md">Enviar Respuestas</button>
            </div>
        @endif

        <!-- Botones de navegación -->
        <div class="flex justify-between mt-8">
            @if ($currentStep > 1)
                <button type="button" wire:click="previousStep" class="bg-gray-500 text-white px-4 py-2 rounded-md">Anterior</button>
            @endif
            @if ($currentStep < 5)
                <button type="button" wire:click="nextStep" class="bg-blue-500 text-white px-4 py-2 rounded-md">Siguiente</button>
            @endif
        </div>
    </form>
</div>