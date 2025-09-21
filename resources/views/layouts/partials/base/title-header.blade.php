<div class="flex justify-between items-center mb-6">
    <!-- Título -->
    <x-title-header></x-title-header>

    <!-- Área flexível: pesquisa + botão -->
    <div class="flex items-center gap-4">
        <!-- Input de pesquisa -->
        <x-input-search></x-input-search>
        

        <!-- Botão de ação -->
        <template x-if="showButton">
            <x-button></x-button>
        </template>
    </div>
</div>