<div class="w-full">
    <div class="bg-gradient-to-b from-blue-800 to-blue-600 h-96"></div>
    <div class="max-w-5xl mx-auto px-6 sm:px-6 lg:px-8 mb-12">
        <div class="bg-white w-full shadow rounded p-8 sm:p-12 -mt-72">
            <p class="text-3xl font-bold leading-7 text-center">Perfil de Puestos</p>
            
                <div class="md:flex items-center mt-12">
                    <div class="w-full md:w-1/2 flex flex-col">
                        <label class="font-semibold leading-none">Nombre de puesto</label>
                        <input type="text" wire:model="nombre_puesto" class="leading-none text-gray-900 p-3 focus:outline-none focus:border-blue-700 mt-4 bg-gray-100 border rounded border-gray-200" />
                    </div>
                    <div class="w-full md:w-1/2 flex flex-col md:ml-6 md:mt-0 mt-4">
                        <label class="font-semibold leading-none">Área al que pertenece</label>
                        <input type="text" wire:model="area" class="leading-none text-gray-900 p-3 focus:outline-none focus:border-blue-700 mt-4 bg-gray-100 border rounded border-gray-200"/>
                    </div>
                    <div class="w-full md:w-1/2 flex flex-col md:ml-6 md:mt-0 mt-4">
                        <label class="font-semibold leading-none">Proceso al que pertenece</label>
                        <input type="text" wire:model="proceso" class="leading-none text-gray-900 p-3 focus:outline-none focus:border-blue-700 mt-4 bg-gray-100 border rounded border-gray-200"/>
                    </div>
                </div>

                <div class="w-full flex flex-col mt-8">
                    <label class="font-semibold leading-none">Misión del Puesto</label>
                    <textarea type="text" wire:model="mision" class="h-40 text-base leading-none text-gray-900 p-3 focus:outline-none focus:border-blue-700 mt-4 bg-gray-100 border rounded border-gray-200"></textarea>
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
                                    <select wire:model="funciones.{{ $i }}.id" class="w-full p-2 border rounded-md">
                                        <option value="">Selecciona una función</option>
                                        @foreach($this->selectFuncion as $course)
                                            <option value="{{ $course->id }}">{{ $course->nombre }}</option>
                                        @endforeach
                                    </select>
                                    <x-input-error for="funciones.{{ $i }}.id" />
                                </div>
                            </div>
                        @endfor
                    </div>
                </div>                
                

                <div class="md:flex items-center mt-12">
                    <div class="w-full md:w-1/2 flex flex-col">
                        <label class="font-semibold leading-none">Puesto al que reporta</label>
                        <input type="text" wire:model="puesto_reporta" class="leading-none text-gray-900 p-3 focus:outline-none focus:border-blue-700 mt-4 bg-gray-100 border rounded border-gray-200" />
                    </div>
                    <div class="w-full md:w-1/2 flex flex-col md:ml-6 md:mt-0 mt-4">
                        <label class="font-semibold leading-none">Puestos que le reportan</label>
                        <input type="text" wire:model="puestos_que_le_reportan" class="leading-none text-gray-900 p-3 focus:outline-none focus:border-blue-700 mt-4 bg-gray-100 border rounded border-gray-200"/>
                    </div>
                    <div class="w-full md:w-1/2 flex flex-col md:ml-6 md:mt-0 mt-4">
                        <label class="font-semibold leading-none">Suplencia</label>
                        <input type="text" wire:model="suplencia" class="leading-none text-gray-900 p-3 focus:outline-none focus:border-blue-700 mt-4 bg-gray-100 border rounded border-gray-200"/>
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
                                    <select wire:model="internas.{{ $i }}.id" class="w-full p-2 border rounded-md">
                                        <option value="">Selecciona una relación interna</option>
                                        @foreach($this->selectInterna as $course)
                                            <option value="{{ $course->id }}">{{ $course->puesto}} / {{ $course->razon_motivo}} / {{$course->frecuencia}}</option>
                                        @endforeach
                                    </select>
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
                                    <select wire:model="externas.{{ $i }}.id" class="w-full p-2 border rounded-md">
                                        <option value="">Selecciona una relación externa</option>
                                        @foreach($this->selectExterna as $course)
                                            <option value="{{ $course->id }}">{{ $course->nombre}} / {{ $course->razon_motivo}} / {{$course->frecuencia}}</option>
                                        @endforeach
                                    </select>
                                    <x-input-error for="externas.{{ $i }}.id" />
                                </div>
                            </div>
                        @endfor
                    </div>
                </div> 

                <div class="md:flex items-center mt-12"> 
                    <div class="w-full md:w-1/2 flex flex-col">
                        <label class="font-semibold leading-none">Rango de toma de decisiones</label>
                        <select wire:model="rango_toma_desicones" class="leading-none text-gray-900 p-3 focus:outline-none focus:border-blue-700 mt-4 bg-gray-100 border rounded border-gray-200">
                            <option value="">Seleccionar</option>
                            <option value="alta">Alta</option>
                            <option value="media">Media</option>
                            <option value="baja">Baja</option>
                        </select>
                    </div>
                    <div class="w-full md:w-1/2 flex flex-col md:ml-6 md:mt-0 mt-4">
                        <label class="font-semibold leading-none">Decisiones directas</label>
                        <textarea wire:model="desiciones_directas" class="leading-none text-gray-900 p-3 focus:outline-none focus:border-blue-700 mt-4 bg-gray-100 border rounded border-gray-200"></textarea>
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
                                    <select wire:model="responsabilidades.{{ $i }}.id" class="w-full p-2 border rounded-md">
                                        <option value="">Selecciona una responsabilidad universal</option>
                                        @foreach($this->selectResponsabilidad as $course)
                                            <option value="{{ $course->id }}">{{ $course->sistema}} / {{ $course->responsalidad}}</option>
                                        @endforeach
                                    </select>
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
                            <input type="text" wire:model="rango_edad_desable" class="leading-none text-gray-900 p-3 focus:outline-none focus:border-blue-700 mt-2 bg-gray-100 border rounded border-gray-300 shadow-sm"/>
                        </div>
                        <div class="flex flex-col">
                            <label class="font-semibold leading-none">Sexo</label>
                            <select wire:model="sexo_preferente" class="p-3 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-2">
                                <option value="">Seleccionar</option>
                                <option value="Indistinto">Indistinto</option>
                                <option value="Mujer">Mujer</option>
                                <option value="Hombre">Hombre</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="grid md:grid-cols-2 gap-6">
                        <div class="flex flex-col">
                            <label class="font-semibold leading-none">Estado civil deseable</label>
                            <select wire:model="estado_civil_deseable" class="p-3 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-2">
                                <option value="">Seleccionar</option>
                                <option value="Indistinto">Indistinto</option>
                                <option value="Soltero">Soltero</option>
                                <option value="Casado">Casado</option>
                            </select>
                        </div>
                        <div class="flex flex-col">
                            <label class="font-semibold leading-none">Escolaridad</label>
                            <select wire:model="escolaridad" class="p-3 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-2">
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
                        </div>
                    </div>
                    
                    <div class="grid md:grid-cols-2 gap-6">
                        <div class="flex flex-col">
                            <label class="font-semibold leading-none">Idioma requerido</label>
                            <select wire:model="idioma_requerido" class="p-3 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-2">
                                <option value="">Seleccionar</option>
                                <option value="Ingles B1">Ingles B1</option>
                                <option value="Aleman (deseable)">Aleman (deseable)</option>
                                <option value="Otro">Otro</option>
                            </select>
                        </div>
                        <div class="flex flex-col">
                            <label class="font-semibold leading-none">Experiencia requerida</label>
                            <input type="text" wire:model="experiencia_requerida" class="leading-none text-gray-900 p-3 focus:outline-none focus:border-blue-700 mt-2 bg-gray-100 border rounded border-gray-300 shadow-sm"/>
                        </div>
                    </div>  
                    
                    <div class="grid md:grid-cols-2 gap-6">
                        <div class="flex flex-col">
                            <label class="font-semibold leading-none">Nivel de riesgo físico</label>
                            <select wire:model="nivel_riesgo_fisico" class="p-3 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-2">
                                <option value="">Seleccionar</option>
                                <option value="Alto">Alto</option>
                                <option value="Moderado">Moderado</option>
                                <option value="Bajo">Bajo</option>
                            </select>
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
                                    <select wire:model="humanas.{{ $i }}.id" class="w-full p-2 border rounded-md">
                                        <option value="">Selecciona una habilidad humana</option>
                                        @foreach($this->selectHumana as $course)
                                            <option value="{{ $course->id }}">{{ $course->descripcion}} / {{ $course->nivel}}</option>
                                        @endforeach
                                    </select>
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
                                    <select wire:model="tecnicas.{{ $i }}.id" class="w-full p-2 border rounded-md">
                                        <option value="">Selecciona una habilidad tecnica</option>
                                        @foreach($this->selectTecnica as $course)
                                            <option value="{{ $course->id }}">{{ $course->descripcion}} / {{ $course->nivel}}</option>
                                        @endforeach
                                    </select>
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
                            <input type="text" wire:model="elaboro_nombre" class="leading-none text-gray-900 p-3 focus:outline-none focus:border-blue-700 mt-4 bg-gray-100 border rounded border-gray-200"/>
                        </div>
                        <div class="flex flex-col">
                            <label class="font-semibold leading-none">Elaboro Puesto</label>
                            <input type="text" wire:model="elaboro_puesto" class="leading-none text-gray-900 p-3 focus:outline-none focus:border-blue-700 mt-4 bg-gray-100 border rounded border-gray-200"/>
                        </div>
                    </div>
                </div>
                
                <div class="space-y-8 mt-12">
                    <div class="grid md:grid-cols-2 gap-6">
                        <div class="flex flex-col">
                            <label class="font-semibold leading-none">Reviso Nombre</label>
                            <input type="text" wire:model="reviso_nombre" class="leading-none text-gray-900 p-3 focus:outline-none focus:border-blue-700 mt-4 bg-gray-100 border rounded border-gray-200"/>
                        </div>
                        <div class="flex flex-col">
                            <label class="font-semibold leading-none">Reviso Puesto</label>
                            <input type="text" wire:model="reviso_puesto" class="leading-none text-gray-900 p-3 focus:outline-none focus:border-blue-700 mt-4 bg-gray-100 border rounded border-gray-200"/>
                        </div>
                    </div>
                </div>
                
                <div class="space-y-8 mt-12">
                    <div class="grid md:grid-cols-2 gap-6">
                        <div class="flex flex-col">
                            <label class="font-semibold leading-none">Autorizo Nombre</label>
                            <input type="text" wire:model="autorizo_nombre" class="leading-none text-gray-900 p-3 focus:outline-none focus:border-blue-700 mt-4 bg-gray-100 border rounded border-gray-200"/>
                        </div>
                        <div class="flex flex-col">
                            <label class="font-semibold leading-none">Autorizo Puesto</label>
                            <input type="text" wire:model="autorizo_puesto" class="leading-none text-gray-900 p-3 focus:outline-none focus:border-blue-700 mt-4 bg-gray-100 border rounded border-gray-200"/>
                        </div>
                    </div>
                </div>

                <div class="md:flex items-center mt-8">
                    <div class="w-full flex flex-col">
                        <label class="font-semibold leading-none">Status</label>
                        <select wire:model="status" class="leading-none text-gray-900 p-3 focus:outline-none focus:border-blue-700 mt-4 bg-gray-100 border rounded border-gray-200">
                            <option value="">Seleccione un estado</option>
                            <option value="Aprobado">Aprovado</option>
                            <option value="Corregir">Corregir</option>
                            <option value="Rechazado">Rechazado</option>
                        </select>
                    </div>
                </div>
 
                <div class="flex items-center justify-center w-full space-x-4">
                    <button wire:click='save()' class="mt-9 font-semibold leading-none text-white py-4 px-10 bg-green-700 rounded hover:bg-green-600 focus:ring-2 focus:ring-offset-2 focus:ring-blue-700 focus:outline-none">
                        Actualizar
                    </button>

                    <button wire:click="cerrar" class="mt-9 font-semibold leading-none text-gray-700 py-4 px-10 bg-gray-300 rounded hover:bg-gray-200 focus:ring-2 focus:ring-offset-2 focus:ring-gray-700 focus:outline-none">
                        Cancelar
                    </button>
                </div>
        </div>
    </div>
</div>

