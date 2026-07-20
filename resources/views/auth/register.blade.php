<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gray-50 px-4 py-12">
        <div class="w-full max-w-sm">

            <div class="text-center mb-8">
                <span style="font-family: 'Space Grotesk', sans-serif;" class="text-2xl font-bold text-gray-900">SHOP.</span>
                <p class="text-sm text-gray-500 mt-1">Crie sua conta</p>
            </div>

            <div class="bg-white border border-gray-200 rounded-xl p-8">

                <x-validation-errors class="mb-4" />

                <form method="POST" action="{{ route('register') }}" class="space-y-4">
                    @csrf

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nome</label>
                        <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                               class="mt-1 block w-full rounded-lg border-gray-200 shadow-sm focus:border-[#2D4FFF] focus:ring-[#2D4FFF]">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Email</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required
                               class="mt-1 block w-full rounded-lg border-gray-200 shadow-sm focus:border-[#2D4FFF] focus:ring-[#2D4FFF]">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Senha</label>
                        <input id="password" type="password" name="password" required autocomplete="new-password"
                               class="mt-1 block w-full rounded-lg border-gray-200 shadow-sm focus:border-[#2D4FFF] focus:ring-[#2D4FFF]">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Confirmar senha</label>
                        <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                               class="mt-1 block w-full rounded-lg border-gray-200 shadow-sm focus:border-[#2D4FFF] focus:ring-[#2D4FFF]">
                    </div>

                    @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                        <div>
                            <label class="flex items-start">
                                <input type="checkbox" name="terms" required class="mt-1 rounded border-gray-300 text-[#2D4FFF] focus:ring-[#2D4FFF]">
                                <span class="ms-2 text-sm text-gray-600">
                                    Eu concordo com os
                                    <a target="_blank" href="{{ route('terms.show') }}" class="text-[#2D4FFF]">Termos de Serviço</a>
                                    e
                                    <a target="_blank" href="{{ route('policy.show') }}" class="text-[#2D4FFF]">Política de Privacidade</a>
                                </span>
                            </label>
                        </div>
                    @endif

                    <button type="submit" class="w-full px-4 py-2 bg-[#2D4FFF] text-white rounded-lg text-sm font-medium">
                        Criar conta
                    </button>
                </form>
            </div>

            <p class="text-center text-sm text-gray-500 mt-6">
                Já tem conta?
                <a href="{{ route('login') }}" class="text-[#2D4FFF] font-medium">Entrar</a>
            </p>
        </div>
    </div>
</x-guest-layout>
