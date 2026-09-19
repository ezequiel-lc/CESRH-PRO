<!-- component -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.1/chart.min.js"></script>
</head>

<div>
    <div class="h-full bg-gray-200 p-8">
        <div class="bg-white rounded-lg shadow-xl pb-8">

            <div class="w-full h-[250px]">
                <img src="https://vojislavd.com/ta-template-demo/assets/img/profile-background.jpg"
                    class="w-full h-full rounded-tl-lg rounded-tr-lg">
            </div>
            <div class="flex flex-col items-center -mt-10"> <!-- Reducimos el -mt para que baje la imagen -->
                <div class="relative mx-auto w-32 h-32 -mt-5">
                    <!-- Círculo blanco detrás de la imagen -->
                    <div class="absolute inset-0 w-32 h-32 bg-white rounded-full"></div>
                
                    <!-- Imagen del usuario -->
                    <img src="{{ asset('img/user.png') }}" class="relative object-cover object-center h-32 w-32 rounded-full">
                </div>

                <div class="flex items-center space-x-2 mt-2">
                    <p class="text-2xl">{{ $usuario->name ?? 'Sin Nombre' }}</p>
                    <span class="bg-blue-500 rounded-full p-1" title="Verified">
                        <svg xmlns="http://www.w3.org/2000/svg" class="text-gray-100 h-2.5 w-2.5" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="4" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                    </span>
                </div>

                <p class="text-gray-700">{{ $becario->clave_becario }}</p>
                <p class="text-sm text-gray-500">{{ $becario->lugar_nacimiento }}, {{ $becario->estado }}</p>
            </div>


            <div class="flex-1 flex flex-col items-center lg:items-end justify-end px-8 mt-2">
                <div class="flex items-center space-x-4 mt-2">

                    <button wire:click.prevent="generatePDF({{ $becario->id }})"
                        wire:loading.attr="disabled"
                        class='w-auto bg-blue-500 hover:bg-blue-700 rounded-lg shadow-xl font-medium text-white px-4 py-2' transition ease-in duration-300">
                    <span wire:loading.remove>Generar Reporte</span>
                    <span wire:loading>
                        <i class="fa-solid fa-spinner animate-spin text-lg text-white mr-3"></i>
                        Procesando...
                    </span>
                </button>
                </div>
            </div>
        </div>

        <div class="my-4 flex flex-col 2xl:flex-row space-y-4 2xl:space-y-0 2xl:space-x-4">
            <div class="w-full flex flex-col 2xl:w-1/3">
                <div class="flex-1 bg-white rounded-lg shadow-xl p-8">
                    <h4 class="text-xl text-gray-900 font-bold">Información Personal</h4>
                    <ul class="mt-2 text-gray-700">
                        <li class="flex border-y py-2">
                            <span class="font-bold w-44">Nombre: </span>
                            <span class="text-gray-700">{{ $usuario->name ?? 'Sin Nombre' }}</span>
                        </li>
                        <li class="flex border-b py-2">
                            <span class="font-bold w-44">Clave de Becario: </span>
                            <span class="text-gray-700">{{ $becario->clave_becario }}</span>
                        </li>
                        <li class="flex border-b py-2">
                            <span class="font-bold w-44">NSS: </span>
                            <span class="text-gray-700">{{ $becario->numero_seguridad_social }}</span>
                        </li>
                        <li class="flex border-b py-2">
                            <span class="font-bold w-44">Fecha de nacimiento:</span>
                            <span class="text-gray-700">{{ $becario->fecha_nacimiento }}</span>
                        </li>
                        <li class="flex border-b py-2">
                            <span class="font-bold w-44">Lugar de nacimiento: </span>
                            <span class="text-gray-700">{{ $becario->lugar_nacimiento }}</span>
                        </li>
                        <li class="flex border-b py-2">
                            <span class="font-bold w-44">Estado: </span>
                            <span class="text-gray-700">{{ $becario->estado }}</span>
                        </li>
                        <li class="flex border-b py-2">
                            <span class="font-bold w-44">Código Postal:</span>
                            <span class="text-gray-700">{{ $becario->codigo_postal }}</span>
                        </li>
                        <li class="flex border-b py-2">
                            <span class="font-bold w-44">Ocupación:</span>
                            <span class="text-gray-700">{{ $becario->ocupacion }}</span>
                        </li>
                        <li class="flex border-b py-2">
                            <span class="font-bold w-44">Sexo:</span>
                            <span class="text-gray-700">{{ $becario->sexo }}</span>
                        </li>
                        <li class="flex border-b py-2">
                            <span class="font-bold w-44">CURP:</span>
                            <span class="text-gray-700">{{ $becario->curp }}</span>
                        </li>
                        <li class="flex border-b py-2">
                            <span class="font-bold w-44">RFC:</span>
                            <span class="text-gray-700">{{ $becario->rfc }}</span>
                        </li>
                        <li class="flex border-b py-2">
                            <span class="font-bold w-44">Número de celular:</span>
                            <span class="text-gray-700"> +52 | {{ $becario->numero_celular }}</span>
                        </li>
                        <li class="flex border-b py-2">
                            <span class="font-bold w-44">Fecha de ingreso:</span>
                            <span class="text-gray-700">{{ $becario->fecha_ingreso }}</span>
                        </li>
                        <li class="flex border-b py-2">
                            <span class="font-bold w-44">Status:</span>
                            <span
                                class="{{ $becario->status === 'Activo' ? 'bg-green-500' : 'bg-red-500' }} py-1 px-2 rounded text-white text-sm">
                                {{ $becario->status }}
                            </span>
                        </li>

                        <li class="flex border-b py-2">
                            <span class="font-bold w-44">Calle:</span>
                            <span class="text-gray-700">{{ $becario->calle }}</span>
                        </li>
                        <li class="flex border-b py-2">
                            <span class="font-bold w-44">Colonia:</span>
                            <span class="text-gray-700">{{ $becario->colonia }}</span>
                        </li>
                        <li class="flex border-b py-2">
                            <span class="font-bold w-44">Registro Patronal:</span>
                            <span
                                class="text-gray-700">{{ $registro_patronal->registro_patronal ?? 'Sin Registro Patronal' }}</span>
                        </li>
                        <li class="flex border-b py-2">
                            <span class="font-bold w-44">Empresa:</span>
                            <span class="text-gray-700">{{ $empresa->nombre ?? 'Sin Empresa' }}</span>
                        </li>
                        <li class="flex border-b py-2">
                            <span class="font-bold w-44">Sucursal:</span>
                            <span class="text-gray-700">{{ $sucursal->nombre_sucursal ?? 'Sin Sucursal' }}</span>
                        </li>
                        <li class="flex border-b py-2">
                            <span class="font-bold w-44">Departamento:</span>
                            <span
                                class="text-gray-700">{{ $departamento->nombre_departamento ?? 'Sin Departamento' }}</span>
                        </li>
                        <li class="flex border-b py-2">
                            <span class="font-bold w-44">Puesto:</span>
                            <span class="text-gray-700">{{ $puesto->nombre_puesto ?? 'Sin Puesto' }}</span>
                        </li>

                    </ul> <br>

                    <h4 class="text-xl text-gray-900 font-bold">Incapacidades</h4>
                    
                    <div class="mt-5 mx-7">
                        @if ($incapacidades->isEmpty())
                            <div class="p-6 text-center text-gray-600">
                                <p>Sin incapacidades actualmente</p>
                            </div>
                        @else
                            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 p-6">
                                @foreach ($incapacidades as $incapacidad)
                                    <div class="w-full mx-auto bg-white shadow-xl rounded-lg text-gray-900 p-4">
                                        <div class="rounded-t-lg h-32 overflow-hidden">
                                            <img class="object-cover object-top w-full" src="{{ asset('img/cesrh.jpeg') }}"
                                                alt="Background">
                                        </div>
            
                                        <div class="text-center mt-2">
                                            <h2><strong>Usuario:</strong>
                                                {{ $incapacidad->users->first() ? $incapacidad->users->first()->name : 'Sin asignar' }}
                                            </h2>
                                            <p><strong>Tipo de incapacidad:</strong> {{ $incapacidad->tipo }}</p>
                                            <p><strong>Motivo:</strong> {{ $incapacidad->motivo }}</p>
                                            <p class="my-2">
                                                <strong>Status:</strong> 
                                                <span class="py-1 px-3 rounded text-white 
                                                    {{ $incapacidad->status === 'Pendiente' ? 'bg-yellow-500' : 
                                                       ($incapacidad->status === 'Aprobada' ? 'bg-green-500' : 'bg-red-500') }}">
                                                    {{ $incapacidad->status }}
                                                </span>
                                            </p>                                            
                                            <p><strong>Fecha inicio:</strong> {{ $incapacidad->fecha_inicio }}</p>
                                            <p><strong>Fecha final:</strong> {{ $incapacidad->fecha_final }}</p>
                                        </div>
            
                                        <div class="flex gap-4 mt-4">
                                            <!-- Aquí pueden ir botones o acciones -->
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <h4 class="text-xl text-gray-900 font-bold">Incidencias</h4>
                    <div class="mt-5 mx-7">
                        @if ($incidencias->isEmpty())
                            <div class="p-6 text-center text-gray-600">
                                <p>Sin incidencias actualmente</p>
                            </div>
                        @else
                            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 p-6">
                                @foreach ($incidencias as $incidencia)
                                    <div class="w-full mx-auto bg-white shadow-xl rounded-lg text-gray-900 p-4">
                                        <div class="rounded-t-lg h-32 overflow-hidden">
                                            <img class="object-cover object-top w-full" src="{{ asset('img/cesrh.jpeg') }}"
                                                alt="Background">
                                        </div>
            
                                        <div class="text-center mt-2">
                                            <h2><strong>Usuario:</strong>
                                                {{ $incidencia->users->first() ? $incidencia->users->first()->name : 'Sin asignar' }}
                                            </h2>
                                            <p><strong>Tipo de incidencia:</strong> {{ $incidencia->tipo_incidencia }}</p>
                                            <p><strong>Fecha inicio:</strong> {{ $incidencia->fecha_inicio }}</p>
                                            <p><strong>Fecha final:</strong> {{ $incidencia->fecha_final }}</p>
                                        </div>
            
                                        <div class="flex gap-4 mt-4">
                                            <!-- Aquí pueden ir botones o acciones -->
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <div class='flex items-center justify-center md:gap-8 gap-4 pt-5 pb-5'>
                        <button type="button" onclick="window.history.back()"
                            class='w-auto bg-blue-500 hover:bg-blue-700 rounded-lg shadow-xl font-medium text-white px-4 py-2'>
                            Volver
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

</html>
