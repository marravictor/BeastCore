# BeastCore

**Feito por:** Victor Marra (marravictor) - I1D35

Sistema de academia desenvolvido em PHP básico e procedural, HTML5, CSS3, PostgreSQL com PDO e sessões PHP.

## 1. Pré-requisitos

- PHP 8.x ou superior
- PostgreSQL
- Git

## 2. Clonar o repositório

```bash
git clone https://github.com/marravictor/BeastCore.git
cd BeastCore
```

## 3. Criar banco no PostgreSQL

```bash
psql -U postgres
```

```sql
CREATE DATABASE beastcore;
\q
```

## 4. Importar o banco

```bash
psql -U postgres -d beastcore -f banco.sql
```

## 5. Configurar conexão

Abra `database/connect.php`. Se for localhost, mude:

```php
$host   = "localhost";
$dbname = "beastcore";
$user   = "postgres";
$pass   = "SUA_SENHA_DO_POSTGRES";
```

## 6. Rodar o servidor

```bash
php -S 0.0.0.0:8000
```

## 7. Acessar

```
http://localhost:8000
```

Ou pelo IP do servidor: `http://SEU-IP:8000`

## 8. Logins

**Admin (específico):** beastcore / 123456  
**Admin:** marravictor6@gmail.com / admin123  
**Admin:** admin@beastcore.com / 123456  
**Aluno:** aluno@exemplo.com / 123456

## 9. Estrutura de Pastas

```
BeastCore/
│
├── admin/
│   ├── login.php           # Login do administrador
│   ├── planos.php          # Gerenciar planos
│   ├── professores.php     # Gerenciar professores
│   ├── unidades.php        # Gerenciar unidades
│   ├── usuarios.php        # Listar usuários
│   └── verifica_admin.php  # Verifica se é admin
│
├── database/
│   ├── connect.php         # Conexão com PostgreSQL (ou SQLite fallback)
│   └── demo.sqlite         # Banco de demonstração (só se PG offline)
│
├── includes/
│   ├── footer.php          # Rodapé do site
│   ├── functions.php       # Funções básicas
│   ├── header_admin_planos.php
│   ├── header_admin_unidades.php
│   ├── header_cadastrar.php
│   ├── header_exercicios.php
│   ├── header_index.php    # Header da página inicial
│   ├── header_login.php
│   ├── header_mensagens.php
│   ├── header_planos.php
│   ├── header_professores.php
│   ├── header_progresso.php
│   ├── header_treinos.php
│   ├── header_unidades.php
│   ├── header_usuarios.php
│   └── header.php          # Header antigo
│
├── login/
│   ├── cadastrar.php       # Cadastro de alunos
│   ├── login.php           # Login de usuários
│   ├── logout.php          # Sair do sistema
│   └── verifica_user.php   # Verifica se está logado
│
├── pages/
│   ├── exercicios.php      # Lista de exercícios
│   ├── mensagens.php       # Mensagens de contato
│   ├── planos.php          # Planos da academia
│   ├── progresso.php       # Progresso do aluno
│   ├── treinos.php         # Treinos do aluno
│   └── unidades.php        # Unidades da academia
│
├── style/
│   └── style.css           # Estilos do site (CSS)
│
├── banco.sql               # Arquivo SQL para importar
├── index.php               # Página inicial
└── README.md               # Este arquivo
```

## 10. Sobre o demo.sqlite

O arquivo `database/demo.sqlite` serve **apenas para visualização** caso o PostgreSQL esteja offline. Quando o PostgreSQL está online, ele é **ignorado** automaticamente.

## 11. Rodar em segundo plano (MobaXterm/Servidor)

```bash
cd BeastCore
nohup php -S 0.0.0.0:8000 > /dev/null 2>&1 &
```
