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
                        <h1 class="text-lg font-bold">Lista de usuários cadastrados</h1>
                    </div>
                    
                    @if ($usersPendingCount > 0)
                        <div class="flex justify-between items-center mb-6">
                            <h1 class="text-lg font-bold">Encostes de vagões</h1>
                            <a href="{{ route('users.pending') }}" 
                            class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                                Usuários para aprovação
                            </a>
                        </div>
                    @endif

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
                                <th class="px-4 py-2 text-center">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($users as $user)
                                <tr class="border-t">
                                    <td class="px-4 py-2 text-sm text-gray-400">{{ $user->id }}</td>
                                    <td class="px-4 py-2">{{ $user->firstname }} {{ $user->lastname }}</td>
                                    <td class="px-4 py-2 text-sm text-gray-400">{{ $user->email }}</td>
                                    <td class="px-4 py-2 text-sm text-gray-400">{{ $user->role }}</td>
                                    <td class="px-4 py-2 text-center flex justify-center space-x-3">
                                        <a href="{{ route('users.edit', $user) }}" class="text-yellow-600 hover:underline">Editar</a>
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
                        {{ $users->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
