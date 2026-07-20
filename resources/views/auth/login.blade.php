<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gray-50 px-4">
        <div class="w-full max-w-sm">

            <div class="text-center mb-8">
                <span style="font-family: 'Space Grotesk', sans-serif;" class="text-2xl font-bold text-gray-900">SHOP.</span>
                <p class="text-sm text-gray-500 mt-1">Entre na sua conta</p>
            </div>

            <div class="bg-white border border-gray-200 rounded-xl p-8">

                @if (session('status'))
    <div class="mb-4 p-3 bg-[#EAF3DE] text-[#27500A] rounded-lg text-sm">
        {{ session('status') }}
    </div>
@endif
                <x-validation-errors class="mb-4" />

                <form method="POST" action="{{ route('login') }}" class="space-y-4">
                    @csrf

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Email</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                               class="mt-1 block w-full rounded-lg border-gray-200 shadow-sm focus:border-[#2D4FFF] focus:ring-[#2D4FFF]">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Senha</label>
                        <input id="password" type="password" name="password" required autocomplete="current-password"
                               class="mt-1 block w-full rounded-lg border-gray-200 shadow-sm focus:border-[#2D4FFF] focus:ring-[#2D4FFF]">
                    </div>

                    <div class="flex items-center justify-between">
                        <label class="flex items-center">
                            <input type="checkbox" name="remember" class="rounded border-gray-300 text-[#2D4FFF] focus:ring-[#2D4FFF]">
                            <span class="ms-2 text-sm text-gray-600">Lembrar-me</span>
                        </label>

                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-sm text-[#2D4FFF]">Esqueceu a senha?</a>
                        @endif
                    </div>

                    <button type="submit" class="w-full px-4 py-2 bg-[#2D4FFF] text-white rounded-lg text-sm font-medium">
                        Entrar
                    </button>
                </form>
            </div>

            @if (Route::has('register'))
                <p class="text-center text-sm text-gray-500 mt-6">
                    Não tem conta?
                    <a href="{{ route('register') }}" class="text-[#2D4FFF] font-medium">Registre-se</a>
                </p>
            @endif
        </div>
    </div>
</x-guest-layout>
