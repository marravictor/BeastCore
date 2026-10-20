# BeastCore - Sistema para Academia

**Feito por Victor Marra da I1D35**

Aplicação procedural básica em **PHP com PDO** e **PostgreSQL**, no estilo
"PHP básico" (funções com `$conexao` e `bindParam`, includes de header/footer).

---

## Configuração do Banco de Dados (`database/connect.php`)

```php
$host   = "192.168.10.41";
$dbname = "beastcore";
$user   = "beastcore";
$pass   = "beastcore";
```

---

## Regras de Acesso

- **Acesso Público**: `index.php`, `pages/exercicios.php`, `pages/unidades.php`,
  `pages/planos.php`.
- **Exige Login**: `pages/treinos.php`, `pages/progresso.php`, `pages/mensagens.php`.
- **Só Admin** (`usuarios.tipo = 'admin'`): `admin/usuarios.php`, `admin/planos.php`
  e o cadastro de exercícios em `pages/exercicios.php` (alunos apenas visualizam a lista).

---

## Área do Admin

Para entrar no admin, use o link **Admin** que aparece na área de "entrar"
(login) do site:

- **Usuário**: `beastcore`
- **Senha**: `123456`

Depois de logar, aparecem duas abas no menu:

- **Usuários** (`admin/usuarios.php`): lista todas as pessoas do banco de dados
  (id, nome, e-mail, nascimento, tipo).
- **Gerenciar Planos** (`admin/planos.php`): criar, alterar e excluir planos.

> Contas normais de `usuarios` com `tipo = 'admin'` também continuam entrando
> pela tela de login comum (`login/login.php`).

---

## Headers

Cada página tem o seu próprio cabeçalho em `includes/` (`header_index.php`,
`header_login.php`, `header_exercicios.php`, `header_usuarios.php`, etc.),
incluído de forma simples com `include`. Nada de framework.

---

## Tabelas Utilizadas

- `usuarios` (nome, email, senha, data_nascimento, tipo)
- `unidades` (nome, endereco, telefone, horario)
- `planos` (nome, preco, descricao)
- `exercicios` (nome, grupo_muscular, descricao)
- `treinos` (nome, descricao, usuario_id)
- `progresso` (usuario_id, peso, data_registro, observacao)
- `mensagens` (nome, telefone, email, plano, mensagem, lida, data_envio)

---

## Como Rodar

```bash
php -d extension=pdo_sqlite -S 127.0.0.1:8000
```

Depois abra `http://127.0.0.1:8000` no navegador.

---

## Banco de demonstração (quando o PostgreSQL está offline)

O `connect.php` tenta primeiro o PostgreSQL (`192.168.10.41`). Se ele não
estiver acessível, o site usa um banco local de demonstração em
`database/demo.sqlite` (SQLite), só para visualizar as telas.
**O PostgreSQL não é alterado em nenhum momento.**

Contas do demo:

- `admin@beastcore.com` / `admin123` (tipo admin)
- `aluno@exemplo.com` / `123456` (tipo aluno)

**Feito por Victor Marra da I1D35**
