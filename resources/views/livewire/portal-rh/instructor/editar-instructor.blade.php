<body class="bg-gray-200">
    <div class="flex min-h-screen items-center justify-center py-3">
        <div class="grid bg-white rounded-lg shadow-xl w-full">
            <div class="flex justify-center py-4">
                <div class="flex bg-blue-200 rounded-full md:p-4 p-2 border-2 border-blue-300">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24" width="30" viewBox="0 0 640 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path fill="#ffffff" d="M96 128a128 128 0 1 1 256 0A128 128 0 1 1 96 128zM0 482.3C0 383.8 79.8 304 178.3 304l91.4 0C368.2 304 448 383.8 448 482.3c0 16.4-13.3 29.7-29.7 29.7L29.7 512C13.3 512 0 498.7 0 482.3zM504 312l0-64-64 0c-13.3 0-24-10.7-24-24s10.7-24 24-24l64 0 0-64c0-13.3 10.7-24 24-24s24 10.7 24 24l0 64 64 0c13.3 0 24 10.7 24 24s-10.7 24-24 24l-64 0 0 64c0 13.3-10.7 24-24 24s-24-10.7-24-24z"/></svg>
                </div>
            </div>

            <div class="flex justify-center">
                <div class="flex">
                    <h1 class="text-gray-600 font-bold md:text-2xl text-xl">Editar Instructor</h1>
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
                        <label for="Nueva contraseña"
                            class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Password (SOLO SI ES NECESARIO)
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
                        <select wire:model.defer="registro_patronal_id" id="registro_patronal_id"
                            class="py-2 px-3 rounded-lg border-2 border-blue-300 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent">
                            <option value=""> --- Seleccione un Registro Patronal --- </option>
                            @foreach ($registros_patronales as $registro_patronal)
                                <option value="{{ $registro_patronal->id }}">
                                    {{ $registro_patronal->registro_patronal }}</option>
                            @endforeach
                        </select>

                        <x-input-error for="registro_patronal_id" />
                        
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
                    
                    <div class="grid grid-cols-1 mt-5">
                        <label for="telefono1"
                            class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Telefono 1
                        </label>
                        <input wire:model.defer="telefono1" type="text" id="telefono1"
                            placeholder="Número de contacto primordial"
                            class="py-2 px-3 rounded-lg border-2 border-blue-300 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent" />
                    </div>
                </div>
                

                <!-- *********** -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-8 mt-5">
                    <div class="grid grid-cols-1">
                        <label for="telefono2"
                            class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Telefono 2
                        </label>
                        <input wire:model.defer="telefono2" type="text" id="telefono2"
                            placeholder="Número de contacto secundario"
                            class="py-2 px-3 rounded-lg border-2 border-blue-300 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent" />
                    </div>

                    <div class="grid grid-cols-1">
                        <label for="registroStps"
                            class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold"> Registro STPS
                        </label>
                        <input wire:model.defer="registroStps" type="text" id="registroStps"
                            placeholder="Registro STPS"
                            class="py-2 px-3 rounded-lg border-2 border-blue-300 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent" />
                    </div>
                </div>

                <!-- ********************** -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-8 mt-5">

                    <div class="grid grid-cols-1">
                        <label for="rfc"
                            class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold"> RFC
                        </label>
                        <input wire:model.defer="rfc" type="text" id="rfc"
                            placeholder="RFC a 13 digitos"
                            class="py-2 px-3 rounded-lg border-2 border-blue-300 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent" />
                    </div>

                    <div class="grid grid-cols-1">
                        <label for="regimen"
                            class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">
                            Regimen fiscal</label>
                        <input wire:model.defer="regimen" type="text" id="regimen"
                             placeholder="Regimen fiscal"
                            class="py-2 px-3 rounded-lg border-2 border-blue-300 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent" />
                    </div>
                </div>

                <!--  -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-8 mt-5">
                    <div class="grid grid-cols-1">
                        <label for="estado"
                            class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Estado
                        </label>
                        <input wire:model.defer="estado" type="text" id="estado" 
                        placeholder="Estado"
                            class="py-2 px-3 rounded-lg border-2 border-blue-300 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent" />
                    </div>

                    <div class="grid grid-cols-1">
                        <label for="municipio"
                            class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Municipio
                        </label>
                        <input wire:model.defer="municipio" type="text" id="municipio" 
                        placeholder="Municipio"
                            class="py-2 px-3 rounded-lg border-2 border-blue-300 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent" />
                    </div>
                </div>

                <!--  -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-8 mt-5">
                    <div class="grid grid-cols-1">
                        <label for="codigopostal"
                            class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Código Postal
                        </label>
                        <input wire:model.defer="codigopostal" type="text" id="codigopostal" 
                        placeholder="Código Postal"
                            class="py-2 px-3 rounded-lg border-2 border-blue-300 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent" />
                    </div>

                    <div class="grid grid-cols-1">
                        <label for="colonia"
                            class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Colonia
                        </label>
                        <input wire:model.defer="colonia" type="text" id="colonia" 
                        placeholder="Colonia"
                            class="py-2 px-3 rounded-lg border-2 border-blue-300 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent" />
                    </div>
                </div>

                <!-- ***********************  -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-8 mt-5">
                    <div class="grid grid-cols-1">
                        <label for="calle"
                            class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Calle </label>
                        <input wire:model.defer="calle" type="text" id="calle" 
                        placeholder="Nombre de calle"
                            class="py-2 px-3 rounded-lg border-2 border-blue-300 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent" />
                    </div>

                    <div class="grid grid-cols-1">
                        <label for="numero"
                            class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Número </label>
                        <input wire:model.defer="numero" type="text" id="numero" 
                        placeholder="Número de calle"
                            class="py-2 px-3 rounded-lg border-2 border-blue-300 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent" />
                    </div>
                </div>

                <!-- ********************************** -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-8 mt-5">
                    <div class="grid grid-cols-1 mt-5">
                        <label for="honorarios"
                            class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Honorarios</label>
                        <input wire:model.defer="honorarios" type="text" id="honorarios" 
                        placeholder="Honorarios"
                            class="py-2 px-3 rounded-lg border-2 border-blue-300 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent" />
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

                <!-- ***********************  -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-8 mt-5">
                    <div class="grid grid-cols-1">
                        <label for="dc5"
                            class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">DC5
                        </label>
                        <input wire:model.defer="dc5" type="text" id="dc5" 
                        placeholder="DC5"
                            class="py-2 px-3 rounded-lg border-2 border-blue-300 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent" />
                    </div>

                    <div class="grid grid-cols-1">
                        <label for="cuentabancaria"
                            class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Cuenta Bancaria
                        </label>
                        <input wire:model.defer="cuentabancaria" type="text" id="cuentabancaria" 
                        placeholder="Número de cuenta bancaria"
                            class="py-2 px-3 rounded-lg border-2 border-blue-300 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent" />
                    </div>
                </div>

                <!-- ***********************  -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-8 mt-5">
                    <div class="grid grid-cols-1">
                        <label for="ine"
                            class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">INE
                        </label>
                        <input wire:model.defer="ine" type="text" id="ine" 
                        placeholder="INE"
                            class="py-2 px-3 rounded-lg border-2 border-blue-300 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent" />
                    </div>

                    <div class="grid grid-cols-1">
                        <label for="curp"
                            class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">CURP
                        </label>
                        <input wire:model.defer="curp" type="text" id="curp" 
                        placeholder="CURP"
                            class="py-2 px-3 rounded-lg border-2 border-blue-300 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent" />
                    </div>
                </div>

                <!-- ***********************  -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-8 mt-5">
                    <div class="grid grid-cols-1">
                        <label for="sat"
                            class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">SAT
                        </label>
                        <input wire:model.defer="sat" type="text" id="sat" 
                        placeholder="SAT"
                            class="py-2 px-3 rounded-lg border-2 border-blue-300 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent" />
                    </div>

                    <div class="grid grid-cols-1">
                        <label for="domicilio"
                            class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Domicilio
                        </label>
                        <input wire:model.defer="domicilio" type="text" id="domicilio" 
                        placeholder="Domicilio"
                            class="py-2 px-3 rounded-lg border-2 border-blue-300 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent" />
                    </div>
                </div>

                <!-- ***********************  -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-8 mt-5">
                    <div class="grid grid-cols-1">
                        <label for="tipoinstructor"
                            class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Tipo Instructor
                        </label>
                        <input wire:model.defer="tipoinstructor" type="text" id="tipoinstructor" 
                        placeholder="Tipo de instructor"
                            class="py-2 px-3 rounded-lg border-2 border-blue-300 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent" />
                    </div>

                    <div class="grid grid-cols-1">
                        <label for="nombre_empresa"
                            class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Nombre Empresa
                        </label>
                        <input wire:model.defer="nombre_empresa" type="text" id="nombre_empresa" 
                        placeholder="Nombre Empresa"
                            class="py-2 px-3 rounded-lg border-2 border-blue-300 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent" />
                    </div>
                </div>

                <!-- ***********************  -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-8 mt-5">
                    <div class="grid grid-cols-1">
                        <label for="rfc_empre"
                            class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">RFC Empresa
                        </label>
                        <input wire:model.defer="rfc_empre" type="text" id="rfc_empre" 
                        placeholder="RFC de la Empresa"
                            class="py-2 px-3 rounded-lg border-2 border-blue-300 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent" />
                    </div>

                    <div class="grid grid-cols-1">
                        <label for="calle_empre"
                            class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Calle Empresa
                        </label>
                        <input wire:model.defer="calle_empre" type="text" id="calle_empre" 
                        placeholder="Calle de la Empresa"
                            class="py-2 px-3 rounded-lg border-2 border-blue-300 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent" />
                    </div> 
                </div>

                <!-- ***********************  -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-8 mt-5">
                    <div class="grid grid-cols-1">
                        <label for="numero_empre"
                            class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Número Calle Empresa
                        </label>
                        <input wire:model.defer="numero_empre" type="text" id="numero_empre" 
                        placeholder="Número de Calle de la Empresa"
                            class="py-2 px-3 rounded-lg border-2 border-blue-300 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent" />
                    </div>

                    <div class="grid grid-cols-1">
                        <label for="colonia_empre"
                            class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Colonia Empresa
                        </label>
                        <input wire:model.defer="colonia_empre" type="text" id="colonia_empre" 
                        placeholder="Colonia de la Empresa"
                            class="py-2 px-3 rounded-lg border-2 border-blue-300 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent" />
                    </div> 
                </div>

                <!-- ***********************  -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-8 mt-5">
                    <div class="grid grid-cols-1">
                        <label for="municipio_empre"
                            class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Municipio Empresa
                        </label>
                        <input wire:model.defer="municipio_empre" type="text" id="municipio_empre" 
                        placeholder="Municipio de la Empresa"
                            class="py-2 px-3 rounded-lg border-2 border-blue-300 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent" />
                    </div>

                    <div class="grid grid-cols-1">
                        <label for="estado_empre"
                            class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Estado Empresa
                        </label>
                        <input wire:model.defer="estado_empre" type="text" id="estado_empre" 
                        placeholder="Estado de la Empresa"
                            class="py-2 px-3 rounded-lg border-2 border-blue-300 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent" />
                    </div> 
                </div>

                <!-- ***********************  -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-8 mt-5">
                    <div class="grid grid-cols-1">
                        <label for="postal_empre"
                            class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Código Postal Empresa
                        </label>
                        <input wire:model.defer="postal_empre" type="text" id="postal_empre" 
                        placeholder="Código Postal de la Empresa"
                            class="py-2 px-3 rounded-lg border-2 border-blue-300 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent" />
                    </div>

                    <div class="grid grid-cols-1 mt-5">
                        <label for="regimen_empre"
                            class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Regimen Empresa
                        </label>
                        <input wire:model.defer="regimen_empre" type="text" id="regimen_empre" 
                        placeholder="Regimen de la Empresa"
                            class="py-2 px-3 rounded-lg border-2 border-blue-300 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent" />
                    </div> 
                </div>

                <!-- Botones -->
                <div class='flex items-center justify-center md:gap-8 gap-4 pt-5 pb-5'>

                    <button type="button" wire:click="actualizarInstructor"
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
</body>
