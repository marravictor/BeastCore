# BeastCore - Sistema para Academia

**Feito por Victor Marra da I1D35**

---

## 🚀 Deploy Universal (Funciona em QUALQUER máquina)

Este projeto roda **local (VS Code)**, **Moba**, **Heroku**, **Railway**, **Render**, **VPS**, **Docker** - sem mudar código.

### Arquivos principais:
| Arquivo | Função |
|---------|--------|
| `beastcore_dump.sql` | **Dump universal** (schema + dados) - SQLite + PostgreSQL |
| `database/connect.php` | Conexão automática (detecta PostgreSQL/SQLite via env vars) |
| `database/init_db.php` | Inicializa banco com um comando: `php database/init_db.php` |
| `DEPLOY.md` | Guia completo de deploy no Moba/Heroku/Railway/Render |

---

## 🖥️ Desenvolvimento Local (VS Code)

```bash
# 1. Clone
git clone https://github.com/marravictor/BeastCore.git
cd BeastCore

# 2. Rode (PHP 8.1+ com pdo_sqlite)
php -S localhost:8000

# 3. Acesse
# http://localhost:8000
# Admin: admin@beastcore.com / 123456
# Aluno: aluno@exemplo.com / 123456
```

**Resetar banco local:**
```bash
php database/init_db.php
```

---

## ☁️ Deploy no Moba (ou Heroku / Railway / Render)

### 1. Push pro GitHub
```bash
git add .
git commit -m "Deploy universal ready"
git push origin main
```

### 2. No painel do Moba
- **Add Service** → **PostgreSQL**
- **Environment Variables** (copie do banco criado):
  ```
  DB_HOST=seu-host.moba.com
  DB_PORT=5432
  DB_NAME=beastcore
  DB_USER=postgres
  DB_PASS=sua-senha
  ```
- **Start Command**: `php -S 0.0.0.0:$PORT`
- **Deploy**

### 3. Primeira vez no servidor (console do Moba)
```bash
php database/init_db.php
```
Ou importe `beastcore_dump.sql` via pgAdmin/DBeaver/painel do Moba.

### 4. Ajuste sequences (só PostgreSQL)
```sql
SELECT setval('usuarios_id_seq', (SELECT MAX(id) FROM usuarios));
SELECT setval('unidades_id_seq', (SELECT MAX(id) FROM unidades));
SELECT setval('planos_id_seq', (SELECT MAX(id) FROM planos));
SELECT setval('exercicios_id_seq', (SELECT MAX(id) FROM exercicios));
SELECT setval('treinos_id_seq', (SELECT MAX(id) FROM treinos));
SELECT setval('progresso_id_seq', (SELECT MAX(id) FROM progresso));
SELECT setval('mensagens_id_seq', (SELECT MAX(id) FROM mensagens));
```

---

## 🔧 Como funciona a mágica (connect.php)

```php
// 1. Lê variáveis de ambiente (produção)
$host = $_ENV['DB_HOST'] ?? getenv('DB_HOST') ?? "192.168.10.41";
// ...

// 2. Tem DB_HOST configurado? → PostgreSQL (Moba/Produção)
// 3. Não tem? Testa conexão local PostgreSQL (sua rede)
// 4. Falhou? → SQLite local (database/demo.sqlite)
// 5. Nem isso? → SQLite em memória + init automático do dump
```

**Resultado**: Mesmo código, qualquer ambiente.

---

## 📦 O que tem no Dump (`beastcore_dump.sql`)

- ✅ **7 tabelas** com `CREATE TABLE IF NOT EXISTS`
- ✅ **Dados seed** (5 usuários, 2 unidades, 3 planos, 5 exercícios, 2 treinos, 2 progressos, 1 mensagem)
- ✅ **Compatível** SQLite E PostgreSQL
- ✅ **Senhas** = bcrypt de "123456"

### Tabelas:
| Tabela | Descrição |
|--------|-----------|
| `usuarios` | Alunos, professores, admins |
| `unidades` | Academias/filiais |
| `planos` | Planos de assinatura |
| `exercicios` | Biblioteca de exercícios |
| `treinos` | Treinos dos alunos |
| `progresso` | Histórico de peso/medidas |
| `mensagens` | Contato/leads |

---

## 🔑 Logins (padrão no dump)

| Perfil | Email | Senha |
|--------|-------|-------|
| **Admin** | `admin@beastcore.com` | `123456` |
| **Aluno** | `aluno@exemplo.com` | `123456` |

---

## 📁 Estrutura das pastas

```text
BeastCore/
├── admin/                 # Painel admin
│   ├── login.php
│   ├── planos.php
│   ├── professores.php
│   ├── unidades.php
│   ├── usuarios.php
│   └── verifica_admin.php
├── app/                   # API/endpoints
│   ├── create.php
│   ├── select.php
│   ├── select_w.php
│   ├── update.php
│   └── delete.php
├── database/
│   ├── connect.php        # Conexão UNIVERSAL (PG/SQLite)
│   ├── init_db.php        # Inicializador automático
│   └── demo.sqlite        # Banco local (ignorado no git)
├── includes/              # Headers, footer, functions
├── login/                 # Auth aluno
│   ├── cadastrar.php
│   ├── login.php
│   ├── logout.php
│   └── verifica_user.php
├── pages/                 # Páginas do aluno
│   ├── exercicios.php
│   ├── mensagens.php
│   ├── planos.php
│   ├── progresso.php
│   ├── treinos.php
│   └── unidades.php
├── style/
│   └── style.css
├── beastcore_dump.sql     # DUMP UNIVERSAL (schema + dados)
├── DEPLOY.md              # Guia de deploy completo
├── index.php              # Página inicial
└── README.md              # Este arquivo
```

---

## 🛠️ Comandos Úteis

```bash
# Testar conexão
php -r "require 'database/connect.php'; echo 'OK: ' . \$conexao->getAttribute(PDO::ATTR_DRIVER_NAME);"

# Recriar banco local do zero
rm database/demo.sqlite
php database/init_db.php

# Ver logs (se usar nohup)
tail -f nohup.out
```

---

## ⚠️ Troubleshooting

| Problema | Solução |
|----------|---------|
| "Erro ao conectar ao banco" | Verifique `DB_HOST`, `DB_NAME`, `DB_USER`, `DB_PASS` no Moba |
| Tabelas não criam no PG | Rode `php database/init_db.php` no console do servidor |
| Auto-incremento dá erro | Execute os comandos `setval` acima |
| Login não funciona | Senha padrão é `123456` (hash bcrypt no dump) |
| CSS/JS não carrega | Configure servidor web para servir arquivos estáticos |

---

## 📞 Suporte

1. Verifique logs do Moba (aba **Logs**)
2. Teste conexão: `php -r "require 'database/connect.php'; var_dump(\$conexao);"`
3. Confirme extensões `pdo_pgsql` e `pdo_sqlite` ativas no PHP do servidor

---

**✨ Pronto! BeastCore roda em qualquer lugar - local, Moba, Heroku, Railway, Render, VPS, Docker...**