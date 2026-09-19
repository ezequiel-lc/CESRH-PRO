<div class="fixed left-0 top-0 w-64 h-full bg-[#f8f4f3] p-4 z-50 sidebar-menu transition-transform">
    <a href="#" class="flex flex-col items-center pb-4">
        <img src="/ModuloActivo/recursos/logoaf.png"
            alt="Inventario" class="w-49 h-50 object-scale-down p-2">
    </a>
    <div class="w-full h-1 bg-gradient-to-r from-[#1763A6] to-[#1EA4D9]"></div>
    
    <ul class="mt-4">
        <span class="text-gray-400 font-bold">INICIO</span>
        <li class="mb-1 group">
            <a href="{{route('inicio-activo')}}" class="flex font-semibold items-center py-2 px-4 text-gray-900 hover:bg-gray-950 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100">
                <i class="ri-home-2-line mr-3 text-lg"></i>
                <span class="text-sm">Dashboard</span>
            </a>
        </li>
        <li class="mb-1 group">
            @can('Tipo activo')
            <a href="{{route('mostrartipoactivo')}}" class="flex font-semibold items-center py-2 px-4 text-gray-900 hover:bg-gray-950 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100">
                <i class='fas fa-boxes mr-3 text-lg'></i>
                <span class="text-sm">Inventario</span>
            </a>
            @endcan
        </li>
        <span class="text-gray-400 font-bold">ACTIVOS</span>
        <li class="mb-1 group">
            <a href="" class="flex font-semibold items-center py-2 px-4 text-gray-900 hover:bg-gray-950 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100 sidebar-dropdown-toggle">
                <i class='fab fa-creative-commons-share mr-3 text-lg' ></i>
                <span class="text-sm">Activo Tecnologia</span>
                <i class="ri-arrow-right-s-line ml-auto group-[.selected]:rotate-90"></i>
            </a>
            <ul class="pl-7 mt-2 hidden group-[.selected]:block">
                @can('Activo tecnologia Admin')
                <li class="mb-4">
                    <a href="{{route('mostrartecad')}}" class="text-gray-900 text-sm flex items-center hover:text-[#f84525] before:contents-[''] before:w-1 before:h-1 before:rounded-full before:bg-gray-300 before:mr-3">Administrador</a>
                </li>
                @endcan
                @can('Activo tecnologia Admin')
                <li class="mb-4">
                    <a href="{{route('mostrarasignaad')}}" class="text-gray-900 text-sm flex items-center hover:text-[#f84525] before:contents-[''] before:w-1 before:h-1 before:rounded-full before:bg-gray-300 before:mr-3">Asignaciones</a>
                </li>
                @endcan
                @can('Activo tecnologia Empresa')
                <li class="mb-4">
                    <a href="{{route('mostrartec')}}" class="text-gray-900 text-sm flex items-center hover:text-[#f84525] before:contents-[''] before:w-1 before:h-1 before:rounded-full before:bg-gray-300 before:mr-3">Empresa</a>
                </li>
                @endcan
                @can('Activo tecnologia Empresa')
                <li class="mb-4">
                    <a href="{{route('mostrarasigntecem')}}" class="text-gray-900 text-sm flex items-center hover:text-[#f84525] before:contents-[''] before:w-1 before:h-1 before:rounded-full before:bg-gray-300 before:mr-3">Asignaciones</a>
                </li>
                @endcan 
                @can('Activo tecnologia Sucursal')
                <li class="mb-4">
                    <a href="{{route('mostraracttec')}}" class="text-gray-900 text-sm flex items-center hover:text-[#f84525] before:contents-[''] before:w-1 before:h-1 before:rounded-full before:bg-gray-300 before:mr-3">Sucursal</a>
                </li>
                @endcan
                @can('Activo tecnologia Sucursal')
                <li class="mb-4">
                    <a href="{{route('mostrarasigntecsu')}}" class="text-gray-900 text-sm flex items-center hover:text-[#f84525] before:contents-[''] before:w-1 before:h-1 before:rounded-full before:bg-gray-300 before:mr-3">Asignaciones</a>
                </li>
                @endcan
            </ul>
        </li>
        <li class="mb-1 group">
            <a href="" class="flex font-semibold items-center py-2 px-4 text-gray-900 hover:bg-gray-950 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100 sidebar-dropdown-toggle">
                <i class='fab fa-creative-commons-share mr-3 text-lg' ></i>
                <span class="text-sm">Activo Mobiliario</span>
                <i class="ri-arrow-right-s-line ml-auto group-[.selected]:rotate-90"></i>
            </a>
            <ul class="pl-7 mt-2 hidden group-[.selected]:block">
                @can('Activo mobiliario Admin')
                <li class="mb-4">
                    <a href="{{route('mostrarmobad')}}" class="text-gray-900 text-sm flex items-center hover:text-[#f84525] before:contents-[''] before:w-1 before:h-1 before:rounded-full before:bg-gray-300 before:mr-3">Administrador</a>
                </li>
                @endcan
                @can('Activo mobiliario Admin')
                <li class="mb-4">
                    <a href="{{route('mostrarasignmobad')}}" class="text-gray-900 text-sm flex items-center hover:text-[#f84525] before:contents-[''] before:w-1 before:h-1 before:rounded-full before:bg-gray-300 before:mr-3">Asignaciones</a>
                </li>
                @endcan
                @can('Activo mobiliario Empresa')
                <li class="mb-4">
                    <a href="{{route('mostrarmob')}}" class="text-gray-900 text-sm flex items-center hover:text-[#f84525] before:contents-[''] before:w-1 before:h-1 before:rounded-full before:bg-gray-300 before:mr-3">Empresa</a>
                </li>
                @endcan
                @can('Activo mobiliario Empresa')
                <li class="mb-4">
                    <a href="{{route('mostrarasignmobem')}}" class="text-gray-900 text-sm flex items-center hover:text-[#f84525] before:contents-[''] before:w-1 before:h-1 before:rounded-full before:bg-gray-300 before:mr-3">Asignaciones</a>
                </li>
                @endcan
                @can('Activo mobiliario Sucursal')
                <li class="mb-4">
                    <a href="{{route('mostraractmob')}}" class="text-gray-900 text-sm flex items-center hover:text-[#f84525] before:contents-[''] before:w-1 before:h-1 before:rounded-full before:bg-gray-300 before:mr-3">Sucursal</a>
                </li>
                @endcan
            </ul>
        </li>
        <li class="mb-1 group">
            <a href="" class="flex font-semibold items-center py-2 px-4 text-gray-900 hover:bg-gray-950 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100 sidebar-dropdown-toggle">
                <i class='fab fa-creative-commons-share mr-3 text-lg' ></i>
                <span class="text-sm">Activo Oficina</span>
                <i class="ri-arrow-right-s-line ml-auto group-[.selected]:rotate-90"></i>
            </a>
            <ul class="pl-7 mt-2 hidden group-[.selected]:block">
                @can('Activo oficina Admin')
                <li class="mb-4">
                    <a href="{{route('mostrarofiad')}}" class="text-gray-900 text-sm flex items-center hover:text-[#f84525] before:contents-[''] before:w-1 before:h-1 before:rounded-full before:bg-gray-300 before:mr-3">Administrador</a>
                </li>
                @endcan
                @can('Activo oficina Admin')
                <li class="mb-4">
                    <a href="{{route('mostrarasignofiad')}}" class="text-gray-900 text-sm flex items-center hover:text-[#f84525] before:contents-[''] before:w-1 before:h-1 before:rounded-full before:bg-gray-300 before:mr-3">Asignaciones</a>
                </li>
                @endcan
                @can('Activo oficina Empresa')
                <li class="mb-4">
                    <a href="{{route('mostrarofi')}}" class="text-gray-900 text-sm flex items-center hover:text-[#f84525] before:contents-[''] before:w-1 before:h-1 before:rounded-full before:bg-gray-300 before:mr-3">Empresa</a>
                </li>
                @endcan
                @can('Activo oficina Empresa')
                <li class="mb-4">
                    <a href="{{route('mostrarasignofiem')}}" class="text-gray-900 text-sm flex items-center hover:text-[#f84525] before:contents-[''] before:w-1 before:h-1 before:rounded-full before:bg-gray-300 before:mr-3">Asignaciones</a>
                </li>
                @endcan
                @can('Activo oficina Sucursal')
                <li class="mb-4">
                    <a href="{{route('mostraractofi')}}" class="text-gray-900 text-sm flex items-center hover:text-[#f84525] before:contents-[''] before:w-1 before:h-1 before:rounded-full before:bg-gray-300 before:mr-3">Sucursal</a>
                </li>
                @endcan
            </ul>
        </li>
        <li class="mb-1 group">
            <a href="" class="flex font-semibold items-center py-2 px-4 text-gray-900 hover:bg-gray-950 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100 sidebar-dropdown-toggle">
                <i class='fab fa-creative-commons-share mr-3 text-lg' ></i>
                <span class="text-sm">Activo Uniforme</span>
                <i class="ri-arrow-right-s-line ml-auto group-[.selected]:rotate-90"></i>
            </a>
            <ul class="pl-7 mt-2 hidden group-[.selected]:block">
                @can('Activo uniforme Admin')
                <li class="mb-4">
                    <a href="{{route('mostraruniad')}}" class="text-gray-900 text-sm flex items-center hover:text-[#f84525] before:contents-[''] before:w-1 before:h-1 before:rounded-full before:bg-gray-300 before:mr-3">Administrador</a>
                </li>
                @endcan
                @can('Activo uniforme Admin')
                <li class="mb-4">
                    <a href="{{route('mostrarasignuniad')}}" class="text-gray-900 text-sm flex items-center hover:text-[#f84525] before:contents-[''] before:w-1 before:h-1 before:rounded-full before:bg-gray-300 before:mr-3">Asignaciones</a>
                </li>
                @endcan
                @can('Activo uniforme Empresa')
                <li class="mb-4">
                    <a href="{{route('mostraruni')}}" class="text-gray-900 text-sm flex items-center hover:text-[#f84525] before:contents-[''] before:w-1 before:h-1 before:rounded-full before:bg-gray-300 before:mr-3">Empresa</a>
                </li>
                @endcan
                @can('Activo uniforme Empresa')
                <li class="mb-4">
                    <a href="{{route('mostrarasignuniem')}}" class="text-gray-900 text-sm flex items-center hover:text-[#f84525] before:contents-[''] before:w-1 before:h-1 before:rounded-full before:bg-gray-300 before:mr-3">Asignaciones</a>
                </li>
                @endcan
                @can('Activo uniforme Sucursal')
                <li class="mb-4">
                    <a href="{{route('mostraractuni')}}" class="text-gray-900 text-sm flex items-center hover:text-[#f84525] before:contents-[''] before:w-1 before:h-1 before:rounded-full before:bg-gray-300 before:mr-3">Sucursal</a>
                </li>
                @endcan
            </ul>
        </li>
        <li class="mb-1 group">
            <a href="" class="flex font-semibold items-center py-2 px-4 text-gray-900 hover:bg-gray-950 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100 sidebar-dropdown-toggle">
                <i class='fab fa-creative-commons-share mr-3 text-lg' ></i>
                <span class="text-sm">Activo Papeleria</span>
                <i class="ri-arrow-right-s-line ml-auto group-[.selected]:rotate-90"></i>
            </a>
            <ul class="pl-7 mt-2 hidden group-[.selected]:block">
                @can('Activo papeleria Admin')
                <li class="mb-4">
                    <a href="{{route('mostrarpapead')}}" class="text-gray-900 text-sm flex items-center hover:text-[#f84525] before:contents-[''] before:w-1 before:h-1 before:rounded-full before:bg-gray-300 before:mr-3">Administrador</a>
                </li>
                @endcan
                @can('Activo papeleria Admin')
                <li class="mb-4">
                    <a href="{{route('mostrarasignpapead')}}" class="text-gray-900 text-sm flex items-center hover:text-[#f84525] before:contents-[''] before:w-1 before:h-1 before:rounded-full before:bg-gray-300 before:mr-3">Asignaciones</a>
                </li>
                @endcan
                @can('Activo papeleria Empresa')
                <li class="mb-4">
                    <a href="{{route('mostrarpape')}}" class="text-gray-900 text-sm flex items-center hover:text-[#f84525] before:contents-[''] before:w-1 before:h-1 before:rounded-full before:bg-gray-300 before:mr-3">Empresa</a>
                </li>
                @endcan
                @can('Activo papeleria Empresa')
                <li class="mb-4">
                    <a href="{{route('mostrarasignpapeem')}}" class="text-gray-900 text-sm flex items-center hover:text-[#f84525] before:contents-[''] before:w-1 before:h-1 before:rounded-full before:bg-gray-300 before:mr-3">Asignaciones</a>
                </li>
                @endcan
                @can('Activo papeleria Sucursal')
                <li class="mb-4">
                    <a href="{{route('mostraractpape')}}" class="text-gray-900 text-sm flex items-center hover:text-[#f84525] before:contents-[''] before:w-1 before:h-1 before:rounded-full before:bg-gray-300 before:mr-3">Sucursal</a>
                </li>
                @endcan
            </ul>
        </li>
        <li class="mb-1 group">
            <a href="" class="flex font-semibold items-center py-2 px-4 text-gray-900 hover:bg-gray-950 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100 sidebar-dropdown-toggle">
                <i class='fab fa-creative-commons-share mr-3 text-lg' ></i>
                <span class="text-sm">Activo Souvenir</span>
                <i class="ri-arrow-right-s-line ml-auto group-[.selected]:rotate-90"></i>
            </a>
            <ul class="pl-7 mt-2 hidden group-[.selected]:block">
                @can('Activo souvenir Admin')
                <li class="mb-4">
                    <a href="{{route('mostrarsouad')}}" class="text-gray-900 text-sm flex items-center hover:text-[#f84525] before:contents-[''] before:w-1 before:h-1 before:rounded-full before:bg-gray-300 before:mr-3">Administrador</a>
                </li>
                @endcan
                @can('Activo souvenir Admin')
                <li class="mb-4">
                    <a href="{{route('mostrarasignsouad')}}" class="text-gray-900 text-sm flex items-center hover:text-[#f84525] before:contents-[''] before:w-1 before:h-1 before:rounded-full before:bg-gray-300 before:mr-3">Asignaciones</a>
                </li>
                @endcan
                @can('Activo souvenir Empresa')
                <li class="mb-4">
                    <a href="{{route('mostrarsou')}}" class="text-gray-900 text-sm flex items-center hover:text-[#f84525] before:contents-[''] before:w-1 before:h-1 before:rounded-full before:bg-gray-300 before:mr-3">Empresa</a>
                </li>
                @endcan
                @can('Activo souvenir Empresa')
                <li class="mb-4">
                    <a href="{{route('mostrarasignsouem')}}" class="text-gray-900 text-sm flex items-center hover:text-[#f84525] before:contents-[''] before:w-1 before:h-1 before:rounded-full before:bg-gray-300 before:mr-3">Asignaciones</a>
                </li>
                @endcan
                @can('Activo souvenir Sucursal')
                <li class="mb-4">
                    <a href="{{route('mostraractsou')}}" class="text-gray-900 text-sm flex items-center hover:text-[#f84525] before:contents-[''] before:w-1 before:h-1 before:rounded-full before:bg-gray-300 before:mr-3">Sucursal</a>
                </li>
                @endcan
            </ul>
        </li>
        {{-- <li class="mb-1 group">
            <a href="" class="flex font-semibold items-center py-2 px-4 text-gray-900 hover:bg-gray-950 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100">
                <i class='bx bx-archive mr-3 text-lg'></i>
                <span class="text-sm">Archive</span>
            </a>
        </li> --}}
        {{-- <span class="text-gray-400 font-bold">PERSONAL</span>
        <li class="mb-1 group">
            <a href="" class="flex font-semibold items-center py-2 px-4 text-gray-900 hover:bg-gray-950 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100">
                <i class='bx bx-bell mr-3 text-lg' ></i>
                <span class="text-sm">Notificaciones</span>
                <span class=" md:block px-2 py-0.5 ml-auto text-xs font-medium tracking-wide text-red-600 bg-red-200 rounded-full">5</span>
            </a>
        </li>
        <li class="mb-1 group">
            <a href="" class="flex font-semibold items-center py-2 px-4 text-gray-900 hover:bg-gray-950 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100">
                <i class='bx bx-envelope mr-3 text-lg' ></i>
                <span class="text-sm">Mensajes</span>
                <span class=" md:block px-2 py-0.5 ml-auto text-xs font-medium tracking-wide text-green-600 bg-green-200 rounded-full">2 New</span>
            </a>
        </li> --}}
    </ul>
</div>
<div class="fixed top-0 left-0 w-full h-full bg-black/50 z-40 md:hidden sidebar-overlay"></div>