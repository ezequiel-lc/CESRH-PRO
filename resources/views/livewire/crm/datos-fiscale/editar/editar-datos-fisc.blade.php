<div>
    <div class="container px-4 mx-auto mt-6">
        <!-- Razon Social -->
        <div class="flex flex-wrap mb-6 -mx-2">
            <div class="w-full px-3 md:w-1/2">
                <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase" for="nombre">
                    Razon Social
                </label>
                <input
                    class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500"
                    wire:model.defer="25razon_social" type="text" placeholder="">
                <x-input-error for="razon_social" />
            </div>
        </div>
        <!-- RFC -->
        <div class="flex flex-wrap mb-6 -mx-2">
            <div class="w-full px-3 md:w-1/2">
                <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase" for="nombre">
                    RFC
                </label>
                <input
                    class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500"
                    wire:model.defer="rfc" type="text" placeholder="">
                <x-input-error for="rfc" />
            </div>
        </div>
        <div class="flex flex-wrap mb-6 -mx-2">
            <div class="w-full px-3 md:w-1/2">
                <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase" for="nombre">
                    Calle
                </label>
                <input
                    class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500"
                    wire:model.defer="calle" type="text" placeholder="">
                <x-input-error for="calle" />
            </div>
        </div>
        <div class="flex flex-wrap mb-6 -mx-2">
            <div class="w-full px-3 md:w-1/2">
                <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase" for="nombre">
                    Numero Exterior
                </label>
                <input
                    class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500"
                    wire:model.defer="numero_exterior" type="text" placeholder="">
                <x-input-error for="numero_exterior" />
            </div>
        </div>
        <div class="flex flex-wrap mb-6 -mx-2">
            <div class="w-full px-3 md:w-1/2">
                <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase" for="nombre">
                    Numero Interior
                </label>
                <input
                    class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500"
                    wire:model.defer="numero_interior" type="text" placeholder="">
                <x-input-error for="numero_interior" />
            </div>
        </div>
        <div class="flex flex-wrap mb-6 -mx-2">
            <div class="w-full px-3 md:w-1/2">
                <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase" for="nombre">
                    Colonia
                </label>
                <input
                    class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500"
                    wire:model.defer="colonia" type="text" placeholder="">
                <x-input-error for="colonia" />
            </div>
        </div>
        <div class="flex flex-wrap mb-6 -mx-2">
            <div class="w-full px-3 md:w-1/2">
                <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase" for="nombre">
                    Municipio
                </label>
                <input
                    class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500"
                    wire:model.defer="municipio" type="text" placeholder="">
                <x-input-error for="municipio" />
            </div>
        </div>
        <div class="flex flex-wrap mb-6 -mx-2">
            <div class="w-full px-3 md:w-1/2">
                <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase" for="nombre">
                    Localidad
                </label>
                <input
                    class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500"
                    wire:model.defer="localidad" type="text" placeholder="">
                <x-input-error for="localidad" />
            </div>
        </div>
        <div class="flex flex-wrap mb-6 -mx-2">
            <div class="w-full px-3 mb-6 md:w-1/2 md:mb-0">
                <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase"
                    for="estado">Estado:</label>
                <select id="estados" name="estados"
                    class="block w-full px-4 py-3 pr-8 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500"
                    wire:model.defer="estado">>
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
            </div>
            <div class="flex flex-wrap mb-6 -mx-2">
                <div class="w-full px-3 md:w-1/2">
                    <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase" for="nombre">
                        Pais
                    </label>
                    <input
                        class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500"
                        wire:model.defer="pais" type="text" placeholder="">
                    <x-input-error for="pais" />
                </div>
            </div>
            <div class="flex flex-wrap mb-6 -mx-2">
                <div class="w-full px-3 md:w-1/2">
                    <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase" for="nombre">
                        Código Postal
                    </label>
                    <input
                        class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500"
                        wire:model.defer="codigo_postal" type="text" placeholder="">
                    <x-input-error for="codigo_postal" />
                </div>
                <div class="w-full px-3 mb-6 md:w-1/2 md:mb-0">
                    <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase"
                        for="crm_empresaid">Empresa:</label>
                    {{-- <input
                        class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500"
                        wire:model.defer="empresa.crm_empresaid" type="text" placeholder="">
                    <x-input-error for="crm_empresaid" /> --}}
                    <select id="estados" name="estados"
                        class="block w-full px-4 py-3 pr-8 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500"
                        wire:model.defer="crm_empresaid">>
                        <option value="0" disabled></option>
                        <option value="0">------</option>
                        @foreach ($empresa as $empresas)
                            <option value="{{ $empresas->id }}">{{ $empresas->nombre }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <!-- Botón -->
        <div class="flex items-center justify-center">
            <button wire:click="editDato()"
                class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">
                Editar
            </button>
            <a href="{{ url('/crm/crm-mostrarDatosFiscales') }}"
                class="px-4 py-2 font-bold text-white bg-red-500 rounded btn hover:bg-red-700">
                Cancelar
            </a>
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
