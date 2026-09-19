<div class="w-full">
    <!-- Background Gradient -->
    <div class="bg-gradient-to-b from-blue-800 to-blue-600 h-96"></div>
    
    <!-- Container -->
    <div class="max-w-5xl mx-auto px-6 sm:px-6 lg:px-8 mb-12">
        <!-- Form Card -->
        <div class="bg-white w-full shadow rounded p-8 sm:p-12 -mt-72">
            <!-- Title -->
            <p class="text-3xl font-bold leading-7 text-center">Perfil de Puestos</p>
            
             <!-- Seleccionar Empresa -->
                <div class="md:flex items-center mt-12">
                    <div class="w-full md:w-1/2 flex flex-col">
                        <label class="font-semibold leading-none">Empresa:</label>
                        <select wire:model.live="empresa_id" class="p-3 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-2">
                            <option value="">Seleccione una empresa</option>
                            @foreach($empresas as $empresa)
                                <option value="{{ $empresa->id }}">{{ $empresa->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Seleccionar Sucursal (según empresa) -->
                    <div class="w-full md:w-1/2 flex flex-col md:ml-6 md:mt-0 mt-4">
                        @if (!empty($sucursales))
                            <label  class="font-semibold leading-none">Sucursal:</label>
                            <select wire:model.live="sucursal_id" class="p-3 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-2">
                                <option value="">Seleccione una sucursal</option>
                                @foreach($sucursales as $sucursal)
                                    <option value="{{ $sucursal->id }}">{{ $sucursal->nombre_sucursal }}</option>
                                @endforeach
                            </select>
                        @endif
                    </div>
                </div>

                <div class="md:flex items-center mt-12">
                    <div class="w-full md:w-1/2 flex flex-col">
                        <label class="font-semibold leading-none">Nombre de puesto</label>
                        <input type="text" wire:model="perfil.nombre_puesto" class="leading-none text-gray-900 p-3 focus:outline-none focus:border-blue-700 mt-4 bg-gray-100 border rounded border-gray-200" />
                        @error('perfil.nombre_puesto')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="w-full md:w-1/2 flex flex-col md:ml-6 md:mt-0 mt-4">
                        <label class="font-semibold leading-none">Área al que pertenece</label>
                        <input type="text" wire:model="perfil.area" class="leading-none text-gray-900 p-3 focus:outline-none focus:border-blue-700 mt-4 bg-gray-100 border rounded border-gray-200"/>
                        @error('perfil.area')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="w-full md:w-1/2 flex flex-col md:ml-6 md:mt-0 mt-4">
                        <label class="font-semibold leading-none">Proceso al que pertenece</label>
                        <input type="text" wire:model="perfil.proceso" class="leading-none text-gray-900 p-3 focus:outline-none focus:border-blue-700 mt-4 bg-gray-100 border rounded border-gray-200"/>
                        @error('perfil.proceso')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="w-full flex flex-col mt-8">
                    <label class="font-semibold leading-none">Misión del Puesto</label>
                    <textarea type="text" wire:model="perfil.mision" class="h-40 text-base leading-none text-gray-900 p-3 focus:outline-none focus:border-blue-700 mt-4 bg-gray-100 border rounded border-gray-200"></textarea>
                    @error('perfil.mision')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                <div class="w-full flex flex-col mt-8">
                    <div class="flex justify-between items-center">
                        <label class="font-semibold leading-none">Funciones específicas del puesto</label>
                        <button wire:click="agregarFuncion" type="button" class="p-3 flex items-center justify-center w-30 h-10 text-blue-600">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                                <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25ZM12.75 9a.75.75 0 0 0-1.5 0v2.25H9a.75.75 0 0 0 0 1.5h2.25V15a.75.75 0 0 0 1.5 0v-2.25H15a.75.75 0 0 0 0-1.5h-2.25V9Z" clip-rule="evenodd" />
                              </svg>                                                           
                        </button>
                    </div>
                    
                    <div class="space-y-6 mt-4">
                        @for($i = 0; $i < $numerofuncion; $i++)
                            <div class="transition-all duration-300 p-6 rounded-lg shadow-lg border-l-4 border-blue-600">
                                <div class="flex justify-between items-center mb-4">
                                    <h2 class="text-lg font-semibold text-blue-700">Función Especifica #{{ $i + 1 }}</h2>
                                    <button wire:click="eliminarFunciones({{ $i }})" type="button" class="p-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-red-600">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                          </svg>
                                          
                                    </button>
                                </div>
                                <div class="grid gap-4">
                                    @if (!empty($funcionesDisponibles))
                                        <select wire:model="funciones.{{ $i }}.id" class="w-full p-2 border rounded-md">
                                            <option value="">Selecciona una función</option>
                                            @foreach($this->funcionesDisponibles as $course)
                                                <option value="{{ $course->id }}">{{ $course->nombre }}</option>
                                            @endforeach
                                        </select>
                                    @endif
                                    <x-input-error for="funciones.{{ $i }}.id" />
                                </div>
                            </div>
                        @endfor
                    </div>
                </div>                
                

                <div class="md:flex items-center mt-12">
                    <div class="w-full md:w-1/2 flex flex-col">
                        <label class="font-semibold leading-none">Puesto al que reporta</label>
                        <input type="text" wire:model="perfil.puesto_reporta" class="leading-none text-gray-900 p-3 focus:outline-none focus:border-blue-700 mt-4 bg-gray-100 border rounded border-gray-200" />
                        @error('perfil.puesto_reporta')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="w-full md:w-1/2 flex flex-col md:ml-6 md:mt-0 mt-4">
                        <label class="font-semibold leading-none">Puestos que le reportan</label>
                        <input type="text" wire:model="perfil.puestos_que_le_reportan" class="leading-none text-gray-900 p-3 focus:outline-none focus:border-blue-700 mt-4 bg-gray-100 border rounded border-gray-200"/>
                        @error('perfil.puestos_que_le_reportan')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="w-full md:w-1/2 flex flex-col md:ml-6 md:mt-0 mt-4">
                        <label class="font-semibold leading-none">Suplencia</label>
                        <input type="text" wire:model="perfil.suplencia" class="leading-none text-gray-900 p-3 focus:outline-none focus:border-blue-700 mt-4 bg-gray-100 border rounded border-gray-200"/>
                        @error('perfil.suplencia')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="w-full flex flex-col mt-8">
                    <div class="flex justify-between items-center">
                        <label class="font-semibold leading-none">Relaciones Internas</label>
                        <button wire:click="agregarInterna" type="button" class="p-3 flex items-center justify-center w-30 h-10 text-blue-600">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                                <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25ZM12.75 9a.75.75 0 0 0-1.5 0v2.25H9a.75.75 0 0 0 0 1.5h2.25V15a.75.75 0 0 0 1.5 0v-2.25H15a.75.75 0 0 0 0-1.5h-2.25V9Z" clip-rule="evenodd" />
                              </svg>                                                           
                        </button>
                    </div>
                    
                    <div class="space-y-6 mt-4">
                        @for($i = 0; $i < $numerointerna; $i++)
                            <div class="transition-all duration-300 p-6 rounded-lg shadow-lg border-l-4 border-blue-600">
                                <div class="flex justify-between items-center mb-4">
                                    <h2 class="text-lg font-semibold text-blue-700">Relación Interna #{{ $i + 1 }}</h2>
                                    <button wire:click="eliminarInternas({{ $i }})" type="button" class="p-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-red-600">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                          </svg>
                                          
                                    </button>
                                </div>
                                <div class="grid gap-4">
                                    @if (!empty($internasDisponibles))
                                        <select wire:model="internas.{{ $i }}.id" class="w-full p-2 border rounded-md">
                                            <option value="">Selecciona una relación interna</option>
                                            @foreach($this->internasDisponibles as $course)
                                                <option value="{{ $course->id }}">{{ $course->puesto}} / {{ $course->razon_motivo}} / {{$course->frecuencia}}</option>
                                            @endforeach
                                        </select>
                                    @endif
                                    <x-input-error for="internas.{{ $i }}.id" />
                                </div>
                            </div>
                        @endfor
                    </div>
                </div> 

                <div class="w-full flex flex-col mt-8">
                    <div class="flex justify-between items-center">
                        <label class="font-semibold leading-none">Relaciones Externas</label>
                        <button wire:click="agregarExterna" type="button" class="p-3 flex items-center justify-center w-30 h-10 text-blue-600">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                                <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25ZM12.75 9a.75.75 0 0 0-1.5 0v2.25H9a.75.75 0 0 0 0 1.5h2.25V15a.75.75 0 0 0 1.5 0v-2.25H15a.75.75 0 0 0 0-1.5h-2.25V9Z" clip-rule="evenodd" />
                              </svg>                                                           
                        </button>
                    </div>
                    
                    <div class="space-y-6 mt-4">
                        @for($i = 0; $i < $numeroexterna; $i++)
                            <div class="transition-all duration-300 p-6 rounded-lg shadow-lg border-l-4 border-blue-600">
                                <div class="flex justify-between items-center mb-4">
                                    <h2 class="text-lg font-semibold text-blue-700">Relación Externa #{{ $i + 1 }}</h2>
                                    <button wire:click="eliminarExternas({{ $i }})" type="button" class="p-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-red-600">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                          </svg>
                                          
                                    </button>
                                </div>
                                <div class="grid gap-4">
                                    @if (!empty($externasDisponibles))
                                        <select wire:model="externas.{{ $i }}.id" class="w-full p-2 border rounded-md">
                                            <option value="">Selecciona una relación externa</option>
                                            @foreach($this->externasDisponibles as $course)
                                                <option value="{{ $course->id }}">{{ $course->nombre}} / {{ $course->razon_motivo}} / {{$course->frecuencia}}</option>
                                            @endforeach
                                        </select>
                                    @endif
                                    <x-input-error for="externas.{{ $i }}.id" />
                                </div>
                            </div>
                        @endfor
                    </div>
                </div> 

                <div class="md:flex items-center mt-12"> 
                    <div class="w-full md:w-1/2 flex flex-col">
                        <label class="font-semibold leading-none">Rango de toma de decisiones</label>
                        <select wire:model="perfil.rango_toma_desicones" class="leading-none text-gray-900 p-3 focus:outline-none focus:border-blue-700 mt-4 bg-gray-100 border rounded border-gray-200">
                            <option value="">Seleccionar</option>
                            <option value="alta">Alta</option>
                            <option value="media">Media</option>
                            <option value="baja">Baja</option>
                        </select>
                        @error('perfil.rango_toma_desiciones')
                        <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="w-full md:w-1/2 flex flex-col md:ml-6 md:mt-0 mt-4">
                        <label class="font-semibold leading-none">Decisiones directas</label>
                        <textarea wire:model="perfil.desiciones_directas" class="leading-none text-gray-900 p-3 focus:outline-none focus:border-blue-700 mt-4 bg-gray-100 border rounded border-gray-200"></textarea>
                        @error('perfil.desiciones_directas')
                        <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                

                <div class="w-full flex flex-col mt-8">
                    <div class="flex justify-between items-center">
                        <label class="font-semibold leading-none">Responsabilidades Universales</label>
                        <button wire:click="agregarResponsabilidades" type="button" class="p-3 flex items-center justify-center w-30 h-10 text-blue-600">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                                <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25ZM12.75 9a.75.75 0 0 0-1.5 0v2.25H9a.75.75 0 0 0 0 1.5h2.25V15a.75.75 0 0 0 1.5 0v-2.25H15a.75.75 0 0 0 0-1.5h-2.25V9Z" clip-rule="evenodd" />
                              </svg>                                                           
                        </button>
                    </div>
                    
                    <div class="space-y-6 mt-4">
                        @for($i = 0; $i < $numeroresponsabilidad; $i++)
                            <div class="transition-all duration-300 p-6 rounded-lg shadow-lg border-l-4 border-blue-600">
                                <div class="flex justify-between items-center mb-4">
                                    <h2 class="text-lg font-semibold text-blue-700">Responsabilidad Universal #{{ $i + 1 }}</h2>
                                    <button wire:click="eliminarResponsabilidades({{ $i }})" type="button" class="p-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-red-600">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                          </svg>
                                          
                                    </button>
                                </div>
                                <div class="grid gap-4">
                                    @if (!empty($responsabilidadesDisponibles))
                                        <select wire:model="responsabilidades.{{ $i }}.id" class="w-full p-2 border rounded-md">
                                            <option value="">Selecciona una responsabilidad universal</option>
                                            @foreach($this->responsabilidadesDisponibles as $course)
                                                <option value="{{ $course->id }}">{{ $course->sistema}} / {{ $course->responsalidad}}</option>
                                            @endforeach
                                        </select>
                                    @endif
                                    <x-input-error for="responsabilidades.{{ $i }}.id" />
                                </div>
                            </div>
                        @endfor
                    </div>
                </div> 


                <div class="space-y-8 mt-12">
                    <div class="grid md:grid-cols-2 gap-6">
                        <div class="flex flex-col">
                            <label class="font-semibold leading-none">Rango de edad deseable</label>
                            <input type="text" wire:model="perfil.rango_edad_desable" class="leading-none text-gray-900 p-3 focus:outline-none focus:border-blue-700 mt-2 bg-gray-100 border rounded border-gray-300 shadow-sm"/>
                            @error('perfil.rango_edad_desable')
                            <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="flex flex-col">
                            <label class="font-semibold leading-none">Sexo</label>
                            <select wire:model="perfil.sexo_preferente" class="p-3 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-2">
                                <option value="">Seleccionar</option>
                                <option value="Indistinto">Indistinto</option>
                                <option value="Mujer">Mujer</option>
                                <option value="Hombre">Hombre</option>
                            </select>
                            @error('perfil.sexo_preferente')
                            <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="grid md:grid-cols-2 gap-6">
                        <div class="flex flex-col">
                            <label class="font-semibold leading-none">Estado civil deseable</label>
                            <select wire:model="perfil.estado_civil_deseable" class="p-3 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-2">
                                <option value="">Seleccionar</option>
                                <option value="Indistinto">Indistinto</option>
                                <option value="Soltero">Soltero</option>
                                <option value="Casado">Casado</option>
                            </select>
                            @error('perfil.estado_civil_deseable')
                            <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="flex flex-col">
                            <label class="font-semibold leading-none">Escolaridad</label>
                            <select wire:model="perfil.escolaridad" class="p-3 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-2">
                                <option value="">Seleccionar</option>
                                <option value="Primaria">Primaria</option>
                                <option value="Secundaria">Secundaria</option>
                                <option value="Preparatoria">Preparatoria</option>
                                <option value="Oficio">Oficio</option>
                                <option value="Carrera Corta">Carrera Corta</option>
                                <option value="Carrera Técnica">Carrera Técnica</option>
                                <option value="Licenciatura/Ingeniería: Sistemas, IT o afin.">Licenciatura/Ingeniería: Sistemas, IT o afin.</option>
                                <option value="Maestría deseable">Maestría deseable</option>
                                <option value="Otro">Otro</option>
                            </select>
                            @error('perfil.escolaridad')
                            <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="grid md:grid-cols-2 gap-6">
                        <div class="flex flex-col">
                            <label class="font-semibold leading-none">Idioma requerido</label>
                            <select wire:model="perfil.idioma_requerido" class="p-3 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-2">
                                <option value="">Seleccionar</option>
                                <option value="Ingles B1">Ingles B1</option>
                                <option value="Aleman (deseable)">Aleman (deseable)</option>
                                <option value="Otro">Otro</option>
                            </select>
                            @error('perfil.idioma_requerido')
                            <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="flex flex-col">
                            <label class="font-semibold leading-none">Experiencia requerida</label>
                            <input type="text" wire:model="perfil.experiencia_requerida" class="leading-none text-gray-900 p-3 focus:outline-none focus:border-blue-700 mt-2 bg-gray-100 border rounded border-gray-300 shadow-sm"/>
                            @error('perfil.experiencia_requerida')
                            <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="grid md:grid-cols-2 gap-6">
                        <div class="flex flex-col">
                            <label class="font-semibold leading-none">Nivel de riesgo físico</label>
                            <select wire:model="perfil.nivel_riesgo_fisico" class="p-3 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-2">
                                <option value="">Seleccionar</option>
                                <option value="Alto">Alto</option>
                                <option value="Moderado">Moderado</option>
                                <option value="Bajo">Bajo</option>
                            </select>
                            @error('perfil.nivel_riesgo_fisico')
                            <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>                

                <div class="w-full flex flex-col mt-8">
                    <div class="flex justify-between items-center">
                        <label class="font-semibold leading-none">Formación y Habilidades Humanas</label>
                        <button wire:click="agregarHumanas" type="button" class="p-3 flex items-center justify-center w-30 h-10 text-blue-600">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                                <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25ZM12.75 9a.75.75 0 0 0-1.5 0v2.25H9a.75.75 0 0 0 0 1.5h2.25V15a.75.75 0 0 0 1.5 0v-2.25H15a.75.75 0 0 0 0-1.5h-2.25V9Z" clip-rule="evenodd" />
                              </svg>                                                           
                        </button>
                    </div>
                    
                    <div class="space-y-6 mt-4">
                        @for($i = 0; $i < $numerohumana; $i++)
                            <div class="transition-all duration-300 p-6 rounded-lg shadow-lg border-l-4 border-blue-600">
                                <div class="flex justify-between items-center mb-4">
                                    <h2 class="text-lg font-semibold text-blue-700">Habilidad Humana #{{ $i + 1 }}</h2>
                                    <button wire:click="eliminarHumanas({{ $i }})" type="button" class="p-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-red-600">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                          </svg>
                                          
                                    </button>
                                </div>
                                <div class="grid gap-4">
                                    @if (!empty($humanasDisponibles))
                                        <select wire:model="humanas.{{ $i }}.id" class="w-full p-2 border rounded-md">
                                            <option value="">Selecciona una habilidad humana</option>
                                            @foreach($this->humanasDisponibles as $course)
                                                <option value="{{ $course->id }}">{{ $course->descripcion}} / {{ $course->nivel}}</option>
                                            @endforeach
                                        </select>
                                    @endif
                                    <x-input-error for="humanas.{{ $i }}.id" />
                                </div>
                            </div>
                        @endfor
                    </div>
                </div> 

                <div class="w-full flex flex-col mt-8">
                    <div class="flex justify-between items-center">
                        <label class="font-semibold leading-none">Formación y Habilidades Tecnicas</label>
                        <button wire:click="agregarTecnicas" type="button" class="p-3 flex items-center justify-center w-30 h-10 text-blue-600">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                                <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25ZM12.75 9a.75.75 0 0 0-1.5 0v2.25H9a.75.75 0 0 0 0 1.5h2.25V15a.75.75 0 0 0 1.5 0v-2.25H15a.75.75 0 0 0 0-1.5h-2.25V9Z" clip-rule="evenodd" />
                              </svg>                                                           
                        </button>
                    </div>
                    
                    <div class="space-y-6 mt-4">
                        @for($i = 0; $i < $numerotecnica; $i++)
                            <div class="transition-all duration-300 p-6 rounded-lg shadow-lg border-l-4 border-blue-600">
                                <div class="flex justify-between items-center mb-4">
                                    <h2 class="text-lg font-semibold text-blue-700">Habilidad Tecnica #{{ $i + 1 }}</h2>
                                    <button wire:click="eliminarTecnicas({{ $i }})" type="button" class="p-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-red-600">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                          </svg>
                                          
                                    </button>
                                </div>
                                <div class="grid gap-4">
                                    @if (!empty($tecnicasDisponibles))
                                        <select wire:model="tecnicas.{{ $i }}.id" class="w-full p-2 border rounded-md">
                                            <option value="">Selecciona una habilidad tecnica</option>
                                            @foreach($this->tecnicasDisponibles as $course)
                                                <option value="{{ $course->id }}">{{ $course->descripcion}} / {{ $course->nivel}}</option>
                                            @endforeach
                                        </select>
                                    @endif
                                    <x-input-error for="tecnicas.{{ $i }}.id" />
                                </div>
                            </div>
                        @endfor
                    </div>
                </div>

                <div class="space-y-8 mt-12">
                    <div class="grid md:grid-cols-2 gap-6">
                        <div class="flex flex-col">
                            <label class="font-semibold leading-none">Elaboro Nombre</label>
                            <input type="text" wire:model="perfil.elaboro_nombre" class="leading-none text-gray-900 p-3 focus:outline-none focus:border-blue-700 mt-4 bg-gray-100 border rounded border-gray-200"/>
                            @error('perfil.elaboro_nombre')
                            <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="flex flex-col">
                            <label class="font-semibold leading-none">Elaboro Puesto</label>
                            <input type="text" wire:model="perfil.elaboro_puesto" class="leading-none text-gray-900 p-3 focus:outline-none focus:border-blue-700 mt-4 bg-gray-100 border rounded border-gray-200"/>
                            @error('perfil.elaboro_puesto')
                            <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <div class="space-y-8 mt-12">
                    <div class="grid md:grid-cols-2 gap-6">
                        <div class="flex flex-col">
                            <label class="font-semibold leading-none">Reviso Nombre</label>
                            <input type="text" wire:model="perfil.reviso_nombre" class="leading-none text-gray-900 p-3 focus:outline-none focus:border-blue-700 mt-4 bg-gray-100 border rounded border-gray-200"/>
                            @error('perfil.reviso_nombre')
                            <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="flex flex-col">
                            <label class="font-semibold leading-none">Reviso Puesto</label>
                            <input type="text" wire:model="perfil.reviso_puesto" class="leading-none text-gray-900 p-3 focus:outline-none focus:border-blue-700 mt-4 bg-gray-100 border rounded border-gray-200"/>
                            @error('perfil.reviso_puesto')
                            <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <div class="space-y-8 mt-12">
                    <div class="grid md:grid-cols-2 gap-6">
                        <div class="flex flex-col">
                            <label class="font-semibold leading-none">Autorizo Nombre</label>
                            <input type="text" wire:model="perfil.autorizo_nombre" class="leading-none text-gray-900 p-3 focus:outline-none focus:border-blue-700 mt-4 bg-gray-100 border rounded border-gray-200"/>
                            @error('perfil.autorizo_nombre')
                            <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="flex flex-col">
                            <label class="font-semibold leading-none">Autorizo Puesto</label>
                            <input type="text" wire:model="perfil.autorizo_puesto" class="leading-none text-gray-900 p-3 focus:outline-none focus:border-blue-700 mt-4 bg-gray-100 border rounded border-gray-200"/>
                            @error('perfil.autorizo_puesto')
                            <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <!-- Subject -->
                <div class="md:flex items-center mt-8">
                    <div class="w-full flex flex-col">
                        <label class="font-semibold leading-none">Status</label>
                        <!-- Aquí puedes cambiar el campo 'Status' a un 'select' o un 'radio' según lo necesites -->
                        <select wire:model="perfil.status" class="leading-none text-gray-900 p-3 focus:outline-none focus:border-blue-700 mt-4 bg-gray-100 border rounded border-gray-200">
                            <option value="">Seleccione un estado</option>
                            <option value="Aprobado">Aprovado</option>
                            <option value="Corregir">Corrección</option>
                            <option value="Rechazado">Rechazado</option>
                        </select>
                        @error('perfil.status')
                        <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
 
                <div class="flex items-center justify-center w-full space-x-4">
                    <button wire:click='savePerfil()' class="mt-9 font-semibold leading-none text-white py-4 px-10 bg-blue-700 rounded hover:bg-blue-600 focus:ring-2 focus:ring-offset-2 focus:ring-blue-700 focus:outline-none">
                        Guardar
                    </button>

                    <button wire:click="cerrar" class="mt-9 font-semibold leading-none text-gray-700 py-4 px-10 bg-gray-300 rounded hover:bg-gray-200 focus:ring-2 focus:ring-offset-2 focus:ring-gray-700 focus:outline-none">
                        Cancelar
                    </button>
                </div>
                
        </div>
    </div>
    @if (session()->has('message'))
        <div class="fixed top-5 right-5 bg-green-600 text-white text-lg px-6 py-3 rounded-lg shadow-lg transition-opacity duration-500"
            style="z-index: 1000;"
            x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show">
            ✅ {{ session('message') }}
        </div>
    @endif
</div>

