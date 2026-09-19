<div>
    <div class="flex min-h-screen items-center justify-center py-3">

        <div class="grid bg-white rounded-lg shadow-xl w-full">
            <div class="flex justify-center py-4">
                <div class="flex bg-blue-200 rounded-full md:p-4 p-2 border-2 border-blue-300">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24" width="30"
                        viewBox="0 0 640 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                        <path fill="#ffffff"
                            d="M96 128a128 128 0 1 1 256 0A128 128 0 1 1 96 128zM0 482.3C0 383.8 79.8 304 178.3 304l91.4 0C368.2 304 448 383.8 448 482.3c0 16.4-13.3 29.7-29.7 29.7L29.7 512C13.3 512 0 498.7 0 482.3zM504 312l0-64-64 0c-13.3 0-24-10.7-24-24s10.7-24 24-24l64 0 0-64c0-13.3 10.7-24 24-24s24 10.7 24 24l0 64 64 0c13.3 0 24 10.7 24 24s-10.7 24-24 24l-64 0 0 64c0 13.3-10.7 24-24 24s-24-10.7-24-24z" />
                    </svg>
                </div>
            </div>

            <div class="flex justify-center">
                <div class="flex">
                    <h1 class="text-gray-600 font-bold md:text-2xl text-xl">Agregar Practicante</h1>
                </div>
            </div>

            <div class="mt-5 mx-7">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-8 mt-5">
                    <div class="grid grid-cols-1 mt-5">
                        <label for="nombre"
                            class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Nombre
                        </label>
                        <input wire:model.defer="nombre" type="text" id="nombre"
                            placeholder="Nombre"
                            class="py-2 px-3 rounded-lg border-2 border-blue-300 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent"/>

                        <x-input-error for="nombre" /> 
                    </div>

                    <div class="grid grid-cols-1 mt-5">
                        <label for="apellido_p"
                            class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Apellido Paterno
                        </label>
                        <input wire:model.defer="apellido_p" type="text" id="apellido_p"
                            placeholder="Apellido paterno"
                            class="py-2 px-3 rounded-lg border-2 border-blue-300 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent"/>

                        <x-input-error for="apellido_p" />
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-8 mt-5">
                    <div class="grid grid-cols-1 mt-5">
                        <label for="apellido_m"
                            class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Apellido Materno
                        </label>
                        <input wire:model.defer="apellido_m" type="text" id="apellido_m"
                            placeholder="Apellido materno"
                            class="py-2 px-3 rounded-lg border-2 border-blue-300 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent"/>

                        <x-input-error for="apellido_m" /> 
                    </div>

                    <div class="grid grid-cols-1 mt-5">
                        <label for="email"
                            class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Correo
                        </label>
                        <input wire:model.defer="user.email" type="email" id="email"
                            placeholder="Correo"
                            class="py-2 px-3 rounded-lg border-2 border-blue-300 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent"/>

                        <x-input-error for="user.email" /> 
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-8 mt-5">
                    <!--  -->
                    <div class="grid grid-cols-1 mt-5">
                        <label for="password"
                            class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Password
                        </label>
                        <input wire:model.defer="password" type="password" id="password"
                            placeholder="Password"
                            class="py-2 px-3 rounded-lg border-2 border-blue-300 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent"/>

                        <x-input-error for="password" />
                    </div>

                    <div class="grid grid-cols-1 mt-5">
                        <label for="registro_patronal_id"
                            class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">
                            Registros Patronales</label>
                        <select wire:model.defer="practicante.registro_patronal_id" id="registro_patronal_id"
                            class="py-2 px-3 rounded-lg border-2 border-blue-300 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent">
                            <option value=""> --- Seleccione un Registro Patronal --- </option>
                            @foreach ($registros_patronales as $registro_patronal)
                                <option value="{{ $registro_patronal->id }}">
                                    {{ $registro_patronal->registro_patronal }}</option>
                            @endforeach
                        </select>

                        <x-input-error for="practicante.registro_patronal_id" />
                        
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-8 mt-5">
                    
                    <div class="grid grid-cols-1 mt-5">
                        <label for="empresa"
                            class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">
                            Empresa</label>
                        <select wire:model.live="empresa" id="empresa"
                            class="py-2 px-3 rounded-lg border-2 border-blue-300 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent">
                            <option value=""> --- Seleccione una empresa --- </option>
                            @foreach ($empresas as $empresa)
                                <option value="{{ $empresa->id }}">{{ $empresa->nombre }}</option>
                            @endforeach
                        </select>

                        <x-input-error for="empresa" />
                    </div>

                    <div class="grid grid-cols-1 mt-5">
                        <label for="sucursal"
                            class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">
                            Sucursal</label>
                        <select wire:model.live="sucursal" id="sucursal"
                            class="py-2 px-3 rounded-lg border-2 border-blue-300 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent">
                            <option value=""> --- Seleccione una sucursal --- </option>
                            @forelse ($sucursales as $sucursal)

                                @foreach($sucursal->sucursales as $mi_sucursal)

                                    <option value="{{ $mi_sucursal->id }}">{{ $mi_sucursal->nombre_sucursal }}
                                    </option>
                                @endforeach

                            @empty
                                <option value=""> Esta empresa no tiene sucursales </option>
                            @endforelse
                        </select>

                        <x-input-error for="sucursal" />
                    </div>
                </div>
                
                <!-- ***********************  -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-8 mt-5">
                    <!--  -->
                    <div class="grid grid-cols-1 mt-5">
                        <label for="departamento"
                            class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">
                            Departamento</label>
                        <select wire:model.live="departamento" id="departamento"
                            class="py-2 px-3 rounded-lg border-2 border-blue-300 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent">
                            <option value=""> --- Seleccione un departamento --- </option>
                            @forelse ($departamentos as $departamento)

                                @foreach($departamento->departamentos as $mi_depa)

                                    <option value="{{ $mi_depa->id }}">{{ $mi_depa->nombre_departamento }}
                                    </option>
                                @endforeach

                            @empty
                                <option value=""> Esta sucursal no tiene departamentos</option>
                            @endforelse
                        </select>

                        <x-input-error for="departamento" />
                    </div>


                    <!--  -->
                    <div class="grid grid-cols-1 mt-5">
                        <label for="puesto_id"
                            class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">
                            Puesto</label>
                        <select wire:model.defer="user.puesto_id" id="puesto_id"
                            class="py-2 px-3 rounded-lg border-2 border-blue-300 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent">
                            <option value=""> --- Seleccione un puesto --- </option>
                            @forelse ($puestos as $puesto)

                                @foreach($puesto->puestos as $mi_puesto)

                                    <option value="{{ $mi_puesto->id }}">{{ $mi_puesto->nombre_puesto }}
                                    </option>
                                @endforeach

                            @empty
                                <option value=""> Este departamento no tiene puestos </option>
                            @endforelse
                        </select>

                        <x-input-error for="user.puesto_id" />
                    </div>
                </div>

                <!-- Clave -->
                <div class="grid grid-cols-1 mt-7">
                    <label for="clave_practicante"
                        class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">
                        Clave Practicante
                    </label>
                    <input wire:model.defer="practicante.clave_practicante" type="text" id="clave_practicante"
                        placeholder="Clave del becario"
                        class="py-2 px-3 rounded-lg border-2 border-blue-300 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent"/>

                    <x-input-error for="practicante.clave_practicante" /> 
                    
                </div>

                <!-- NNS y Fecha Nacimiento -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-8 mt-5">
                    <div class="grid grid-cols-1">
                        <label for="numero_seguridad_social"
                            class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Número de
                            Seguridad Social</label>
                        <input wire:model.defer="practicante.numero_seguridad_social" type="text" id="numero_seguridad_social"
                            placeholder="Número de Seguridad Social (NSS)"
                            class="py-2 px-3 rounded-lg border-2 border-blue-300 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent"/>
                        
                        <x-input-error for="practicante.numero_seguridad_social" />
                    </div>

                    <div class="grid grid-cols-1">
                        <label for="fecha_nacimiento"
                            class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">
                            Fecha Nacimiento
                        </label>
                        <input wire:model.defer="practicante.fecha_nacimiento" type="date" id="fecha_nacimiento"
                            class="py-2 px-3 rounded-lg border-2 border-blue-300 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent" />

                        
                        <x-input-error for="practicante.fecha_nacimiento" />
                    </div>
                </div>

                <!-- Lugar Nacimiento y Estado -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-8 mt-5">

                    <div class="grid grid-cols-1">
                        <label for="lugar_nacimiento"
                            class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">
                            Lugar Nacimiento</label>
                        <input wire:model.defer="practicante.lugar_nacimiento" type="text" id="lugar_nacimiento"
                            placeholder="Lugar de nacimiento"
                            class="py-2 px-3 rounded-lg border-2 border-blue-300 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent" />

                        
                        <x-input-error for="practicante.lugar_nacimiento" />
                    </div>

                    <div class="grid grid-cols-1">
                        <label for="estado"
                            class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">
                            Estado</label>
                        <input wire:model.defer="practicante.estado" type="text" id="estado"
                            placeholder="Estado"
                            class="py-2 px-3 rounded-lg border-2 border-blue-300 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent" />

                        
                        <x-input-error for="practicante.estado" />
                    </div>
                </div>

                <!-- Código Postal y Sexo -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-8 mt-5">
                    <div class="grid grid-cols-1">
                        <label for="codigo_postal"
                            class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">
                            Código Postal</label>
                        <input wire:model.defer="practicante.codigo_postal" type="text" id="codigo_postal"
                            placeholder="Código Postal"
                            class="py-2 px-3 rounded-lg border-2 border-blue-300 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent" />

                        <x-input-error for="practicante.codigo_postal" />
                        
                    </div>

                    <div class="grid grid-cols-1">
                        <label for="ocupacion"
                            class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">
                            Ocupación</label>
                        <input wire:model.defer="practicante.ocupacion" type="text" id="ocupacion"
                            placeholder="Ocupacion"
                            class="py-2 px-3 rounded-lg border-2 border-blue-300 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent" />

                        <x-input-error for="practicante.ocupacion" />
                        
                    </div>
                </div>

                <!-- CURP Y RFC -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-8 mt-5">
                    <div class="grid grid-cols-1">
                        <label for="sexo"
                            class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Sexo</label>
                        <select wire:model.defer="practicante.sexo" id="sexo"
                            class="py-2 px-3 rounded-lg border-2 border-blue-300 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent">
                            <option value="" selected>-- Selecciona una opción --</option>
                            <option value="Hombre">Hombre</option>
                            <option value="Mujer">Mujer</option>
                        </select>

                        <x-input-error for="practicante.sexo" />
                        
                    </div>

                    <div class="grid grid-cols-1">
                        <label for="curp"
                            class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">
                            CURP</label>
                        <input wire:model.defer="practicante.curp" type="text" id="curp" placeholder="CURP"
                            class="py-2 px-3 rounded-lg border-2 border-blue-300 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent" />

                        <x-input-error for="practicante.curp" />
                        
                    </div>
                </div>


                <!-- ***********************  -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-8 mt-5">
                    
                    <div class="grid grid-cols-1">
                        <label for="rfc"
                            class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">
                            RFC
                        </label>
                        <input wire:model.defer="practicante.rfc" type="text" id="rfc"
                            placeholder="Número de celular"
                            class="py-2 px-3 rounded-lg border-2 border-blue-300 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent" />

                        <x-input-error for="practicante.rfc" />
                        
                    </div>

                    <div class="grid grid-cols-1">
                        <label for="numero_celular"
                            class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Número Celular
                        </label>
                        <input wire:model.defer="practicante.numero_celular" type="text" id="numero_celular"
                            placeholder="Número de celular"
                            class="py-2 px-3 rounded-lg border-2 border-blue-300 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent" />

                        <x-input-error for="practicante.numero_celular" />
                        
                    </div>
                </div>

                <!-- Botones -->
                <div class='flex items-center justify-center md:gap-8 gap-4 pt-5 pb-5'>

                    <button type="button" wire:click="savePracticante()"
                        class='w-auto bg-blue-500 hover:bg-blue-700 rounded-lg shadow-xl font-medium text-white px-4 py-2'>
                        Agregar
                    </button>

                    <button type="button" wire:click="redirigirPracticante()"
                        class='w-auto bg-red-500 hover:bg-red-700 rounded-lg shadow-xl font-medium text-white px-4 py-2'>
                        Cancelar
                    </button>
                </div>

            </div> <!-- -->
        </div>
    </div>
</div>
