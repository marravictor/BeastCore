# BeastCore - Sistema para Academia

**Feito por Victor Marra da I1D35**

Aplicacao procedural basica em PHP com PDO e PostgreSQL, no estilo PHP basico (includes de header/footer e consultas com bindParam).

## Estrutura das Pastas

```
BeastCore/
?
??? admin/           # Area administrativa (planos, usuarios, professores, unidades)
??? database/        # Conexao com banco e demo.sqlite
??? includes/        # Funcoes e headers de cada pagina
??? login/           # Login, cadastro e logout
??? pages/           # Paginas para o aluno/usuario
??? style/           # Arquivo CSS
??? banco.sql        # Script SQL para importar
??? index.php        # Pagina inicial
```

## Configuracao do Banco (`database/connect.php`)

```php
$host   = "192.168.10.41";
$dbname = "beastcore";
$user   = "beastcore";
$pass   = "beastcore";
```

## Regras de Acesso

- **Publico:** `index.php`, `pages/exercicios.php`, `pages/unidades.php`, `pages/planos.php`
- **Precisa logar:** `pages/treinos.php`, `pages/progresso.php`, `pages/mensagens.php`
- **Somente Admin:** `admin/usuarios.php`, `admin/planos.php`, `admin/professores.php`, `admin/unidades.php`

## Login Admin

Pelo link "Admin" no site ou direto `admin/login.php`:
- Usuario: `beastcore`
- Senha: `123456`

Login comum com conta admin:
- Email: `marravictor6@gmail.com`
- Senha: `admin123`

## Como Rodar

```bash
php -d extension=pdo_sqlite -S 127.0.0.1:8000
```

Abrir: `http://127.0.0.1:8000`

## Banco de Demonstracao

Se o PostgreSQL estiver offline, o site usa `database/demo.sqlite` automaticamente. O banco PostgreSQL nao e alterado.

**Feito por Victor Marra da I1D35**
