<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PedidoController extends Controller
{
    // Cliente: formulário para montar um novo pedido
    public function create()
    {
        $produtos = Produto::where('estoque', '>', 0)->get();
        return view('pedidos.create', compact('produtos'));
    }

    // Cliente: envia o pedido com um ou mais itens
    // Espera do form: produto_id[] e quantidade[] (arrays paralelos)
    public function store(Request $request)
    {
        $request->validate([
            'produto_id' => 'required|array|min:1',
            'produto_id.*' => 'exists:produtos,id',
            'quantidade' => 'required|array|min:1',
            'quantidade.*' => 'integer|min:0',
        ]);

        $itensValidos = collect($request->produto_id)
            ->zip($request->quantidade)
            ->filter(fn ($par) => (int) $par[1] > 0);

        if ($itensValidos->isEmpty()) {
            return back()->with('erro', 'Selecione ao menos um produto com quantidade maior que zero.');
        }

        DB::transaction(function () use ($itensValidos) {
            $pedido = Pedido::create([
                'user_id' => auth()->id(),
                'status' => 'pendente',
                'total' => 0,
            ]);

            $total = 0;

            foreach ($itensValidos as [$produtoId, $quantidade]) {
                $produto = Produto::findOrFail($produtoId);
                $quantidade = (int) $quantidade;

                if (!$produto->estaDisponivel($quantidade)) {
                    abort(422, "Estoque insuficiente para o produto: {$produto->nome}");
                }

                $pedido->itens()->create([
                    'produto_id' => $produto->id,
                    'quantidade' => $quantidade,
                    'preco_unitario' => $produto->preco,
                ]);

                $produto->decrement('estoque', $quantidade);
                $total += $produto->preco * $quantidade;
            }

            $pedido->update(['total' => $total]);
        });

        return redirect()->route('pedidos.meus')->with('msg', 'Pedido realizado com sucesso!');
    }

    // Cliente: vê só os próprios pedidos
    public function meus()
    {
        $pedidos = auth()->user()->pedidos()->with('itens.produto')->latest()->get();
        return view('pedidos.meus', compact('pedidos'));
    }

    // Admin: vê todos os pedidos do sistema
    public function index()
    {
        $pedidos = Pedido::with(['user', 'itens.produto'])->latest()->get();
        return view('pedidos.index', compact('pedidos'));
    }

    // Admin: atualiza o status do pedido
    public function atualizarStatus(Request $request, Pedido $pedido)
    {
        $request->validate([
            'status' => 'required|in:pendente,enviado,entregue,cancelado',
        ]);

        $pedido->update(['status' => $request->status]);

        return back()->with('msg', 'Status do pedido atualizado!');
    }
}
