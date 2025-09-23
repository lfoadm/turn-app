<x-app-layout>
    <div class="mx-auto max-w-[1440px] p-4 md:p-6">
        <!-- Breadcrumb / Título -->
        <div x-data="{
            pageName: 'Painel',
            activeHarvest: '{{ $activeHarvest->title }}'
        }">
            @include('layouts.partials.base.breadcrumb')
        </div>
        <p class="text-gray-600 dark:text-gray-200">
            Safra atual: <strong class="text-cyan-600">{{ $activeHarvest->title }}</strong>
        </p>

        
        <div class="p-2 text-gray-900 mt-6">

            <div class="mb-4 flex flex-col sm:flex-row sm:items-center sm:justify-between">
                <form method="GET" action="{{ route('dashboard') }}"
                    class="w-full space-y-4 sm:flex sm:items-center sm:space-x-4 sm:space-y-0">
                    <div x-data="{}"
                        class="flex flex-col sm:flex-row sm:items-center w-full sm:w-auto space-y-3 sm:space-y-0 sm:space-x-3">
                        <div class="relative w-full">
                            <input type="text" name="start_date" id="start_date"
                                value="{{ request('start_date') }}"
                                class="block w-full rounded-md border-gray-300 bg-white py-2.5 pl-4 pr-12 text-sm text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-cyan-600 dark:border-slate-600 dark:bg-slate-700 dark:text-gray-200 dark:ring-slate-600 dark:placeholder:text-gray-400 dark:focus:ring-cyan-500"
                                x-init="flatpickr($el, {
                                    dateFormat: 'Y-m-d',
                                    altFormat: 'd/m/Y', // Formato de exibição
                                    altInput: true, // Exibe formato de exibição
                                    locale: 'pt', // Opcional: Para tradução
                                    // Opcional: Adicione classes do Tailwind ao calendário para dark mode
                                    theme: 'dark' // Opcional: Tema dark do flatpickr
                                })">
                            <label for="start_date"
                                class="absolute left-3 -top-2.5 inline-block bg-white px-1 text-xs font-medium text-gray-900 dark:bg-slate-800 dark:text-gray-300">Data
                                de Início</label>
                        </div>

                        <span class="text-center font-semibold text-gray-500 sm:text-lg dark:text-gray-400">a</span>

                        <div class="relative w-full">
                            <input type="text" name="end_date" id="end_date" value="{{ request('end_date') }}"
                                class="block w-full rounded-md border-gray-300 bg-white py-2.5 pl-4 pr-12 text-sm text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-cyan-600 dark:border-slate-600 dark:bg-slate-700 dark:text-gray-200 dark:ring-slate-600 dark:placeholder:text-gray-400 dark:focus:ring-cyan-500"
                                x-init="flatpickr($el, {
                                    dateFormat: 'Y-m-d',
                                    altFormat: 'd/m/Y',
                                    altInput: true,
                                    locale: 'pt',
                                    theme: 'dark'
                                })">
                            <label for="end_date"
                                class="absolute left-3 -top-2.5 inline-block bg-white px-1 text-xs font-medium text-gray-900 dark:bg-slate-800 dark:text-gray-300">Data
                                de Fim</label>
                        </div>
                    </div>

                    <div class="flex w-full sm:w-auto space-x-2">
                        <button type="submit"
                            class="flex-1 rounded-md bg-cyan-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-cyan-700 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-cyan-600 dark:bg-cyan-500 dark:hover:bg-cyan-600">
                            Filtrar
                        </button>

                        @if (request('start_date') || request('end_date'))
                            <a href="{{ route('dashboard') }}"
                                class="flex-1 rounded-md bg-white px-4 py-2.5 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 dark:bg-slate-700 dark:text-gray-200 dark:ring-slate-600 dark:hover:bg-slate-600">
                                Limpar
                            </a>
                        @endif
                    </div>
                </form>
            </div>
        </div>
        @include('pages.dashboard.includes.cards')
        
    </div>

</x-app-layout>
