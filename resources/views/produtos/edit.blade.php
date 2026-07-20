<x-app-layout>
    <x-slot name="header">
        <h2 style="font-family: 'Space Grotesk', sans-serif;" class="font-bold text-xl text-gray-900 leading-tight">
            Editar Produto
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

                <form method="POST" action="{{ route('produtos.update', $produto) }}" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nome</label>
                        <input type="text" name="nome" value="{{ old('nome', $produto->nome) }}" required
                               class="mt-1 block w-full rounded-lg border-gray-200 shadow-sm focus:border-[#2D4FFF] focus:ring-[#2D4FFF]">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Descrição</label>
                        <textarea name="descricao" rows="3"
                                  class="mt-1 block w-full rounded-lg border-gray-200 shadow-sm focus:border-[#2D4FFF] focus:ring-[#2D4FFF]">{{ old('descricao', $produto->descricao) }}</textarea>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Preço (R$)</label>
                            <input type="number" step="0.01" name="preco" value="{{ old('preco', $produto->preco) }}" required
                                   class="mt-1 block w-full rounded-lg border-gray-200 shadow-sm focus:border-[#2D4FFF] focus:ring-[#2D4FFF]">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Estoque</label>
                            <input type="number" name="estoque" value="{{ old('estoque', $produto->estoque) }}" required
                                   class="mt-1 block w-full rounded-lg border-gray-200 shadow-sm focus:border-[#2D4FFF] focus:ring-[#2D4FFF]">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Imagem do produto</label>

                        @if ($produto->imagem)
                            <div class="mt-2 mb-2">
                                <img src="{{ asset('storage/' . $produto->imagem) }}" alt="{{ $produto->nome }}"
                                     class="w-24 h-24 object-cover rounded-lg border border-gray-200">
                                <p class="text-xs text-gray-400 mt-1">Imagem atual — escolha um novo arquivo abaixo para substituir.</p>
                            </div>
                        @endif

                        <input type="file" name="imagem" accept="image/*"
                               class="mt-1 block w-full text-sm text-gray-600
                                      file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0
                                      file:text-sm file:font-medium file:bg-gray-100 file:text-gray-700
                                      hover:file:bg-gray-200">
                        <p class="text-xs text-gray-400 mt-1">JPG ou PNG, até 2MB. Opcional.</p>
                    </div>

                    <div class="flex gap-3 pt-2">
                        <button type="submit" class="px-4 py-2 bg-[#2D4FFF] text-white rounded-lg text-sm font-medium">Atualizar</button>
                        <a href="{{ route('produtos.index') }}" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg text-sm font-medium">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
