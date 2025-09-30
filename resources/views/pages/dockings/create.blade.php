<x-app-layout>
    <div class="mx-auto max-w-[1440px] p-4 md:p-6">
        <!-- Breadcrumb / Título -->
        <div x-data="{ pageName: `Encoste ferroviário` }" class="px-3 py-2">
            @include('layouts.partials.base.breadcrumb')
        </div>

        <!-- Datatable Container -->
        <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
            <!-- Cabeçalho com título e botão Novo -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between my-4 px-4">
                <h3 class="text-base font-medium text-gray-800 dark:text-white/90 mb-2 sm:mb-0">
                    🚆 Novo encoste ferroviário
                </h3>
            </div>

            <div class="border-t border-gray-100 p-5 dark:border-gray-800 sm:p-6">

                <!-- Mensagem de erro -->
                <x-alert-error></x-alert-error>

                <!-- DataTable Start -->
                <div x-data="dataTable()"
                    class="overflow-hidden rounded-xl border border-gray-200 bg-white pt-4 dark:border-gray-800 dark:bg-white/[0.03]">

                    <!-- Formulario -->
                    <form action="{{ route('dockings.store') }}" method="POST" class="space-y-6 m-6">
                        @csrf

                        {{-- RELACIONAMENTOS --}}
                        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">

                        <!-- Campo Terminal Destino -->
                        <div>
                            <x-input-label for="port_id" :value="__('Port')" />
                            <select name="port_id" id="port_id" class="mt-1 block w-full rounded-xl border border-gray-900 shadow-sm
                                        focus:border-cyan-400 focus:ring focus:ring-cyan-300 focus:ring-opacity-50
                                        dark:bg-gray-800 dark:border-gray-400 dark:text-white dark:placeholder-gray-400
                                        transition h-11 px-4 text-sm">
                                <option value="">Selecione</option>
                                @foreach($ports as $port)
                                    <option value="{{ $port->id }}">
                                        {{ $port->title }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- HORA --}}
                        <div>
                            <x-input-label for="hora_encoste" :value="__('Hour Docking')" />
                            <input type="datetime-local" name="hora_encoste" id="hora_encoste"
                                value="{{ old('hora_encoste') }}"
                                class="mt-1 block w-full rounded-xl border border-gray-900 shadow-sm
                                    focus:border-cyan-400 focus:ring focus:ring-cyan-300 focus:ring-opacity-50
                                    dark:bg-gray-800 dark:border-gray-400 dark:text-white dark:placeholder-gray-400
                                    transition h-11 px-4 text-sm">
                        </div>

                        <input type="hidden" name="situacao_vagoes" value="LIMPOS">

                        {{-- VAGÕES --}}
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                            <div>
                                <x-input-label for="hora_encoste" :value="__('Qty Wagons')" />
                                <input type="number" name="qtd_vagoes_total" id="qtd_vagoes_total" value="{{ old('qtd_vagoes_total') }}"
                                    class="mt-1 block w-full rounded-xl border border-gray-900 shadow-sm
                                        focus:border-cyan-400 focus:ring focus:ring-cyan-300 focus:ring-opacity-50
                                        dark:bg-gray-800 dark:border-gray-400 dark:text-white dark:placeholder-gray-400
                                        transition h-11 px-4 text-sm">
                            </div>
                        </div>


                        <!-- Botões -->
                        <div class="flex items-center space-x-4">
                            <x-primary-button>Salvar</x-primary-button>

                            <a href="{{ route('dockings.index') }}">
                                <x-secondary-button>{{ __('Cancel') }}</x-secondary-button>
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
