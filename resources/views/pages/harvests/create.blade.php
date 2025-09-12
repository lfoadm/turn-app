<x-app-layout>
<x-slot name="header">
<h2 class="font-semibold text-xl text-gray-800 leading-tight">
{{ __('Nova safra') }}
</h2>
</x-slot>

<div class="py-12">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                
                <h1 class="text-lg font-bold mb-6">Cadastrar novo período de safra</h1>

                @if ($errors->any())
                    <div class="mb-4 p-3 bg-red-100 text-red-800 rounded">
                        <ul class="list-disc pl-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('harvests.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <!-- Título -->
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700">Título</label>
                        <input type="text" name="title" id="title"
                            value="{{ old('title') }}"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                            placeholder="Exemplo: 2023/24"
                            required>
                    </div>

                    <!-- Status (Toggle Switch) -->
                    <div>
                        <label for="is_active" class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                        <label id="is_active" class="relative inline-flex items-center cursor-pointer">
                            <!-- hidden para garantir envio do valor false -->
                            <input type="hidden" name="is_active" value="0">

                            <!-- checkbox envia 1 quando marcado -->
                            <input type="checkbox" id="is_active" name="is_active" value="1"
                                class="sr-only peer" {{ old('is_active', $model->is_active ?? false) ? 'checked' : '' }}>

                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 
                                        peer-focus:ring-blue-300 rounded-full peer 
                                        peer-checked:after:translate-x-full peer-checked:after:border-white
                                        after:content-[''] after:absolute after:top-[2px] after:left-[2px]
                                        after:bg-white after:border-gray-300 after:border after:rounded-full
                                        after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600">
                            </div>

                            <span class="ml-3 text-sm font-medium text-gray-900">Ativa</span>
                        </label>
                    </div>


                    <!-- Botões -->
                    <div class="flex items-center space-x-4">
                        <button type="submit"
                                class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                            Salvar
                        </button>
                        <a href="{{ route('harvests.index') }}"
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

{{-- <script>
document.addEventListener('DOMContentLoaded', function() {
const checkbox = document.getElementById('is_active_checkbox');
const hiddenInput = document.getElementById('is_active_hidden');

    // Define a lógica para o evento de mudança
    checkbox.addEventListener(&#39;change&#39;, function() {
        hiddenInput.value = this.checked ? &#39;1&#39; : &#39;0&#39;;
    });

    // Configura o estado inicial do toggle com base no valor antigo
    const oldIsActive = &#39;{{ old(&#39;is_active&#39;) }}&#39;;
    if (oldIsActive === &#39;1&#39;) {
        checkbox.checked = true;
    }
    // Garante que o valor do input hidden seja atualizado no carregamento
    hiddenInput.value = checkbox.checked ? &#39;1&#39; : &#39;0&#39;;
});

</script> --}}