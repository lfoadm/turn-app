<div class="relative" x-data="{ dropdownOpen: false }" @click.outside="dropdownOpen = false">

    <button
        class="relative flex h-11 w-11 items-center justify-center rounded-full border border-gray-200 bg-white text-gray-500 transition-colors hover:bg-gray-100 hover:text-gray-700 dark:border-gray-800 dark:bg-gray-900 dark:text-gray-400 dark:hover:bg-gray-800 dark:hover:text-white focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:ring-offset-2"
        @click.prevent="dropdownOpen = ! dropdownOpen">

        @if (auth()->user()->unreadNotifications->count() > 0)
            <span class="absolute top-0 right-0 z-10 h-3 w-3 rounded-full bg-red-500">
                <span class="absolute inline-flex h-full w-full animate-ping rounded-full bg-red-500 opacity-75"></span>
            </span>
        @endif

        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
            class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.04 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
        </svg>
    </button>

    <div x-show="dropdownOpen" x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95"
        class="absolute right-0 mt-3 w-80 sm:w-96 rounded-xl shadow-lg bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 overflow-hidden z-20">

        <div class="p-4 border-b border-gray-100 dark:border-gray-700 flex justify-between items-center">
            <h5 class="text-lg font-semibold text-gray-800 dark:text-white">Notificações</h5>
            @if ($notificationsCount = auth()->user()->unreadNotifications->count() > 0)
            <a href="{{ route('notifications.markAllAsRead') }}"class="text-sm text-cyan-500 hover:text-cyan-600 dark:text-cyan-400 dark:hover:text-cyan-500">
                Marcar todas como lidas
            </a>
            @endif
        </div>

        <ul class="max-h-96 overflow-y-auto custom-scrollbar">
            @forelse(auth()->user()->notifications as $notification)
                <li class="p-2 border-b border-gray-100 dark:border-gray-700 {{ $notification->read_at ? 'opacity-75' : 'bg-cyan-50 dark:bg-cyan-900' }}">
                    <a href="{{ $notification->read_at ? route('users.pending') : route('notifications.read', $notification->id) }}"
                        class="flex items-start gap-4 p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                        <span
                            class="flex h-10 w-10 items-center justify-center rounded-full flex-shrink-0 {{ $notification->read_at ? 'bg-gray-200 dark:bg-gray-700' : 'bg-cyan-500 dark:bg-cyan-600 text-white' }}">
                            @if (isset($notification->data['user_firstname']))
                                <svg xmlns="http://www.w3.org/2000/svg" class="size-6" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path d="M16 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2" />
                                    <circle cx="8.5" cy="7" r="4" />
                                    <path d="M20 8v6M23 11h-6" />
                                </svg>
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" class="size-6" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9" />
                                    <path d="M13.73 21a2 2 0 0 1-3.46 0" />
                                </svg>
                            @endif
                        </span>

                        <div class="flex-grow">
                            <p class="text-sm font-semibold text-gray-800 dark:text-white">
                                Novo usuário cadastrado
                            </p>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                                {{ $notification->data['user_firstname'] }} {{ $notification->data['user_lastname'] }}
                            </p>
                            <div class="flex justify-between">
                                <span class="text-xs text-gray-500 dark:text-gray-500 mt-2 block">
                                    {{ $notification->created_at->diffForHumans() }}
                                </span>
                                <span class="text-xs text-gray-500 dark:text-gray-500 mt-2 block">
                                    @if ($notification->read_at)
                                        lida
                                    @endif
                                </span>
                            </div>
                        </div>
                    </a>
                </li>
            @empty
                <li class="p-4 text-center text-sm text-gray-500 dark:text-gray-400">
                    Nenhuma notificação
                </li>
            @endforelse
        </ul>

        <div class="p-4 border-t border-gray-100 dark:border-gray-700">
            <a href="#"
                class="w-full text-center block rounded-md bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 px-4 py-2 text-sm font-medium hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors">
                Ver todas as notificações
            </a>
        </div>
    </div>
</div>
