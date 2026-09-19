<div class="bg-gradient-to-br bg-gray-100 shadow-lg rounded-lg p-6 border border-gray-200">

    <div class="text-center mb-8">
        <h2 class="text-3xl font-bold text-blue-900 sm:text-4xl">Comparar Perfiles de Puestos</h2>
    </div>

    <div class="mb-6">
        <label for="puesto" class="block text-lg font-semibold text-gray-700 mb-2">Selecciona un puesto:</label>
        <select wire:model.live="perfil"
            class="w-full px-4 py-2 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-gray-700 bg-white shadow-md">
            <option value="">Elige un puesto...</option>
            @foreach ($puestos as $puesto)
                <option value="{{ $puesto->id }}">{{ $puesto->nombre_puesto }}</option>
            @endforeach
        </select>
    </div>

    <div class="flex flex-col md:flex-row min-h-screen">

        <div class="w-full md:w-1/2 p-4 flex flex-col">
            <div class="bg-white rounded-lg shadow-xl p-8 flex-1">
                <h2 class="text-3xl font-bold text-center text-indigo-700">{{ $perfilactual->nombre_puesto ?? 'Sin asignar' }}</h2>
                <p class="text-gray-600 mt-2"><strong class="text-gray-600">Area:</strong> {{ $perfilactual?->area ?? 'No definido' }}</p>
                <p class="text-gray-600"><strong class="text-gray-600">Proceso:</strong> {{ $perfilactual?->proceso ?? 'No definido' }}</p>
                <p class="text-gray-600"><strong class="text-gray-600">Misión:</strong> {{ $perfilactual?->mision ?? 'No definido' }}</p>

                <div class="mt-4">
                    <h3 class="text-xl font-bold text-indigo-700 mb-3">Funciones Específicas</h3>
                    @forelse($funcionesEspecificas as $funcion)
                        <div class="bg-white shadow-md rounded-lg p-4 mb-3 border-l-4 border-indigo-500">
                            <p class="text-gray-800"><strong class="text-indigo-600">Nombre:</strong> {{ $funcion->nombre }}</p>
                        </div>
                    @empty
                        <div class="text-gray-500 italic">No hay funciones específicas registradas</div>
                    @endforelse
                </div>

                <p class="text-gray-600"><strong class="text-gray-600">Puesto Reporta:</strong> {{ $perfilactual?->puesto_reporta ?? 'No definido' }}</p>
                <p class="text-gray-600"><strong class="text-gray-600">Puestos que le reportan: </strong> {{ $perfilactual?->puestos_que_le_reportan ?? 'No definido' }}</p>
                <p class="text-gray-600"><strong class="text-gray-600">Suplencia: </strong> {{ $perfilactual?->suplencia ?? 'No definido' }}</p>

                <div class="mt-4">
                    <h3 class="text-xl font-bold text-indigo-700 mb-3">Relaciones Internas</h3>
                    @forelse($relacionesInternas as $interna)
                        <div class="bg-white shadow-md rounded-lg p-4 mb-3 border-l-4 border-indigo-500">
                            <p class="text-gray-800"><strong class="text-indigo-600">Puesto:</strong>{{ $interna->puesto }}</p>
                            <p class="text-gray-800"><strong class="text-indigo-600">Razón o motivo: </strong>{{ $interna->razon_motivo }}</p>
                            <p class="text-gray-800"><strong class="text-indigo-600">Frecuencia:</strong>{{ $interna->frecuencia }}</p>
                        </div>
                    @empty
                        <div class="text-gray-500 italic">No hay relaciones internas registradas</div>
                    @endforelse
                </div>

                <div class="mt-4">
                    <h3 class="text-xl font-bold text-indigo-700 mb-3">Relaciones Externas</h3>
                    @forelse($relacionesExternas as $interna)
                        <div class="bg-white shadow-md rounded-lg p-4 mb-3 border-l-4 border-indigo-500">
                            <p class="text-gray-800"><strong class="text-indigo-600">Nombre:</strong>{{ $interna->nombre }}</p>
                            <p class="text-gray-800"><strong class="text-indigo-600">Razón o motivo: </strong>{{ $interna->razon_motivo }}</p>
                            <p class="text-gray-800"><strong class="text-indigo-600">Frecuencia:</strong>{{ $interna->frecuencia }}</p>
                        </div>
                    @empty
                        <div class="text-gray-500 italic">No hay relaciones externas registradas</div>
                    @endforelse
                </div>


                <p class="text-gray-600"><strong class="text-gray-600">Rango toma de decisiones:</strong> {{ $perfilactual?->rango_toma_desicones ?? 'No definido' }}</p>
                <p class="text-gray-600"><strong class="text-gray-600">Decisiones directas:</strong> {{ $perfilactual?->desiciones_directas ?? 'No definido' }}</p>

                <div class="mt-4">
                    <h3 class="text-xl font-bold text-indigo-700 mb-3">Responsabilidades Universales</h3>
                    @forelse($responsabilidadesUniversales as $universal)
                        <div class="bg-white shadow-md rounded-lg p-4 mb-3 border-l-4 border-indigo-500">
                            <p class="text-gray-800"><strong class="text-indigo-600">Sistema:</strong>{{ $universal->sistema }}</p>
                            <p class="text-gray-800"><strong class="text-indigo-600">Responsabilidad: </strong>{{ $universal->responsalidad }}</p>
                        </div>
                    @empty
                        <div class="text-gray-500 italic">No hay relaciones externas asignadas</div>
                    @endforelse
                </div>

                <p class="text-gray-600"><strong class="text-gray-600">Edad deseable:</strong> {{ $perfilactual?->rango_edad_desable ?? 'No definido' }}</p>
                <p class="text-gray-600"><strong class="text-gray-600">Sexo preferente:</strong> {{ $perfilactual?->sexo_preferente ?? 'No definido' }}</p>
                <p class="text-gray-600"><strong class="text-gray-600">Estado civil deseable:</strong> {{ $perfilactual?->estado_civil_deseable ?? 'No definido' }}</p>
                <p class="text-gray-600"><strong class="text-gray-600">Escolaridad:</strong> {{ $perfilactual?->escolaridad ?? 'No definido' }}</p>
                <p class="text-gray-600"><strong class="text-gray-600">Idioma requerido:</strong> {{ $perfilactual?->idioma_requerido ?? 'No definido' }}</p>
                <p class="text-gray-600"><strong class="text-gray-600">Experiencia Requerida:</strong> {{ $perfilactual?->experiencia_requerida ?? 'No definido' }}</p>
                <p class="text-gray-600"><strong class="text-gray-600">Nivel riesgo físico:</strong> {{ $perfilactual?->nivel_riesgo_fisico ?? 'No definido' }}</p>

                <div class="mt-4">
                    <h3 class="text-xl font-bold text-indigo-700 mb-3">Formación y Habilidades Humanas</h3>
                    @forelse($habilidadesHumanas as $humana)
                        <div class="bg-white shadow-md rounded-lg p-4 mb-3 border-l-4 border-indigo-500">
                            <p class="text-gray-800"><strong class="text-indigo-600">Descripción:</strong>{{ $humana->descripcion }}</p>
                            <p class="text-gray-800"><strong class="text-indigo-600">Nivel: </strong>{{ $humana->nivel }}</p>
                        </div>
                    @empty
                        <div class="text-gray-500 italic">No hay relaciones externas asignadas</div>
                    @endforelse
                </div>

                <div class="mt-4">
                    <h3 class="text-xl font-bold text-indigo-700 mb-3">Formación y Habilidades Técnicas</h3>
                    @forelse($habilidadesTecnicas as $tecnica)
                        <div class="bg-white shadow-md rounded-lg p-4 mb-3 border-l-4 border-indigo-500">
                            <p class="text-gray-800"><strong class="text-indigo-600">Descripción:</strong>{{ $tecnica->descripcion }}</p>
                            <p class="text-gray-800"><strong class="text-indigo-600">Nivel: </strong>{{ $tecnica->nivel }}</p>
                        </div>
                    @empty
                        <div class="text-gray-500 italic">No hay relaciones externas asignadas</div>
                    @endforelse
                </div>

                <p class="text-gray-600"><strong class="text-gray-600">Elaboro Nombre:</strong> {{ $perfilactual?->elaboro_nombre ?? 'No definido' }}</p>
                <p class="text-gray-600"><strong class="text-gray-600">Elaboro Puesto:</strong> {{ $perfilactual?->elaboro_puesto ?? 'No definido' }}</p>
                    
                <p class="text-gray-600"><strong class="text-gray-600">Reviso Nombre:</strong> {{ $perfilactual?->reviso_nombre ?? 'No definido' }}</p>
                <p class="text-gray-600"><strong class="text-gray-600">Reviso Puesto:</strong> {{ $perfilactual?->reviso_puesto ?? 'No definido' }}</p>
                    
                <p class="text-gray-600"><strong class="text-gray-600">Autorizo Nombre:</strong> {{ $perfilactual?->autorizo_nombre ?? 'No definido' }}</p>
                <p class="text-gray-600"><strong class="text-gray-600">Autorizo Puesto:</strong> {{ $perfilactual?->autorizo_puesto ?? 'No definido' }}</p>

                <p class="text-gray-600 mt-6">
                    <strong>Estado:</strong> 
                    <span class="px-2 py-1 rounded-md text-white mt-6
                        {{ $perfilactual->status == 'Aprobado' ? 'bg-green-500' : ($perfilactual->status == 'Corregir' ? 'bg-yellow-500' : ($perfilactual->status == 'Rechazado' ? 'bg-red-500' : 'bg-gray-500')) }}">
                        {{ $perfilactual->status }}
                    </span>
                </p>
            </div>
        </div>


        <div class="w-full md:w-1/2 p-4 flex flex-col">

            <div class="bg-white rounded-lg shadow-xl p-8 flex-1">
                <h2 class="text-3xl font-bold text-center text-indigo-700">{{ $detallePuesto->nombre_puesto ?? '---' }}
                </h2>
                <p class="text-gray-600 mt-2"><strong class="text-gray-600">Area:</strong> {{ $detallePuesto->area ?? '---' }}</p>
                <p class="text-gray-600"><strong class="text-gray-600">Proceso:</strong> {{ $detallePuesto->proceso ?? '---' }}</p>
                <p class="text-gray-600"><strong class="text-gray-600">Misión:</strong> {{ $detallePuesto->mision ?? '---' }}</p>

                <div class="mt-4">
                    <h3 class="text-xl font-bold text-indigo-700 mb-3">Funciones Específicas</h3>
                
                    @forelse($detallePuesto->funcionesEspecificas ?? [] as $funcion)
                        <div class="bg-white shadow-md rounded-lg p-4 mb-3 border-l-4 border-indigo-500">
                            <p class="text-gray-800"><strong class="text-indigo-600">Nombre:</strong>{{ $funcion->nombre }}</p>
                        </div>
                    @empty
                        <div class="text-gray-500 italic">No hay funciones registrada</div>
                    @endforelse
                </div>

                <p class="text-gray-600 mt-4"><strong class="text-gray-600">Puesto reporta:</strong> {{ $detallePuesto->puesto_reporta ?? '---' }}</p>
                <p class="text-gray-600"><strong class="text-gray-600">Puestos que le reportan:</strong> {{ $detallePuesto->puestos_que_le_reportan ?? '---' }}</p>
                <p class="text-gray-600"><strong class="text-gray-600">Suplencia</strong> {{ $detallePuesto->suplencia ?? '---' }}</p>

                <div class="mt-4">
                    <h3 class="text-xl font-bold text-indigo-700 mb-3">Relaciones Internas</h3>
                
                    @forelse($detallePuesto->relacionesInternas ?? [] as $relacion)
                        <div class="bg-white shadow-md rounded-lg p-4 mb-3 border-l-4 border-indigo-500">
                            <p class="text-gray-800"><strong class="text-indigo-600">Puesto:</strong> {{ $relacion->puesto }}</p>
                            <p class="text-gray-800"><strong class="text-indigo-600">Razón o motivo:</strong> {{ $relacion->razon_motivo }}</p>
                            <p class="text-gray-800"><strong class="text-indigo-600">Frecuencia:</strong> {{ $relacion->frecuencia }}</p>
                        </div>
                    @empty
                        <div class="text-gray-500 italic">No hay relaciones internas registradas</div>
                    @endforelse
                </div>
                

                <div class="mt-4">
                    <h3 class="text-xl font-bold text-indigo-700 mb-3">Relaciones Externas</h3>
                
                    @forelse($detallePuesto->relacionesExternas ?? [] as $relacion)
                        <div class="bg-white shadow-md rounded-lg p-4 mb-3 border-l-4 border-indigo-500">
                            <p class="text-gray-800"><strong class="text-indigo-600">Nombre:</strong> {{ $relacion->nombre }}</p>
                            <p class="text-gray-800"><strong class="text-indigo-600">Razón o motivo:</strong> {{ $relacion->razon_motivo }}</p>
                            <p class="text-gray-800"><strong class="text-indigo-600">Frecuencia:</strong> {{ $relacion->frecuencia }}</p>
                        </div>
                    @empty
                        <div class="text-gray-500 italic">No hay relaciones externas registradas</div>
                    @endforelse
                </div>

                <p class="text-gray-600 mt-4"><strong class="text-gray-600">Rango toma decisiones: </strong> {{ $detallePuesto->rango_toma_desicones ?? '---' }}</p>
                <p class="text-gray-600"><strong class="text-gray-600">Decisiones directas:</strong> {{ $detallePuesto->desiciones_directas ?? '---' }}</p>

                <div class="mt-4">
                    <h3 class="text-xl font-bold text-indigo-700 mb-3">Responsabilidades Universales</h3>
                
                    @forelse($detallePuesto->responsabilidadesUniversales ?? [] as $resp)
                        <div class="bg-white shadow-md rounded-lg p-4 mb-3 border-l-4 border-indigo-500">
                            <p class="text-gray-800"><strong class="text-indigo-600">Sistema:</strong> {{ $resp->sistema }}</p>
                            <p class="text-gray-800"><strong class="text-indigo-600">Responsabilidad:</strong> {{ $resp->responsalidad }}</p>
                        </div>
                    @empty
                        <div class="text-gray-500 italic">No hay responsabilidades universales registradas</div>
                    @endforelse
                </div>

                <p class="text-gray-600 mt-4"><strong class="text-gray-600">Rango edad deseable:</strong> {{ $detallePuesto->rango_edad_desable ?? '---' }}</p>
                <p class="text-gray-600"><strong class="text-gray-600">Sexo preferente:</strong> {{ $detallePuesto->sexo_preferente ?? '---' }}</p>
                <p class="text-gray-600"><strong class="text-gray-600">Estado civil deseable:</strong> {{ $detallePuesto->estado_civil_deseable ?? '---' }}</p>
                <p class="text-gray-600"><strong class="text-gray-600">Escolaridad:</strong> {{ $detallePuesto->escolaridad ?? '---' }}</p>
                <p class="text-gray-600"><strong class="text-gray-600">Idioma requerido:</strong> {{ $detallePuesto->idioma_requerido ?? '---' }}</p>
                <p class="text-gray-600"><strong class="text-gray-600">Experiencia requerida:</strong> {{ $detallePuesto->experiencia_requerida ?? '---' }}</p>
                <p class="text-gray-600"><strong class="text-gray-600">Nivel riesgis físico:</strong> {{ $detallePuesto->nivel_riesgo_fisico ?? '---' }}</p>

                <div class="mt-4">
                    <h3 class="text-xl font-bold text-indigo-700 mb-3">Habilidades Humanas</h3>
                
                    @forelse($detallePuesto->habilidadesHumanas?? [] as $habilidad)
                        <div class="bg-white shadow-md rounded-lg p-4 mb-3 border-l-4 border-indigo-500">
                            <p class="text-gray-800"><strong class="text-indigo-600">Descripcion:</strong> {{ $habilidad->descripcion }}</p>
                            <p class="text-gray-800"><strong class="text-indigo-600">Nivel:</strong> {{ $habilidad->nivel }}</p>
                        </div>
                    @empty
                        <div class="text-gray-500 italic">No hay habilidades humanas registradas</div>
                    @endforelse
                </div>

                <div class="mt-4">
                    <h3 class="text-xl font-bold text-indigo-700 mb-3">Habilidades Técnicas</h3>
                
                    @forelse($detallePuesto->habilidadesTecnicas?? [] as $habilidad)
                        <div class="bg-white shadow-md rounded-lg p-4 mb-3 border-l-4 border-indigo-500">
                            <p class="text-gray-800"><strong class="text-indigo-600">Descripcion:</strong> {{ $habilidad->descripcion }}</p>
                            <p class="text-gray-800"><strong class="text-indigo-600">Nivel:</strong> {{ $habilidad->nivel }}</p>
                        </div>
                    @empty
                        <div class="text-gray-500 italic">No hay habilidades técnicas registradas</div>
                    @endforelse
                </div>

                <p class="text-gray-600 mt-4"><strong class="text-gray-600">Elaboro nombre:</strong> {{$detallePuesto->elaboro_nombre ?? '---' }}</p>
                <p class="text-gray-600"><strong class="text-gray-600">Elaboro puesto:</strong> {{$detallePuesto->elaboro_puesto ?? '---' }}</p>
                    
                <p class="text-gray-600"><strong class="text-gray-600">Reviso nombre:</strong> {{$detallePuesto->reviso_nombre ?? '---' }}</p>
                <p class="text-gray-600"><strong class="text-gray-600">Reviso puesto:</strong> {{$detallePuesto->reviso_puesto ?? '---' }}</p>
                
                <p class="text-gray-600"><strong class="text-gray-600">Autorizo nombre:</strong> {{$detallePuesto->autorizo_nombre ?? '---' }}</p>
                <p class="text-gray-600"><strong class="text-gray-600">Autorizo puesto:</strong> {{$detallePuesto->autorizo_puesto ?? '---' }}</p>

                <p class="text-gray-600"><strong class="text-gray-600">Estado:</strong> {{$detallePuesto->status ?? '---' }}</p>
            </div>
        </div>
    </div>

    <div class="mt-10 bg-white text-center py-8 px-6 rounded-lg shadow-lg w-full max-w-5xl mx-auto">
        <h2 class="text-2xl font-bold text-blue-900">Conclusión Generada</h2>
    
        @if ($mostrarTabla)
            <div class="overflow-x-auto mt-4">
                <table class="min-w-full bg-white border border-gray-300 shadow-md rounded-lg">
                    <thead class="bg-blue-900 text-white">
                        <tr>
                            <th class="px-4 py-3 text-left">Competencia Evaluada</th>
                            <th class="px-4 py-3 text-center">Nivel de Puesto Actual</th>
                            <th class="px-4 py-3 text-center">Nivel de Puesto a Actualizar</th>
                            <th class="px-4 py-3 text-center">Diferencia</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($habilidadesComparadas as $habilidad)
                            <tr class="hover:bg-gray-100 transition">
                                <td class="px-4 py-3 text-gray-800 text-left">{{ $habilidad['nombre'] }}</td>
                                <td class="px-4 py-3 text-center text-gray-900 font-semibold">{{ $habilidad['nivel_usuario'] }}</td>
                                <td class="px-4 py-3 text-center text-gray-900 font-semibold">{{ $habilidad['nivel_puesto'] }}</td>
                                <td class="px-4 py-3 text-center font-bold 
                                    {{ $habilidad['diferencia'] < 0 ? 'text-red-600' : ($habilidad['diferencia'] > 0 ? 'text-green-600' : 'text-gray-600') }}">
                                    {{ $habilidad['diferencia'] }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <button wire:click="guardarConclusion"
                class="mt-6 px-6 py-2 bg-green-600 text-white text-lg font-semibold rounded-lg shadow-md hover:bg-green-700 transition">
                Guardar Conclusión
            </button>
        @else
            <p class="text-gray-700 mt-4 text-lg italic">
                Aún no hay una conclusión generada por el sistema.
            </p>
        @endif

        <button wire:click="generarConclusion"
            class="mt-6 px-6 py-2 bg-blue-900 text-white text-lg font-semibold rounded-lg shadow-md hover:bg-blue-700 transition">
            Generar Conclusión
        </button>
    </div>
    

    <div class="flex justify-center gap-4 mt-6">
        <button onclick="window.history.back()" class="px-6 py-2 text-white bg-red-600 rounded-lg shadow-md hover:bg-red-700 transition">
            Salir
        </button>

        <button onclick="window.location.href='{{ route('agregarCapacitacionesInd', Crypt::encrypt($userSeleccionado->id)) }}'" 
                class="px-6 py-2 text-white bg-green-600 rounded-lg shadow-md hover:bg-green-700 transition">
            Asignar Capacitación
        </button>
    </div>

    @if (session()->has('success') || session()->has('error'))
    <div class="fixed top-5 right-5 bg-green-600 text-white text-lg px-6 py-3 rounded-lg shadow-lg transition-opacity duration-500"
        style="z-index: 1000;"
        x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show">

        @if (session()->has('success'))
            ✅ {{ session('success') }}
        @endif

        @if (session()->has('error'))
            ❌ {{ session('error') }}
        @endif
    </div>
    @endif

</div>