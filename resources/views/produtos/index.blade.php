<x-app-layout>
    <x-slot name="header">
        <h2 style="font-family: 'Space Grotesk', sans-serif;" class="font-bold text-xl text-gray-900 leading-tight">
            Catálogo
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">

            @if (session('msg'))
                <div class="mb-4 p-4 bg-[#EAF3DE] text-[#27500A] rounded-lg text-sm">
                    {{ session('msg') }}
                </div>
            @endif

            <div class="flex justify-between items-center mb-6 gap-4">
                <form method="GET" action="{{ route('produtos.index') }}" class="flex gap-2 flex-1 max-w-sm">
                    <input type="text" name="busca" value="{{ $busca }}" placeholder="Buscar produto..."
                           class="border-gray-200 rounded-lg shadow-sm w-full text-sm focus:border-[#2D4FFF] focus:ring-[#2D4FFF]">
                    <button type="submit" class="px-4 py-2 bg-gray-900 text-white rounded-lg text-sm font-medium">Buscar</button>
                </form>

                @auth
                    @if (auth()->user()->isAdmin())
                        <a href="{{ route('produtos.create') }}"
                           class="px-4 py-2 bg-[#2D4FFF] text-white rounded-lg text-sm font-medium whitespace-nowrap">+ Novo Produto</a>
                    @else
                        <a href="{{ route('pedidos.create') }}"
                           class="px-4 py-2 bg-[#2D4FFF] text-white rounded-lg text-sm font-medium whitespace-nowrap">Fazer Pedido</a>
                    @endif
                @endauth
            </div>

            <div class="grid gap-5" style="grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));">
                @forelse ($produtos as $produto)
                    <div class="relative bg-white border border-gray-200 rounded-xl p-5 pt-6">

                        <div style="font-family: 'IBM Plex Mono', monospace; transform: rotate(3deg);"
                             class="absolute -top-2.5 right-4 text-white text-xs font-medium px-2.5 py-1 rounded
                                    {{ $produto->estoque > 0 ? 'bg-[#2D4FFF]' : 'bg-[#FF5A36]' }}">
                            R$ {{ number_format($produto->preco, 2, ',', '.') }}
                        </div>

                        <p style="font-family: 'Space Grotesk', sans-serif;" class="font-medium text-[15px] text-gray-900 mt-2">
                            {{ $produto->nome }}
                        </p>
                        <p class="text-xs text-gray-500 mt-1 mb-4 min-h-[2rem]">
                            {{ Str::limit($produto->descricao, 60) }}
                        </p>

                        <div class="flex items-center gap-1.5">
                            <span class="w-1.5 h-1.5 rounded-full {{ $produto->estoque > 0 ? 'bg-[#1F9D55]' : 'bg-[#E24B4A]' }}"></span>
                            @if ($produto->estoque > 0)
                                <span class="text-xs text-gray-500">{{ $produto->estoque }} em estoque</span>
                            @else
                                <span class="text-xs text-[#993C1D]">Esgotado</span>
                            @endif
                        </div>

                        @if (auth()->user()->isAdmin())
                            <div class="flex gap-3 mt-4 pt-4 border-t border-gray-100 text-xs">
                                <a href="{{ route('produtos.edit', $produto) }}" class="text-[#2D4FFF] font-medium">Editar</a>
                                <form action="{{ route('produtos.destroy', $produto) }}" method="POST"
                                      onsubmit="return confirm('Excluir este produto?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-[#993C1D] font-medium">Excluir</button>
                                </form>
                            </div>
                        @endif
                    </div>
                @empty
                    <div class="col-span-full text-center py-16 text-gray-400 text-sm">
                        Nenhum produto encontrado.
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
