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
                    
                    <h1 class="text-lg font-bold mb-6">Aprovar cadastro de usuário <strong class="text-red-600">{{ $user->firstname }} {{ $user->lastname }}</strong></h1>

                    @if ($errors->any())
                        <div class="mb-4 p-3 bg-red-100 text-red-800 rounded">
                            <ul class="list-disc pl-5">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('users.update', $user) }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div>
                                <label for="role" class="block text-sm font-medium text-gray-700">Funçãoo <strong class="text-red-600">*</strong></label>
                                <select name="role" id="role" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    <option value="">Selecione</option>
                                    <option value="admin">Admin</option>
                                    <option value="manager">Analista</option>
                                    <option value="user">Usuário terceiro</option>
                                </select>
                            </div>
                        </div>
                        <div class="flex items-center space-x-4 pt-4">
                            <button type="submit" class="px-6 py-2 bg-cyan-600 text-white rounded-lg shadow hover:bg-cyan-700 transition">
                                APROVAR
                            </button>
                            <a href="{{ route('users.index') }}" class="px-6 py-2 bg-gray-300 text-gray-800 rounded-lg shadow hover:bg-gray-400 transition">
                                CANCELAR
                            </a>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
