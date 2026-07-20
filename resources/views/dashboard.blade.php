<x-app-layout>
    <x-slot name="header">
        <h2 style="font-family: 'Space Grotesk', sans-serif;" class="font-bold text-xl text-gray-900 leading-tight">
            Dashboard
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white border border-gray-200 rounded-xl p-8 mb-6">
                <p style="font-family: 'Space Grotesk', sans-serif;" class="font-bold text-2xl text-gray-900">
                    Olá, {{ explode(' ', auth()->user()->name)[0] }}
                </p>
                <p class="text-sm text-gray-500 mt-1">
                    @if (auth()->user()->isAdmin())
                        Você está logado como administrador da SHOP.
                    @else
                        Bem-vindo à SHOP. — confira o catálogo e acompanhe seus pedidos.
                    @endif
                </p>
            </div>

            @if (auth()->user()->isAdmin())
                <div class="grid gap-4 mb-6" style="grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));">
                    <div class="bg-gray-50 rounded-xl p-5">
                        <p class="text-xs text-gray-500 mb-1">Produtos cadastrados</p>
                        <p style="font-family: 'IBM Plex Mono', monospace;" class="text-2xl font-medium text-gray-900">
                            {{ \App\Models\Produto::count() }}
                        </p>
                    </div>
                    <div class="bg-gray-50 rounded-xl p-5">
                        <p class="text-xs text-gray-500 mb-1">Pedidos pendentes</p>
                        <p style="font-family: 'IBM Plex Mono', monospace;" class="text-2xl font-medium text-gray-900">
                            {{ \App\Models\Pedido::where('status', 'pendente')->count() }}
                        </p>
                    </div>
                    <div class="bg-gray-50 rounded-xl p-5">
                        <p class="text-xs text-gray-500 mb-1">Total de pedidos</p>
                        <p style="font-family: 'IBM Plex Mono', monospace;" class="text-2xl font-medium text-gray-900">
                            {{ \App\Models\Pedido::count() }}
                        </p>
                    </div>
                </div>

                <div class="flex gap-3">
                    <a href="{{ route('produtos.create') }}" class="px-4 py-2 bg-[#2D4FFF] text-white rounded-lg text-sm font-medium">+ Novo Produto</a>
                    <a href="{{ route('pedidos.index') }}" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg text-sm font-medium">Ver Pedidos</a>
                </div>
            @else
                <div class="grid gap-4 mb-6" style="grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));">
                    <div class="bg-gray-50 rounded-xl p-5">
                        <p class="text-xs text-gray-500 mb-1">Seus pedidos</p>
                        <p style="font-family: 'IBM Plex Mono', monospace;" class="text-2xl font-medium text-gray-900">
                            {{ auth()->user()->pedidos()->count() }}
                        </p>
                    </div>
                    <div class="bg-gray-50 rounded-xl p-5">
                        <p class="text-xs text-gray-500 mb-1">Produtos no catálogo</p>
                        <p style="font-family: 'IBM Plex Mono', monospace;" class="text-2xl font-medium text-gray-900">
                            {{ \App\Models\Produto::count() }}
                        </p>
                    </div>
                </div>

                <div class="flex gap-3">
                    <a href="{{ route('produtos.index') }}" class="px-4 py-2 bg-[#2D4FFF] text-white rounded-lg text-sm font-medium">Ver Catálogo</a>
                    <a href="{{ route('pedidos.meus') }}" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg text-sm font-medium">Meus Pedidos</a>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
