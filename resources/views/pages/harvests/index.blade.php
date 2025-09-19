<x-app-layout>
    <div class="space-y-5 sm:space-y-6 p-6">
        <div x-data="{ pageName: `Safras`}" class="px-3 py-2">
            @include('layouts.partials.base.breadcrumb')
        </div>
        <div class="bg-white dark:bg-gray-900 shadow-lg rounded-2xl overflow-hidden transition">
            <div class="p-6 rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03 ] dark:bg-gray-800">
                <!-- Título + Botão -->
                <div x-data="{ 
                    title: '🌱 Período Safra',
                    buttonText: '+ Safra',
                    buttonRoute: '{{ route('harvests.create') }}',
                    showButton: {{ request()->routeIs('harvests.create') ? 'false' : 'true' }}
                }">@include('layouts.partials.ui.title.title')
                </div>

                <!-- Mensagem de sucesso -->
                @include('layouts.partials.ui.alert.alert-success')
                
                <!-- Tabela -->
                <div class="overflow-x-auto rounded-xl border border-gray-200 dark:border-gray-700 shadow-md">
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
