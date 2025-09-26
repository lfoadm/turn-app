<x-guest-layout>
    {{-- Container Principal: Centralizado Vertical e Horizontalmente --}}
    <div class="flex flex-col items-center justify-center min-h-screen bg-gray-50 dark:bg-gray-900 p-4 sm:p-6">
        
        {{-- Bloco do Logo e Slogan (Visível em TODAS as telas, acima do form) --}}
        <div class="flex lg:hidden flex-col items-center max-w-sm mb-8 mt-10 sm:mt-0">
            <div class="flex justify-center">
                <a href="/">
                    <img src="{{ asset('assets/images/logo/logo.svg') }}" alt="Logo Light" class="w-36 dark:hidden transition duration-300">
                    <img src="{{ asset('assets/images/logo/logo-dark.svg') }}" alt="Logo Dark" class="w-36 hidden dark:block transition duration-300">
                </a>
            </div>
            {{-- Ajuste da cor do slogan para coerência com o modo dark --}}
            <p class="text-center text-gray-700 dark:text-gray-300 font-semibold mt-2 tracking-wide">
                Gestão Ferroviária Inteligente
            </p>
        </div>

        {{-- Card/Formulário --}}
        <div class="w-full max-w-md bg-white dark:bg-gray-800 rounded-2xl shadow-xl p-8 sm:p-10 text-center transition-shadow duration-300 border border-gray-100 dark:border-gray-700">
            <h2 class="text-3xl font-extrabold text-gray-900 dark:text-white mb-3">
                {{ __('Verificação de E-mail') }}
            </h2>
            <p class="text-gray-600 dark:text-gray-400 mb-6">
                {{ __('Digite o código de 6 dígitos que enviamos para o seu e-mail.') }}
            </p>

            @if (session('status') == 'otp-invalid')
                {{-- Ajuste de cores para a mensagem de erro --}}
                <div class="mb-4 text-sm font-medium p-3 rounded-lg bg-red-100 dark:bg-red-900 text-red-700 dark:text-red-300 border border-red-300 dark:border-red-700">
                    {{ __('O código informado está incorreto ou expirado.') }}
                </div>
            @endif

            {{-- Formulário de Verificação --}}
            <form method="POST" action="{{ route('verification.otp.verify') }}" id="otp-form">
                @csrf

                <div class="flex justify-center gap-2 sm:gap-3 mb-6">
                    @for ($i = 1; $i <= 6; $i++)
                        <input
                            type="text"
                            inputmode="numeric"
                            pattern="[0-9]*"
                            maxlength="1"
                            {{-- Classes para inputs OTP: Tamanho, estilo e cores modernas --}}
                            class="otp-input w-10 h-10 sm:w-12 sm:h-12 text-center text-xl font-extrabold border-2 border-gray-300 dark:border-gray-600 rounded-xl focus:border-blue-600 dark:focus:border-blue-400 focus:ring-blue-600 dark:focus:ring-blue-400 dark:bg-gray-700 dark:text-white transition duration-150"
                            autocomplete="one-time-code"
                            aria-label="Digit {{ $i }}"
                            required
                        >
                    @endfor
                </div>

                {{-- Botão Principal: Usando a cor primária Blue --}}
                <x-primary-button class="w-full justify-center bg-blue-600 hover:bg-blue-700 dark:bg-blue-500 dark:hover:bg-blue-600 focus:ring-blue-500 dark:focus:ring-blue-400 transition duration-150">
                    {{ __('Confirmar Código') }}
                </x-primary-button>
            </form>

            <div class="mt-6 flex flex-col space-y-3">
                {{-- Reenviar Código: Link em Blue --}}
                <form method="POST" action="{{ route('verification.otp.resend') }}">
                    @csrf
                    <button type="submit"
                        class="text-sm font-semibold text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 transition duration-150">
                        {{ __('Reenviar Código') }}
                    </button>
                </form>

                {{-- Sair --}}
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="text-sm text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300 underline transition duration-150">
                        {{ __('Sair') }}
                    </button>
                </form>
            </div>
        </div>
    </div>

    {{-- Script JavaScript (Mantido para a lógica do OTP) --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('otp-form');
            const inputs = Array.from(document.querySelectorAll('.otp-input'));
            const total = inputs.length;

            // Restringe a digitação para dígitos, auto-advance, paste e navegação
            inputs.forEach((input, idx) => {
                input.addEventListener('input', (e) => {
                    // só números e apenas 1 char
                    input.value = input.value.replace(/\D/g, '').slice(0, 1);
                    if (input.value && idx < total - 1) {
                        inputs[idx + 1].focus();
                    } else if (input.value && idx === total - 1) {
                        form.dispatchEvent(new Event('submit')); // Tenta submeter ao preencher o último
                    }
                });

                input.addEventListener('keydown', (e) => {
                    if (e.key === 'Backspace' && input.value === '' && idx > 0) {
                        e.preventDefault();
                        inputs[idx - 1].focus();
                    }
                    if (e.key === 'ArrowLeft' && idx > 0) {
                        inputs[idx - 1].focus();
                    }
                    if (e.key === 'ArrowRight' && idx < total - 1) {
                        inputs[idx + 1].focus();
                    }
                });

                input.addEventListener('paste', (e) => {
                    e.preventDefault();
                    const paste = (e.clipboardData || window.clipboardData).getData('text')
                        .replace(/\D/g, '').slice(0, total - idx);
                    for (let i = 0; i < paste.length; i++) {
                        inputs[idx + i].value = paste[i];
                    }
                    const next = Math.min(idx + paste.length, total - 1);
                    inputs[next].focus();
                    if (next === total - 1 && inputs[next].value !== '') {
                        form.dispatchEvent(new Event('submit'));
                    }
                });
            });

            form.addEventListener('submit', function (e) {
                e.preventDefault();

                const code = inputs.map(i => i.value).join('');
                if (code.length !== total) {
                    // Adicione lógica para exibir a mensagem de erro no DOM, se preferir
                    alert('Por favor, preencha os ' + total + ' dígitos do código.');
                    return;
                }

                // Desabilita os inputs
                inputs.forEach(i => i.disabled = true);

                // Remove hidden antigo se existir
                const existing = form.querySelector('input[name="otp_code"]');
                if (existing) existing.remove();

                // Cria o hidden com o código concatenado
                const hidden = document.createElement('input');
                hidden.type = 'hidden';
                hidden.name = 'otp_code';
                hidden.value = code;
                form.appendChild(hidden);

                form.submit();
            });
        });
    </script>
</x-guest-layout>