# 🚀 BeastCore - Guia de Deploy Universal (Moba / Heroku / Railway / Render)

Este projeto roda em **qualquer máquina/servidor** graças à detecção automática de banco:
- **Produção**: PostgreSQL (via variáveis de ambiente)
- **Desenvolvimento**: SQLite (arquivo local `database/demo.sqlite`)

---

## 📁 Arquivos Principais

| Arquivo | Função |
|---------|--------|
| `beastcore_dump.sql` | **Dump completo** (schema + dados) - use em qualquer banco |
| `database/connect.php` | Conexão universal (detecta PostgreSQL/SQLite automaticamente) |
| `database/init_db.php` | Script para inicializar banco via PHP |

---

## 🖥️ Desenvolvimento Local (VS Code)

### 1. Pré-requisitos
- PHP 8.1+ com extensões `pdo_sqlite` e `pdo_pgsql`
- Servidor web (Apache/Nginx) ou PHP built-in server

### 2. Rodar localmente
```bash
# Opção 1: PHP Built-in Server (mais simples)
cd C:\Users\I1D35\Documents\BeastCore
php -S localhost:8000

# Opção 2: Apache/XAMPP/WAMP
# Coloque a pasta no htdocs/www e acesse http://localhost/BeastCore
```

### 3. Acessar
- URL: `http://localhost:8000`
- **Admin**: `admin@beastcore.com` / `123456`
- **Aluno**: `aluno@exemplo.com` / `123456`

### 4. Resetar banco local (se precisar)
```bash
php database/init_db.php
```

---

## ☁️ Deploy no Moba (ou Heroku / Railway / Render)

### 1. Prepare o repositório
```bash
# No VS Code Terminal (já está no git)
git add .
git commit -m "Deploy: dump universal + connect.php atualizado"
git push origin main
```

### 2. No painel do Moba (ou provedor similar)

#### A. Crie o banco PostgreSQL
- No dashboard: **Add Service** → **PostgreSQL**
- Anote: Host, Database, User, Password, Port

#### B. Configure as Variáveis de Ambiente (Environment Variables)
| Variável | Valor | Exemplo |
|----------|-------|---------|
| `DB_HOST` | Host do PostgreSQL | `db-xyz.moba.com` |
| `DB_PORT` | Porta (padrão 5432) | `5432` |
| `DB_NAME` | Nome do banco | `beastcore` |
| `DB_USER` | Usuário do banco | `postgres` |
| `DB_PASS` | Senha do banco | `senha_super_secreta` |

#### C. Configure o Build/Start Command
```
Build: (vazio - PHP não precisa build)
Start: php -S 0.0.0.0:$PORT
```
*Ou configure Apache/Nginx apontando para a pasta raiz*

#### D. Deploy
- Clique em **Deploy**
- Aguarde o build completar

### 3. Inicialize o banco na primeira vez
Após o primeiro deploy, execute **uma vez** no terminal/console do Moba:
```bash
php database/init_db.php
```
Ou importe o `beastcore_dump.sql` via painel do PostgreSQL (phpMyAdmin/pgAdmin/DBeaver).

### 4. Ajuste sequences (só PostgreSQL)
Após importar o SQL, execute no console SQL do provedor:
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

O arquivo `database/connect.php` faz **detecção automática**:

```php
// 1. Verifica variáveis de ambiente (produção)
$host = $_ENV['DB_HOST'] ?? getenv('DB_HOST') ?? "192.168.10.41";
// ...

// 2. Tenta PostgreSQL se configuração de produção existe
if ($isProduction || @fsockopen($host, $port, ...)) {
    // Conecta no PostgreSQL
}

// 3. Fallback: SQLite local (desenvolvimento)
if (!$conexao) {
    $demo = __DIR__ . "/demo.sqlite";
    // ...
}

// 4. Último recurso: SQLite em memória + init automático
if (!$conexao) {
    // Cria tabelas do beastcore_dump.sql na hora
}
```

**Resultado**: O **mesmo código** roda no seu PC, no Moba, no Heroku, Railway, Render, VPS, etc.

---

## 📦 Estrutura do Dump (`beastcore_dump.sql`)

O dump contém:
- ✅ **7 tabelas** com `CREATE TABLE IF NOT EXISTS`
- ✅ **Dados iniciais** (5 usuários, 2 unidades, 3 planos, 5 exercícios, 2 treinos, 2 progressos, 1 mensagem)
- ✅ **Compatível** com SQLite E PostgreSQL
- ✅ **Comentários** com instruções de uso

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

## 🛠️ Comandos Úteis

```bash
# Verificar conexão local
php -r "require 'database/connect.php'; echo 'OK: ' . \$conexao->getAttribute(PDO::ATTR_DRIVER_NAME);"

# Recriar banco local do zero
rm database/demo.sqlite
php database/init_db.php

# Exportar dump atualizado (após mudanças locais)
php database/init_db.php  # garante que demo.sqlite está atualizado
# Depois use ferramenta do SQLite para exportar, ou rode o dump manualmente
```

---

## ⚠️ Checklist Pré-Deploy

- [ ] `beastcore_dump.sql` na raiz do projeto
- [ ] `database/connect.php` atualizado (usa env vars)
- [ ] `database/init_db.php` presente
- [ ] `.gitignore` ignora `database/demo.sqlite` e `vendor/`
- [ ] Variáveis de ambiente configuradas no Moba
- [ ] Build/Start command configurado
- [ ] Primeira execução do `init_db.php` no servidor

---

## 🆘 Troubleshooting

| Problema | Solução |
|----------|---------|
| "Erro ao conectar ao banco" | Verifique se `DB_HOST`, `DB_NAME`, `DB_USER`, `DB_PASS` estão corretos no Moba |
| Tabelas não criam no PostgreSQL | Rode `php database/init_db.php` no console do servidor |
| Auto-incremento dá erro | Execute os comandos `setval` listados acima |
| Login não funciona | Senha padrão é `123456` (hash bcrypt no dump) |
| CSS/JS não carrega | Configure servidor web para servir arquivos estáticos da pasta raiz |

---

## 📞 Suporte

Se tiver dúvidas no deploy:
1. Verifique logs do Moba (aba **Logs**)
2. Teste conexão: `php -r "require 'database/connect.php'; var_dump(\$conexao);"`
3. Confirme se extensões `pdo_pgsql` e `pdo_sqlite` estão ativas no PHP do servidor

---

**✨ Pronto! Seu BeastCore agora roda em qualquer lugar - local, Moba, Heroku, Railway, Render, VPS, Docker...**