<x-app-layout>
    <x-slot name="header">
        <h2 style="font-family: 'Space Grotesk', sans-serif;" class="font-bold text-xl text-gray-900 leading-tight">
            Meus Pedidos
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-3">

            @if (session('msg'))
                <div class="p-4 bg-[#EAF3DE] text-[#27500A] rounded-lg text-sm">{{ session('msg') }}</div>
            @endif
            @if (session('erro'))
                <div class="p-4 bg-[#FAECE7] text-[#712B13] rounded-lg text-sm">{{ session('erro') }}</div>
            @endif

            @forelse ($pedidos as $pedido)
                <div class="bg-white border border-gray-200 rounded-xl p-5">
                    <div class="flex justify-between items-center mb-3">
                        <span style="font-family: 'Space Grotesk', sans-serif;" class="font-medium text-sm text-gray-900">
                            Pedido #{{ $pedido->id }} — {{ $pedido->created_at->format('d/m/Y H:i') }}
                        </span>
                        <span class="px-3 py-1 rounded-full text-xs font-medium
                            @class([
                                'bg-[#FAEEDA] text-[#633806]' => $pedido->status === 'pendente',
                                'bg-[#E6F1FB] text-[#0C447C]' => $pedido->status === 'enviado',
                                'bg-[#EAF3DE] text-[#27500A]' => $pedido->status === 'entregue',
                                'bg-[#FCEBEB] text-[#791F1F]' => $pedido->status === 'cancelado',
                            ])">
                            {{ ucfirst($pedido->status) }}
                        </span>
                    </div>
                    <ul class="text-sm text-gray-500 mb-3 space-y-0.5">
                        @foreach ($pedido->itens as $item)
                            <li>{{ $item->quantidade }}x {{ $item->produto->nome }} —
                                <span style="font-family: 'IBM Plex Mono', monospace;">R$ {{ number_format($item->subtotal(), 2, ',', '.') }}</span>
                            </li>
                        @endforeach
                    </ul>
                    <div style="font-family: 'IBM Plex Mono', monospace;" class="font-medium text-sm text-gray-900">
                        Total: R$ {{ number_format($pedido->total, 2, ',', '.') }}
                    </div>
                </div>
            @empty
                <div class="text-center py-16 text-gray-400 text-sm bg-white border border-gray-200 rounded-xl">
                    Você ainda não fez nenhum pedido.
                </div>
            @endforelse
        </div>
    </div>
</x-app-layout>
