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
            <div class="bg-white shadow-lg rounded-2xl p-6">
                <h3 class="text-xl font-bold mb-4">Eficiência do Encoste</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- Paradas por motivo --}}
                    <div>
                        <canvas id="stopsByReasonChart"></canvas>
                    </div>
                    {{-- Tempo de operação vs paradas --}}
                    <div>
                        <canvas id="operationChart"></canvas>
                    </div>
                </div>
            </div>

            {{-- LISTA DE PARADAS --}}
            <div class="bg-white shadow-lg rounded-2xl p-6 mt-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-xl font-bold text-gray-800">Paradas do Encoste</h3>
                    <a href="{{ route('stops.create', $docking->id) }}"
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
                                        <td class="px-4 py-2">{{ $stop->motivo }}</td>
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
        // Paradas por motivo
        const stopsByReasonCtx = document.getElementById('stopsByReasonChart').getContext('2d');
        new Chart(stopsByReasonCtx, {
            type: 'pie',
            data: {
                labels: @json($chartLabels),
                datasets: [{
                    data: @json($chartData),
                    backgroundColor: [
                        '#34d399', '#3b82f6', '#facc15', '#f87171', '#a78bfa', '#2dd4bf'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                plugins: {
                    title: {
                        display: true,
                        text: 'Tempo de paradas por motivo (minutos)',
                        font: { size: 16 }
                    }
                }
            }
        });

        // Tempo de operação vs paradas
        const operationCtx = document.getElementById('operationChart').getContext('2d');
        new Chart(operationCtx, {
            type: 'doughnut',
            data: {
                labels: ['Tempo Operação', 'Tempo Paradas'],
                datasets: [{
                    data: [@json($operationMinutes), @json($totalStopMinutes)],
                    backgroundColor: ['#3b82f6', '#f87171'],
                    borderWidth: 1
                }]
            },
            options: {
                plugins: {
                    title: {
                        display: true,
                        text: 'Proporção de tempo de operação vs paradas',
                        font: { size: 16 }
                    }
                }
            }
        });
    </script>

</x-app-layout>
