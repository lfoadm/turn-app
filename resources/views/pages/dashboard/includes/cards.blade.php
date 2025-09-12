<div class="bg-white p-2">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">

        <div class="relative bg-gradient-to-br from-[#ff7700] to-[#ff9900] text-white p-6 rounded-3xl shadow-lg transform transition duration-300 hover:scale-105">
            <div class="flex items-center gap-3">
                <div class="flex-shrink-0">
                    <img src="{{ asset('assets/images/coruripe-logo.svg') }}" class="w-16 " alt="" srcset="">
                </div>
                <div>
                    <h3 class="text-lg font-semibold">Coruripe</h3>
                    <p class="mt-1 text-xl font-bold">{{ $indicators['coruripeTotalFormat'] }}</p>
                    <p class="mt-2 text-xs opacity-80">Volume carregado para Coruripe na safra
                        
                        {{ $indicators['selectedHarvest']?->title ?? '' }}
                        
                    </p>
                </div>
            </div>
        </div>

        <div class="relative bg-white p-6 rounded-3xl shadow-lg border border-gray-200 transform transition duration-300 hover:scale-105">
            <div class="absolute inset-0 bg-blue-500 rounded-3xl opacity-10"></div>
            <div class="flex items-center space-x-4">
                <div class="flex-shrink-0">
                    <img src="{{ asset('assets/images/rumo-logo.svg') }}" class="w-32 " alt="" srcset="">
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-800">Rumo</h3>
                    <p class="mt-1 text-xl font-bold text-blue-600">{{ $indicators['rumoTotalFormat'] }}</p>
                    <p class="mt-2 text-xs text-gray-500">Volume carregado para Coruripe na safra
                        {{ $indicators['selectedHarvest']?->title ?? '' }}
                    </p>
                </div>
            </div>
        </div>

        <div class="relative bg-white p-6 rounded-3xl shadow-lg border border-gray-200 transform transition duration-300 hover:scale-105">
            <div class="absolute inset-0 bg-green-500 rounded-3xl opacity-10"></div>
            <div class="flex items-center space-x-4">
                <div class="flex-shrink-0">
                    <svg class="h-10 w-10 text-green-800" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-800">Volume total</h3>
                    <p class="mt-1 text-xl font-bold text-green-600">{{ $indicators['pitTotalFormat'] }}</p>
                    <p class="mt-2 text-xs text-green-900">Volume total carregado em PIT
                        Safra <strong class="text-xl">
                            {{ $indicators['selectedHarvest']?->title ?? '' }}
                        </strong>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>