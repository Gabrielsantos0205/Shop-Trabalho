<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'descricao', 'preco', 'estoque'];

    public function pedidoItens()
    {
        return $this->hasMany(PedidoItem::class);
    }

    public function estaDisponivel(int $quantidade = 1): bool
    {
        return $this->estoque >= $quantidade;
    }
}
