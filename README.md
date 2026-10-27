# BeastCore - Sistema para Academia

**Feito por Victor Marra da I1D35**

---

## 👨‍🏫 PARA O PROFESSOR (Já tem o deploy no ar)

Se o professor já tem o site no ar no Moba/servidor e só precisa atualizar ou configurar, siga este passo a passo **simplificado**:

### 📥 PASSO 0: Clonar o repositório (só isto!)

```bash
# No terminal (Mobaxterm, PowerShell, Git Bash)
git clone https://github.com/marravictor/BeastCore.git

# Entra na pasta
cd BeastCore

# Mover para a pasta do site (se já tem Apache/Nginx configurado)
cd /var/www/html
# ou ficar na pasta BeastCore e apontar o servidor pra ela
```

---

### 🔧 PASSO 1: Configurar o banco (arquivo .env)

Crie o arquivo `.env` dentro da pasta `BeastCore` com os dados do banco do professor:

```bash
echo "DB_HOST=localhost
DB_PORT=5432
DB_NAME=beastcore
DB_USER=postgres
DB_PASS=sua_senha
BASE_PATH=/BeastCore" > .env
```

> **Importante**: Ajuste `DB_HOST`, `DB_NAME`, `DB_USER`, `DB_PASS` com os dados do banco do professor. `BASE_PATH=/BeastCore` se o site estiver na subpasta.

---

### 🔐 PASSO 2: Dar permissão no banco (se SQLite)

```bash
chown -R www-data:www-data database/
chmod 664 database/demo.sqlite
```

---

### ▶️ PASSO 3: Reiniciar o site

**Apache:**
```bash
sudo systemctl restart apache2
```

**Nginx:**
```bash
sudo systemctl restart nginx
```

---

### ✅ Pronto!

Acesse: `http://IP_DO_SERVIDOR/` ou `http://IP_DO_SERVIDOR/BeastCore/`

**Logins:**
| Perfil | Email | Senha |
|--------|-------|-------|
| **Admin** | `admin@beastcore.com` | `123456` |
| **Aluno** | `aluno@exemplo.com` | `123456` |

---

## 🛠️ Comandos úteis afterward

```bash
# Atualizar código no futuro (só isto!)
git pull origin main

# Recriar banco local do zero (se precisar)
php database/init_db.php
```

---

## 📞 Suporte

Se der erro:
1. Verifique se o `.env` está correto na pasta `BeastCore/`
2. Verifique permissões do banco (`chown www-data:www-data database/`)
3. Rodando Apache: `sudo tail -f /var/log/apache2/error.log`
4. Rodando Nginx: `sudo tail -f /var/log/nginx/error.log`

---

**Pronto! O professor tem o site funcionando com só clonar o repositório e configurar o .env.**