<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Encostes ferroviário') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3>Safra vigente: <strong>{{$currencyHarvest->title}}</strong></h3>
                    <hr class="my-4">
                    <div class="flex justify-between items-center mb-6">    
                        <h1 class="text-lg font-bold">Encostes de vagões</h1>
                        <!-- Filtro por data -->
                        <form method="GET" action="{{ route('dockings.index') }}" class="flex items-center space-x-2">
                            <input type="date" name="start_date" value="{{ request('start_date') }}"
                                class="border rounded px-2 py-1 text-sm">
                            <span>a</span>
                            <input type="date" name="end_date" value="{{ request('end_date') }}"
                                class="border rounded px-2 py-1 text-sm">
                            <button type="submit" class="px-3 py-1 bg-cyan-600 text-white rounded hover:bg-cyan-700 text-sm">
                                Filtrar
                            </button>
                            @if(request('start_date') || request('end_date'))
                                <a href="{{ route('dockings.index') }}" 
                                class="px-3 py-1 bg-gray-400 text-white rounded hover:bg-gray-500 text-sm">
                                    Limpar
                                </a>
                            @endif
                        </form>
                        <a href="{{ route('dockings.create') }}" 
                           class="font-bold px-4 py-2 bg-cyan-600 text-white rounded hover:bg-cyan-700">
                            + Novo encoste
                        </a>
                    </div>

                    <div class="mb-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                        <div class="bg-cyan-100 p-4 rounded shadow text-center">
                            <h4 class="text-sm font-semibold text-gray-700">Quantidade de encostes</h4>
                            <p class="text-xl font-bold text-cyan-800">{{ $dockingsCount }}</p>
                        </div>

                        <div class="bg-green-100 p-4 rounded shadow text-center">
                            <h4 class="text-sm font-semibold text-gray-700">Volume Coruripe</h4>
                            <p class="text-xl font-bold text-green-800">{{ number_format($sumCoruripe, 3, ',', '.') }} t</p>
                        </div>

                        <div class="bg-yellow-100 p-4 rounded shadow text-center">
                            <h4 class="text-sm font-semibold text-gray-700">Volume Rumo</h4>
                            <p class="text-xl font-bold text-yellow-800">{{ number_format($sumRumo, 3, ',', '.') }} t</p>
                        </div>

                        <div class="bg-blue-100 p-4 rounded shadow text-center">
                            <h4 class="text-sm font-semibold text-gray-700">Volume total carregado</h4>
                            <p class="text-xl font-bold text-blue-800">{{ number_format($sumTotal, 3, ',', '.') }} t</p>
                        </div>
                    </div>

                    @if(session('success'))
                        <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
                            {{ session('success') }}
                        </div>
                    @endif

                    <table class="w-full border border-gray-300">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-2 text-left text-sm">Nº encoste</th>
                                <th class="px-4 py-2 text-left text-sm">Destino</th>
                                <th class="px-4 py-2 text-left text-sm">Horário encoste</th>
                                <th class="px-4 py-2 text-left text-sm">Horário partida</th>
                                <th class="px-4 py-2 text-left text-sm">Volume Coruripe</th>
                                <th class="px-4 py-2 text-left text-sm">Volume Rumo</th>
                                <th class="px-4 py-2 text-left text-sm">Volume total</th>
                                <th class="px-4 py-2 text-left text-sm">Status</th>
                                <th class="px-4 py-2 text-center">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($dockings as $docking)
                                @php
                                    $background_class = '';
                                    $text_class = '';

                                    if ($docking->hora_partida) {
                                        // Se tem hora de partida, fica cinza escuro.
                                        $background_class = 'bg-gray-200';
                                        $text_class = 'text-zinc-800';
                                    } elseif ($docking->hora_fim_carga) {
                                        // Se tem hora final de carga, mas não tem hora de partida, fica preto.
                                        $background_class = 'bg-black';
                                        $text_class = 'text-white';
                                    } elseif ($docking->hora_inicio_carga) {
                                        // Se tem hora de inicio de carga, mas não tem hora de final de carga, fica azul claro.
                                        $background_class = 'bg-blue-200';
                                        $text_class = 'text-black';
                                    } elseif ($docking->hora_encoste) {
                                        // Se tem hora de encoste, mas ainda não tem hora inicio de carga, fica laranja claro.
                                        $background_class = 'bg-orange-200';
                                        $text_class = 'text-black';
                                    } else {
                                        // Caso padrão, se não houver nenhuma das horas preenchidas.
                                        $background_class = 'bg-white';
                                        $text_class = 'text-black';
                                    }
                                @endphp

                                <tr class="border-t {{ $background_class }} {{ $text_class }}">
                                    <td class="px-4 py-2 text-xs">{{ $docking->numero_encoste }}</td>
                                    <td class="px-4 py-2 text-sm">{{ $docking->port->title }}</td>
                                    <td class="px-4 py-2 text-xs">{{ $docking->hora_encoste_formatted }}</td>
                                    <td class="px-4 py-2 text-xs">{{ $docking->hora_partida_formatted }}</td>
                                    <td class="px-4 py-2 text-xs">{{ $docking->peso_proprio_formatted }}</td>
                                    <td class="px-4 py-2 text-sm">{{ $docking->peso_terceiros_formatted }}</td>
                                    <td class="px-4 py-2 text-sm">{{ $docking->volume_total }}</td>
                                    <td class="px-4 py-2 text-sm">
                                        @if ($docking->hora_partida) Tracionado
                                        @elseif ($docking->hora_fim_carga) Aguardando tração
                                        @elseif ($docking->hora_inicio_carga) Em operação
                                        @elseif ($docking->hora_encoste) Aguardando início
                                        @else nao sei
                                        @endif
                                    </td>
                                    <td class="px-4 py-2 text-center flex justify-center space-x-3 gap-3">
                                        <a href="{{ route('dockings.edit', $docking) }}" class="text-yellow-600 hover:underline">
                                            <>
                                        </a>
                                        <button type="submit" class="text-cyan-600 hover:underline">
                                            +
                                        </button>
                                        <form action="{{ route('dockings.destroy', $docking) }}" method="POST"
                                            onsubmit="return confirm('Tem certeza que deseja excluir este encoste?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:underline">
                                                -
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-4 py-4 text-center text-gray-500">
                                        Nenhum registro cadastrado.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <div class="mt-4">
                        {{ $dockings->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
