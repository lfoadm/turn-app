<x-app-layout>
    <div class="mx-auto max-w-[1440px] p-4 md:p-6">
        <!-- Breadcrumb / Título -->
        <div x-data="{ pageName: `Novo usuário` }" class="px-3 py-2">
            @include('layouts.partials.base.breadcrumb')
        </div>

        <!-- Container -->
        <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">

            <!-- Cabeçalho -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between my-4 px-4">
                <h3 class="text-base font-medium text-gray-800 dark:text-white/90 mb-2 sm:mb-0">
                    ➕ Cadastro de usuário
                </h3>
            </div>

            <div class="border-t border-gray-100 p-5 dark:border-gray-800 sm:p-6">
                <!-- Mensagem de erro -->
                <x-alert-error></x-alert-error>

                <form action="{{ route('users.store') }}" method="POST"
                    class="bg-white dark:bg-gray-800 p-8 rounded-2xl shadow-xl border border-gray-200 dark:border-gray-700 space-y-8">
                    @csrf

                    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">

                        <!-- First Name -->
                        <div class="sm:col-span-1">
                            <x-input-label for="firstname" :value="__('Firstname')" />
                            <x-text-input id="firstname" placeholder="Informe o primeiro nome"
                                class="dark:bg-dark-900 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800"
                                type="text" name="firstname" :value="old('firstname')" required autofocus autocomplete="name" />
                            <x-input-error :messages="$errors->get('firstname')" class="mt-2" />
                        </div>

                        <!-- Last Name -->
                        <div class="sm:col-span-1">
                            <x-input-label for="lastname" :value="__('Lastname')" />
                            <x-text-input id="lastname" placeholder="Informe seu primeiro nome"
                                class="dark:bg-dark-900 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800"
                                type="text" name="lastname" :value="old('lastname')" required autofocus
                                autocomplete="name" />
                            <x-input-error :messages="$errors->get('lastname')" class="mt-2" />
                        </div>

                    </div>

                    <!-- Email -->
                    <div class="mt-4">
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input placeholder="Informe seu e-mail" id="email" class="dark:bg-dark-900 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800" type="email" name="email" :value="old('email')" required autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Phone -->
                    <div class="mt-4" x-data>
                        <x-input-label for="phone" :value="__('Phone')" />
                        <x-text-input id="phone" class="dark:bg-dark-900 h-11 w-full rounded-lg border border-gray-300 bg-transparent py-2.5 pl-4 pr-11 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-cyan-500 focus:outline-hidden focus:ring-3 focus:ring-cyan-500 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800" type="text" name="phone" :value="old('phone')" autofocus autocomplete="phone" x-mask="(99) 99999-9999" placeholder="(xx) xxxxx-xxxx" />
                        <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                    </div>

                    <!-- Role -->
                    <div>
                        <label for="role_id" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">
                            Grupo de usuários <strong class="text-red-500">*</strong>
                        </label>
                        <select name="role_id" id="role_id" required
                            class="mt-1 block w-full rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-50 shadow-sm focus:ring-cyan-600 focus:border-cyan-600 py-3 px-4">
                            <option value="">Selecione</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}" @selected(old('role') == $role->id)>
                                    {{ $role->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Ações -->
                    <div class="flex items-center space-x-4 pt-4 border-t border-gray-200 dark:border-gray-700">
                        <x-primary-button
                            class="bg-cyan-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-full transition-all duration-200 ease-in-out shadow-lg transform hover:scale-105">
                            Criar
                        </x-primary-button>
                        <a href="{{ route('users.index') }}">
                            <x-secondary-button
                                class="text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 py-2 px-6 rounded-full transition-all duration-200 ease-in-out">
                                Cancelar
                            </x-secondary-button>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
