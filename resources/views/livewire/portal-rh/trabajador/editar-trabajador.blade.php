<div class="bg-gray-200">
    <div class="flex min-h-screen items-center justify-center py-3">
        <div class="grid bg-white rounded-lg shadow-xl w-full">
            <div class="flex justify-center py-4">
                <div class="flex bg-blue-200 rounded-full md:p-4 p-2 border-2 border-blue-300">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24" width="24" viewBox="0 0 512 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path fill="#ffffff" d="M471.6 21.7c-21.9-21.9-57.3-21.9-79.2 0L362.3 51.7l97.9 97.9 30.1-30.1c21.9-21.9 21.9-57.3 0-79.2L471.6 21.7zm-299.2 220c-6.1 6.1-10.8 13.6-13.5 21.9l-29.6 88.8c-2.9 8.6-.6 18.1 5.8 24.6s15.9 8.7 24.6 5.8l88.8-29.6c8.2-2.7 15.7-7.4 21.9-13.5L437.7 172.3 339.7 74.3 172.4 241.7zM96 64C43 64 0 107 0 160L0 416c0 53 43 96 96 96l256 0c53 0 96-43 96-96l0-96c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 96c0 17.7-14.3 32-32 32L96 448c-17.7 0-32-14.3-32-32l0-256c0-17.7 14.3-32 32-32l96 0c17.7 0 32-14.3 32-32s-14.3-32-32-32L96 64z"/></svg>
                </div>
            </div>

            <div class="flex justify-center">
                <div class="flex">
                    <h1 class="text-gray-600 font-bold md:text-2xl text-xl">Editar Trabajador</h1>
                </div>
            </div>

            <form class="mt-5 mx-7">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-8 mt-5">
                    <div class="grid grid-cols-1 mt-5">
                        <label for="name"
                            class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Nombre
                        </label>
                        <input wire:model.defer="user.name" type="text" id="name"
                            placeholder="Nombre"
                            class="py-2 px-3 rounded-lg border-2 border-blue-300 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent"/>

                        <x-input-error for="user.name" /> 
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
                            class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Password (SOLO SI ES NECESARIO)
                        </label>
                        <input wire:model.defer="password" type="password" id="password"
                            placeholder="Nueva contraseña"
                            class="py-2 px-3 rounded-lg border-2 border-blue-300 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent"/>

                        <x-input-error for="password" />
                    </div>

                    <!-- Clave -->
                    <div class="grid grid-cols-1 mt-5">
                        <label for="clave_trabajador"
                            class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Clave
                            Trabajador</label>
                        <input wire:model.defer="clave_trabajador" type="text" id="clave_trabajador"
                            placeholder="Clave del trabajador"
                            class="py-2 px-3 rounded-lg border-2 border-blue-300 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent" />
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
                    <!--  -->
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

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-8 mt-5">
                    <!--  -->
                    <div class="grid grid-cols-1 mt-5">
                        <label for="registro_patronal_id"
                            class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">
                            Registros Patronales</label>
                        <select wire:model.defer="registro_patronal_id" id="registro_patronal_id"
                            class="py-2 px-3 rounded-lg border-2 border-blue-300 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent">
                            <option value=""> ---  Seleccione un Registro Patronal --- </option>
                            @foreach ($registros_patronales as $registro_patronal)
                                <option value="{{ $registro_patronal->id }}">{{ $registro_patronal->registro_patronal }}</option>
                            @endforeach
                        </select>
                    </div>
                        

                    <div class="grid grid-cols-1 mt-5">
                        <label for="status"
                            class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Status</label>
                        <select wire:model.defer="status" id="status"
                            class="py-2 px-3 rounded-lg border-2 border-blue-300 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent">
                            <option value="" selected>-- Selecciona una opción --</option>
                            <option value="Activo">Activo</option>
                            <option value="Inactivo">Inactivo</option>
                        </select>
                    </div>
                </div>
                

                <!-- NNS y Fecha Nacimiento -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-8 mt-5">
                    <div class="grid grid-cols-1">
                        <label for="numero_seguridad_social"
                            class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Número de 
                            Seguridad Social</label>
                        <input wire:model.defer="numero_seguridad_social" type="text" id="numero_seguridad_social"
                            placeholder="Número de Seguridad Social (NSS)"
                            class="py-2 px-3 rounded-lg border-2 border-blue-300 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent" />
                    </div>

                    <div class="grid grid-cols-1">
                        <label for="fecha_nacimiento" class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">
                            Fecha Nacimiento
                        </label>
                        <input wire:model.defer="fecha_nacimiento" type="date" id="fecha_nacimiento"
                            class="py-2 px-3 rounded-lg border-2 border-blue-300 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent" />
                    </div>
                </div>

                <!-- Lugar Nacimiento y Estado -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-8 mt-5">

                    <div class="grid grid-cols-1">
                        <label for="lugar_nacimiento"
                            class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">
                            Lugar Nacimiento</label>
                        <input wire:model.defer="lugar_nacimiento" type="text" id="lugar_nacimiento"
                            placeholder="Lugar de nacimiento"
                            class="py-2 px-3 rounded-lg border-2 border-blue-300 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent" />
                    </div>

                    <div class="grid grid-cols-1">
                        <label for="estado"
                            class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">
                            Estado</label>
                        <input wire:model.defer="estado" type="text" id="estado"
                             placeholder="Estado"
                            class="py-2 px-3 rounded-lg border-2 border-blue-300 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent" />
                    </div>
                </div>

                <!-- Código Postal y Sexo -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-8 mt-5">
                    <div class="grid grid-cols-1">
                        <label for="codigo_postal"
                            class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Código Postal</label>
                        <input wire:model.defer="codigo_postal" type="text" id="codigo_postal" placeholder="Código Postal"
                            class="py-2 px-3 rounded-lg border-2 border-blue-300 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent" />
                    </div>

                    <div class="grid grid-cols-1">
                        <label for="sexo"
                            class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Sexo</label>
                        <select wire:model.defer="sexo" id="sexo"
                            class="py-2 px-3 rounded-lg border-2 border-blue-300 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent">
                            <option value="" selected>-- Selecciona una opción --</option>
                            <option value="Hombre">Hombre</option>
                            <option value="Mujer">Mujer</option>
                        </select>
                    </div>
                </div>

                <!-- CURP Y RFC -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-8 mt-5">
                    <div class="grid grid-cols-1">
                        <label for="curp"
                            class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">CURP</label>
                        <input wire:model.defer="curp" type="text" id="curp" placeholder="CURP"
                            class="py-2 px-3 rounded-lg border-2 border-blue-300 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent" />
                    </div>

                    <div class="grid grid-cols-1">
                        <label for="rfc"
                            class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">RFC</label>
                        <input wire:model.defer="rfc" type="text" id="rfc" placeholder="RFC"
                            class="py-2 px-3 rounded-lg border-2 border-blue-300 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent" />
                    </div>
                </div>

                <!-- ***********************  -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-8 mt-5">
                    <div class="grid grid-cols-1">
                        <label for="numero_celular"
                            class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Número Celular </label>
                        <input wire:model.defer="numero_celular" type="text" id="numero_celular" placeholder="Número de celular"
                            class="py-2 px-3 rounded-lg border-2 border-blue-300 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent" />
                    </div>

                    <div class="grid grid-cols-1">
                        <label for="fecha_ingreso" class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">
                            Fecha Ingreso
                        </label>
                        <input wire:model.defer="fecha_ingreso" type="date" id="fecha_ingreso"
                            class="py-2 px-3 rounded-lg border-2 border-blue-300 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent" />
                    </div>
                </div>

                <!-- ********************************** -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-8 mt-5">
                    <div class="grid grid-cols-1">
                        <label for="edad"
                            class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Edad</label>
                        <input wire:model.defer="edad" type="text" id="edad" placeholder="Edad"
                            class="py-2 px-3 rounded-lg border-2 border-blue-300 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent" />
                    </div>

                    <div class="grid grid-cols-1">
                        <label for="estado_civil"
                            class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Estado Civil</label>
                        <select wire:model.defer="estado_civil" id="estado_civil"
                            class="py-2 px-3 rounded-lg border-2 border-blue-300 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent">
                            <option value="" selected>-- Selecciona una opción --</option>
                            <option value="Soltero">Soltero</option>
                            <option value="Casado">Casado</option>
                            <option value="Viudo">Viudo</option>
                            <option value="Divorciado">Divorciado</option>
                        </select>
                    </div>
                </div>

                <!-- ***********************  -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-8 mt-5">
                    <div class="grid grid-cols-1">
                        <label for="estudios"
                            class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Nivel de Estudios</label>
                        <select wire:model.defer="estudios" id="estudios"
                            class="py-2 px-3 rounded-lg border-2 border-blue-300 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent">
                            <option value="" selected>-- Selecciona una opción --</option>
                            <option value="Preescolar">Preescolar</option>
                            <option value="Primaria">Primaria</option>
                            <option value="Secundaria">Secundaria</option>
                            <option value="Medio Superior">Medio Superior</option>
                            <option value="Superior Licenciatura">Superior Licenciatura</option>
                            <option value="Superior Ingenieria">Superior Ingenieria</option>
                        </select>
                    </div>

                    <div class="grid grid-cols-1">
                        <label for="ocupacion"
                            class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Ocupación</label>
                        <input wire:model.defer="ocupacion" type="text" id="ocupacion" placeholder="Ocupación actual"
                            class="py-2 px-3 rounded-lg border-2 border-blue-300 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent" />
                    </div>
                </div>

                <!-- ***********************  -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-8 mt-5">
                    <div class="grid grid-cols-1">
                        <label for="tipo_puest"
                            class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Tipo puesto</label>
                        <input wire:model.defer="tipo_puest" type="text" id="tipo_puest" placeholder="Tipo de puesto"
                            class="py-2 px-3 rounded-lg border-2 border-blue-300 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent" />
                    </div>

                    <div class="grid grid-cols-1">
                        <label for="contratacion"
                            class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Contratación</label>
                        <input wire:model.defer="contratacion" type="text" id="contratacion" placeholder="Contratación"
                            class="py-2 px-3 rounded-lg border-2 border-blue-300 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent" />
                    </div>
                </div>

                <!-- ***********************  -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-8 mt-5">
                    <div class="grid grid-cols-1">
                        <label for="tipo_personal"
                            class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Tipo personal</label>
                        <input wire:model.defer="tipo_personal" type="text" id="tipo_personal" placeholder="Tipo de personal"
                            class="py-2 px-3 rounded-lg border-2 border-blue-300 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent" />
                    </div>

                    <div class="grid grid-cols-1">
                        <label for="jornada_trabajo"
                            class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Jornada Trabajo</label>
                        <input wire:model.defer="jornada_trabajo" type="text" id="jornada_trabajo" placeholder="Jornada de trabajo"
                            class="py-2 px-3 rounded-lg border-2 border-blue-300 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent" />
                    </div>
                </div>

                <!-- ***********************  -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-8 mt-5">
                    <div class="grid grid-cols-1">
                        <label for="rotacion"
                            class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Rotación</label>
                        <input wire:model.defer="rotacion" type="text" id="rotacion" placeholder="Rotación de turno"
                            class="py-2 px-3 rounded-lg border-2 border-blue-300 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent" />
                    </div>

                    <div class="grid grid-cols-1">
                        <label for="experiencia"
                            class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Experiencia</label>
                        <input wire:model.defer="experiencia" type="text" id="experiencia" placeholder="Experiencia laboral"
                            class="py-2 px-3 rounded-lg border-2 border-blue-300 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent" />
                    </div>
                </div>

                <!-- ***********************  -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-8 mt-5">
                    <div class="grid grid-cols-1">
                        <label for="tiempo_puesto"
                            class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Tiempo Puesto</label>
                        <input wire:model.defer="tiempo_puesto" type="text" id="tiempo_puesto" placeholder="Tiempo ocupado en el puesto"
                            class="py-2 px-3 rounded-lg border-2 border-blue-300 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent" />
                    </div>

                    <div class="grid grid-cols-1">
                        <label for="calle"
                            class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Calle</label>
                        <input wire:model.defer="calle" type="text" id="calle" placeholder="Calle"
                            class="py-2 px-3 rounded-lg border-2 border-blue-300 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent" />
                    </div>
                </div>

                <!-- ***********************  -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-8 mt-5">
                    <div class="grid grid-cols-1">
                        <label for="numero"
                            class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Número</label>
                        <input wire:model.defer="numero" type="text" id="numero" placeholder="Número de calle"
                            class="py-2 px-3 rounded-lg border-2 border-blue-300 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent" />
                    </div>

                    <div class="grid grid-cols-1">
                        <label for="colonia"
                            class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Colonia</label>
                        <input wire:model.defer="colonia" type="text" id="colonia" placeholder="Colonia"
                            class="py-2 px-3 rounded-lg border-2 border-blue-300 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent" />
                    </div>
                </div>

                <!-- Botones -->
                <div class='flex items-center justify-center md:gap-8 gap-4 pt-5 pb-5'>

                    <button type="button" wire:click="actualizarTrabajador"
                        class='w-auto bg-blue-500 hover:bg-blue-700 rounded-lg shadow-xl font-medium text-white px-4 py-2'>
                        Actualizar
                    </button>

                    <button type="button" onclick="window.history.back()"
                        class='w-auto bg-red-500 hover:bg-red-700 rounded-lg shadow-xl font-medium text-white px-4 py-2'>
                        Cancelar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
