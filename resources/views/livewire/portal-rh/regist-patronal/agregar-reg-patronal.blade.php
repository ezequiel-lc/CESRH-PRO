<div class="container mx-auto px-4">
    <div class="mt-6">
        <!-- Primera fila -->
        <div class="flex flex-wrap -mx-2 mb-6">

            <div class="w-full md:w-1/2 px-3">

                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="registro_patronal">
                    Registro Patronal
                </label>
                <input wire:model.defer="registro.registro_patronal" type="text"
                    class="appearance-none block w-full bg-gray-200 border rounded py-3 px-4 mb-3"
                    placeholder="Ingrese el registro patronal">
                <x-input-error for="registro.registro_patronal" />
            </div>
            
            <div class="w-full md:w-1/2 px-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="rfc">
                    RFC
                </label>
                <input wire:model.defer="registro.rfc" type="text"
                    class="appearance-none block w-full bg-gray-200 border rounded py-3 px-4 mb-3"
                    placeholder="Ingrese el RFC">
                <x-input-error for="registro.rfc" />
            </div>
        </div>

        <!-- Segunda fila -->
        <div class="flex flex-wrap -mx-2 mb-6">
            <div class="w-full md:w-1/2 px-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="nombre_o_razon_social">
                    Nombre o Razón Social
                </label>
                <input wire:model.defer="registro.nombre_o_razon_social" type="text"
                    class="appearance-none block w-full bg-gray-200 border rounded py-3 px-4 mb-3"
                    placeholder="Ingrese el nombre o razón social">
                <x-input-error for="registro.nombre_o_razon_social" />
            </div>
            <div class="w-full md:w-1/2 px-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="regimen_capital">
                    Régimen de Capital
                </label>
                <input wire:model.defer="registro.regimen_capital" type="text"
                    class="appearance-none block w-full bg-gray-200 border rounded py-3 px-4 mb-3"
                    placeholder="Ingrese el régimen de capital">
                <x-input-error for="registro.regimen_capital" />
            </div>
        </div>

        <!-- Tercera fila -->
        <div class="flex flex-wrap -mx-2 mb-6">
            <div class="w-full md:w-1/2 px-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="regimen_fiscal">
                    Régimen Fiscal
                </label>
                <input wire:model.defer="registro.regimen_fiscal" type="text"
                    class="appearance-none block w-full bg-gray-200 border rounded py-3 px-4 mb-3"
                    placeholder="Ingrese el régimen fiscal">
                <x-input-error for="registro.regimen_fiscal" />
            </div>
            <div class="w-full md:w-1/2 px-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="actividad_economica">
                    Actividad Económica
                </label>
                <input wire:model.defer="registro.actividad_economica" type="text"
                    class="appearance-none block w-full bg-gray-200 border rounded py-3 px-4 mb-3"
                    placeholder="Ingrese la actividad económica">
                <x-input-error for="registro.actividad_economica" />
            </div>
        </div>

        <!-- Cuarta fila -->
        <div class="flex flex-wrap -mx-2 mb-6">
            <div class="w-full md:w-1/2 px-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="imss_calle_manzana">
                    Calle y Manzana IMSS
                </label>
                <input wire:model.defer="registro.imss_calle_manzana" type="text"
                    class="appearance-none block w-full bg-gray-200 border rounded py-3 px-4 mb-3"
                    placeholder="Ingrese la calle y manzana del IMSS">
                <x-input-error for="registro.imss_calle_manzana" />
            </div>
            <div class="w-full md:w-1/2 px-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="imms_num_exterior">
                    Número Exterior IMSS
                </label>
                <input wire:model.defer="registro.imms_num_exterior" type="text"
                    class="appearance-none block w-full bg-gray-200 border rounded py-3 px-4 mb-3"
                    placeholder="Ingrese el número exterior del IMSS">
                <x-input-error for="registro.imms_num_exterior" />
            </div>
        </div>

        <!-- Quinta fila -->
        <div class="flex flex-wrap -mx-2 mb-6">
            <div class="w-full md:w-1/2 px-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="imms_num_int">
                    Número Interior IMSS (Opcional)
                </label>
                <input wire:model.defer="registro.imms_num_int" type="text"
                    class="appearance-none block w-full bg-gray-200 border rounded py-3 px-4 mb-3"
                    placeholder="Ingrese el número interior del IMSS">
                <x-input-error for="registro.imms_num_int" />
            </div>
            <div class="w-full md:w-1/2 px-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="imms_colonia">
                    Colonia IMSS
                </label>
                <input wire:model.defer="registro.imms_colonia" type="text"
                    class="appearance-none block w-full bg-gray-200 border rounded py-3 px-4 mb-3"
                    placeholder="Ingrese la colonia del IMSS">
                <x-input-error for="registro.imms_colonia" />
            </div>
        </div>

        <!-- Sexta fila -->
        <div class="flex flex-wrap -mx-2 mb-6">
            <div class="w-full md:w-1/2 px-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="imms_codigo_postal">
                    Código Postal IMSS
                </label>
                <input wire:model.defer="registro.imms_codigo_postal" type="text"
                    class="appearance-none block w-full bg-gray-200 border rounded py-3 px-4 mb-3"
                    placeholder="Ingrese el código postal del IMSS">
                <x-input-error for="registro.imms_codigo_postal" />
            </div>
            <div class="w-full md:w-1/2 px-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="imms_estado">
                    Estado IMSS
                </label>
                <input wire:model.defer="registro.imms_estado" type="text"
                    class="appearance-none block w-full bg-gray-200 border rounded py-3 px-4 mb-3"
                    placeholder="Ingrese el estado del IMSS">
                <x-input-error for="registro.imms_estado" />
            </div>
        </div>

        <!-- Séptima fila -->
        <div class="flex flex-wrap -mx-2 mb-6">
            <div class="w-full md:w-1/2 px-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="imms_municipio">
                    Municipio IMSS
                </label>
                <input wire:model.defer="registro.imms_municipio" type="text"
                    class="appearance-none block w-full bg-gray-200 border rounded py-3 px-4 mb-3"
                    placeholder="Ingrese el municipio del IMSS">
                <x-input-error for="registro.imms_municipio" />
            </div>
            <div class="w-full md:w-1/2 px-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="imms_telefono">
                    Teléfono IMSS
                </label>
                <input wire:model.defer="registro.imms_telefono" type="text"
                    class="appearance-none block w-full bg-gray-200 border rounded py-3 px-4 mb-3"
                    placeholder="Ingrese el teléfono del IMSS">
                <x-input-error for="registro.imms_telefono" />
            </div>
        </div>

        <!-- Octava fila -->
        <div class="flex flex-wrap -mx-2 mb-6">
            <div class="w-full md:w-1/2 px-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="imms_convenio_rembolso_subsidios">
                    Convenio Rembolso Subsidios IMSS (Opcional)
                </label>
                <input wire:model.defer="registro.imms_convenio_rembolso_subsidios" type="text"
                    class="appearance-none block w-full bg-gray-200 border rounded py-3 px-4 mb-3"
                    placeholder="Ingrese el convenio rembolso subsidios del IMSS">
                <x-input-error for="registro.imms_convenio_rembolso_subsidios" />
            </div>
            <div class="w-full md:w-1/2 px-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="imms_tipo_contribucion">
                    Tipo de Contribución IMSS
                </label>
                <input wire:model.defer="registro.imms_tipo_contribucion" type="text"
                    class="appearance-none block w-full bg-gray-200 border rounded py-3 px-4 mb-3"
                    placeholder="Ingrese el tipo de contribución del IMSS">
                <x-input-error for="registro.imms_tipo_contribucion" />
            </div>
        </div>

        <!-- Novena fila -->
        <div class="flex flex-wrap -mx-2 mb-6">
            <div class="w-full md:w-1/2 px-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="area_geografica">
                    Área Geográfica IMSS
                </label>
                <input wire:model.defer="registro.area_geografica" type="text"
                    class="appearance-none block w-full bg-gray-200 border rounded py-3 px-4 mb-3"
                    placeholder="Ingrese el área geográfica del IMSS">
                <x-input-error for="registro.area_geografica" />
            </div>
            <div class="w-full md:w-1/2 px-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="delegacion_imms">
                    Delegación IMSS
                </label>
                <input wire:model.defer="registro.delegacion_imms" type="text"
                    class="appearance-none block w-full bg-gray-200 border rounded py-3 px-4 mb-3"
                    placeholder="Ingrese la delegación del IMSS">
                <x-input-error for="registro.delegacion_imms" />
            </div>
        </div>

        <!-- Décima fila -->
        <div class="flex flex-wrap -mx-2 mb-6">
            <div class="w-full md:w-1/2 px-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="subdelegacion_imms">
                    Subdelegación IMSS
                </label>
                <input wire:model.defer="registro.subdelegacion_imms" type="text"
                    class="appearance-none block w-full bg-gray-200 border rounded py-3 px-4 mb-3"
                    placeholder="Ingrese la subdelegación del IMSS">
                <x-input-error for="registro.subdelegacion_imms" />
            </div>
            <div class="w-full md:w-1/2 px-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="prima_año">
                    Año de Prima
                </label>
                <input wire:model.defer="registro.prima_año" type="text"
                    class="appearance-none block w-full bg-gray-200 border rounded py-3 px-4 mb-3"
                    placeholder="Ingrese el año de prima">
                <x-input-error for="registro.prima_año" />
            </div>
        </div>

        <!-- Undécima fila -->
        <div class="flex flex-wrap -mx-2 mb-6">
            <div class="w-full md:w-1/2 px-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="prima_mes">
                    Mes de Prima
                </label>
                <input wire:model.defer="registro.prima_mes" type="text"
                    class="appearance-none block w-full bg-gray-200 border rounded py-3 px-4 mb-3"
                    placeholder="Ingrese el mes de prima">
                <x-input-error for="registro.prima_mes" />
            </div>
            <div class="w-full md:w-1/2 px-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="porcentaje_prima_rt">
                    Porcentaje Prima RT
                </label>
                <input wire:model.defer="registro.porcentaje_prima_rt" type="text"
                    class="appearance-none block w-full bg-gray-200 border rounded py-3 px-4 mb-3"
                    placeholder="Ingrese el porcentaje de prima RT">
                <x-input-error for="registro.porcentaje_prima_rt" />
            </div>
        </div>

        <!-- Duodécima fila -->
        <div class="flex flex-wrap -mx-2 mb-6">
            <div class="w-full md:w-1/2 px-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="clase_riesgo_trabajo">
                    Clase Riesgo Trabajo
                </label>
                <input wire:model.defer="registro.clase_riesgo_trabajo" type="text"
                    class="appearance-none block w-full bg-gray-200 border rounded py-3 px-4 mb-3"
                    placeholder="Ingrese la clase de riesgo de trabajo">
                <x-input-error for="registro.clase_riesgo_trabajo" />
            </div>
            <div class="w-full md:w-1/2 px-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="acreditacion_stps">
                    Acreditación STPS
                </label>
                <input wire:model.defer="registro.acreditacion_stps" type="text"
                    class="appearance-none block w-full bg-gray-200 border rounded py-3 px-4 mb-3"
                    placeholder="Ingrese la acreditación STPS">
                <x-input-error for="registro.acreditacion_stps" />
            </div>
        </div>

        <div class="flex flex-wrap -mx-2 mb-6">
            <div class="w-full md:w-1/2 px-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="representante_legal">
                    Representante Legal
                </label>
                <input wire:model.defer="registro.representante_legal" type="text"
                    class="appearance-none block w-full bg-gray-200 border rounded py-3 px-4 mb-3"
                    placeholder="Ingrese el representante legal">
                <x-input-error for="registro.representante_legal" />
            </div>
            <div class="w-full md:w-1/2 px-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="puesto_representante">
                    Puesto Representante
                </label>
                <input wire:model.defer="registro.puesto_representante" type="text"
                    class="appearance-none block w-full bg-gray-200 border rounded py-3 px-4 mb-3"
                    placeholder="Ingrese el puesto del representante">
                <x-input-error for="registro.puesto_representante" />
            </div>
        </div>

        <div class="flex flex-wrap -mx-2 mb-6">
            <div class="w-full md:w-1/2 px-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="cuenta_contable">
                    Cuenta Contable
                </label>
                <input wire:model.defer="registro.cuenta_contable" type="text"
                    class="appearance-none block w-full bg-gray-200 border rounded py-3 px-4 mb-3"
                    placeholder="Ingrese la cuenta contable">
                <x-input-error for="registro.cuenta_contable" />
            </div>
            
        </div>
        

        <!-- Botón -->
        <div class="flex items-center justify-center">
            <button wire:click="saveRegistro()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Agregar Registro
            </button>
        </div>
    </div>
</div>
