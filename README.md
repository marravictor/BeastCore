# BeastCore - Sistema para Academia

**Feito por Victor Marra da I1D35**

---

## 👨‍🏫 GUIA RÁPIDO PARA O PROFESSOR ACESSAR O SITE
*(Passo a passo sem conhecimento técnico necessário)*

### 🎯 Objetivo: Deixar o site no ar **pra sempre** no navegador (URL fixa)

---

### PASSO 1: Criar conta no Moba (grátis)
1. Acesse: **https://moba.com** (ou **https://mobaxterm.mobatek.net** se for MobaXterm)
2. Clique em **"Sign Up"** / **"Criar conta"**
3. Use email do professor → confirme no email

---

### PASSO 2: Criar o Banco de Dados (PostgreSQL)
1. No painel do Moba → clique em **"+ New Service"** ou **"+ Add Service"**
2. Escolha: **PostgreSQL** (ícone de elefante azul)
3. Nome: `beastcore-db` (qualquer nome)
4. Plano: **Free / Hobby** (grátis)
5. Clique **Create** / **Criar**
6. **AGUARDE** ficar verde **"Running"** (uns 30 seg)

---

### PASSO 3: Pegar as credenciais do banco
1. Clique no banco `beastcore-db` que acabou de criar
2. Vá na aba **Connection Info** / **Conexão** / **Details**
3. **COPIE** estes 5 valores (guarde num bloco de notas):
   ```
   Host:     postgres-xxx.moba.com     (ou IP interno tipo 10.x.x.x)
   Port:     5432
   Database: beastcore                 (nome do banco)
   User:     postgres
   Password: ********                  (clique no olho pra ver)
   ```

---

### PASSO 4: Criar o App (o site)
1. No painel → **"+ New Service"** → **App** / **Web Service**
2. **Source**: **GitHub** → conecte sua conta GitHub se pedir
3. **Repository**: `marravictor/BeastCore` (selecione esse repo)
4. **Branch**: `main`
5. **Build Command**: *(deixe vazio)*
6. **Start Command**: `php -S 0.0.0.0:$PORT`
7. **NÃO clique em Deploy ainda!**

---

### PASSO 5: Colar as variáveis de ambiente (O MAIS IMPORTANTE!)
**Ainda na tela de criar o App**, procure **"Environment Variables"** / **"Variáveis de Ambiente"** / **"Env Vars"**

**Adicione EXATAMENTE estas 5 linhas** (cole os valores do PASSO 3):

| Key (Nome) | Value (Valor) |
|------------|---------------|
| `DB_HOST` | `postgres-xxx.moba.com` *(o Host do PASSO 3)* |
| `DB_PORT` | `5432` |
| `DB_NAME` | `beastcore` *(o Database do PASSO 3)* |
| `DB_USER` | `postgres` *(o User do PASSO 3)* |
| `DB_PASS` | `sua_senha_real` *(o Password do PASSO 3 - clique no olho)* |

⚠️ **Cuidados:**
- Sem aspas, sem espaços antes/depois
- `DB_HOST` **NÃO** é `localhost` nem `192.168.x.x`
- `DB_PASS` copie **exato** (maiúsculas/minúsculas/símbolos)

---

### PASSO 6: Deploy!
1. Clique **Deploy** / **Create & Deploy**
2. Aguarde **2-3 minutos** (barra verde)
3. Quando aparecer **"Running"** → **CLIQUE NA URL** (ex: `https://beastcore-xxx.moba.app`)

---

### PASSO 7: Criar as tabelas (SÓ NA PRIMEIRA VEZ)
1. No painel do App → aba **Console** / **Terminal** / **Shell**
2. Digite e aperte Enter:
   ```bash
   php database/init_db.php
   ```
3. Deve aparecer:
   ```
   ✅ Banco de dados inicializado com sucesso!
   📋 Tabelas criadas: usuarios, unidades, planos, exercicios, treinos, progresso, mensagens
   👤 Login admin: admin@beastcore.com / 123456
   👤 Login aluno: aluno@exemplo.com / 123456
   ```

---

### PASSO 8: Ajustar auto-incremento (SÓ NA PRIMEIRA VEZ)
**Ainda no Console do Moba**, cole isto **todo de uma vez** e aperte Enter:

```sql
psql $DATABASE_URL -c "SELECT setval('usuarios_id_seq', (SELECT MAX(id) FROM usuarios)); SELECT setval('unidades_id_seq', (SELECT MAX(id) FROM unidades)); SELECT setval('planos_id_seq', (SELECT MAX(id) FROM planos)); SELECT setval('exercicios_id_seq', (SELECT MAX(id) FROM exercicios)); SELECT setval('treinos_id_seq', (SELECT MAX(id) FROM treinos)); SELECT setval('progresso_id_seq', (SELECT MAX(id) FROM progresso)); SELECT setval('mensagens_id_seq', (SELECT MAX(id) FROM mensagens));"
```

*Ou use o painel do banco → Query Tool → cole os 7 SELECT setval... um por um*

---

### ✅ PRONTO! O SITE ESTÁ NO AR PRA SEMPRE

**URL fixa:** `https://seu-app.moba.app` (guarde essa URL)

**Logins:**
| Perfil | Email | Senha |
|--------|-------|-------|
| **Professor/Admin** | `admin@beastcore.com` | `123456` |
| **Aluno** | `aluno@exemplo.com` | `123456` |

---

### 🔄 Atualizações futuras (quando aluno mudar código)
1. Aluno faz mudança no VS Code
2. `git add . && git commit -m "msg" && git push`
3. **Moba faz deploy automático** (ou clique **Redeploy** no painel)
4. Site atualiza sozinho na mesma URL

---

---

## 🚀 Deploy Universal (Detalhes técnicos)

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

# http://localhost:8000
# Admin: admin@beastcore.com / 123456
# Aluno: aluno@exemplo.com / 123456
```

**Resetar banco local:**
```bash
php database/init_db.php
```

---

## ☁️ Deploy no Moba (Resumo Técnico)

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
