<div class="container mx-auto p-6">
    <h2 class="text-3xl font-bold text-gray-800 mb-6">📂 Evidencias del Grupo</h2>

    <div class="flex space-x-4">
        <!-- Botón de Agregar Evidencia -->
        <button
            onclick="window.location.href='{{ route('agregarEvidenciasGruTrabajador', Crypt::encrypt($caps_grupales_id)) }}'"
            class="bg-green-600 text-white px-4 py-2 rounded-md shadow-md hover:bg-green-700 hover:shadow-lg 
                flex items-center gap-2 transition-all duration-300 transform hover:scale-105 focus:outline-none">
            <i class="fas fa-plus text-lg"></i>
            <span class="text-sm font-semibold">Agregar evidencia</span>
        </button>

        @if ($tieneEvidenciasAprobadas)
            <!-- Botón de Descargar Reconocimiento -->
            <a href="{{ route('descargar.reconocimiento', Crypt::encrypt($caps_grupales_id)) }}"
                class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition-all transform hover:scale-105 
                flex items-center gap-2 shadow-md hover:shadow-lg focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                </svg>
                <span class="text-sm font-semibold">Descargar Reconocimiento</span>
            </a>
        @endif
    </div>

    <div class="space-y-8 mt-6">
        <!-- 📌 Evidencias Aprobadas Agrupadas -->
        @if ($evidencias_aprobadas->count() > 0)
            <div class="bg-white shadow-md rounded-xl p-6 border-l-4 border-green-500">
                <h3 class="text-xl font-semibold text-green-600">✅ Evidencias Aprobadas</h3>
                @foreach ($evidencias_aprobadas->groupBy('comentarios') as $comentario => $grupoEvidencias)
                    <div class="bg-gray-50 p-4 rounded-lg shadow-sm mb-4">
                        <p class="text-gray-600 text-gr">📅 <span class="font-semibold">Fecha:</span>
                            {{ $grupoEvidencias->first()->fecha }}</p>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mt-3">
                            @foreach ($grupoEvidencias as $evidencia)
                                <img src="{{ asset('storage/' . $evidencia->evidencias) }}"
                                    class="w-full h-40 object-cover rounded-lg shadow">
                            @endforeach
                        </div>
                        @php
                            $documentosAsociados = $documentos->whereIn('evidencia_id', $grupoEvidencias->pluck('id'));
                        @endphp
                        @if ($documentosAsociados->count() > 0)
                            <h4 class="text-md font-semibold mt-3">📄 Documentos PDF</h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mt-2">
                                @foreach ($documentosAsociados as $doc)
                                    <iframe src="{{ asset('storage/' . $doc->urlEsca) }}"
                                        class="w-full h-48 border rounded-lg"></iframe>
                                @endforeach
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        @endif

        <!-- 📌 Evidencias Rechazadas Agrupadas -->
        @if ($evidencias_rechazadas->count() > 0)
            <div class="bg-white shadow-md rounded-xl p-6 border-l-4 border-red-500">
                <h3 class="text-xl font-semibold text-red-600">❌ Evidencias Rechazadas</h3>
                @foreach ($evidencias_rechazadas->groupBy('comentarios') as $comentario => $grupoEvidencias)
                    <div class="bg-gray-50 p-4 rounded-lg shadow-sm mb-4">
                        <p class="text-gray-700 font-medium">📝 <span class="font-semibold">Comentario:</span>
                            {{ $comentario }}</p>
                        <p class="text-gray-600 text-gr">📅 <span class="font-semibold">Fecha:</span>
                            {{ $grupoEvidencias->first()->fecha }}</p>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mt-3">
                            @foreach ($grupoEvidencias as $evidencia)
                                <img src="{{ asset('storage/' . $evidencia->evidencias) }}"
                                    class="w-full h-40 object-cover rounded-lg shadow">
                            @endforeach
                        </div>
                        @php
                            $documentosAsociados = $documentos->whereIn('evidencia_id', $grupoEvidencias->pluck('id'));
                        @endphp
                        @if ($documentosAsociados->count() > 0)
                            <h4 class="text-md font-semibold mt-3">📄 Documentos PDF</h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mt-2">
                                @foreach ($documentosAsociados as $doc)
                                    <iframe src="{{ asset('storage/' . $doc->urlEsca) }}"
                                        class="w-full h-48 border rounded-lg"></iframe>
                                @endforeach
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        @endif

        <!-- 📌 Evidencias Pendientes -->
        @if ($evidencias_pendientes->count() > 0)
            <div class="bg-white shadow-md rounded-xl p-6 border-l-4 border-yellow-400">
                <h3 class="text-xl font-semibold text-yellow-600">⚠️ Evidencias Pendientes</h3>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach ($evidencias_pendientes as $evidencia)
                        <div class="bg-gray-100 p-4 rounded-lg shadow">
                            <img src="{{ asset('storage/' . $evidencia->evidencias) }}"
                                class="w-full h-40 object-cover rounded-lg">
                        </div>
                    @endforeach
                </div>
                @php
                $documentosAsociados = $documentos->whereIn('evidencia_id', $grupoEvidencias->pluck('id'));
                @endphp
                @if ($documentosAsociados->count() > 0)
                    <h4 class="text-md font-semibold mt-3">📄 Documentos PDF</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mt-2">
                        @foreach ($documentosAsociados as $doc)
                            <iframe src="{{ asset('storage/' . $doc->urlEsca) }}"
                                class="w-full h-48 border rounded-lg"></iframe>
                        @endforeach
                    </div>
                @endif
            </div>
        @endif
    </div>
</div>

    
   