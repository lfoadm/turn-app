<x-app-layout>
    <div class="mx-auto max-w-[1440px] p-4 md:p-6">
        <!-- Breadcrumb / Título -->
        <div x-data="{ pageName: `Grupo de usuários` }" class="px-3 py-2">
            @include('layouts.partials.base.breadcrumb')
        </div>

        <!-- Container -->
        <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03] shadow-sm">
            <!-- Cabeçalho -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between my-4 px-4">
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                         stroke-width="1.5" stroke="currentColor"
                         class="size-6 text-cyan-600 mr-2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 
                                 3 3 0 0 0-4.682-2.72m.94 3.198
                                 .001.031c0 .225-.012.447-.037.666
                                 A11.944 11.944 0 0 1 12 21
                                 c-2.17 0-4.207-.576-5.963-1.584
                                 A6.062 6.062 0 0 1 6 18.719m12 0
                                 a5.971 5.971 0 0 0-.941-3.197m0 
                                 0A5.995 5.995 0 0 0 12 12.75
                                 a5.995 5.995 0 0 0-5.058 2.772m0 0
                                 a3 3 0 0 0-4.681 2.72
                                 8.986 8.986 0 0 0 3.74.477m.94-3.197
                                 a5.971 5.971 0 0 0-.94 3.197M15 
                                 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3
                                 a2.25 2.25 0 1 1-4.5 0 
                                 2.25 2.25 0 0 1 4.5 0Zm-13.5 0
                                 a2.25 2.25 0 1 1-4.5 0 
                                 2.25 2.25 0 0 1 4.5 0Z"/>
                    </svg>
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">
                        Grupo de Usuários - {{ $role->name }}
                    </h3>
                </div>
            </div>

            <div class="border-t border-gray-100 p-5 dark:border-gray-800 sm:p-6">
                <!-- Mensagens -->
                <x-alert-error></x-alert-error>
                <x-alert-success></x-alert-success>

                <!-- Informações básicas -->
                <div class="mb-6">
                    <p class="text-gray-700 dark:text-gray-300">
                        <span class="font-semibold">Nome:</span> 
                        <strong class="text-3xl text-cyan-800 dark:text-cyan-600">{{ $role->name }}</strong>
                    </p>
                    <p class="text-gray-500 text-sm">
                        Criado em {{ $role->created_at->format('d/m/Y H:i') }}
                    </p>
                    <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                        Total de permissões: <span class="font-medium">{{ $permissionsCount }}</span>
                    </p>
                </div>
                <div class="text-2xl text-slate-600 dark:text-slate-300 mb-6">
                    <h2>Ajuste ações e permissões do grupo de usuário:</h2>
                </div>

                <!-- Lista de permissões -->
                <form method="POST" action="{{ route('roles.updatePermissions', $role->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="flex justify-between md:justify-end gap-6 my-6">
                        <div>
                            <a href="{{ route('roles.index') }}">
                                <x-secondary-button>{{ __('Back') }}</x-secondary-button>
                            </a>
                        </div>
                        <div>
                            <x-primary-button>
                                Salvar Alterações
                            </x-primary-button>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($permissionsByModel as $model => $permissions)
                            <div class="border rounded-xl p-5 bg-gray-50 dark:bg-white/[0.02] shadow-md">
                                <div class="flex items-center justify-between mb-4 pb-4 border-b border-gray-200 dark:border-gray-700">
                                    <h4 class="font-bold text-lg text-gray-600 dark:text-gray-400">
                                        {{ $modelLabels[$model] ?? ucfirst($model) }}
                                    </h4>
                                    <label class="flex items-center space-x-2 text-xs font-semibold text-cyan-600 dark:text-cyan-400 cursor-pointer">
                                        <input type="checkbox"
                                            class="select-all rounded border-gray-300 text-cyan-600 focus:ring-cyan-500 dark:bg-gray-800 dark:border-gray-700"
                                            data-group="{{ $model }}">
                                        <span>Selecionar tudo</span>
                                    </label>
                                </div>

                                <div class="space-y-4">
                                    @foreach($permissions as $permission)
                                        @php
                                            $action = Str::after($permission->name, '.');
                                        @endphp
                                    
                                        <label class="flex items-center space-x-2 cursor-pointer group">
                                            <input type="checkbox"
                                                name="permissions[]"
                                                value="{{ $permission->id }}"
                                                @checked($role->permissions->contains($permission->id))
                                                class="perm-checkbox sr-only peer"
                                                data-group="{{ $model }}">  {{-- 👈 adicionei o data-group --}}
                                                {{-- TOGGLE SWITCH --}}
                                                <div class="w-11 h-6 bg-gray-300 dark:bg-gray-600 rounded-full relative transition-colors duration-300 ease-in-out  peer-checked:bg-green-500 dark:peer-checked:bg-green-400 after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:h-5 after:w-5 after:bg-white after:rounded-full after:transition-all peer-checked:after:translate-x-5"></div>

                                            <span class="text-sm text-gray-700 dark:text-gray-300 group-hover:text-cyan-600 dark:group-hover:text-cyan-400 transition-colors duration-300 ease-in-out">
                                                {{ $actionLabels[$action] ?? ucfirst($action) }}
                                            </span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-6 flex justify-end">
                        <x-primary-button>
                            Salvar Alterações
                        </x-primary-button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const permSelector = '.perm-checkbox';

    // Atualiza o estado do "select-all" para um grupo específico
    const updateSelectAllState = (group) => {
        const items = Array.from(document.querySelectorAll(`${permSelector}[data-group="${group}"]`))
                           .filter(cb => !cb.disabled);
        const selectAll = document.querySelector(`.select-all[data-group="${group}"]`);
        if (!selectAll) return;

        if (items.length === 0) {
            selectAll.checked = false;
            return;
        }

        const allChecked = items.every(cb => cb.checked);
        selectAll.checked = allChecked;
    };

    // Inicializa: para cada select-all, define o estado e adiciona listener
    document.querySelectorAll('.select-all').forEach(selectAll => {
        const group = selectAll.dataset.group;
        // Inicializa o estado visual do select-all baseado nos filhos
        updateSelectAllState(group);

        // Quando clicar em "Selecionar tudo"
        selectAll.addEventListener('change', function () {
            const isChecked = this.checked;
            document.querySelectorAll(`${permSelector}[data-group="${group}"]`).forEach(cb => {
                if (cb.checked !== isChecked) {
                    cb.checked = isChecked;
                    // dispara event para que o peer CSS e quaisquer listeners internos respondam
                    cb.dispatchEvent(new Event('change', { bubbles: true }));
                }
            });
        });
    });

    // Para cada checkbox filho, atualiza o select-all do seu grupo quando mudar
    // (isso cobre cliques manuais no toggle)
    document.querySelectorAll(permSelector).forEach(cb => {
        cb.addEventListener('change', function () {
            const group = this.dataset.group;
            updateSelectAllState(group);
        });
    });
});
</script>
