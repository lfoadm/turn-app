<x-app-layout>
    <div class="mx-auto max-w-[1440px] p-4 md:p-6">
        <!-- Breadcrumb / Título -->
        <div x-data="{ pageName: `Editando usuário` }" class="px-3 py-2">
            @include('layouts.partials.base.breadcrumb')
        </div>

        <!-- Datatable Container -->
        <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
            <!-- Cabeçalho com título e botão Novo -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between my-4 px-4">
                <h3 class="text-base font-medium text-gray-800 dark:text-white/90 mb-2 sm:mb-0">
                    ✅ Atualizando o usuário {{ $user->firstname }} {{ $user->lastname }}
                </h3>
            </div>

            <div class="border-t border-gray-100 p-5 dark:border-gray-800 sm:p-6">
                <!-- Mensagem de erro -->
                <x-alert-error></x-alert-error>
                <!-- DataTable Start -->
                <div x-data="dataTable()" class="overflow-hidden rounded-xl border border-gray-200 bg-white pt-4 dark:border-gray-800 dark:bg-white/[0.03]">

                    <form action="{{ route('users.update', $user) }}" method="POST" class="bg-white dark:bg-gray-800 p-8 rounded-2xl shadow-xl border border-gray-200 dark:border-gray-700 space-y-8">
                        @csrf
                        @method('PUT')

                        <div>
                            <h3 class="text-3xl font-extrabold text-gray-900 dark:text-white mb-2">Atribua o grupo de usuário</h3>
                            <p class="text-gray-500 dark:text-gray-400">Selecione o grupo que melhor se adequa ao usuário.</p>
                        </div>

                        <div class="space-y-6">
                            <div>
                                <label for="role" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">
                                    Grupo de usuários <strong class="text-red-500">*</strong>
                                </label>
                                <select name="role" id="role" class="mt-1 block w-full rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-50 dark:placeholder-gray-400 shadow-sm focus:ring-blue-600 focus:border-blue-600 transition-colors duration-200 ease-in-out py-3 px-4">
                                    <option value="">Selecione</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}" {{ $userRoleId == $role->id ? 'selected' : '' }}>
                                            {{ $role->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        
                        <div class="flex items-center space-x-4 pt-4 border-t border-gray-200 dark:border-gray-700">
                            <x-primary-button class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-full transition-all duration-200 ease-in-out shadow-lg transform hover:scale-105">
                                Atualizar
                            </x-primary-button>
                            <a href="{{ route('users.index') }}">
                                <x-secondary-button class="text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 py-2 px-6 rounded-full transition-all duration-200 ease-in-out">
                                    {{ __('Cancel') }}
                                </x-secondary-button>
                            </a>
                        </div>
                    </form>
                </div>
                <!-- DataTable End -->
            </div>
        </div>
    </div>
</x-app-layout>

