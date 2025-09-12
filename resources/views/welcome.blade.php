<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Turn App') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        <!-- Styles / Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
    </head>
    <body class="bg-gray-800 text-[#1b1b18] flex p-6 lg:p-8 items-center lg:justify-center min-h-screen flex-col">
        <div class="flex items-center justify-center w-full transition-opacity opacity-100 duration-750 lg:grow starting:opacity-0">
            <main class="flex items-center justify-center w-full min-h-screen transition-opacity opacity-100 duration-750 starting:opacity-0 flex-col bg-gray-800 text-gray-200">
                <img src="{{asset('assets/images/logo-dark.svg')}}" alt="" class="w-64 mb-6 lg:mb-9">
                <div class="flex flex-col items-center justify-center text-center p-6 lg:p-12 max-w-4xl w-full">
                    <h1 class="text-4xl lg:text-6xl font-extrabold text-white dark:text-cyan-400 mb-4 tracking-tight">
                        Gestão Ferroviária Inteligente
                    </h1>
                    <p class="text-lg lg:text-xl text-gray-400 dark:text-gray-300 max-w-2xl mb-12">
                        Controle de ponta para a logística do seu terminal. Otimize a operação de pátio, minimize gargalos e maximize a eficiência no transbordo.
                    </p>

                    <div class="flex flex-col lg:flex-row gap-4 w-full justify-center">
                        <a href="{{ route('login') }}" class="inline-block px-8 py-3 bg-cyan-600 text-white rounded-lg font-semibold shadow-xl hover:bg-cyan-500 transition-colors duration-300 transform hover:scale-105">
                            Acessar Plataforma
                        </a>
                        <a href="{{ route('register') }}" class="inline-block px-8 py-3 border border-gray-600 text-gray-300 rounded-lg font-semibold hover:bg-gray-800 transition-colors duration-300 transform hover:scale-105">
                            Criar Nova Conta
                        </a>
                    </div>
                </div>
                
                <div class="w-full max-w-6xl p-6 lg:p-12 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mt-12">
                    <div class="bg-gray-900 rounded-xl shadow-lg p-8 flex flex-col items-center text-center transition-all hover:scale-105 duration-300">
                        <div class="w-16 h-16 rounded-full bg-cyan-600 flex items-center justify-center mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m-5 4H5a2 2 0 01-2-2V7a2 2 0 012-2h10a2 2 0 012 2v2m-5 8a2 2 0 01-2-2v-8a2 2 0 012-2h8a2 2 0 012 2v8a2 2 0 01-2 2h-8z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold mb-2 text-white">Monitoramento do fluxo de vagões</h3>
                        <p class="text-gray-400">Gerencie o status de cada encoste em tempo real. Visualização intuitiva para decisões ágeis.</p>
                    </div>
                    
                    <div class="bg-gray-900 rounded-xl shadow-lg p-8 flex flex-col items-center text-center transition-all hover:scale-105 duration-300">
                        <div class="w-16 h-16 rounded-full bg-cyan-600 flex items-center justify-center mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold mb-2 text-white">Otimização de Fluxo</h3>
                        <p class="text-gray-400">Ferramentas inteligentes que reduzem o tempo de espera e maximizam a capacidade de manobra de vagões.</p>
                    </div>

                    <div class="bg-gray-900 rounded-xl shadow-lg p-8 flex flex-col items-center text-center transition-all hover:scale-105 duration-300">
                        <div class="w-16 h-16 rounded-full bg-cyan-600 flex items-center justify-center mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold mb-2 text-white">Relatórios e Métricas</h3>
                        <p class="text-gray-400">Acompanhe métricas em tempo real e gere relatórios completos para otimizar suas operações logísticas.</p>
                    </div>
                </div>
            </main>
        </div>

        
    </body>
</html>
