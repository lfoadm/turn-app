<x-app-layout>
    <div class="space-y-5 sm:space-y-6 p-6">
        <div x-data="{ pageName: `Safras`}" class="px-3 py-2">
            @include('layouts.partials.base.breadcrumb')
        </div>
        <div class="bg-white dark:bg-gray-900 shadow-lg rounded-2xl overflow-hidden transition">
            <div class="p-6 rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03 ] dark:bg-gray-800">
                <!-- Título + Botão -->
                <div x-data="{ 
                    title: '💣 Testes',
                    buttonText: '+ TESTE',
                    buttonRoute: '{{ route('dashboard') }}',
                    showButton: {{ request()->routeIs('dashboard') ? 'false' : 'true' }}
                }">@include('layouts.partials.ui.title.title')
                </div>

                <!-- Mensagem de sucesso -->
                @include('layouts.partials.ui.alert.alert-success')
                
                <!-- Tabela -->
                <div class="overflow-x-auto rounded-xl border border-gray-200 dark:border-gray-700 shadow-md">
                        @include('layouts.partials.test.badge-01')
                        <hr class="m-3">
                        @include('layouts.partials.test.badge-02')
                        <hr class="m-3">
                        @include('layouts.partials.test.badge-03')
                        <hr class="m-3">
                        @include('layouts.partials.test.badge-04')
                        <hr class="m-3">
                        @include('layouts.partials.test.badge-05')
                        <hr class="m-3">
                        @include('layouts.partials.test.badge-06')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
