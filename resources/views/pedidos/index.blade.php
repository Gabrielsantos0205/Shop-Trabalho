<x-app-layout>
    <x-slot name="header">
        <h2 style="font-family: 'Space Grotesk', sans-serif;" class="font-bold text-xl text-gray-900 leading-tight">
            Todos os Pedidos
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-3">

            @if (session('msg'))
                <div class="p-4 bg-[#EAF3DE] text-[#27500A] rounded-lg text-sm">{{ session('msg') }}</div>
            @endif
            @if (session('erro'))
                <div class="p-4 bg-[#FAECE7] text-[#712B13] rounded-lg text-sm">{{ session('erro') }}</div>
            @endif

            @forelse ($pedidos as $pedido)
                <div class="bg-white border border-gray-200 rounded-xl p-5">
                    <div class="flex justify-between items-center mb-3 flex-wrap gap-2">
                        <span style="font-family: 'Space Grotesk', sans-serif;" class="font-medium text-sm text-gray-900">
                            Pedido #{{ $pedido->id }} — {{ $pedido->user->name }} — {{ $pedido->created_at->format('d/m/Y H:i') }}
                        </span>
                        <form method="POST" action="{{ route('pedidos.status', $pedido) }}" class="flex items-center gap-2">
                            @csrf
                            @method('PUT')
                            <select name="status" class="rounded-lg border-gray-200 shadow-sm text-xs focus:border-[#2D4FFF] focus:ring-[#2D4FFF]">
                                @foreach (['pendente', 'enviado', 'entregue', 'cancelado'] as $status)
                                    <option value="{{ $status }}" @selected($pedido->status === $status)>
                                        {{ ucfirst($status) }}
                                    </option>
                                @endforeach
                            </select>
                            <button type="submit" class="px-3 py-1.5 bg-gray-900 text-white rounded-lg text-xs font-medium">Atualizar</button>
                        </form>
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
                    Nenhum pedido registrado ainda.
                </div>
            @endforelse
        </div>
    </div>
</x-app-layout>
