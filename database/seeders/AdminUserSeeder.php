<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Administrador',
            'email' => 'admin@loja.com',
            'password' => Hash::make('senha123'), // troque depois!
            'role' => 'admin',
        ]);
    }
}

/*
   Para rodar: php artisan db:seed --class=AdminUserSeeder
   Depois faça login com admin@loja.com / senha123
   e troque a senha pelo próprio sistema.
*/
