{{-- <x-app-layout>
    <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
    Cadastro de motivo
    </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <h1 class="text-lg font-bold mb-6">Cadastrar novo motivo de parada</h1>

                    @if ($errors->any())
                        <div class="mb-4 p-3 bg-red-100 text-red-800 rounded">
                            <ul class="list-disc pl-5">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('reasons.update', $reason) }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <!-- Título -->
                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700">Título</label>
                            <input type="text" name="title" id="title"
                                value="{{ old('title', $reason->title) }}"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-cyan-500 focus:ring focus:ring-cyan-200 focus:ring-opacity-50"
                                placeholder="Exemplo: 2023/24"
                                required>
                        </div>

                        <!-- Expurgo (Toggle Switch) -->
                            <div>
                                <label id="purge" class="relative inline-flex items-center cursor-pointer">
                                    <!-- hidden para garantir envio do valor false -->
                                    <input type="hidden" name="purge" value="0">

                                    <!-- checkbox envia 1 quando marcado -->
                                    <input type="checkbox" id="purge" name="purge" value="1" class="sr-only peer"
                                        {{ old('purge', $reason->purge) ? 'checked' : '' }}>

                                    <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 
                                                peer-focus:ring-blue-300 rounded-full peer 
                                                peer-checked:after:translate-x-full peer-checked:after:border-white
                                                after:content-[''] after:absolute after:top-[2px] after:left-[2px]
                                                after:bg-white after:border-gray-300 after:border after:rounded-full
                                                after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600">
                                    </div>
                                    <span class="ml-3 text-sm font-medium text-gray-900">Expurga</span>
                                </label>
                            </div>


                        <!-- Botões -->
                        <div class="flex items-center space-x-4">
                            <button type="submit"
                                    class="px-4 py-2 bg-cyan-600 text-white rounded hover:bg-cyan-700">
                                Salvar
                            </button>
                            <a href="{{ route('reasons.index') }}"
                            class="px-4 py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400">
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
    <div class="mx-auto max-w-[1440px] p-4 md:p-6">
        <!-- Breadcrumb / Título -->
        <div x-data="{ pageName: `Editando a safra` }" class="px-3 py-2">
            @include('layouts.partials.base.breadcrumb')
        </div>

        <!-- Datatable Container -->
        <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
            <!-- Cabeçalho com título e botão Novo -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between my-4 px-4">
                <h3 class="text-base font-medium text-gray-800 dark:text-white/90 mb-2 sm:mb-0">
                    🛑 Atualizando o motivo {{ $reason->title }}
                </h3>
            </div>

            <div class="border-t border-gray-100 p-5 dark:border-gray-800 sm:p-6">
                <!-- Mensagem de erro -->
                <x-alert-error></x-alert-error>
                <!-- DataTable Start -->
                <div x-data="dataTable()"
                    class="overflow-hidden rounded-xl border border-gray-200 bg-white pt-4 dark:border-gray-800 dark:bg-white/[0.03]">

                    <!-- Formulario -->
                    <form action="{{ route('reasons.update', $reason) }}" method="POST" class="space-y-6 m-6">
                        @csrf
                        @method('PUT')

                        <!-- Campo título -->
                        <div>
                            <x-input-label for="title" :value="__('Título')" />
                            <x-text-input id="title" name="title" type="text"
                                value="{{ old('title', $reason->title) }}" required autofocus
                                class="mt-1 block w-full rounded-xl border border-gray-900 shadow-sm
                                    focus:border-cyan-400 focus:ring focus:ring-cyan-300 focus:ring-opacity-50
                                    dark:bg-gray-800 dark:border-gray-400 dark:text-white dark:placeholder-gray-400
                                    transition h-11 px-4 text-sm" />
                        </div>

                        <!-- Toggle Expurgo -->
                        <div>
                            <x-input-label for="purge" :value="__('Purge?')" />
                            <label x-data="{ active: {{ old('purge', $reason->purge) ? 'true' : 'false' }} }"
                                class="relative inline-flex items-center mt-2 cursor-pointer">

                                <input type="hidden" name="purge" value="0">

                                <input type="checkbox" id="purge" name="purge" value="1" class="sr-only peer" x-model="active">
                                <div
                                    class="w-12 h-6 bg-gray-300 rounded-full peer
                                            peer-checked:bg-cyan-600
                                            peer-focus:ring-4 peer-focus:ring-cyan-300
                                            dark:bg-gray-700 dark:peer-focus:ring-cyan-800
                                            after:content-[''] after:absolute after:top-[2px] after:left-[2px]
                                            after:h-5 after:w-5 after:bg-white after:rounded-full after:transition-all
                                            peer-checked:after:translate-x-6">
                                </div>

                                <span x-show="active"
                                    class="ml-3 text-sm font-medium text-green-600 dark:text-green-400">Sim</span>
                                <span x-show="!active"
                                    class="ml-3 text-sm font-medium text-red-600 dark:text-red-400">Não</span>
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
                <!-- DataTable End -->
            </div>
        </div>
    </div>
</x-app-layout>
