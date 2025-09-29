<x-app-layout>
    <div class="mx-auto max-w-[1440px] p-4 md:p-6">
        <!-- Breadcrumb / Título -->
        <div x-data="{ pageName: `Permissão de acesso` }" class="px-3 py-2">
            @include('layouts.partials.base.breadcrumb')
        </div>

        <!-- Container -->
        <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03] shadow-sm">
            <!-- Cabeçalho -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between my-4 px-4">
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                         stroke-width="1.5" stroke="currentColor"
                         class="size-6 text-cyan-600 mr-2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198 .001.031c0 .225-.012.447-.037.666 A11.944 11.944 0 0 1 12 21 c-2.17 0-4.207-.576-5.963-1.584 A6.062 6.062 0 0 1 6 18.719m12 0 a5.971 5.971 0 0 0-.941-3.197m0  0A5.995 5.995 0 0 0 12 12.75 a5.995 5.995 0 0 0-5.058 2.772m0 0 a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197 a5.971 5.971 0 0 0-.94 3.197M15  6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3 a2.25 2.25 0 1 1-4.5 0  2.25 2.25 0 0 1 4.5 0Zm-13.5 0 a2.25 2.25 0 1 1-4.5 0  2.25 2.25 0 0 1 4.5 0Z"/>
                    </svg>
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">
                        Permissão de acesso: {{ $permission->name }}
                    </h3>
                </div>
            </div>

            <div class="border-t border-gray-100 p-5 dark:border-gray-800 sm:p-6">
                <!-- Mensagens -->
                <x-alert-error></x-alert-error>
                <x-alert-success></x-alert-success>

                <!-- Informações básicas -->
                <div class="mb-6">
                    <p class="text-gray-700 dark:text-gray-300">
                        <span class="font-semibold">Nome:</span> 
                        <strong class="text-3xl text-cyan-800 dark:text-cyan-600">{{ $permission->name }}</strong>
                    </p>
                    <p class="text-gray-500 text-sm">
                        Criado em {{ $permission->created_at->format('d/m/Y H:i') }}
                    </p>
                    <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                        Pertence a <span class="font-medium">{{ $rolesCount }}</span> grupo(s) de usuário.
                    </p>
                </div>

                <div class="text-2xl text-slate-600 dark:text-slate-300 mb-6">
                    Grupos de usuários com esta permissão
                </div>

                @if($rolesCount > 0)
                    <ul class="grid gap-3 sm:grid-cols-2 lg:grid-cols-3">
                        @foreach($roles as $role)
                            <li class="rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-slate-800 p-4 shadow-sm flex items-center justify-between">
                                <span class="font-medium text-gray-800 dark:text-gray-200">
                                    {{ $role->name }}
                                </span>
                                <span class="px-2 py-1 text-xs rounded-lg bg-cyan-100 text-cyan-800 dark:bg-cyan-900 dark:text-cyan-200">
                                    ID #{{ $role->id }}
                                </span>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-red-500 text-sm">
                        Nenhum grupo de usuário possui esta permissão.
                    </p>
                @endif

                
            </div>
        </div>
    </div>
</x-app-layout>