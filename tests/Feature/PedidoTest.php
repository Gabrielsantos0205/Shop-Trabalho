<?php

namespace Tests\Feature;

use App\Models\Produto;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PedidoTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Rota protegida: sem estar logado, não é possível acessar "meus pedidos".
     */
    public function test_visitante_nao_logado_nao_acessa_meus_pedidos(): void
    {
        $response = $this->get('/meus-pedidos');

        $response->assertRedirect('/login');
    }

    /**
     * Criação de registro: um cliente logado consegue finalizar um pedido,
     * e o estoque do produto deve ser descontado corretamente.
     */
    public function test_cliente_consegue_finalizar_um_pedido(): void
    {
        $cliente = User::factory()->create(['role' => 'cliente']);

        $produto = Produto::create([
            'nome' => 'Boné Teste',
            'descricao' => 'Produto para teste',
            'preco' => 40.00,
            'estoque' => 5,
        ]);

        $response = $this->actingAs($cliente)->post('/pedidos', [
            'produto_id' => [$produto->id],
            'quantidade' => [2],
        ]);

        $response->assertRedirect('/meus-pedidos');

        $this->assertDatabaseHas('pedidos', [
            'user_id' => $cliente->id,
            'status' => 'pendente',
        ]);

        $this->assertDatabaseHas('pedido_itens', [
            'produto_id' => $produto->id,
            'quantidade' => 2,
        ]);

        // Estoque deve ter sido descontado: 5 - 2 = 3
        $this->assertEquals(3, $produto->fresh()->estoque);
    }

    /**
     * Validação: não deve ser possível pedir mais unidades do que o
     * estoque disponível.
     */
    public function test_nao_e_possivel_pedir_mais_que_o_estoque_disponivel(): void
    {
        $cliente = User::factory()->create(['role' => 'cliente']);

        $produto = Produto::create([
            'nome' => 'Moletom Teste',
            'descricao' => 'Produto para teste',
            'preco' => 90.00,
            'estoque' => 1,
        ]);

        $response = $this->actingAs($cliente)->post('/pedidos', [
            'produto_id' => [$produto->id],
            'quantidade' => [5],
        ]);

        $response->assertStatus(422);

        $this->assertDatabaseCount('pedidos', 0);
    }

    /**
     * Controle de permissão: um cliente não pode acessar a listagem de
     * todos os pedidos (essa rota é exclusiva do admin).
     */
    public function test_cliente_nao_pode_ver_todos_os_pedidos(): void
    {
        $cliente = User::factory()->create(['role' => 'cliente']);

        $response = $this->actingAs($cliente)->get('/pedidos');

        $response->assertForbidden();
    }
}
