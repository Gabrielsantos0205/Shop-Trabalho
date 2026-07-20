<x-app-layout>
    <x-slot name="header">
        <h2 style="font-family: 'Space Grotesk', sans-serif;" class="font-bold text-xl text-gray-900 leading-tight">
            Fazer Pedido
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white border border-gray-200 rounded-xl p-6">

                @if ($errors->any())
                    <div class="mb-4 p-4 bg-[#FAECE7] text-[#712B13] rounded-lg text-sm">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <p class="text-gray-500 text-sm mb-5">Marque a quantidade dos produtos que deseja e clique em "Finalizar Pedido".</p>

                <form method="POST" action="{{ route('pedidos.store') }}">
                    @csrf

                    <div class="space-y-2 mb-6">
                        @forelse ($produtos as $produto)
                            <div class="flex items-center justify-between border border-gray-100 rounded-lg px-4 py-3">
                                <div class="flex items-center gap-3">
                                    @if ($produto->imagem)
                                        <img src="{{ asset('storage/' . $produto->imagem) }}" alt="{{ $produto->nome }}"
                                             class="w-12 h-12 object-cover rounded-lg border border-gray-100">
                                    @else
                                        <div class="w-12 h-12 bg-gray-50 rounded-lg flex items-center justify-center">
                                            <span class="text-gray-300 text-[10px]">Sem foto</span>
                                        </div>
                                    @endif
                                    <div>
                                        <p style="font-family: 'Space Grotesk', sans-serif;" class="font-medium text-sm text-gray-900">{{ $produto->nome }}</p>
                                        <p class="text-xs text-gray-500 mt-0.5">
                                            <span style="font-family: 'IBM Plex Mono', monospace;">R$ {{ number_format($produto->preco, 2, ',', '.') }}</span>
                                            · {{ $produto->estoque }} em estoque
                                        </p>
                                    </div>
                                </div>
                                <input type="hidden" name="produto_id[]" value="{{ $produto->id }}">
                                <input type="number" name="quantidade[]" min="0" max="{{ $produto->estoque }}"
                                       value="0" class="w-20 rounded-lg border-gray-200 shadow-sm text-sm focus:border-[#2D4FFF] focus:ring-[#2D4FFF]">
                            </div>
                        @empty
                            <p class="text-center text-gray-400 text-sm py-6">Nenhum produto disponível no momento.</p>
                        @endforelse
                    </div>

                    <div class="flex gap-3">
                        <button type="submit" class="px-4 py-2 bg-[#2D4FFF] text-white rounded-lg text-sm font-medium">Finalizar Pedido</button>
                        <a href="{{ route('produtos.index') }}" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg text-sm font-medium">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
