<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    // Catálogo — qualquer usuário logado (admin ou cliente) pode ver
    public function index(Request $request)
    {
        $busca = $request->input('busca');

        $produtos = Produto::when($busca, function ($query) use ($busca) {
                $query->where('nome', 'like', "%{$busca}%");
            })
            ->get();

        return view('produtos.index', compact('produtos', 'busca'));
    }

    // Abaixo: só admin (protegido via middleware nas rotas)

    public function create()
    {
        return view('produtos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'preco' => 'required|numeric|min:0',
            'estoque' => 'required|integer|min:0',
        ]);

        Produto::create($request->only('nome', 'descricao', 'preco', 'estoque'));

        return redirect()->route('produtos.index')->with('msg', 'Produto cadastrado com sucesso!');
    }

    public function edit(Produto $produto)
    {
        return view('produtos.edit', compact('produto'));
    }

    public function update(Request $request, Produto $produto)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'preco' => 'required|numeric|min:0',
            'estoque' => 'required|integer|min:0',
        ]);

        $produto->update($request->only('nome', 'descricao', 'preco', 'estoque'));

        return redirect()->route('produtos.index')->with('msg', 'Produto atualizado!');
    }

    public function destroy(Produto $produto)
    {
        $produto->delete();
        return redirect()->route('produtos.index')->with('msg', 'Produto removido!');
    }
}
