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
                    🚆 Atualizando encoste ferroviário: <strong class="text-2xl text-cyan-600">{{ $docking->numero_encoste }}</strong>
                <p>⏰ Horário do encoste: <strong class="text-xl text-cyan-600">{{ $docking->hora_encoste_formatted }}</strong></p>    
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
                        {{-- hidden para manter no update --}}
                        <input type="hidden" name="hora_encoste" value="{{ $docking->hora_encoste }}">
                        
                        <div class="grid grid-cols-1 gap-5 md:grid-cols-6">
                            
                            <!-- Campo Terminal Destino -->
                            <div class="sm:col-span-1">
                                <x-input-label for="port_id" :value="__('Port')" />
                                <select name="port_id" id="port_id" class="mt-1 block w-full rounded-xl border border-gray-900 shadow-sm focus:border-cyan-400 focus:ring focus:ring-cyan-300 focus:ring-opacity-50 dark:bg-gray-800 dark:border-gray-400 dark:text-white dark:placeholder-gray-400transition h-11 px-4 text-sm">
                                    <option value="">Selecione</option>
                                    @foreach($ports as $port)
                                    <option value="{{ $port->id }}" {{ $docking->port_id == $port->id ? 'selected' : '' }}>
                                            {{ $port->title }}
                                        </option>
                                        @endforeach
                                </select>
                            </div>
                            
                            <!-- Campo situação dos vagões -->
                            <div class="sm:col-span-1">
                                <x-input-label for="situacao_vagoes" :value="__('Status Wagon')" />
                                <select name="situacao_vagoes" id="situacao_vagoes"
                                    class="mt-1 block w-full rounded-xl border border-gray-900 shadow-sm focus:border-cyan-400 focus:ring focus:ring-cyan-300 focus:ring-opacity-50 dark:bg-gray-800 dark:border-gray-400 dark:text-white dark:placeholder-gray-400transition h-11 px-4 text-sm">
                                    <option value="">Selecione</option>
                                    <option value="LIMPOS" {{ $docking->situacao_vagoes == 'LIMPOS' ? 'selected' : '' }}>Limpos</option>
                                    <option value="SUJOS" {{ $docking->situacao_vagoes == 'SUJOS' ? 'selected' : '' }}>Sujos</option>
                                </select>
                            </div>

                            <!-- Campo Quantidade total de vagões -->
                            <div class="sm:col-span-1">
                                <x-input-label for="qtd_vagoes_total" :value="__('Qty Wagons')" />
                                <input type="number" name="qtd_vagoes_total" value="{{ $docking->qtd_vagoes_total }}"
                                    class="mt-1 block w-full rounded-xl border border-gray-900 shadow-sm focus:border-cyan-400 focus:ring focus:ring-cyan-300 focus:ring-opacity-50 dark:bg-gray-800 dark:border-gray-400 dark:text-white dark:placeholder-gray-400transition h-11 px-4 text-sm">
                            </div>

                            <!-- Campo Quantidade de vagões carregados -->
                            <div class="sm:col-span-1">
                                <x-input-label for="qtd_vagoes_carregados" :value="__('Wagons Load')" />
                                <input type="number" name="qtd_vagoes_carregados" value="{{ $docking->qtd_vagoes_carregados }}"
                                    class="mt-1 block w-full rounded-xl border border-gray-900 shadow-sm focus:border-cyan-400 focus:ring focus:ring-cyan-300 focus:ring-opacity-50 dark:bg-gray-800 dark:border-gray-400 dark:text-white dark:placeholder-gray-400transition h-11 px-4 text-sm">
                            </div>

                            <!-- Campo Quantidade total de vagões abertos -->
                            <div class="sm:col-span-1">
                                <x-input-label for="qtd_vagoes_abertos" :value="__('Wagons Open')" />
                                <input type="number" name="qtd_vagoes_abertos" value="{{ $docking->qtd_vagoes_abertos }}"
                                    class="mt-1 block w-full rounded-xl border border-gray-900 shadow-sm focus:border-cyan-400 focus:ring focus:ring-cyan-300 focus:ring-opacity-50 dark:bg-gray-800 dark:border-gray-400 dark:text-white dark:placeholder-gray-400transition h-11 px-4 text-sm">
                            </div>

                            <!-- Campo Quantidade total de vagões recusados -->
                            <div class="sm:col-span-1">
                                <x-input-label for="qtd_vagoes_recusados" :value="__('Wagons Recused')" />
                                <input type="number" name="qtd_vagoes_recusados" value="{{ $docking->qtd_vagoes_recusados }}"
                                    class="mt-1 block w-full rounded-xl border border-gray-900 shadow-sm focus:border-cyan-400 focus:ring focus:ring-cyan-300 focus:ring-opacity-50 dark:bg-gray-800 dark:border-gray-400 dark:text-white dark:placeholder-gray-400transition h-11 px-4 text-sm">
                            </div>

                        </div>

                        {{-- PAREIIIIIIIIIIIIIIIIIIIIIIIIA AQUIIIIIIIIIIIII --}}

                        {{-- HORA --}}
                        <div class="grid grid-cols-1 gap-5 md:grid-cols-6">

                            <div class="sm:col-span-1">
                                <x-input-label for="hora_inicio_carga" :value="__('Hour Start')" />
                                <input type="datetime-local" name="hora_inicio_carga" id="hora_inicio_carga" value="{{ $docking->hora_inicio_carga }}"
                                class="mt-1 block w-full rounded-xl border border-gray-900 shadow-sm
                                    focus:border-cyan-400 focus:ring focus:ring-cyan-300 focus:ring-opacity-50
                                    dark:bg-gray-800 dark:border-gray-400 dark:text-white dark:placeholder-gray-400
                                    transition h-11 px-4 text-sm">
                            </div>

                            <div class="sm:col-span-1">
                                <x-input-label for="hora_fim_carga" :value="__('Hour End')" />
                                <input type="datetime-local" name="hora_fim_carga" id="hora_fim_carga" value="{{ $docking->hora_fim_carga }}"
                                class="mt-1 block w-full rounded-xl border border-gray-900 shadow-sm
                                    focus:border-cyan-400 focus:ring focus:ring-cyan-300 focus:ring-opacity-50
                                    dark:bg-gray-800 dark:border-gray-400 dark:text-white dark:placeholder-gray-400
                                    transition h-11 px-4 text-sm">
                            </div>

                            <div class="sm:col-span-1">
                                <x-input-label for="hora_partida" :value="__('Hour Departure')" />
                                <input type="datetime-local" name="hora_partida" id="hora_partida"  value="{{ $docking->hora_partida }}"
                                class="mt-1 block w-full rounded-xl border border-gray-900 shadow-sm
                                    focus:border-cyan-400 focus:ring focus:ring-cyan-300 focus:ring-opacity-50
                                    dark:bg-gray-800 dark:border-gray-400 dark:text-white dark:placeholder-gray-400
                                    transition h-11 px-4 text-sm">
                            </div>

                            <div class="sm:col-span-1">
                                <x-input-label for="hora_partida" :value="__('Own')" />
                                <input type="number" step="0.001" name="peso_proprio" id="peso_proprio" value="{{ old('peso_proprio', $docking->peso_proprio) }}"
                                    class="mt-1 block w-full rounded-xl border border-gray-900 shadow-sm focus:border-cyan-400 focus:ring focus:ring-cyan-300 focus:ring-opacity-50 dark:bg-gray-800 dark:border-gray-400 dark:text-white dark:placeholder-gray-400transition h-11 px-4 text-sm">
                            </div>

                            <div class="sm:col-span-1">
                                <x-input-label for="hora_partida" :value="__('Third Party')" />
                                <input type="number" step="0.001" name="peso_terceiros" id="peso_terceiros" value="{{ old('peso_terceiros', $docking->peso_terceiros) }}"
                                    class="mt-1 block w-full rounded-xl border border-gray-900 shadow-sm focus:border-cyan-400 focus:ring focus:ring-cyan-300 focus:ring-opacity-50 dark:bg-gray-800 dark:border-gray-400 dark:text-white dark:placeholder-gray-400transition h-11 px-4 text-sm">
                            </div>
                            
                            <div class="sm:col-span-1">
                                <x-input-label for="hora_partida" :value="__('Total')" />
                                <input type="number" step="0.001" name="peso_total" id="peso_total" value="{{ old('peso_total', $docking->peso_total) }}"
                                    class="mt-1 block w-full rounded-xl border border-gray-900 shadow-sm focus:border-cyan-400 focus:ring focus:ring-cyan-300 focus:ring-opacity-50 dark:bg-gray-800 dark:border-gray-400 dark:text-white dark:placeholder-gray-400transition h-11 px-4 text-sm">
                            </div>

                            
                        </div>

                        <input type="hidden" name="situacao_vagoes" value="LIMPOS">

                        


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
