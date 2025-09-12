<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Usuários') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <div class="flex justify-between items-center mb-6">
                        <h1 class="text-lg font-bold text-red-500">Lista de usuários para aprovação</h1>
                    </div>
                    
                    @if(session('success'))
                        <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
                            {{ session('success') }}
                        </div>
                    @endif

                    <table class="w-full border border-gray-300 shadow-lg rounded-md">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-2 text-left">Cód</th>
                                <th class="px-4 py-2 text-left">Nome</th>
                                <th class="px-4 py-2 text-left">E-mail</th>
                                <th class="px-4 py-2 text-left">Tipo</th>
                                <th class="px-4 py-2 text-center">Apontar função</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($usersPending as $userPending)
                                <tr class="border-t">
                                    <td class="px-4 py-2 text-sm text-gray-400">{{ $userPending->id }}</td>
                                    <td class="px-4 py-2">{{ $userPending->firstname }} {{ $userPending->lastname }}</td>
                                    <td class="px-4 py-2 text-sm text-gray-400">{{ $userPending->email }}</td>
                                    <td class="px-4 py-2 text-sm text-gray-400">{{ $userPending->role }}</td>
                                    <td class="px-4 py-2 text-center flex justify-center space-x-3">
                                        <a href="{{ route('users.edit', $userPending) }}" class="text-yellow-600 hover:underline">Editar</a>
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
                        {{-- {{ $users->links() }} --}}
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
