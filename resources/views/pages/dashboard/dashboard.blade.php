    <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Painel') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @if (Auth::user()->role == 'new')
                    <div class="p-6 text-gray-900">
                        <p class="text-red-600">Sua conta foi criada e está em análise...</p>
                    </div>
                @else
                <div class="p-2 text-gray-900 mt-6">
                    <div class="p-4 bg-gray-50 rounded-lg shadow-sm">
                        <div class="mb-4 flex flex-col sm:flex-row sm:items-center sm:justify-between">
                            <h1 class="text-xl sm:text-2xl font-semibold text-gray-800 mb-2 sm:mb-0">
                                Safra atual: <strong class="text-cyan-600">{{ $activeHarvest->title }}</strong>
                            </h1>

                            <form method="GET" action="{{ route('dashboard') }}" class="w-full sm:w-auto flex flex-col sm:flex-row sm:items-center space-y-3 sm:space-y-0 sm:space-x-3">
                                <div class="flex items-center space-x-2">
                                    <input type="date"
                                        name="start_date"
                                        id="start_date"
                                        value="{{ request('start_date') }}"
                                        class="w-full sm:w-auto form-input block rounded-md border-gray-300 shadow-sm focus:border-cyan-500 focus:ring-cyan-500 text-sm"
                                        placeholder="Data de Início">
                                    
                                    <span class="text-gray-500">a</span>
                                    
                                    <input type="date"
                                        name="end_date"
                                        id="end_date"
                                        value="{{ request('end_date') }}"
                                        class="w-full sm:w-auto form-input block rounded-md border-gray-300 shadow-sm focus:border-cyan-500 focus:ring-cyan-500 text-sm"
                                        placeholder="Data de Fim">
                                </div>

                                <div class="flex space-x-2">
                                    <button type="submit"
                                            class="w-full text-xl sm:w-auto flex items-center justify-center px-4 py-2 border border-transparent font-medium rounded-md shadow-sm text-white bg-cyan-600 hover:bg-cyan-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500">
                                        Filtrar
                                    </button>

                                    @if(request('start_date') || request('end_date'))
                                        <a href="{{ route('dashboard') }}"
                                        class="w-full sm:w-auto flex items-center justify-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-200">
                                            Limpar
                                        </a>
                                    @endif
                                </div>
                            </form>
                        </div>
                    </div>
                    <hr class="my-4">
                
                <div class="bg-white p-3">
                    @include('pages.dashboard.includes.cards')
                    <div class="p-6 bg-gray-100 rounded-md">
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

                            <!-- Encostes no período -->
                            <div class="bg-white rounded-2xl shadow p-4 flex items-center gap-4">
                                <div class="p-3 bg-green-100 rounded-full">
                                    <i data-lucide="train" class="w-6 h-6 text-green-600"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Encostes no período</p>
                                    <p class="text-2xl font-bold text-gray-800">{{ $indicators['dockingsCount'] }}</p>
                                </div>
                            </div>

                            <!-- Toneladas totais -->
                            <div class="bg-white rounded-2xl shadow p-4 flex items-center gap-4">
                                <div class="p-3 bg-blue-100 rounded-full">
                                    <i data-lucide="package" class="w-6 h-6 text-blue-600"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Toneladas totais</p>
                                    <p class="text-2xl font-bold text-gray-800">
                                        {{ number_format($indicators['sumTotal'], 0, ',', '.') }}
                                    </p>
                                </div>
                            </div>

                            <!-- Média ton/vagão -->
                            <div class="bg-white rounded-2xl shadow p-4 flex items-center gap-4">
                                <div class="p-3 bg-yellow-100 rounded-full">
                                    <i data-lucide="scale" class="w-6 h-6 text-yellow-600"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Média ton/vagão</p>
                                    <p class="text-2xl font-bold text-gray-800">{{ $indicators['avgTonPerWagon'] }}</p>
                                </div>
                            </div>

                            <!-- Média vagões/hora -->
                            <div class="bg-white rounded-2xl shadow p-4 flex items-center gap-4">
                                <div class="p-3 bg-purple-100 rounded-full">
                                    <i data-lucide="clock-8" class="w-6 h-6 text-purple-600"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Média vagões/hora</p>
                                    <p class="text-2xl font-bold text-gray-800">{{ $indicators['avgWagonsPerHour'] }}</p>
                                </div>
                            </div>

                            <!-- Média ton/hora -->
                            <div class="bg-white rounded-2xl shadow p-4 flex items-center gap-4">
                                <div class="p-3 bg-pink-100 rounded-full">
                                    <i data-lucide="activity" class="w-6 h-6 text-pink-600"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Média ton/hora</p>
                                    <p class="text-2xl font-bold text-gray-800">{{ $indicators['avgTonsPerHour'] }}</p>
                                </div>
                            </div>

                            <!-- Tempo médio início -->
                            <div class="bg-white rounded-2xl shadow p-4 flex items-center gap-4">
                                <div class="p-3 bg-indigo-100 rounded-full">
                                    <i data-lucide="timer" class="w-6 h-6 text-indigo-600"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Tempo médio início (min)</p>
                                    <p class="text-2xl font-bold text-gray-800">{{ $indicators['avgStartDelay'] }}</p>
                                </div>
                            </div>

                            <!-- Tempo médio carga -->
                            <div class="bg-white rounded-2xl shadow p-4 flex items-center gap-4">
                                <div class="p-3 bg-red-100 rounded-full">
                                    <i data-lucide="loader" class="w-6 h-6 text-red-600"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Tempo médio carga (horas)</p>
                                    <p class="text-2xl font-bold text-gray-800">{{ $indicators['avgLoadingTime'] }}</p>
                                </div>
                            </div>

                            <!-- Tempo médio ciclo -->
                            <div class="bg-white rounded-2xl shadow p-4 flex items-center gap-4">
                                <div class="p-3 bg-teal-100 rounded-full">
                                    <i data-lucide="repeat" class="w-6 h-6 text-teal-600"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Tempo médio ciclo (horas)</p>
                                    <p class="text-2xl font-bold text-gray-800">{{ $indicators['avgCycleTime'] }}</p>
                                </div>
                            </div>

                            <!-- Aproveitamento -->
                            <div class="bg-white rounded-2xl shadow p-4 flex items-center gap-4">
                                <div class="p-3 bg-green-100 rounded-full">
                                    <i data-lucide="check-circle" class="w-6 h-6 text-green-600"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Aproveitamento (%)</p>
                                    <p class="text-2xl font-bold text-gray-800">{{ $indicators['wagonUtilizationRate'] }}%</p>
                                </div>
                            </div>

                            <!-- Recusa -->
                            <div class="bg-white rounded-2xl shadow p-4 flex items-center gap-4">
                                <div class="p-3 bg-orange-100 rounded-full">
                                    <i data-lucide="x-circle" class="w-6 h-6 text-orange-600"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Recusa (%)</p>
                                    <p class="text-2xl font-bold text-gray-800">{{ $indicators['wagonRefusalRate'] }}%</p>
                                </div>
                            </div>

                            <!-- Vagoes abertos -->
                            <div class="bg-white rounded-2xl shadow p-4 flex items-center gap-4">
                                <div class="p-3 bg-cyan-100 rounded-full">
                                    <i data-lucide="factory" class="w-6 h-6 text-cyan-600"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Vagões abertos (%)</p>
                                    <p class="text-2xl font-bold text-gray-800">{{ $indicators['wagonsOpen'] }}%</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    lucide.createIcons();
</script>