<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Novo Stop') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <h1 class="text-lg font-bold mb-6">
                        Cadastrar parada para o encoste: 
                        <strong class="text-cyan-500">{{ $docking->numero_encoste }}</strong>
                    </h1>

                    @if ($errors->any())
                        <div class="mb-4 p-3 bg-red-100 text-red-800 rounded">
                            <ul class="list-disc pl-5">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('stops.store') }}" method="POST" class="space-y-6">
                        @csrf
                        <input type="hidden" name="docking_id" value="{{$docking->id}}">

                        <!-- Hora Início -->
                        <div>
                            <label for="hora_inicio" class="block text-sm font-medium text-gray-700">Hora Início</label>
                            <input type="datetime-local" name="hora_inicio" id="hora_inicio"
                                value="{{ old('hora_inicio') }}"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-cyan-500 focus:ring focus:ring-cyan-200 focus:ring-opacity-50"
                                required>
                        </div>

                        <!-- Hora Fim -->
                        <div>
                            <label for="hora_fim" class="block text-sm font-medium text-gray-700">Hora Fim</label>
                            <input type="datetime-local" name="hora_fim" id="hora_fim"
                                value="{{ old('hora_fim') }}"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-cyan-500 focus:ring focus:ring-cyan-200 focus:ring-opacity-50"
                                required>
                        </div>

                        <!-- Duração (somente exibição) -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Duração</label>
                            <p id="duracao_texto" class="mt-1 text-gray-900 font-semibold">
                                {{ old('duracao_minutos', 0) }} minutos
                            </p>
                        </div>

                        <!-- Motivo -->
                        <div>
                            <label for="reason_id" class="block text-sm font-medium text-gray-700">Motivo <strong class="text-red-500">*</strong></label>
                            <select name="reason_id" id="reason_id" class="bg-indigo-100 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-cyan-500 focus:border-cyan-500">
                                <option value="">Selecione</option>
                                @foreach($reasons as $reason)
                                    <option value="{{ $reason->id }}">
                                        {{ $reason->title }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        
                        <!-- Observações -->
                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700">Observações</label>
                            <textarea name="description" id="description" rows="3"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-cyan-500 focus:ring focus:ring-cyan-200 focus:ring-opacity-50"
                                placeholder="observações">{{ old('description') }}</textarea>
                        </div>

                        <!-- Botões -->
                        <div class="flex items-center space-x-4">
                            <button type="submit"
                                    class="px-4 py-2 bg-cyan-600 text-white rounded hover:bg-cyan-700">
                                Salvar
                            </button>
                            <a href="{{ route('dockings.index') }}"
                               class="px-4 py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400">
                                Cancelar
                            </a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>

{{-- Script para cálculo dinâmico --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
    const inicio = document.getElementById('hora_inicio');
    const fim = document.getElementById('hora_fim');
    const duracaoTexto = document.getElementById('duracao_texto');

    function calcularDuracao() {
        if (inicio.value && fim.value) {
            const start = new Date(inicio.value);
            const end = new Date(fim.value);

            if (end > start) {
                const diffMs = end - start;
                const diffMin = Math.floor(diffMs / 60000); // ms -> min
                duracaoTexto.textContent = diffMin + ' minutos';
            } else {
                duracaoTexto.textContent = '0 minutos';
            }
        }
    }

    inicio.addEventListener('change', calcularDuracao);
    fim.addEventListener('change', calcularDuracao);
});
</script>
