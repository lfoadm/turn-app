<x-app-layout>
    <div class="mx-auto max-w-[1440px] p-4 md:p-6">
        <!-- Breadcrumb / Título -->
        <div x-data="{ pageName: `Permissões` }" class="px-3 py-2">
            @include('layouts.partials.base.breadcrumb')
        </div>

        <!-- Datatable Container -->
        <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
            <!-- Cabeçalho com título e botão Novo -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between my-4 px-4">
                <div class="flex">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-cyan-700 mr-2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 10.5V6.75a4.5 4.5 0 1 1 9 0v3.75M3.75 21.75h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H3.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                    </svg>
                    <h3 class="text-base font-medium text-gray-800 dark:text-white/90 mb-2 sm:mb-0">
                        Permissão de acessos - Criando nova permissão
                    </h3>
                </div>
            </div>

            <div class="border-t border-gray-100 p-5 dark:border-gray-800 sm:p-6">

                <!-- Mensagem de erro -->
                <x-alert-error></x-alert-error>

                <!-- DataTable Start -->
                <div x-data="dataTable()"
                    class="overflow-hidden rounded-xl border border-gray-200 bg-white pt-4 dark:border-gray-800 dark:bg-white/[0.03]">

                    <!-- Formulario -->
                    <form action="{{ route('permissions.store') }}" method="POST" class="space-y-6 m-6">
                        @csrf

                        <!-- Campo Nome -->
                        <div>
                            <x-input-label for="name" :value="__('Name')" />
                            <x-text-input id="name" name="name" type="text" placeholder="Exemplo: (nome do model).index" value="{{ old('name') }}" required autofocus
                                class="mt-1 block w-full rounded-xl border border-gray-900 shadow-sm focus:border-cyan-400 focus:ring focus:ring-cyan-300 focus:ring-opacity-50 dark:bg-gray-800 dark:border-gray-400 dark:text-white dark:placeholder-gray-400 transition h-11 px-4 text-sm" />
                        </div>

                        <!-- Botões -->
                        <div class="flex items-center space-x-4">
                            <x-primary-button>Salvar</x-primary-button>
                            <a href="{{ route('permissions.index') }}">
                                <x-secondary-button>{{ __('Cancel') }}</x-secondary-button>
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
