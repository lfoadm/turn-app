<x-app-layout>
<x-slot name="header">
<h2 class="font-semibold text-xl text-gray-800 leading-tight">
Cadastro de motivo
</h2>
</x-slot>

<div class="py-12">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                
                <h1 class="text-lg font-bold mb-6">Cadastrar novo motivo de parada</h1>

                @if ($errors->any())
                    <div class="mb-4 p-3 bg-red-100 text-red-800 rounded">
                        <ul class="list-disc pl-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('reasons.update', $reason) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Título -->
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700">Título</label>
                        <input type="text" name="title" id="title"
                            value="{{ old('title', $reason->title) }}"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-cyan-500 focus:ring focus:ring-cyan-200 focus:ring-opacity-50"
                            placeholder="Exemplo: 2023/24"
                            required>
                    </div>

                    <!-- Expurgo (Toggle Switch) -->
                        <div>
                            {{-- <label for="purge" class="block text-sm font-medium text-gray-700 mb-2">Status</label> --}}
                            <label id="purge" class="relative inline-flex items-center cursor-pointer">
                                <!-- hidden para garantir envio do valor false -->
                                <input type="hidden" name="purge" value="0">

                                <!-- checkbox envia 1 quando marcado -->
                                <input type="checkbox" id="purge" name="purge" value="1" class="sr-only peer"
                                    {{ old('purge', $reason->purge) ? 'checked' : '' }}>

                                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 
                                            peer-focus:ring-blue-300 rounded-full peer 
                                            peer-checked:after:translate-x-full peer-checked:after:border-white
                                            after:content-[''] after:absolute after:top-[2px] after:left-[2px]
                                            after:bg-white after:border-gray-300 after:border after:rounded-full
                                            after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600">
                                </div>
                                <span class="ml-3 text-sm font-medium text-gray-900">Expurga</span>
                            </label>
                        </div>


                    <!-- Botões -->
                    <div class="flex items-center space-x-4">
                        <button type="submit"
                                class="px-4 py-2 bg-cyan-600 text-white rounded hover:bg-cyan-700">
                            Salvar
                        </button>
                        <a href="{{ route('reasons.index') }}"
                        class="px-4 py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400">
                            Cancelar
                        </a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

</x-app-layout>