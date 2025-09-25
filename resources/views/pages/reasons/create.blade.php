<x-app-layout>
    <div class="mx-auto max-w-[1440px] p-4 md:p-6">
        <!-- Breadcrumb / Título -->
        <div x-data="{ pageName: `Criando motivo de parada`}" class="px-3 py-2">
            @include('layouts.partials.base.breadcrumb')
        </div>

        <!-- Datatable Container -->
        <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
            <!-- Cabeçalho com título e botão Novo -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between my-4 px-4">
                <h3 class="text-base font-medium text-gray-800 dark:text-white/90 mb-2 sm:mb-0">
                    🛑 Criando motivo de parada na operação de carregamento ferroviário
                </h3>
            </div>

            <div class="border-t border-gray-100 p-5 dark:border-gray-800 sm:p-6">
                
                <!-- Mensagem de erro -->
                <x-alert-error></x-alert-error>
                
                <!-- DataTable Start -->
                <div x-data="dataTable()" class="overflow-hidden rounded-xl border border-gray-200 bg-white pt-4 dark:border-gray-800 dark:bg-white/[0.03]">
                
                    <!-- Formulario -->
                    <form action="{{ route('reasons.store') }}" method="POST" class="space-y-6 m-6">
                        @csrf

                        <!-- Campo título -->
                        <div>
                            <x-input-label for="title" :value="__('Título')" />
                            <x-text-input
                                id="title"
                                name="title"
                                type="text"
                                placeholder="Nome breve do motivo"
                                value="{{ old('title') }}"
                                required
                                autofocus
                                class="mt-1 block w-full rounded-xl border border-gray-900 shadow-sm
                                    focus:border-cyan-400 focus:ring focus:ring-cyan-300 focus:ring-opacity-50
                                    dark:bg-gray-800 dark:border-gray-400 dark:text-white dark:placeholder-gray-400
                                    transition h-11 px-4 text-sm"
                            />
                        </div>

                        <!-- Toggle Status -->
                        <div>
                            <x-input-label for="purge" :value="__('Purge?')" />
                            <label x-data="{ active: {{ old('purge', $model->purge ?? false) ? 'true' : 'false' }} }" 
                                class="relative inline-flex items-center mt-2 cursor-pointer">

                                <input type="hidden" name="purge" value="0">

                                <input type="checkbox" id="purge" name="purge" value="1" class="sr-only peer" x-model="active">

                                <div class="w-12 h-6 bg-gray-300 rounded-full peer
                                    peer-checked:bg-cyan-600
                                    peer-focus:ring-4 peer-focus:ring-cyan-600
                                    dark:bg-gray-700 dark:peer-focus:ring-cyan-800
                                    after:content-[''] after:absolute after:top-[2px] after:left-[2px]
                                    after:h-5 after:w-5 after:bg-white after:rounded-full after:transition-all
                                    peer-checked:after:translate-x-6">
                                </div>

                                <span x-show="active" class="ml-3 text-sm font-medium text-green-600 dark:text-green-400">
                                    Sim
                                </span>
                                <span x-show="!active" class="ml-3 text-sm font-medium text-red-600 dark:text-red-400">
                                    Não
                                </span>
                            </label>
                        </div>

                        <!-- Botões -->
                        <div class="flex items-center space-x-4">
                            <x-primary-button>Salvar</x-primary-button>

                            <a href="{{ route('reasons.index') }}">
                                <x-secondary-button>{{ __('Cancel') }}</x-secondary-button>
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
