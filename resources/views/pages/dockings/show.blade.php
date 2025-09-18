<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detalhes do Encoste') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto sm:px-6 lg:px-8">
            
            {{-- CARD PRINCIPAL DO ENCOSTE --}}
            <div class="bg-white shadow-lg rounded-2xl p-6 mb-3">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-2xl font-bold text-cyan-700">
                        Encoste nº {{ $docking->numero_encoste }}
                    </h3>
                    <a href="{{ route('dockings.index') }}"
                       class="px-4 py-2 bg-gray-200 rounded-lg hover:bg-gray-300 text-sm font-semibold">
                        ← Voltar
                    </a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div class="bg-indigo-100 p-4 rounded-xl shadow">
                        <p class="text-xs text-gray-500">Destino</p>
                        <p class="text-lg font-bold ">{{ $docking->port->title }}</p>
                    </div>
                    <div class="bg-indigo-100 p-4 rounded-xl shadow">
                        <p class="text-xs text-gray-500">Horário Encoste</p>
                        <p class="text-lg font-semibold">{{ $docking->hora_encoste_formatted }}</p>
                    </div>
                    <div class="bg-indigo-100 p-4 rounded-xl shadow">
                        <p class="text-xs text-gray-500">Horário Partida</p>
                        <p class="text-lg font-semibold">{{ $docking->hora_partida_formatted ?? '-' }}</p>
                    </div>
                    <div class="bg-indigo-100 p-4 rounded-xl shadow">
                        <p class="text-xs text-gray-500">Volume Coruripe</p>
                        <p class="text-lg font-bold text-green-700">{{ $docking->peso_proprio_formatted }}</p>
                    </div>
                    <div class="bg-indigo-100 p-4 rounded-xl shadow">
                        <p class="text-xs text-gray-500">Volume Rumo</p>
                        <p class="text-lg font-bold text-yellow-700">{{ $docking->peso_terceiros_formatted }}</p>
                    </div>
                    <div class="bg-indigo-100 p-4 rounded-xl shadow">
                        <p class="text-xs text-gray-500">Volume Total</p>
                        <p class="text-lg font-bold text-purple-700">{{ $docking->volume_total }}</p>
                    </div>
                    <div class="bg-indigo-100 p-4 rounded-xl shadow">
                        <p class="text-xs text-gray-500">Início do carregamento</p>
                        <p class="text-lg font-bold text-purple-700">{{ $docking->hora_inicio_carga_formatted ?? '-'  }}</p>
                    </div>
                    <div class="bg-indigo-100 p-4 rounded-xl shadow">
                        <p class="text-xs text-gray-500">Fim do carregamento</p>
                        <p class="text-lg font-bold text-purple-700">{{ $docking->hora_fim_carga_formatted ?? '-'   }}</p>
                    </div>
                    <div class="bg-indigo-100 p-4 rounded-xl shadow">
                        <p class="text-xs text-gray-500">Tempo carregamento (desconto das paradas)</p>
                        <p class="text-lg font-bold text-purple-700">{{ $formattedTime }}</p>
                    </div>
                    <div class="bg-indigo-100 p-4 rounded-xl shadow">
                        <p class="text-xs text-gray-500">Total de tempo parado</p>
                        <p class="text-lg font-bold text-red-600">{{ $totalStopFormatted }}</p>
                    </div>
                    <div class="bg-indigo-100 p-4 rounded-xl shadow">
                        <p class="text-xs text-gray-500">Toneladas média por vagão</p>
                        <p class="text-lg font-bold text-purple-700">{{ $tonsPerWagon }}</p>
                    </div>
                    <div class="bg-indigo-100 p-4 rounded-xl shadow">
                        <p class="text-xs text-gray-500">Toneladas média carregadas por hora</p>
                        <p class="text-lg font-bold text-purple-700">{{ $tonsPerHour }}</p>
                    </div>
                    
                </div>

                <div class="mt-6">
                    <span class="px-4 py-2 rounded-lg text-white
                        @if($docking->hora_partida) bg-gray-600
                        @elseif($docking->hora_fim_carga) bg-yellow-600
                        @elseif($docking->hora_inicio_carga) bg-blue-600
                        @elseif($docking->hora_encoste) bg-orange-600
                        @else bg-red-600
                        @endif">
                        @if ($docking->hora_partida) Tracionado
                        @elseif ($docking->hora_fim_carga) Aguardando tração
                        @elseif ($docking->hora_inicio_carga) Em operação
                        @elseif ($docking->hora_encoste) Aguardando início
                        @else Não definido
                        @endif
                    </span>
                </div>
            </div>

            {{-- GRÁFICOS --}}
            <div class="flex justify-center">
                <div class="bg-white shadow-lg rounded-2xl p-6 w-full">
                    <h3 class="text-xl font-bold mb-4">Eficiência do Encoste</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        {{-- Paradas por motivo --}}
                        <div>
                            <canvas id="stopsByReasonChart"></canvas>
                        </div>
                        {{-- Tempo de operação vs paradas --}}
                        <div>
                            <canvas id="operationChart"></canvas>
                        </div>
                        {{-- Vagões abertos x total carregado --}}
                        <div>
                            <canvas id="wagonsChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            {{-- LISTA DE PARADAS --}}
            <div class="bg-white shadow-lg rounded-2xl p-6 mt-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-xl font-bold text-gray-800">Paradas do Encoste</h3>
                    <a href="{{ route('stop.create', $docking->id) }}"
                    class="px-4 py-2 bg-cyan-600 text-white rounded-lg hover:bg-cyan-700">
                        + Nova Parada
                    </a>
                </div>

                @if($docking->stops->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="w-full border border-gray-200 rounded-lg">
                            <thead class="bg-gray-100 text-sm text-gray-600">
                                <tr>
                                    <th class="px-4 py-2 text-left">Início</th>
                                    <th class="px-4 py-2 text-left">Fim</th>
                                    <th class="px-4 py-2 text-left">Motivo</th>
                                    <th class="px-4 py-2 text-center">Duração (min)</th>
                                    <th class="px-4 py-2 text-center">Usuário</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($docking->stops as $stop)
                                    <tr class="border-t hover:bg-gray-50">
                                        <td class="px-4 py-2">{{ $stop->hora_inicio_formatted }}</td>
                                        <td class="px-4 py-2">{{ $stop->hora_fim_formatted }}</td>
                                        <td class="px-4 py-2">{{ $stop->reason->title }}</td>
                                        <td class="px-4 py-2 text-center text-xl font-bold text-cyan-700">
                                            {{ $stop->duracao_minutos }}
                                        </td>
                                        <td class="px-4 py-2 text-center">{{ $stop->user->firstname ?? '-' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-gray-500 text-sm">Nenhuma parada registrada para este encoste.</p>
                @endif
            </div>
        </div>
    </div>

    {{-- Chart.js --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Função utilitária: converte minutos em hh:mm
        function formatMinutesToHHMM(minutes) {
            const h = Math.floor(minutes / 60);
            const m = minutes % 60;
            return `${h.toString().padStart(2, '0')}:${m.toString().padStart(2, '0')}`;
        }

        // Paleta de cores para os motivos
        const reasonColors = [
            '#9ED2BE', // Verde-água
            '#A0D8B3', // Verde-menta
            '#B5EAD7', // Verde pastel claro
            '#C7CEEA', // Azul lavanda
            '#D4ECDD', // Verde claro suave
            '#E9E3D4', // Bege
            '#F2EFEA', // Cinza claro
            '#B0C4DE', // Azul acinzentado
            '#E0BBE4', // Lilás
            '#FEE1E8'  // Rosa claro
        ];

        // --- 1. Paradas por motivo ---
        const stopsByReasonCtx = document.getElementById('stopsByReasonChart').getContext('2d');
        new Chart(stopsByReasonCtx, {
            type: 'pie',
            data: {
                labels: @json($chartLabels),
                datasets: [{
                    data: @json($chartData), // minutos
                    backgroundColor: reasonColors.slice(0, @json(count($chartLabels))),
                    borderWidth: 1
                }]
            },
            options: {
                plugins: {
                    title: {
                        display: true,
                        text: 'Tempo de paradas por motivo (hh:mm)',
                        font: { size: 16 }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                const minutes = context.raw;
                                return `${context.label}: ${formatMinutesToHHMM(minutes)} h`;
                            }
                        }
                    }
                }
            }
        });

        // --- 2. Tempo de operação vs paradas ---
        const operationCtx = document.getElementById('operationChart').getContext('2d');
        new Chart(operationCtx, {
            type: 'doughnut',
            data: {
                labels: ['Tempo Operação', 'Tempo Paradas'],
                datasets: [{
                    data: [@json($operationMinutes), @json($totalStopMinutes)], // minutos
                    backgroundColor: ['#06B6D4', '#ef4444'],
                    borderWidth: 1
                }]
            },
            options: {
                plugins: {
                    title: {
                        display: true,
                        text: 'Proporção de tempo de operação vs paradas (hh:mm)',
                        font: { size: 16 }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                const minutes = context.raw;
                                return `${context.label}: ${formatMinutesToHHMM(minutes)} h`;
                            }
                        }
                    }
                }
            }
        });

        const loadedWagons = @json($docking->qtd_vagoes_carregados);
        const openWagons = @json($docking->qtd_vagoes_abertos);

        // Garante que o número de vagões abertos não exceda o total carregado
        const correctedOpenWagons = Math.min(openWagons, loadedWagons);

        // Calcula o número de vagões carregados que NÃO estavam abertos
        const closedLoadedWagons = loadedWagons - correctedOpenWagons;

        const wagonsCtx = document.getElementById('wagonsChart').getContext('2d');

        new Chart(wagonsCtx, {
            type: 'pie', // Ou 'doughnut'
            data: {
                labels: ['Vagões Abertos', 'Vagões Carregados (Fechados)'],
                datasets: [{
                    data: [correctedOpenWagons, closedLoadedWagons],
                    backgroundColor: ['#e1e1e1', '#ff7700'],
                    borderWidth: 1
                }]
            },
            options: {
                plugins: {
                    title: {
                        display: true,
                        text: 'Proporção de Vagões Carregados',
                        font: { size: 16 }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                const total = context.dataset.data.reduce((sum, val) => sum + val, 0);
                                const value = context.raw;
                                const percentage = total > 0 ? ((value / total) * 100).toFixed(2) + '%' : '0%';
                                return `${context.label}: ${value} (${percentage})`;
                            }
                        }
                    }
                }
            }
        });
    </script>
</x-app-layout>
    