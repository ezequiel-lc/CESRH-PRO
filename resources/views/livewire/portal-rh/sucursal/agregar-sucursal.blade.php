<div>
    <div class="flex min-h-screen items-center justify-center py-3">
        <div class="grid bg-white rounded-lg shadow-xl w-full">
            <div class="flex justify-center py-4">
                <div class="flex bg-blue-200 rounded-full md:p-4 p-2 border-2 border-blue-300">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24" width="30"
                        viewBox="0 0 640 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                        <path fill="#ffffff"
                            d="M36.8 192l566.3 0c20.3 0 36.8-16.5 36.8-36.8c0-7.3-2.2-14.4-6.2-20.4L558.2 21.4C549.3 8 534.4 0 518.3 0L121.7 0c-16 0-31 8-39.9 21.4L6.2 134.7c-4 6.1-6.2 13.2-6.2 20.4C0 175.5 16.5 192 36.8 192zM64 224l0 160 0 80c0 26.5 21.5 48 48 48l224 0c26.5 0 48-21.5 48-48l0-80 0-160-64 0 0 160-192 0 0-160-64 0zm448 0l0 256c0 17.7 14.3 32 32 32s32-14.3 32-32l0-256-64 0z" />
                    </svg>
                </div>
            </div>

            <div class="flex justify-center">
                <div class="flex">
                    <h1 class="text-gray-600 font-bold md:text-2xl text-xl">Agregar Sucursal</h1>
                </div>
            </div>

            <form class="mt-5 mx-7">
                <!-- Clave Sucursal -->
                <div class="grid grid-cols-1">
                    <label for="clave_sucursal"
                        class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Clave
                        Sucursal</label>
                    <input wire:model.defer="sucursal.clave_sucursal" type="text" id="clave_sucursal"
                        placeholder="Clave de la sucursal"
                        class="py-2 px-3 rounded-lg border-2 border-blue-300 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent" />

                    <x-input-error for="sucursal.clave_sucursal" />
                </div>

                <!-- Nombre Sucursal y Zona Económica -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-8 mt-5">
                    <div class="grid grid-cols-1">
                        <label for="nombre_sucursal"
                            class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Nombre
                            Sucursal</label>
                        <input wire:model.defer="sucursal.nombre_sucursal" type="text" id="nombre_sucursal"
                            placeholder="Nombre de la sucursal"
                            class="py-2 px-3 rounded-lg border-2 border-blue-300 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent" />

                        <x-input-error for="sucursal.nombre_sucursal" />
                    </div>

                    <div class="grid grid-cols-1">
                        <label for="zona_economica"
                            class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Zona
                            Económica</label>
                        <input wire:model.defer="sucursal.zona_economica" type="text" id="zona_economica"
                            placeholder="Zona económica"
                            class="py-2 px-3 rounded-lg border-2 border-blue-300 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent" />

                        <x-input-error for="sucursal.zona_economica" />
                    </div>
                </div>

                <!-- Estado y Cuenta Contable -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-8 mt-5">
                    <div class="grid grid-cols-1">
                        <label for="estado"
                            class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Estado</label>
                        <input wire:model.defer="sucursal.estado" type="text" id="estado" placeholder="Estado"
                            class="py-2 px-3 rounded-lg border-2 border-blue-300 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent" />

                        <x-input-error for="sucursal.estado" />
                    </div>

                    <div class="grid grid-cols-1">
                        <label for="cuenta_contable"
                            class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Cuenta
                            Contable</label>
                        <input wire:model.defer="sucursal.cuenta_contable" type="text" id="cuenta_contable"
                            placeholder="Cuenta contable"
                            class="py-2 px-3 rounded-lg border-2 border-blue-300 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent" />

                        <x-input-error for="sucursal.cuenta_contable" />
                    </div>
                </div>

                <!-- RFC y Correo -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-8 mt-5">
                    <div class="grid grid-cols-1">
                        <label for="rfc"
                            class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">RFC</label>
                        <input wire:model.defer="sucursal.rfc" type="text" id="rfc" placeholder="RFC"
                            class="py-2 px-3 rounded-lg border-2 border-blue-300 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent" />

                        <x-input-error for="sucursal.rfc" />
                    </div>

                    <div class="grid grid-cols-1">
                        <label for="correo"
                            class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Correo</label>
                        <input wire:model.defer="sucursal.correo" type="email" id="correo"
                            placeholder="Correo electrónico"
                            class="py-2 px-3 rounded-lg border-2 border-blue-300 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent" />

                        <x-input-error for="sucursal.correo" />
                    </div>
                </div>

                <!-- Teléfono y Status -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-8 mt-5">
                    <div class="grid grid-cols-1">
                        <label for="telefono"
                            class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Teléfono</label>
                        <input wire:model.defer="sucursal.telefono" type="text" id="telefono" placeholder="Teléfono"
                            class="py-2 px-3 rounded-lg border-2 border-blue-300 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent" />

                        <x-input-error for="sucursal.telefono" />
                    </div>

                    <div class="grid grid-cols-1">
                        <label for="status"
                            class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Status</label>
                        <select wire:model.defer="sucursal.status" id="status"
                            class="py-2 px-3 rounded-lg border-2 border-blue-300 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent">
                            <option value="" selected>-- Selecciona una opción --</option>
                            <option value="Activo">Activo</option>
                            <option value="Inactivo">Inactivo</option>
                        </select>

                        <x-input-error for="sucursal.status" />
                    </div>
                </div>

                <!-- Registro Patronal -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-8 mt-5">
                    <div class="grid grid-cols-1 mt-5">
                        <label for="registro_patronal_id"
                            class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">
                            Registro Patronal
                        </label>
                        <select wire:model.defer="sucursal.registro_patronal_id" id="registro_patronal_id"
                            class="py-2 px-3 rounded-lg border-2 border-blue-300 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent">
                            <option value="">Seleccione un Registro Patronal</option>
                            @foreach ($regpatronales as $regpatronal)
                                <option value="{{ $regpatronal->id }}">{{ $regpatronal->registro_patronal }}</option>
                            @endforeach
                        </select>
    
                        <x-input-error for="sucursal.registro_patronal_id" />
                    </div>

                    <div class="grid grid-cols-1 mt-5">
                        <label for="empresa_id"
                            class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Asociar Empresa</label>
                        <select wire:model.defer="empresa_id" id="empresa_id"
                            class="py-2 px-3 rounded-lg border-2 border-blue-300 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent">
                            <option value="">Seleccione una Empresa</option>
                            @foreach ($empresas as $empresa)
                                <option value="{{ $empresa->id }}">{{ $empresa->nombre }}</option>
                            @endforeach
                        </select>
    
                        <x-input-error for="empresa_id" />
                    </div>
                </div>
                

                <!-- Botones -->
                <div class='flex items-center justify-center md:gap-8 gap-4 pt-5 pb-5'>

                    <button type="button" wire:click="saveSucursal()"
                        class='w-auto bg-blue-500 hover:bg-blue-700 rounded-lg shadow-xl font-medium text-white px-4 py-2'>
                        Agregar
                    </button>

                    <button type="button" wire:click="redirigirSuc"
                        class='w-auto bg-red-500 hover:bg-red-700 rounded-lg shadow-xl font-medium text-white px-4 py-2'>
                        Cancelar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
