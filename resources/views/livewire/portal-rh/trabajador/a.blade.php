<section class="py-10 my-auto dark:bg-white">
    <div class="lg:w-[80%] md:w-[90%] w-[96%] mx-auto flex gap-4">
        <div
            class="lg:w-[88%] sm:w-[88%] w-full mx-auto shadow-2xl p-4 rounded-xl h-fit self-center dark:bg-gray-800">
            
            <div class="">
                <h1 class="lg:text-3xl md:text-2xl text-xl font-extrabold mb-2 dark:text-white">
                    Perfil
                </h1>

                <form>
                    <!-- Cover Image -->
                    <div class="w-full h-52 rounded-sm bg-cover bg-center bg-no-repeat items-center"
                        style="background-image: url('{{ asset('img/cesrh.jpeg') }}');">

                        <!-- Contenedor del perfil con círculo de fondo -->
                        <div class="relative mx-auto flex justify-center pt-32">
                            <!-- Círculo de fondo detrás de la imagen -->
                            <div class="absolute w-[150px] h-[150px] rounded-full dark:bg-gray-800"></div>

                            <!-- Profile Image -->
                            <div class="relative w-[141px] h-[141px] bg-blue-300/20 rounded-full bg-cover bg-center bg-no-repeat flex items-center justify-center"
                                style="background-image: url('{{ asset('img/user.png') }}');">
                            </div>
                        </div>
                    </div>

                    <!-- AUMENTAMOS EL MARGEN ABAJO DEL AVATAR -->
                    <h2 class="text-center mt-16 font-semibold dark:text-gray-300">
                        {{ $usuario->name ?? 'Sin Nombre' }}
                    </h2>

                    <div class="flex flex-col lg:flex-row gap-2 justify-center w-full mt-6">
                        <div class="w-full mb-4">
                            <label for="" class="mb-2 dark:text-gray-300">Nombre</label>
                            <input type="text" value="{{ $usuario->name ?? 'Sin Nombre' }}" readonly
                                class="mt-2 p-4 w-full border-2 rounded-lg dark:text-gray-200 dark:border-blue-600 dark:bg-gray-800">
                        </div>
                        
                        <div class="w-full mb-4">
                            <label for="" class="dark:text-gray-300">Clave Trabajador</label>
                            <input type="text" value="{{ $trabajador->clave_trabajador }}" readonly
                                class="mt-2 p-4 w-full border-2 rounded-lg dark:text-gray-200 dark:border-blue-600 dark:bg-gray-800">
                        </div>
                    </div>

                    <div class="flex flex-col lg:flex-row gap-2 justify-center w-full">
                        <div class="w-full">
                            <h3 class="dark:text-gray-300 mb-2">Fecha de Nacimiento</h3>
                            <input type="date" value="{{ $trabajador->fecha_nacimiento }}" readonly
                                class="text-grey p-4 w-full border-2 rounded-lg dark:text-gray-200 dark:border-blue-600 dark:bg-gray-800">
                        </div>

                        <div class="w-full mb-4">
                            <label for="" class="dark:text-gray-300">Sucursal</label>
                            <input type="text" value="{{ $sucursal->nombre_sucursal ?? 'Sin Sucursal' }}" readonly
                                class="mt-2 p-4 w-full border-2 rounded-lg dark:text-gray-200 dark:border-blue-600 dark:bg-gray-800">
                        </div>
                        
                    </div>

                    <div class="flex flex-col lg:flex-row gap-2 justify-center w-full">
                        <div class="w-full mb-4">
                            <label for="" class="dark:text-gray-300">Departamento</label>
                            <input type="text" value="{{ $departamento->nombre_departamento ?? 'Sin Departamento' }}" readonly
                                class="mt-2 p-4 w-full border-2 rounded-lg dark:text-gray-200 dark:border-blue-600 dark:bg-gray-800">
                        </div>
                    </div>

                    <div class='flex items-center justify-center md:gap-8 gap-4 pt-5 pb-5'>
                        <button type="button" onclick="window.history.back()"
                            class='w-auto bg-blue-500 hover:bg-blue-700 rounded-lg shadow-xl font-medium text-white px-4 py-2'>
                            Volver
                        </button>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
</section>
