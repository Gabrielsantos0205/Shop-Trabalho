<x-app-layout>
    <x-slot name="header">
        <h2 style="font-family: 'Space Grotesk', sans-serif;" class="font-bold text-xl text-gray-900 leading-tight">
            Novo Produto
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
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

                <form method="POST" action="{{ route('produtos.store') }}" class="space-y-4">
                    @csrf

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nome</label>
                        <input type="text" name="nome" value="{{ old('nome') }}" required
                               class="mt-1 block w-full rounded-lg border-gray-200 shadow-sm focus:border-[#2D4FFF] focus:ring-[#2D4FFF]">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Descrição</label>
                        <textarea name="descricao" rows="3"
                                  class="mt-1 block w-full rounded-lg border-gray-200 shadow-sm focus:border-[#2D4FFF] focus:ring-[#2D4FFF]">{{ old('descricao') }}</textarea>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Preço (R$)</label>
                            <input type="number" step="0.01" name="preco" value="{{ old('preco') }}" required
                                   class="mt-1 block w-full rounded-lg border-gray-200 shadow-sm focus:border-[#2D4FFF] focus:ring-[#2D4FFF]">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Estoque</label>
                            <input type="number" name="estoque" value="{{ old('estoque') }}" required
                                   class="mt-1 block w-full rounded-lg border-gray-200 shadow-sm focus:border-[#2D4FFF] focus:ring-[#2D4FFF]">
                        </div>
                    </div>

                    <div class="flex gap-3 pt-2">
                        <button type="submit" class="px-4 py-2 bg-[#2D4FFF] text-white rounded-lg text-sm font-medium">Salvar</button>
                        <a href="{{ route('produtos.index') }}" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg text-sm font-medium">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
