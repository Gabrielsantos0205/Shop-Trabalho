<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProdutoTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Rota protegida: um visitante não logado não pode acessar o catálogo.
     * Deve ser redirecionado para a tela de login.
     */
    public function test_visitante_nao_logado_e_redirecionado_para_login(): void
    {
        $response = $this->get('/produtos');

        $response->assertRedirect('/login');
    }

    /**
     * Criação de registro: um admin logado consegue cadastrar um produto novo,
     * e o registro deve aparecer no banco de dados.
     */
    public function test_admin_consegue_cadastrar_um_produto(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($admin)->post('/produtos', [
            'nome' => 'Camiseta Teste',
            'descricao' => 'Produto criado durante o teste automatizado',
            'preco' => 59.90,
            'estoque' => 10,
        ]);

        $response->assertRedirect('/produtos');

        $this->assertDatabaseHas('produtos', [
            'nome' => 'Camiseta Teste',
            'estoque' => 10,
        ]);
    }

    /**
     * Validação de dados inválidos: tentar cadastrar um produto sem nome
     * (campo obrigatório) deve falhar e não deve criar nada no banco.
     */
    public function test_cadastro_de_produto_falha_sem_nome(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($admin)->post('/produtos', [
            'nome' => '',
            'preco' => 59.90,
            'estoque' => 10,
        ]);

        $response->assertSessionHasErrors('nome');

        $this->assertDatabaseCount('produtos', 0);
    }

    /**
     * Controle de permissão: um usuário comum (cliente) não pode acessar
     * a rota de cadastro de produto, mesmo estando logado.
     */
    public function test_cliente_nao_pode_cadastrar_produto(): void
    {
        $cliente = User::factory()->create(['role' => 'cliente']);

        $response = $this->actingAs($cliente)->get('/produtos/criar');

        $response->assertForbidden();
    }
}
