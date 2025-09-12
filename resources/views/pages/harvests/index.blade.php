<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Safras') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <div class="flex justify-between items-center mb-6">
                        <h1 class="text-lg font-bold">Período safra</h1>
                        <a href="{{ route('harvests.create') }}" 
                           class="font-bold px-4 py-2 bg-cyan-600 text-white rounded hover:bg-cyan-700">
                            + Nova safra
                        </a>
                    </div>

                    @if(session('success'))
                        <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
                            {{ session('success') }}
                        </div>
                    @endif

                    <table class="w-full border border-gray-300 shadow-lg rounded-md">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-2 text-left">Título</th>
                                <th class="px-4 py-2 text-left">Situação</th>
                                <th class="px-4 py-2 text-center">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($harvests as $harvest)
                                <tr class="border-t">
                                    <td class="px-4 py-2">{{ $harvest->title }}</td>
                                    <td class="px-4 py-2">
                                        <span class="{{ $harvest->is_active ? 'text-green-600 font-bold bg-green-200 px-3 py-1 text-sm rounded-full' : 'text-red-600 font-bold bg-red-200 px-3 py-1 text-sm rounded-full' }}">
                                            {{ $harvest->is_active ? 'ATIVA' : 'INATIVA' }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-2 text-center flex justify-center space-x-3">
                                        <a href="{{ route('harvests.edit', $harvest) }}" class="text-yellow-600 hover:underline">Editar</a>
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
                        {{ $harvests->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
