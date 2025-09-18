<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100">
            {{ __('Terminais portuários') }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-900 shadow-lg rounded-2xl overflow-hidden transition">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                    <!-- Título + Botão -->
                    <div class="flex justify-between items-center mb-6">
                        <h1 class="text-xl font-semibold">📍 Terminais Portuários</h1>
                        <a href="{{ route('ports.create') }}" 
                           class="inline-block px-5 py-2 rounded-xl font-medium text-white bg-cyan-600 hover:bg-cyan-700 dark:bg-cyan-500 dark:hover:bg-cyan-600 transition">
                            + Novo Terminal
                        </a>
                    </div>

                    <!-- Mensagem de sucesso -->
                    @if(session('success'))
                        <div class="mb-4 p-4 rounded-xl bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200 shadow-sm">
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- Tabela -->
                    <div class="overflow-x-auto rounded-xl border border-gray-200 dark:border-gray-700 shadow-md">
                        <table class="w-full text-left text-sm">
                            <thead class="bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-200 uppercase text-xs">
                                <tr>
                                    <th class="px-6 py-3">Nome</th>
                                    <th class="px-6 py-3">Descrição</th>
                                    <th class="px-6 py-3 text-center">Ações</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                @forelse($ports as $port)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-800 transition">
                                        <td class="px-6 py-4 font-medium">{{ $port->title }}</td>
                                        <td class="px-6 py-4">{{ $port->description ?? '-' }}</td>
                                        <td class="px-6 py-4 text-center">
                                            <div class="flex justify-center gap-4">
                                                <a href="{{ route('ports.edit', $port) }}" 
                                                   class="text-yellow-600 dark:text-yellow-400 hover:underline font-medium">
                                                    Editar
                                                </a>
                                                
                                                <form action="{{ route('ports.destroy', $port) }}" 
                                                      method="POST" 
                                                      onsubmit="return confirm('Tem certeza que deseja excluir este terminal?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 dark:text-red-400 hover:underline font-medium">
                                                        Excluir
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="px-6 py-6 text-center text-gray-500 dark:text-gray-400">
                                            Nenhum registro cadastrado.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Paginação -->
                    <div class="mt-6">
                        {{ $ports->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
