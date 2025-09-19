<x-app-layout>
    <div class="space-y-5 sm:space-y-6 p-6">
        <div x-data="{ pageName: `Editando a safra`}" class="px-3 py-2">
            @include('layouts.partials.base.breadcrumb')
        </div>
        <div class="bg-white dark:bg-gray-900 shadow-lg rounded-2xl overflow-hidden transition">
            <div class="p-6 rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03 ] dark:bg-gray-800">
                <!-- Título  -->
                <div 
                    x-data="{ 
                        title: '🩹 Atualizano safra',
                        showButton: {{ request()->routeIs('harvests.edit') ? 'false' : 'true' }}
                    }"
                >
                    @include('layouts.partials.base.title-header')
                </div>

                <!-- Mensagem de erro -->
                <x-alert-error></x-alert-error>
                
                <!-- Formulario -->
                <div class="p-6 overflow-x-auto rounded-xl border border-gray-200 dark:border-gray-700 shadow-md">
                    <form action="{{ route('harvests.update', $harvest) }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <!-- Campo título -->
                        <div>
                            <x-input-label for="title" :value="__('Título')" />
                            <x-text-input
                                id="title"
                                name="title"
                                type="text"
                                placeholder="Exemplo: 2023/24"
                                value="{{ old('title', $harvest->title) }}"
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
                            <x-input-label for="is_active" :value="__('Status')" />
                            <label x-data="{ active: {{ old('is_active', $harvest->is_active) ? 'true' : 'false' }} }" 
                                   class="relative inline-flex items-center mt-2 cursor-pointer">

                                <input type="hidden" name="is_active" value="0">

                                <input type="checkbox" id="is_active" name="is_active" value="1"
                                    class="sr-only peer"
                                    x-model="active">

                                <div class="w-12 h-6 bg-gray-300 rounded-full peer
                                            peer-checked:bg-cyan-600
                                            peer-focus:ring-4 peer-focus:ring-cyan-300
                                            dark:bg-gray-700 dark:peer-focus:ring-cyan-800
                                            after:content-[''] after:absolute after:top-[2px] after:left-[2px]
                                            after:h-5 after:w-5 after:bg-white after:rounded-full after:transition-all
                                            peer-checked:after:translate-x-6">
                                </div>

                                <span x-show="active" class="ml-3 text-sm font-medium text-green-600 dark:text-green-400">Ativa</span>
                                <span x-show="!active" class="ml-3 text-sm font-medium text-red-600 dark:text-red-400">Inativa</span>
                            </label>
                        </div>

                        <!-- Botões -->
                        <div class="flex items-center space-x-4">
                            <x-primary-button>Salvar</x-primary-button>

                            <a href="{{ route('harvests.index') }}">
                                <x-secondary-button>{{ __('Cancel') }}</x-secondary-button>
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
