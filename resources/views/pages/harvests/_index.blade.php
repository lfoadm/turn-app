<x-app-layout>
    <div class="mx-auto max-w-(--breakpoint-2xl) p-4 md:p-6">
        <div x-data="{ pageName: `Safras`}" class="px-3 py-2">
            @include('layouts.partials.base.breadcrumb')
        </div>
        <div class="bg-white dark:bg-gray-900 shadow-lg rounded-2xl overflow-hidden transition">
            <div class="p-6 rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03 ] dark:bg-gray-800">
               
                <!-- Title + Search + Button -->
                <div class="flex justify-between items-center mb-6">
                    <!-- Título -->
                        <h1 class="hidden md:block text-xl font-semibold dark:text-gray-100">🌱 Período Safra</h1>

                    <!-- Área flexível: pesquisa + botão -->
                    <div class="flex justify-between gap-2">
                        <div class="flex items-center gap-4">
                            <input id="title" name="title" type="text" placeholder="Pesquisar título..." class="px-4 py-2 text-sm border rounded-lg dark:bg-gray-800 dark:border-gray-700 dark:text-gray-200 focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500 transition">
                        </div>
                        <div class="flex items-center gap-4">
                            <select id="is_active" name="is_active" class="px-4 py-2 text-sm border rounded-lg dark:bg-gray-800 dark:border-gray-700 dark:text-gray-200 focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500 transition text-gray-600">
                                <option selected disabled class="px-4 py-2 text-sm border rounded-lg dark:bg-gray-800 dark:border-gray-700 dark:text-gray-600 focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500 transition">-- Selecione o status --</option>
                                <option value="1">Ativa</option>
                                <option value="0">Inativa</option>
                            </select>
                        </div>
                        <div>
                            <x-primary-button>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                                </svg>
                            </x-primary-button> 
                        </div>
                    </div>

                    
                    <!-- Botão de ação -->
                    <div
                        x-data="{ 
                            buttonText: '+ Safra',
                            buttonRoute: '{{ route('harvests.create') }}',
                            showButton: {{ request()->routeIs('harvests.create') ? 'false' : 'true' }},
                        }"
                    >
                        <template x-if="showButton">
                            <x-button></x-button>
                        </template>
                    </div>
                </div>

                <!-- Mensagem de sucesso -->
                <x-alert-success></x-alert-success>
                
                <!-- Tabela -->
                <div class="overflow-x-auto rounded-xl border border-gray-200 dark:border-gray-700 shadow-md">
                    <!-- filtros -->
                    <div class="flex items-center gap-3 m-6">
                        <span class="text-gray-500 dark:text-gray-400"> Mostrar </span>
                        <div x-data="{ isOptionSelected: false }" class="relative z-20 bg-transparent">
                            <select class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-9 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none py-2 pr-8 pl-3 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" :class="isOptionSelected &amp;&amp; 'text-gray-500 dark:text-gray-400'" @click="isOptionSelected = true" @change="perPage = $event.target.value">
                                <option value="10" class="text-gray-500 dark:bg-gray-900 dark:text-gray-400">
                                    10
                                </option>
                                <option value="8" class="text-gray-500 dark:bg-gray-900 dark:text-gray-400">
                                    25
                                </option>
                                <option value="5" class="text-gray-500 dark:bg-gray-900 dark:text-gray-400">
                                    50
                                </option>
                            </select>
                            <span class="absolute top-1/2 right-2 z-30 -translate-y-1/2 text-gray-500 dark:text-gray-400">
                            <svg class="stroke-current" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M3.8335 5.9165L8.00016 10.0832L12.1668 5.9165" stroke="" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                            </span>
                        </div>
                        <span class="text-gray-500 dark:text-gray-400"> registros </span>
                    </div>


                    <table class="w-full text-left text-sm">
                        <thead class="bg-gray-100 dark:bg-gray-600 text-gray-600 dark:text-gray-300 uppercase text-xs">
                            <tr>
                                <th class="px-6 py-3">Título</th>
                                <th class="px-6 py-3">Situação</th>
                                <th class="px-6 py-3 text-center">Ações</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            @forelse($harvests as $harvest)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-800 transition dark:text-gray-300">
                                    <td class="px-6 py-4 font-medium">{{ $harvest->title }}</td>
                                    <td class="px-6 py-4">
                                        <x-badge 
                                            :type="$harvest->is_active ? 'success' : 'error'"
                                            :label="$harvest->is_active ? 'Ativa' : 'Inativa'"
                                        ></x-badge>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <div class="flex justify-center">
                                            <a href="{{ route('harvests.edit', $harvest) }}" 
                                            class="px-3 py-1 rounded-lg text-sm font-medium text-cyan-700 dark:text-cyan-400 hover:underline transition">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                                </svg>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="px-6 py-6 text-center text-gray-500 dark:text-gray-400">
                                        Nenhum registro cadastrado.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Paginação -->
                <div class="mt-6">
                    {{ $harvests->links('pagination::tailwind') }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>