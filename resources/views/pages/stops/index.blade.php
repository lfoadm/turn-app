<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Stops') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3>Safra vigente: <strong>Escrever algo!!!</strong></h3>
                    <hr class="my-4">
                    <div class="flex justify-between items-center mb-6">    
                        <h1 class="text-lg font-bold">Lista de paradas no processo de carga de vagões</h1>
                    </div>

                    @if(session('success'))
                        <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
                            {{ session('success') }}
                        </div>
                    @endif

                    <table class="w-full border border-gray-300">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-2 text-left text-sm">ID</th>
                                <th class="px-4 py-2 text-left text-sm">Encoste</th>
                                <th class="px-4 py-2 text-left text-sm">Horário início</th>
                                <th class="px-4 py-2 text-left text-sm">Horário fim</th>
                                <th class="px-4 py-2 text-left text-sm">Duração (min)</th>
                                <th class="px-4 py-2 text-left text-sm">Motivo</th>
                                <th class="px-4 py-2 text-left text-sm">Usuário resp.</th>
                                <th class="px-4 py-2 text-center">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($stops as $stop)
                                <tr class="border-t border-red-600">
                                    <td class="px-4 py-2 text-xs">{{ $stop->id }}</td>
                                    <td class="px-4 py-2 text-xs">{{ $stop->docking->numero_encoste }}</td>
                                    <td class="px-4 py-2 text-xs">{{ $stop->hora_inicio_formatted }}</td>
                                    <td class="px-4 py-2 text-xs">{{ $stop->hora_fim_formatted }}</td>
                                    <td class="px-4 py-2 text-xs">{{ $stop->duracao_minutos }}</td>
                                    <td class="px-4 py-2 text-sm">{{ $stop->motivo }}</td>
                                    <td class="px-4 py-2 text-sm">{{ $stop->user->firstname }}</td>
                                    <td class="px-4 py-2 text-center flex justify-center space-x-3 gap-3">
                                        <a href="{{ route('stops.edit', $stop) }}" class="text-yellow-600 hover:underline">
                                            <>
                                        </a>
                                        <button type="submit" class="text-cyan-600 hover:underline">
                                            +
                                        </button>
                                        <form action="{{ route('stops.destroy', $stop) }}" method="POST"
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
                        {{-- {{ $stops->links() }} --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
