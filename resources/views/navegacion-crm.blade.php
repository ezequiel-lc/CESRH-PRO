<!--sidenav -->
<div class="fixed block left-0 top-0 w-64 h-full bg-[#f8f4f3] p-4 z-50 sidebar-menu transition-transform">
    <a href="{{ url('crm/crm-inicio') }}" class="flex items-center pb-4 border-b border-b-gray-800">
        <h2 class="text-2xl font-bold">CRM</h2>
    </a>
    <ul class="mt-4">
        <span class="font-bold text-gray-400">ADMIN</span>
        <li class="mb-1 group">
            <a href="{{ 'dashboard' }}"
                class="flex font-semibold items-center py-2 px-4 text-gray-900 hover:bg-gray-950 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100">
                <i class="mr-3 text-lg ri-home-2-line"></i>
                <span class="text-sm">Dashboard</span>
            </a>
        </li>
        <li class="mb-1 group">
            <a href="{{ 'Createcrm' }}"
                class="flex font-semibold items-center py-2 px-4 text-gray-900 hover:bg-gray-950 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100">
                <i class='mr-3 text-lg bx bx-list-ul'></i>
                <span class="text-sm">Empresas</span>
            </a>
        </li>
        <details class="group">
            <summary
                class="flex font-semibold items-center py-2 px-4 text-gray-900 hover:bg-gray-950 hover:text-gray-100 rounded-md cursor-pointer">
                <i class='mr-3 text-lg bx bxl-blogger'></i>
                <span class="text-sm">Levantamiento de pedidos</span>
                <i class="fas fa-caret-right text-2xl transition-transform duration-300 group-open:rotate-90"></i>
            </summary>
            <div class="pl-9 mt-2 space-y-3">
                <a href="{{ 'crm-leads' }}" class="flex items-center text-gray-600 hover:text-black group">
                    <span class="w-2 h-2 bg-gray-400 rounded-full mr-3 transition-colors group-hover:bg-black"></span>
                    <span class="text-sm">Leads</span>
                </a>
                <a href="#" class="flex items-center text-gray-600 hover:text-black group">
                    <span class="w-2 h-2 bg-gray-400 rounded-full mr-3 transition-colors group-hover:bg-black"></span>
                    <span class="text-sm">Clientes</span>
                </a>
            </div>
        </details>
        {{-- <li class="mb-1 group">
            <a href=""
                class="flex font-semibold items-center py-2 px-4 text-gray-900 hover:bg-gray-950 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100">
                <i class='mr-3 text-lg bx bx-archive'></i>
                <span class="text-sm">Empresas</span>
            </a>
        </li> --}}
        <li class="mb-1">
            <input type="checkbox" id="datosFiscales" class="peer hidden">
            <label for="datosFiscales"
                class="flex font-semibold items-center py-2 px-4 text-gray-900 hover:bg-gray-950 hover:text-gray-100 rounded-md cursor-pointer">
                <i class='mr-3 text-lg bx bx-user'></i>
                <span class="text-sm">Datos Fiscales</span>
            </label>
            <ul class="pl-7 mt-2 hidden peer-checked:block">
                <li class="mb-4">
                    <a href="{{ route('mostrarDatosFiscales') }}" Mostrar datos fiscales </a>
                </li>
                <li class="mb-4">
                    <a href="{{ route('registra_datos_fiscales') }}"
                        class="text-gray-900 text-sm flex items-center hover:text-[#f84525] before:block before:w-1 before:h-1 before:rounded-full before:bg-gray-300 before:mr-3">
                        Registrar datos fiscales
                    </a>
                </li>
            </ul>
        </li>

        {{-- <span class="font-bold text-gray-400">PERSONAL</span>
        <li class="mb-1 group">
            <a href=""
                class="flex font-semibold items-center py-2 px-4 text-gray-900 hover:bg-gray-950 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100">
                <i class='mr-3 text-lg bx bx-bell'></i>
                <span class="text-sm">Notifications</span>
                <span
                    class=" md:block px-2 py-0.5 ml-auto text-xs font-medium tracking-wide text-red-600 bg-red-200 rounded-full">5</span>
            </a>
        </li>
        <li class="mb-1 group">
            <a href=""
                class="flex font-semibold items-center py-2 px-4 text-gray-900 hover:bg-gray-950 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100">
                <i class='mr-3 text-lg bx bx-envelope'></i>
                <span class="text-sm">Messages</span>
                <span
                    class=" md:block px-2 py-0.5 ml-auto text-xs font-medium tracking-wide text-green-600 bg-green-200 rounded-full">2
                    New</span>
            </a>
        </li> --}}
    </ul>
</div>
