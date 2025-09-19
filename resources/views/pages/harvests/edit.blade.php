{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100">
            {{ __('Editar Safra') }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-900 shadow-lg rounded-2xl overflow-hidden transition">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                    <!-- Título -->
                    <h1 class="text-xl font-semibold mb-6 text-gray-700 dark:text-gray-200">
                        ✏️ Editar período de safra
                    </h1>

                    <!-- Erros -->
                    @if ($errors->any())
                        <div class="mb-6 p-4 rounded-xl bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300 shadow-sm">
                            <ul class="list-disc pl-6 space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Form -->
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
                                class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm
                                       focus:border-cyan-400 focus:ring focus:ring-cyan-300 focus:ring-opacity-50
                                       dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:placeholder-gray-400
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

                                <span x-show="active" class="ml-3 text-sm font-medium text-green-600 dark:text-green-400">
                                    Ativa
                                </span>
                                <span x-show="!active" class="ml-3 text-sm font-medium text-red-600 dark:text-red-400">
                                    Inativa
                                </span>
                            </label>
                        </div>

                        <!-- Botões -->
                        <div class="flex items-center space-x-4">
                            <button type="submit"
                                class="px-6 py-2 rounded-xl font-medium text-white bg-cyan-600 hover:bg-cyan-700 dark:bg-cyan-500 dark:hover:bg-cyan-600 transition">
                                Atualizar
                            </button>
                            <a href="{{ route('harvests.index') }}"
                               class="px-6 py-2 rounded-xl font-medium text-gray-700 bg-gray-200 hover:bg-gray-300 dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600 transition">
                                Cancelar
                            </a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout> --}}


<x-app-layout>
    <div class="space-y-5 sm:space-y-6 p-6">
        <div x-data="{ pageName: `Editando a safra`}" class="px-3 py-2">
            @include('layouts.partials.base.breadcrumb')
        </div>
        <div class="bg-white dark:bg-gray-900 shadow-lg rounded-2xl overflow-hidden transition">
            <div class="p-6 rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03 ] dark:bg-gray-800">
                <!-- Título + Botão -->
                <div x-data="{ 
                    title: '🩹 Atualizano safra',
                    showButton: {{ request()->routeIs('harvests.edit') ? 'false' : 'true' }}
                }">
                @include('layouts.partials.ui.title.title')
                </div>

                <!-- Mensagem de sucesso -->
                @include('layouts.partials.ui.alert.alert-error')
                
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
