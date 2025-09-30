<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Encoste') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg sm:shadow-md">
                <div class="p-6 text-gray-900">

                    <h1 class="text-lg font-bold mb-6">Editar encoste ferroviário</h1>

                    @if ($errors->any())
                        <div class="mb-4 p-3 bg-red-100 text-red-800 rounded">
                            <ul class="list-disc pl-5">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('dockings.update', $docking->id) }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">

                        {{-- TERMINAL E HORA --}}
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div>
                                <label for="port_id" class="block text-sm font-medium text-gray-700">Terminal portuário destino <strong class="text-red-600">*</strong></label>
                                <select name="port_id" id="port_id"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    <option value="">Selecione</option>
                                    @foreach($ports as $port)
                                        <option value="{{ $port->id }}" {{ $docking->port_id == $port->id ? 'selected' : '' }}>
                                            {{ $port->title }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label for="hora_encoste" class="block text-sm font-medium text-gray-700">Hora do Encoste</label>
                                <input type="datetime-local" id="hora_encoste"
                                    value="{{ $docking->hora_encoste }}"
                                    class="mt-1 block w-full rounded-md border-gray-200 bg-gray-100 text-gray-500 shadow-sm cursor-not-allowed"
                                    disabled>
                                {{-- hidden para manter no update --}}
                                <input type="hidden" name="hora_encoste" value="{{ $docking->hora_encoste }}">
                            </div>

                            <div>
                                <label for="situacao_vagoes" class="block text-sm font-medium text-gray-700">Situação dos Vagões <strong class="text-red-600">*</strong></label>
                                <select name="situacao_vagoes" id="situacao_vagoes"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    <option value="">Selecione</option>
                                    <option value="LIMPOS" {{ $docking->situacao_vagoes == 'LIMPOS' ? 'selected' : '' }}>Limpos</option>
                                    <option value="SUJOS" {{ $docking->situacao_vagoes == 'SUJOS' ? 'selected' : '' }}>Sujos</option>
                                </select>
                            </div>
                        </div>

                        {{-- VAGÕES --}}
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                            <div>
                                <label for="qtd_vagoes_total" class="block text-sm font-medium text-gray-700">Total</label>
                                <input type="number" name="qtd_vagoes_total" value="{{ $docking->qtd_vagoes_total }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            <div>
                                <label for="qtd_vagoes_carregados" class="block text-sm font-medium text-gray-700">Carregados</label>
                                <input type="number" name="qtd_vagoes_carregados" value="{{ $docking->qtd_vagoes_carregados }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            <div>
                                <label for="qtd_vagoes_recusados" class="block text-sm font-medium text-gray-700">Recusados</label>
                                <input type="number" name="qtd_vagoes_recusados" value="{{ $docking->qtd_vagoes_recusados }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            <div>
                                <label for="qtd_vagoes_abertos" class="block text-sm font-medium text-gray-700">Abertos</label>
                                <input type="number" name="qtd_vagoes_abertos" value="{{ $docking->qtd_vagoes_abertos }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            </div>
                        </div>

                        {{-- HORÁRIOS --}}
                        <div class="grid grid-cols-1 md:grid-cols-6 gap-6">
                            <div>
                                <label for="hora_inicio_carga" class="block text-sm font-medium text-gray-700">Início da Carga</label>
                                <input type="datetime-local" name="hora_inicio_carga" value="{{ $docking->hora_inicio_carga }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            <div>
                                <label for="hora_fim_carga" class="block text-sm font-medium text-gray-700">Fim da Carga</label>
                                <input type="datetime-local" name="hora_fim_carga" value="{{ $docking->hora_fim_carga }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            <div>
                                <label for="hora_partida" class="block text-sm font-medium text-gray-700">Partida</label>
                                <input type="datetime-local" name="hora_partida" value="{{ $docking->hora_partida }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            <div>
                                <label for="status" class="block text-sm font-medium text-gray-700">Status carregamento <strong class="text-red-600">*</strong></label>
                                <select name="status" id="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    <option value="">Selecione</option>
                                        <option value="waiting">Aguardando</option>
                                        <option value="progress" selected>Em operação</option>
                                        <option value="finished">Finalizado</option>
                                </select>
                            </div>
                        </div>

                        {{-- PESOS --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="peso_proprio" class="block text-sm font-medium text-gray-700">Peso Próprio (t)</label>
                                <input type="number" step="0.001" name="peso_proprio" id="peso_proprio"
                                    value="{{ old('peso_proprio', $docking->peso_proprio) }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            <div>
                                <label for="peso_terceiros" class="block text-sm font-medium text-gray-700">Peso Terceiros (t)</label>
                                <input type="number" step="0.001" name="peso_terceiros" id="peso_terceiros"
                                    value="{{ old('peso_terceiros', $docking->peso_terceiros) }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            </div>
                        </div>
                        {{-- PREFIXOS E REGISTROS --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="prefixo_chegada" class="block text-sm font-medium text-gray-700">Prefixo Chegada</label>
                                <input type="text" name="prefixo_chegada" value="{{ $docking->prefixo_chegada }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            <div>
                                <label for="prefixo_saida" class="block text-sm font-medium text-gray-700">Prefixo Saída</label>
                                <input type="text" name="prefixo_saida" value="{{ $docking->prefixo_saida }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div>
                                <label for="os_partida_rumo" class="block text-sm font-medium text-gray-700">OS Partida Rumo</label>
                                <input type="text" name="os_partida_rumo" value="{{ $docking->os_partida_rumo }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            <div>
                                <label for="registro_transporte_coruripe" class="block text-sm font-medium text-gray-700">Registro Coruripe</label>
                                <input type="text" name="registro_transporte_coruripe" value="{{ $docking->registro_transporte_coruripe }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            <div>
                                <label for="registro_transporte_terceiros" class="block text-sm font-medium text-gray-700">Registro Terceiros</label>
                                <input type="text" name="registro_transporte_terceiros" value="{{ $docking->registro_transporte_terceiros }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            </div>
                        </div>

                        {{-- BOTÕES --}}
                        <div class="flex items-center space-x-4 pt-4">
                            <button type="submit"
                                class="px-6 py-2 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700 transition">
                                Atualizar
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

{{-- Máscara simples para números decimais --}}
<script>
    document.querySelectorAll('.decimal-input').forEach(input => {
        input.addEventListener('input', function () {
            this.value = this.value.replace(/[^0-9,]/g, '').replace(/(\,\d{3})\d+$/, '$1');
        });
    });
</script>