<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Novo Encoste') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg sm:shadow-md">
                <div class="p-6 text-gray-900">
                    
                    <h1 class="text-lg font-bold mb-6">Cadastrar novo encoste ferroviário</h1>
                    @if ($errors->any())
                        <div class="mb-4 p-3 bg-red-100 text-red-800 rounded">
                            <ul class="list-disc pl-5">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('dockings.store') }}" method="POST" class="space-y-6">
                        @csrf
                        {{-- RELACIONAMENTOS --}}
                        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div>
                                <label for="port_id" class="block text-sm font-medium text-gray-700">Terminal portuário destino <strong class="text-red-500">*</strong></label>
                                <select name="port_id" id="port_id" class="bg-cyan-300 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-cyan-500 focus:border-cyan-500">
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
                                <label for="hora_encoste" class="block text-sm font-medium text-gray-700">Hora do Encoste <strong class="text-red-500">*</strong></label>
                                <input type="datetime-local" name="hora_encoste" id="hora_encoste"
                                    value="{{ old('hora_encoste') }}"
                                    class="bg-cyan-300 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-cyan-500 focus:border-cyan-500">
                            </div>

                            {{-- SITUAÇÃO --}}
                            <div>
                                <label for="situacao_vagoes" class="block text-sm font-medium text-gray-700">Situação dos Vagões <strong class="text-red-500">*</strong></label>
                                <select name="situacao_vagoes" id="situacao_vagoes" class="bg-cyan-300 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-cyan-500 focus:border-cyan-500">
                                    <option value="">Selecione</option>
                                    <option value="LIMPOS" {{ old('situacao_vagoes') == 'LIMPOS' ? 'selected' : '' }}>Limpos</option>
                                    <option value="SUJOS" {{ old('situacao_vagoes') == 'SUJOS' ? 'selected' : '' }}>Sujos</option>
                                </select>
                            </div>
                        </div>

                        {{-- VAGÕES --}}
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                            <div>
                                <label for="qtd_vagoes_total" class="block text-sm font-medium text-gray-700">Total <strong class="text-red-500">*</strong></label>
                                <input type="number" name="qtd_vagoes_total" id="qtd_vagoes_total" value="{{ old('qtd_vagoes_total') }}"
                                    class="bg-cyan-300 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-cyan-500 focus:border-cyan-500">
                            </div>
                            <div>
                                <label for="qtd_vagoes_carregados" class="block text-sm font-medium text-gray-700">Carregados</label>
                                <input type="number" name="qtd_vagoes_carregados" id="qtd_vagoes_carregados" value="{{ old('qtd_vagoes_carregados') }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-cyan-500 focus:border-cyan-500">
                            </div>
                            <div>
                                <label for="qtd_vagoes_recusados" class="block text-sm font-medium text-gray-700">Recusados</label>
                                <input type="number" name="qtd_vagoes_recusados" id="qtd_vagoes_recusados" value="{{ old('qtd_vagoes_recusados') }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-cyan-500 focus:border-cyan-500">
                            </div>
                            <div>
                                <label for="qtd_vagoes_abertos" class="block text-sm font-medium text-gray-700">Abertos</label>
                                <input type="number" name="qtd_vagoes_abertos" id="qtd_vagoes_abertos" value="{{ old('qtd_vagoes_abertos') }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-cyan-500 focus:border-cyan-500">
                            </div>
                        </div>

                        {{-- HORÁRIOS --}}
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                            <div>
                                <label for="hora_inicio_carga" class="block text-sm font-medium text-gray-700">Início da Carga</label>
                                <input type="datetime-local" name="hora_inicio_carga" id="hora_inicio_carga" value="{{ old('hora_inicio_carga') }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-cyan-500 focus:border-cyan-500">
                            </div>
                            <div>
                                <label for="hora_fim_carga" class="block text-sm font-medium text-gray-700">Fim da Carga</label>
                                <input type="datetime-local" name="hora_fim_carga" id="hora_fim_carga" value="{{ old('hora_fim_carga') }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-cyan-500 focus:border-cyan-500">
                            </div>
                            <div>
                                <label for="hora_partida" class="block text-sm font-medium text-gray-700">Partida</label>
                                <input type="datetime-local" name="hora_partida" id="hora_partida" value="{{ old('hora_partida') }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-cyan-500 focus:border-cyan-500">
                            </div>
                            <div>
                                <label for="status" class="block text-sm font-medium text-gray-700">Status carregamento <strong class="text-red-500">*</strong></label>
                                <select name="status" id="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-cyan-500 focus:border-cyan-500">
                                    <option value="">Selecione</option>
                                        <option value="waiting" selected>Aguardando</option>
                                        <option value="progress">Em operação</option>
                                        <option value="finished">Finalizado</option>
                                </select>
                            </div>

                        </div>

                        {{-- PESOS --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="peso_proprio" class="block text-sm font-medium text-gray-700">Peso Próprio (t)</label>
                                <input type="number" step="0.001" name="peso_proprio" id="peso_proprio" value="{{ old('peso_proprio', 0) }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-cyan-500 focus:border-cyan-500">
                            </div>
                            <div>
                                <label for="peso_terceiros" class="block text-sm font-medium text-gray-700">Peso Terceiros (t)</label>
                                <input type="number" step="0.001" name="peso_terceiros" id="peso_terceiros" value="{{ old('peso_terceiros', 0) }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-cyan-500 focus:border-cyan-500">
                            </div>
                        </div>

                        {{-- PREFIXOS E REGISTROS --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="prefixo_chegada" class="block text-sm font-medium text-gray-700">Prefixo Chegada</label>
                                <input type="text" name="prefixo_chegada" id="prefixo_chegada" value="{{ old('prefixo_chegada') }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-cyan-500 focus:border-cyan-500">
                            </div>
                            <div>
                                <label for="prefixo_saida" class="block text-sm font-medium text-gray-700">Prefixo Saída</label>
                                <input type="text" name="prefixo_saida" id="prefixo_saida" value="{{ old('prefixo_saida') }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-cyan-500 focus:border-cyan-500">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div>
                                <label for="os_partida_rumo" class="block text-sm font-medium text-gray-700">OS Partida Rumo</label>
                                <input type="text" name="os_partida_rumo" id="os_partida_rumo" value="{{ old('os_partida_rumo') }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-cyan-500 focus:border-cyan-500">
                            </div>
                            <div>
                                <label for="registro_transporte_coruripe" class="block text-sm font-medium text-gray-700">Registro Coruripe</label>
                                <input type="text" name="registro_transporte_coruripe" id="registro_transporte_coruripe" value="{{ old('registro_transporte_coruripe') }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-cyan-500 focus:border-cyan-500">
                            </div>
                            <div>
                                <label for="registro_transporte_terceiros" class="block text-sm font-medium text-gray-700">Registro Terceiros</label>
                                <input type="text" name="registro_transporte_terceiros" id="registro_transporte_terceiros" value="{{ old('registro_transporte_terceiros') }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-cyan-500 focus:border-cyan-500">
                            </div>
                        </div>

                        {{-- BOTÕES --}}
                        <div class="flex items-center space-x-4 pt-4">
                            <button type="submit"
                                class="px-6 py-2 bg-cyan-600 text-white rounded-lg shadow hover:bg-cyan-700 transition">
                                Salvar
                            </button>
                            <a href="{{ route('dockings.index') }}"
                                class="px-6 py-2 bg-gray-300 text-gray-800 rounded-lg shadow hover:bg-gray-400 transition">
                                Cancelar
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
