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
                <p class="text-sm font-medium text-gray-500">Tons p/vagão (média)</p>
                <p class="text-2xl font-bold text-gray-800">{{ $indicators['avgTonPerWagon'] }}</p>
            </div>
        </div>

        <!-- Média vagões/hora -->
        <div class="bg-white rounded-2xl shadow p-4 flex items-center gap-4">
            <div class="p-3 bg-purple-100 rounded-full">
                <i data-lucide="clock-8" class="w-6 h-6 text-purple-600"></i>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500">Vagões p/hora (média)</p>
                <p class="text-2xl font-bold text-gray-800">{{ $indicators['avgWagonsPerHour'] }}</p>
            </div>
        </div>

        <!-- Média ton/hora -->
        <div class="bg-white rounded-2xl shadow p-4 flex items-center gap-4">
            <div class="p-3 bg-pink-100 rounded-full">
                <i data-lucide="activity" class="w-6 h-6 text-pink-600"></i>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500">Tons carregadas p/ hora (média)</p>
                <p class="text-2xl font-bold text-gray-800">{{ $indicators['avgTonsPerHour'] }}</p>
            </div>
        </div>

        <!-- Tempo médio início -->
        <div class="bg-white rounded-2xl shadow p-4 flex items-center gap-4">
            <div class="p-3 bg-indigo-100 rounded-full">
                <i data-lucide="timer" class="w-6 h-6 text-indigo-600"></i>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500">Tempo médio p/ início</p>
                <p class="text-2xl font-bold text-gray-800">{{-- $indicators['avgStartDelay'] --}}</p>
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
                <p class="text-2xl font-bold text-gray-800">{{-- $indicators['avgCycleTime'] --}}</p>
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
                <p class="text-2xl font-bold text-gray-800">{{-- $indicators['wagonsOpen'] --}}%</p>
            </div>
        </div>
    </div>
</div>
