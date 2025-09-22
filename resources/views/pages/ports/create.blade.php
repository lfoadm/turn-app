<x-app-layout>
    <div class="mx-auto max-w-[1440px] p-4 md:p-6">
        <!-- Breadcrumb / Título -->
        <div x-data="{ pageName: `Criando novo terminal` }" class="px-3 py-2">
            @include('layouts.partials.base.breadcrumb')
        </div>

        <!-- Datatable Container -->
        <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
            <!-- Cabeçalho com título e botão Novo -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between my-4 px-4">
                <h3 class="text-base font-medium text-gray-800 dark:text-white/90 mb-2 sm:mb-0">
                    🚢 Criando novo terminal portuário
                </h3>
            </div>

            <div class="border-t border-gray-100 p-5 dark:border-gray-800 sm:p-6">

                <!-- Mensagem de erro -->
                <x-alert-error></x-alert-error>

                <!-- DataTable Start -->
                <div x-data="dataTable()"
                    class="overflow-hidden rounded-xl border border-gray-200 bg-white pt-4 dark:border-gray-800 dark:bg-white/[0.03]">

                    <!-- Formulario -->
                    <form action="{{ route('ports.store') }}" method="POST" class="space-y-6 m-6">
                        @csrf

                        <!-- Campo título -->
                        <div>
                            <x-input-label for="title" :value="__('Título')" />
                            <x-text-input id="title" name="title" type="text"
                                placeholder="Exemplo: CLI, TEC, TAC, TEAG" value="{{ old('title') }}" required
                                autofocus
                                class="mt-1 block w-full rounded-xl border border-gray-900 shadow-sm
                                        focus:border-cyan-400 focus:ring focus:ring-cyan-300 focus:ring-opacity-50
                                        dark:bg-gray-800 dark:border-gray-400 dark:text-white dark:placeholder-gray-400
                                        transition h-11 px-4 text-sm" />
                        </div>

                        <!-- Campo título -->
                        <div>
                            <x-input-label for="description" :value="__('Description')" />
                            <x-text-input id="description" name="description" type="text"
                                placeholder="Descrição breve" value="{{ old('description') }}" required autofocus
                                class="mt-1 block w-full rounded-xl border border-gray-900 shadow-sm
                                        focus:border-cyan-400 focus:ring focus:ring-cyan-300 focus:ring-opacity-50
                                        dark:bg-gray-800 dark:border-gray-400 dark:text-white dark:placeholder-gray-400
                                        transition h-11 px-4 text-sm" />
                        </div>


                        <!-- Botões -->
                        <div class="flex items-center space-x-4">
                            <x-primary-button>Salvar</x-primary-button>

                            <a href="{{ route('ports.index') }}">
                                <x-secondary-button>{{ __('Cancel') }}</x-secondary-button>
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
