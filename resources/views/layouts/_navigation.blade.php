<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <img src="{{asset('assets/images/logo.svg')}}" alt="" class="w-32 m-3">
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Painel') }}
                    </x-nav-link>
                </div>
                @cannot('access-new-menu')
                    <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                        <x-nav-link :href="route('dockings.index')" :active="request()->routeIs('dockings.*')">
                            {{ __('Encostes') }}
                        </x-nav-link>
                    </div>
                @endcannot
                
                {{-- @can('access-admin-menu')
                    
                    <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                        <x-nav-link :href="route('harvests.index')" :active="request()->routeIs('harvests.*')">
                            {{ __('Safras') }}
                        </x-nav-link>
                    </div>
                    
                    <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                        <x-nav-link :href="route('ports.index')" :active="request()->routeIs('ports.*')">
                            {{ __('Terminais Portuário') }}
                        </x-nav-link>
                    </div>
                    
                    <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                        <x-nav-link :href="route('users.index')" :active="request()->routeIs('users.*')">
                            {{ __('Usuários') }}
                            @if ($usersPendingCount > 0) <span class="text-xs bg-red-600 text-white rounded-full px-2 py-0.5">{{ $usersPendingCount }}</span> @endif
                        </x-nav-link>
                    </div>
                @endcan --}}

                @can('access-admin-menu')
                <div class="hidden sm:flex sm:items-center sm:ms-10">
                    <x-dropdown align="left" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 
                                        font-medium rounded-md text-gray-700 bg-white hover:text-gray-900 
                                        focus:outline-none transition ease-in-out duration-150">
                                Cadastros
                                @if ($usersPendingCount > 0) 
                                    <span class="ml-2 text-xs bg-amber-600 text-white rounded-full px-2 py-0.5">
                                        {{ $usersPendingCount }}
                                    </span> 
                                @endif
                                <svg class="ms-1 -me-1 h-4 w-4" xmlns="http://www.w3.org/2000/svg" 
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('harvests.index')" :active="request()->routeIs('harvests.*')">
                                {{ __('Safras') }}
                            </x-dropdown-link>

                            <x-dropdown-link :href="route('ports.index')" :active="request()->routeIs('ports.*')">
                                {{ __('Terminais Portuário') }}
                            </x-dropdown-link>

                            <x-dropdown-link :href="route('users.index')" :active="request()->routeIs('users.*')">
                                {{ __('Usuários') }}
                                @if ($usersPendingCount > 0) 
                                    <span class="ml-2 text-xs bg-red-600 text-white rounded-full px-2 py-0.5">
                                        {{ $usersPendingCount }}
                                    </span> 
                                @endif
                            </x-dropdown-link>
                        </x-slot>
                    </x-dropdown>
                </div>

                <div class="hidden sm:flex sm:items-center sm:ms-10">
                    <x-dropdown align="left" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 
                                        font-medium rounded-md text-gray-700 bg-white hover:text-gray-900 
                                        focus:outline-none transition ease-in-out duration-150">
                                Histórico
                                <svg class="ms-1 -me-1 h-4 w-4" xmlns="http://www.w3.org/2000/svg" 
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('harvests.index')" :active="request()->routeIs('harvests.*')">
                                {{ __('Volumes') }}
                            </x-dropdown-link>
                        </x-slot>
                    </x-dropdown>
                </div>
            @endcan

            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->firstname }}</div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <p class="text-sm text-gray-500 m-3">{{ Auth::user()->email }}</p>
                        <p class="text-sm text-indigo-500 font-semibold m-3">{{ Auth::user()->role }}</p>
                        <hr>
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();" class="text-red-600">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Painel') }}
            </x-responsive-nav-link>
            @cannot('access-new-menu')
                <x-responsive-nav-link :href="route('dockings.index')" :active="request()->routeIs('dockings.*')">
                    {{ __('Encostes ferroviário') }}
                </x-responsive-nav-link>
            @endcannot
            
            @can('access-admin-menu')
                <x-responsive-nav-link :href="route('harvests.index')" :active="request()->routeIs('harvests.*')">
                    {{ __('Safras') }}
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('ports.index')" :active="request()->routeIs('ports.*')">
                    {{ __('Terminais portuário') }}
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('users.index')" :active="request()->routeIs('users.*')">
                    {{ __('Usuários') }}
                    @if ($usersPendingCount > 0) <span class="text-xs bg-red-600 text-white rounded-full px-2 py-0.5">{{ $usersPendingCount }}</span> @endif
                </x-responsive-nav-link>
            @endcan

        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
