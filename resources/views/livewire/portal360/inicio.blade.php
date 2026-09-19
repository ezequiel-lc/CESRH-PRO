<div class="min-h-screen  flex justify-center items-start p-4">
    <!-- Contenido principal -->
    <div class="bg-white shadow-xl rounded-lg p-6 w-full max-w-8xl">

        <!-- Sección de Bienvenida -->
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-blue-600">Bienvenido(a) a la Encuesta 360° de CESRH Consulting</h1>
            <p class="text-lg text-gray-900 mt-2">
                Administrador
            </p>
            <p class="text-gray-800 mt-2">
                Desde este panel, puedes gestionar usuarios, asignar encuestas y supervisar el proceso de evaluación. Tu labor es clave para garantizar una evaluación efectiva y transparente.
            </p>
        </div>

        <!-- Línea divisoria -->
        <div class="border-b border-gray-200 mb-8"></div>

        <!-- Opciones para Administradores -->
        <div>
            <!-- <h2 class="text-2xl font-semibold text-gray-800 text-center mb-8">
                Administrador 
            </h2> -->

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @can('Mostrar Relaciones Laborales ADMIN')
                <a href="{{ route('portal360.relaciones.relaciones-administrador.mostrar-relacion-administrador') }}"
                    class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 border border-gray-200 flex items-center space-x-4">
                    <div class="p-3 bg-teal-100 rounded-full">
                        <svg class="w-8 h-8 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-700">Relaciones Laborales</h3>
                    </div>
                </a>
                @endcan

                @can('Mostrar Empresa ADMIN')
                <a href="{{ route('portal360.empresa.empresa-administrador.mostrar-empresa-administrador') }}"
                    class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 border border-gray-200 flex items-center space-x-4">
                    <div class="p-3 bg-purple-100 rounded-full">
                        <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a2 2 0 012-2h2a2 2 0 012 2v5m-4 0h4"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-700">Empresa</h3>
                    </div>
                </a>
                @endcan

                
                
                @can('Mostrar Preguntas ADMIN')
                <a href="{{ route('portal360.preguntas.preguntas-administrador.mostrar-preguntas-administrador') }}"
                    class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 border border-gray-200 flex items-center space-x-4">
                    <div class="p-3 bg-purple-100 rounded-full">
                        <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-700">Preguntas </h3>
                    </div>
                </a>
                @endcan

                @can('Mostrar Encuesta ADMIN')
                <a href="{{ route('portal360.encuesta.encuesta-administrador.mostrar-encuesta-administrador') }}"
                    class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 border border-gray-200 flex items-center space-x-4">
                    <div class="p-3 bg-indigo-100 rounded-full">
                        <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-700">Encuesta </h3>
                    </div>
                </a>
                @endcan

                @can('Mostrar Asignaciones ADMIN')
                <a href="{{ route('portal360.asignaciones.asignaciones-administrador.mostrar-asignaciones-administrador') }}"
                    class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 border border-gray-200 flex items-center space-x-4">
                    <div class="p-3 bg-blue-100 rounded-full">
                        <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-6h6v6m-3-6v6m-6 0h12a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-700">Asignaciones</h3>
                    </div>
                </a>
                @endcan

                @can('Mostrar Encpre ADMIN')
                <a href="{{ route('portal360.encpre.encuesta-pregunta-encpre-administrador.mostrar-encuesta-pregunta-encpre-administrador') }}"
                    class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 border border-gray-200 flex items-center space-x-4">
                    <div class="p-3 bg-orange-100 rounded-full">
                        <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01m-.01 4h.01"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-700">Preguntas y Encuestas</h3>
                    </div>
                </a>
                @endcan

                
                <a href="{{ route('portal360.resultados.administrador-resultados.mostrar-empresa-administrador-resultadosvs') }}"
                    class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 border border-gray-200 flex items-center space-x-4">
                    <div class="p-3 bg-teal-100 rounded-full">
                        <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 6 9 17l-5-5"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-700">Resultados</h3>
                    </div>
                </a>


                <a href="{{ route('portal360.compromiso.compromiso-administrador.mostrar-compromiso-administrador') }}"
                    class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 border border-gray-200 flex items-center space-x-4">
                    <div class="p-3 bg-teal-100 rounded-full">
                        <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m11 17 2 2a1 1 0 1 0 3-3"></path></path><path d="m14 14 2.5 2.5a1 1 0 1 0 3-3l-3.88-3.88a3 3 0 0 0-4.24 0l-.88.88a1 1 0 1 1-3-3l2.81-2.81a5.79 5.79 0 0 1 7.06-.87l.47.28a2 2 0 0 0 1.42.25L21 4"></path><path d="m21 3 1 11h-2"></path><path d="M3 3 2 14l6.5 6.5a1 1 0 1 0 3-3"></path><path d="M3 4h8"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-700">Compromisos</h3>
                    </div>
                </a>
            
           
           




        



            </div>
        </div>

        <!-- Contacto -->
        <div class="mt-12 text-center">
            <p class="text-sm text-gray-500">
                Si tienes alguna duda, contáctanos en
                <a href="mailto:soporte@cesrh.com" class="text-blue-600 hover:underline">soporte@cesrh.com</a>.
            </p>
        </div>
    </div>
</div>