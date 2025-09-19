<div class="flex justify-between items-center mb-6">
    <h1 class="text-xl font-semibold dark:text-gray-100" x-text="title"></h1>

    <template x-if="showButton">
        @include('layouts.partials.ui.button.button-01')
    </template>
</div>