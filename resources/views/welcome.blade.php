<x-guest-layout>
    <div class="min-h-screen bg-white">

        <!-- Top bar -->
        <div class="max-w-6xl mx-auto px-6 py-6 flex justify-between items-center">
            <span style="font-family: 'Space Grotesk', sans-serif;" class="text-xl font-bold text-gray-900">SHOP.</span>
            <div class="flex gap-3">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ route('dashboard') }}" class="px-4 py-2 bg-[#2D4FFF] text-white rounded-lg text-sm font-medium">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="px-4 py-2 text-gray-700 text-sm font-medium">Entrar</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="px-4 py-2 bg-[#2D4FFF] text-white rounded-lg text-sm font-medium">Criar conta</a>
                        @endif
                    @endauth
                @endif
            </div>
        </div>

        <!-- Hero -->
        <div class="max-w-4xl mx-auto px-6 pt-16 pb-20 text-center">
            <h1 style="font-family: 'Space Grotesk', sans-serif;" class="text-4xl sm:text-5xl font-bold text-gray-900 leading-tight">
                Roupas com identidade,<br>direto pra sua porta.
            </h1>
            <p class="text-gray-500 mt-5 text-base max-w-xl mx-auto">
                Catálogo simples, pedido rápido, acompanhamento em tempo real.
                Crie sua conta e comece a comprar em menos de um minuto.
            </p>
            <div class="flex gap-3 justify-center mt-8">
                @auth
                    <a href="{{ route('produtos.index') }}" class="px-6 py-3 bg-[#2D4FFF] text-white rounded-lg text-sm font-medium">Ver catálogo</a>
                @else
                    <a href="{{ route('register') }}" class="px-6 py-3 bg-[#2D4FFF] text-white rounded-lg text-sm font-medium">Criar conta grátis</a>
                    <a href="{{ route('login') }}" class="px-6 py-3 bg-gray-100 text-gray-700 rounded-lg text-sm font-medium">Já tenho conta</a>
                @endauth
            </div>
        </div>

        <!-- Features -->
        <div class="max-w-4xl mx-auto px-6 pb-20">
            <div class="grid gap-5" style="grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));">

                <div class="border border-gray-200 rounded-xl p-6">
                    <div style="font-family: 'IBM Plex Mono', monospace;" class="inline-block bg-[#E6F1FB] text-[#0C447C] text-xs font-medium px-2.5 py-1 rounded mb-3">01</div>
                    <p style="font-family: 'Space Grotesk', sans-serif;" class="font-medium text-gray-900">Catálogo sempre atualizado</p>
                    <p class="text-sm text-gray-500 mt-1">Veja estoque em tempo real antes de fechar seu pedido.</p>
                </div>

                <div class="border border-gray-200 rounded-xl p-6">
                    <div style="font-family: 'IBM Plex Mono', monospace;" class="inline-block bg-[#EAF3DE] text-[#27500A] text-xs font-medium px-2.5 py-1 rounded mb-3">02</div>
                    <p style="font-family: 'Space Grotesk', sans-serif;" class="font-medium text-gray-900">Pedido em poucos cliques</p>
                    <p class="text-sm text-gray-500 mt-1">Escolha as quantidades e finalize sem complicação.</p>
                </div>

                <div class="border border-gray-200 rounded-xl p-6">
                    <div style="font-family: 'IBM Plex Mono', monospace;" class="inline-block bg-[#FAEEDA] text-[#633806] text-xs font-medium px-2.5 py-1 rounded mb-3">03</div>
                    <p style="font-family: 'Space Grotesk', sans-serif;" class="font-medium text-gray-900">Acompanhe seu pedido</p>
                    <p class="text-sm text-gray-500 mt-1">Do pendente ao entregue, veja o status a qualquer momento.</p>
                </div>

            </div>
        </div>

        <!-- Footer -->
        <div class="border-t border-gray-100 py-6">
            <p class="text-center text-xs text-gray-400">SHOP. — Trabalho de Conclusão · Turma 26 · PHP Full Stack</p>
        </div>

    </div>
</x-guest-layout>
