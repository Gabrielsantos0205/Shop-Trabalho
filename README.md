# SHOP. — Sistema de Gerenciamento de Clientes e Pedidos

Trabalho de Conclusão de Curso — Turma 26, PHP Full Stack
Coude Escola de Programação

Sistema de loja online desenvolvido em Laravel, com dois perfis de
usuário (administrador e cliente), catálogo de produtos, e fluxo
completo de pedidos.

## Tecnologias

- PHP + Laravel
- Laravel Jetstream (autenticação)
- MySQL
- Blade + Tailwind CSS

## Funcionalidades

- Autenticação de usuários (login, registro, logout) com senha em hash
- Dois níveis de acesso: **administrador** e **cliente**
  - Administrador: gerencia produtos (CRUD completo) e acompanha/atualiza status de todos os pedidos
  - Cliente: navega o catálogo, monta pedidos e acompanha seus próprios pedidos
- Controle de estoque automático a cada pedido finalizado

## Modelagem do banco de dados

- `users` — usuários do sistema (coluna `role`: admin ou cliente)
- `produtos` — catálogo (nome, descrição, preço, estoque)
- `pedidos` — pedidos feitos pelos clientes (status, total)
- `pedido_itens` — itens de cada pedido (produto, quantidade, preço unitário)

## Instalação

### Pré-requisitos

- PHP 8.2+
- Composer
- Node.js
- MySQL

### Passo a passo

1. Clone o repositório:
```bash
git clone https://github.com/Gabrielsantos0205/Shop-Trabalho.git
cd Shop-Trabalho
```

2. Instale as dependências:
```bash
composer install
npm install
```

3. Copie o arquivo de ambiente e gere a chave da aplicação:
```bash
cp .env.example .env
php artisan key:generate
```

4. Configure o banco de dados no arquivo `.env`:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=loja
DB_USERNAME=root
DB_PASSWORD=sua_senha
```

5. Crie o banco de dados `loja` no MySQL (pode ser pelo MySQL Workbench
ou linha de comando):
```sql
CREATE DATABASE loja;
```

6. Rode as migrations:
```bash
php artisan migrate
```

7. Crie o usuário administrador padrão:
```bash
php artisan db:seed --class=AdminUserSeeder
```

Login padrão do administrador criado: `admin@loja.com` / `senha123`
(recomendado trocar a senha após o primeiro acesso)

8. Compile os assets (CSS/JS):
```bash
npm run build
```

9. Suba o servidor local:
```bash
php artisan serve
```

10. Acesse `http://localhost:8000` no navegador.

## Perfis de teste

| Perfil | Email | Senha |
|---|---|---|
| Administrador | admin@loja.com | senha123 |
| Cliente | (crie uma conta pela tela de registro) | — |

## Autor

Gabriel Santos Rodrigues — Turma 26, PHP Full Stack
