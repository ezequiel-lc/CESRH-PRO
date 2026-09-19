<div>
    <div class="container px-4 mx-auto mt-6">
        <div class="w-full p-6 bg-white border-2 rounded-md bg bg- b m-6">
            <!-- Razon Social -->

            <div class="w-full m-2">
                <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase" for="razonsocial">
                    Razon Social
                </label>
                <input
                    class="block border-4 rounded-lg w-full px-4 border-blue-500 none bor500 der-gray-200 bg-gray-2-00 text-bluegray-700 lebkuading-tight p-y-3 focus:outline-none focus:bg-white focus:border-gray-500"
                    wire:model.defer="dato.razon_social" type="text" placeholder="">
                <x-input-error for="dato.razon_social" />
            </div>

            <!-- RFC -->

            <div class="w-full m-2">
                <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase" for="rfc">
                    RFC
                </label>
                <input
                    class="block border-4 rounded-lg w-full px-4 border-blue-500 none bor500 der-gray-200 bg-gray-2-00 text-bluegray-700 lebkuading-tight p-y-3 focus:outline-none focus:bg-white focus:border-gray-500"
                    wire:model.defer="dato.rfc" type="text" placeholder="">
                <x-input-error for="dato.rfc" />
            </div>


            <div class="w-full m-2">
                <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase" for="calle">
                    Calle
                </label>
                <input
                    class="block border-4 rounded-lg w-full px-4 border-blue-500 none bor500 der-gray-200 bg-gray-2-00 text-bluegray-700 lebkuading-tight p-y-3 focus:outline-none focus:bg-white focus:border-gray-500"
                    wire:model.defer="dato.calle" type="text" placeholder="">
                <x-input-error for="dato.calle" />
            </div>


            <div class="w-full m-2">
                <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase" for="nombre">
                    Numero Exterior
                </label>
                <input
                    class="block border-4 rounded-lg w-full px-4 border-blue-500 none bor500 der-gray-200 bg-gray-2-00 text-bluegray-700 lebkuading-tight p-y-3 focus:outline-none focus:bg-white focus:border-gray-500"
                    wire:model.defer="dato.numero_exterior" type="text" placeholder="">
                <x-input-error for="dato.numero_exterior" />
            </div>


            <div class="w-full m-2">
                <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase" for="nombre">
                    Numero Interior
                </label>
                <input
                    class="block border-4 rounded-lg w-full px-4 border-blue-500 none bor500 der-gray-200 bg-gray-2-00 text-bluegray-700 lebkuading-tight p-y-3 focus:outline-none focus:bg-white focus:border-gray-500"
                    wire:model.defer="dato.numero_interior" type="text" placeholder="">
                <x-input-error for="dato.numero_interior" />
            </div>


            <div class="w-full m-2">
                <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase" for="nombre">
                    Colonia
                </label>
                <input
                    class="block border-4 rounded-lg w-full px-4 border-blue-500 none bor500 der-gray-200 bg-gray-2-00 text-bluegray-700 lebkuading-tight p-y-3 focus:outline-none focus:bg-white focus:border-gray-500"
                    wire:model.defer="dato.colonia" type="text" placeholder="">
                <x-input-error for="dato.colonia" />
            </div>


            <div class="w-full m-2">
                <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase" for="municipio">
                    Municipio
                </label>
                <input
                    class="block border-4 rounded-lg w-full px-4 border-blue-500 none bor500 der-gray-200 bg-gray-2-00 text-bluegray-700 lebkuading-tight p-y-3 focus:outline-none focus:bg-white focus:border-gray-500"
                    wire:model.defer="dato.municipio" type="text" placeholder="">
                <x-input-error for="dato.municipio" />
            </div>


            <div class="w-full m-2">
                <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase" for="localidad">
                    Localidad
                </label>
                <input
                    class="block border-4 rounded-lg w-full px-4 border-blue-500 none bor500 der-gray-200 bg-gray-2-00 text-bluegray-700 lebkuading-tight p-y-3 focus:outline-none focus:bg-white focus:border-gray-500"
                    wire:model.defer="dato.localidad" type="text" placeholder="">
                <x-input-error for="dato.localidad" />
            </div>


            <div class="w-full px-3 mb-6 md:w-1/2 md:mb-0">
                <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase"
                    for="estado">Estado:</label>
                <select id="estado" name="estado"
                    class="block border-4 rounded-lg w-full px-4 border-blue-500 none bor500 der-gray-200 bg-gray-2-00 text-bluegray-700 lebkuading-tight p-y-3 focus:outline-none focus:bg-white focus:border-gray-500"
                    wire:model.defer="dato.estado">>
                    <option value="aguascalientes">Aguascalientes</option>
                    <option value="baja_california">Baja California</option>
                    <option value="baja_california_sur">Baja California Sur</option>
                    <option value="campeche">Campeche</option>
                    <option value="coahuila">Coahuila</option>
                    <option value="colima">Colima</option>
                    <option value="chiapas">Chiapas</option>
                    <option value="chihuahua">Chihuahua</option>
                    <option value="cdmx">Ciudad de México</option>
                    <option value="durango">Durango</option>
                    <option value="guanajuato">Guanajuato</option>
                    <option value="guerrero">Guerrero</option>
                    <option value="hidalgo">Hidalgo</option>
                    <option value="jalisco">Jalisco</option>
                    <option value="edomex">Estado de México</option>
                    <option value="michoacan">Michoacán</option>
                    <option value="morelos">Morelos</option>
                    <option value="nayarit">Nayarit</option>
                    <option value="nuevo_leon">Nuevo León</option>
                    <option value="oaxaca">Oaxaca</option>
                    <option value="puebla">Puebla</option>
                    <option value="queretaro">Querétaro</option>
                    <option value="quintana_roo">Quintana Roo</option>
                    <option value="san_luis_potosi">San Luis Potosí</option>
                    <option value="sinaloa">Sinaloa</option>
                    <option value="sonora">Sonora</option>
                    <option value="tabasco">Tabasco</option>
                    <option value="tamaulipas">Tamaulipas</option>
                    <option value="tlaxcala">Tlaxcala</option>
                    <option value="veracruz">Veracruz</option>
                    <option value="yucatan">Yucatán</option>
                    <option value="zacatecas">Zacatecas</option>
                </select>


                <div class="w-full m-2">
                    <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase" for="nombre">
                        Pais
                    </label>
                    <input
                        class="block border-4 rounded-lg w-full px-4 border-blue-500 none bor500 der-gray-200 bg-gray-2-00 text-bluegray-700 lebkuading-tight p-y-3 focus:outline-none focus:bg-white focus:border-gray-500"
                        wire:model.defer="dato.pais" type="text" placeholder="">
                    <x-input-error for="dato.pais" />
                </div>


                <div class="w-full m-2">
                    <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase" for="nombre">
                        Código Postal
                    </label>
                    <input
                        class="block border-4 rounded-lg w-full px-4 border-blue-500 none bor500 der-gray-200 bg-gray-2-00 text-bluegray-700 lebkuading-tight p-y-3 focus:outline-none focus:bg-white focus:border-gray-500"
                        wire:model.defer="dato.codigo_postal" type="text" placeholder="">
                    <x-input-error for="dato.codigo_postal" />
                </div>
                <div class="w-full px-3 mb-6 md:w-1/2 md:mb-0">
                    <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase"
                        for="estado">Empresa:</label>
                    <select id="empresas" name="empresas"
                        class="block border-4 rounded-lg w-full px-4 border-blue-500 none bor500 der-gray-200 bg-gray-2-00 text-bluegray-700 lebkuading-tight p-y-3 focus:outline-none focus:bg-white focus:border-gray-500"
                        wire:model.defer="dato.crm_empresas_id">
                        <option value="0" disabled></option>
                        <option value="0">------</option>
                        @foreach ($empresa as $empresas)
                            <option value="{{ $empresas->id }}">{{ $empresas->nombre }}</option>
                        @endforeach
                    </select>
                </div>

            </div>
            <!-- Botón -->
            <div class="flex items-center justify-center">
                <button wire:click="saveDato()"
                    class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">
                    Agregar
                </button>
                <a href="{{ url('/crm/crm-inicio') }}"
                    class="px-4 py-2 font-bold text-white bg-red-500 rounded btn hover:bg-red-700">
                    Cancelar
                </a>
            </div>
        </div>
    </div>
</div>

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('livewire:load', function() {
            Livewire.on('showAnimatedToast', function(message) {
                var toastMixin = Swal.mixin({
                    toast: true,
                    icon: 'success',
                    title: message,
                    animation: true,
                    position: 'top-right',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                });

                toastMixin.fire();
            });
        });
    </script>
@endpush
