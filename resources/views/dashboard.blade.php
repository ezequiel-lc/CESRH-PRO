<x-app-layout >
    <div >
        <div class="gradient"></div>
        <div class="">
            <div class="w-full text-center">
                <p class="text-sm tracking-widest text-white">Sistema</p>
                <h1 class="font-bold text-5xl text-white">
                    Rh Pro
                </h1>
            </div>

            <!-- Primer grupo de módulos -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

                <div class="p-2 sm:p-6 text-center cursor-pointer">
                    <a href="{{ route('inicio') }}">
                        <div class="py-16 max-w-sm rounded overflow-hidden shadow-lg hover:bg-white transition duration-500 bg-white">
                            <div class="space-y-10">
                                <i class="fas fa-user-circle" style="font-size:48px;"></i>
                                <div class="px-6 py-4">
                                    <div class="space-y-5">
                                        <div class="font-bold text-xl mb-2">Módulo Recursos Humanos</div>
                                        <p class="text-gray-700 text-base">Todo tipo de masajes y técnicas</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="p-2 sm:p-6 text-center cursor-pointer">
                    <a href="{{ route('inicio-activo') }}">
                        <div class="py-16 max-w-sm rounded overflow-hidden shadow-lg bg-blue-500 hover:bg-blue-600 transition duration-500">
                            <div class="space-y-10">
                                <i class="fas fa-user-circle" style="font-size:48px;"></i>
                                <div class="px-6 py-4">
                                    <div class="space-y-5">
                                        <div class="font-bold text-xl mb-2">Módulo Activo Fijo</div>
                                        <p class="text-base">Altos estandares de bioseguridad</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="p-2 sm:p-6 text-center cursor-pointer">
                    <a href="{{ route('inicio-capacitacion') }}">
                        <div class="py-16 max-w-sm rounded overflow-hidden shadow-lg hover:bg-white transition duration-500 bg-white">
                            <div class="space-y-10">
                                <i class="fas fa-user-circle" style="font-size:48px;"></i>
                                <div class="px-6 py-4">
                                    <div class="space-y-5">
                                        <div class="font-bold text-xl mb-2">Módulo Portal Capacitacion</div>
                                        <p class="text-gray-700 text-base">Piscina temperada</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

            </div>

            <!-- Segundo grupo de módulos -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-8">

                <div class="p-2 sm:p-6 text-center cursor-pointer">
                    <a href="{{ route('encuesta.index') }}">
                        <div class="py-16 max-w-sm rounded overflow-hidden shadow-lg hover:bg-white transition duration-500 bg-white">
                            <div class="space-y-10">
                                <i class="fas fa-user-circle" style="font-size:48px;"></i>
                                <div class="px-6 py-4">
                                    <div class="space-y-5">
                                        <div class="font-bold text-xl mb-2">Módulo Dx035</div>
                                        <p class="text-gray-700 text-base">Todo tipo de masajes y técnicas</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="p-2 sm:p-6 text-center cursor-pointer">
                    <a href="{{ route('portal360.inicio') }}">
                        <div class="py-16 max-w-sm rounded overflow-hidden shadow-lg bg-blue-500 hover:bg-blue-600 transition duration-500">
                            <div class="space-y-10">
                                <i class="fas fa-user-circle" style="font-size:48px;"></i>
                                <div class="px-6 py-4">
                                    <div class="space-y-5">
                                        <div class="font-bold text-xl mb-2">Módulo Encuesta 360</div>
                                        <p class="text-base">Altos estandares de bioseguridad</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="p-2 sm:p-6 text-center cursor-pointer">
                    <a href="{{ route('InicioCrm') }}">
                        <div class="py-16 max-w-sm rounded overflow-hidden shadow-lg hover:bg-white transition duration-500 bg-white">
                            <div class="space-y-10">
                                <i class="fas fa-user-circle" style="font-size:48px;"></i>
                                <div class="px-6 py-4">
                                    <div class="space-y-5">
                                        <div class="font-bold text-xl mb-2">Módulo CRM</div>
                                        <p class="text-gray-700 text-base">Piscina temperada</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

            </div>
        </div>
    </div>
    {{-- <div class=" bg-red-500/20">
        <livewire:yes/> 
    </div> --}}
</x-app-layout>
