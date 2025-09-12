<nav class="h-full flex flex-col py-6 space-y-2">
    <ul class="flex-1 space-y-2">

        <div class="flex m-3 items-center justify-center">
            <img src="{{ asset('assets/images/logo-icon.svg') }}" alt="" class="h-12 ">

        </div>

        <!-- Dashboard -->
        <li>
            <a href="{{ route('dashboard') }}" class="flex items-center px-4 py-2 rounded hover:bg-gray-200 {{ request()->routeIs('dashboard') ? 'bg-gray-200 font-bold' : '' }}">
                <span class="text-lg">📊</span>
                <span class="ml-3 hidden group-hover:inline">Dashboard</span>
            </a>
        </li>

        <!-- Cadastros -->
        <li x-data="{ open: false }">
            <button @click="open = !open"
                class="w-full flex items-center justify-between px-4 py-2 rounded hover:bg-gray-200">
                <div class="flex items-center">
                    <span class="text-lg">🗂</span>
                    <span class="ml-3 hidden group-hover:inline">Cadastros</span>
                </div>
                <span class="hidden group-hover:inline" x-text="open ? '▾' : '▸'"></span>
            </button>
            <ul x-show="open" class="ml-10 mt-1 space-y-1 hidden group-hover:block" x-cloak>
                <li><a href="{{ route('harvests.index') }}" class="block px-2 py-1 rounded hover:bg-gray-100 {{ request()->routeIs('harvests.index') ? 'bg-gray-200 font-bold' : '' }}"><span class="text-lg mr-3">🗓️</span>Safra</a></li>
                <li><a href="{{ route('ports.index') }}" class="block px-2 py-1 rounded hover:bg-gray-100 {{ request()->routeIs('ports.index') ? 'bg-gray-200 font-bold' : '' }}"><span class="text-lg mr-3">🏗️</span>Terminal portuário</a></li>
                <li><a href="{{ route('users.index') }}" class="block px-2 py-1 rounded hover:bg-gray-100 {{ request()->routeIs('users.index') ? 'bg-gray-200 font-bold' : '' }}"><span class="text-lg mr-3">👥</span>Usuários</a></li>
                
            </ul>
        </li>

        <!-- Processos -->
        <li x-data="{ open: false }">
            <button @click="open = !open"
                class="w-full flex items-center justify-between px-4 py-2 rounded hover:bg-gray-200">
                <div class="flex items-center">
                    <span class="text-lg">⚙️</span>
                    <span class="ml-3 hidden group-hover:inline">Processos</span>
                </div>
                <span class="hidden group-hover:inline" x-text="open ? '▾' : '▸'"></span>
            </button>
            <ul x-show="open" class="ml-10 mt-1 space-y-1 hidden group-hover:block" x-cloak>
                <li><a href="{{ route('dockings.index') }}" class="block px-2 py-1 rounded hover:bg-gray-100 {{ request()->routeIs('dockings.index') ? 'bg-gray-200 font-bold' : '' }}"><span class="text-lg mr-3">🚉</span>Encoste ferro</a></li>
                <li><a href="{{-- route('ports.index') --}}" class="block px-2 py-1 rounded hover:bg-gray-100 {{-- request()->routeIs('ports.index') ? 'bg-gray-200 font-bold' : '' --}}"><span class="text-lg mr-3">🛑</span>Paradas</a></li>
                
            </ul>
        </li>

        <!-- Relatórios -->
        <li>
            <a href="#" class="flex items-center px-4 py-2 rounded hover:bg-gray-200">
                <span class="text-lg">📑</span>
                <span class="ml-3 hidden group-hover:inline">Relatórios</span>
            </a>
        </li>
        <div class="border-t pt-4">

        </div>

        <!-- Configurações -->
        <li>
            <a href="{{ route('profile.edit') }}" class="flex items-center px-4 py-2 rounded hover:bg-gray-200">
                <span class="text-lg">🔧</span>
                <span class="ml-3 hidden group-hover:inline">Conta</span>
            </a>
        </li>

        <!-- Ajuda -->
        <li>
            <a href="#" class="flex items-center px-4 py-2 rounded hover:bg-gray-200">
                <span class="text-lg">❓</span>
                <span class="ml-3 hidden group-hover:inline">Ajuda</span>
            </a>
        </li>
    </ul>

    <!-- Logout -->
    <div class="border-t pt-4">
        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();" class="flex items-center px-4 py-2 rounded hover:bg-gray-200 text-red-500">
                <span class="text-lg mr-3">♨️</span>
                <span class="ml-3 hidden group-hover:inline">{{ __('Log Out') }}</span>
            </x-dropdown-link>
        </form>
    </div>
</nav>
