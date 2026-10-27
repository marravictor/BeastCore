# BeastCore - Sistema para Academia

**Feito por Victor Marra da I1D35**

---

## 👨‍🏫 PARA O PROFESSOR (Já tem o deploy no ar)

Se o professor já tem o site no ar no Moba/servidor e só precisa atualizar ou configurar, siga este passo a passo **simplificado**:

### 📥 PASSO 1: Clonar o repositório (só isto!)

```bash
# No terminal (Mobaxterm)
git clone https://github.com/marravictor/BeastCore.git

# Entra na pasta
cd /var/www/html/

# Adicione no terminal
git clone https://github.com/marravictor/BeastCore.git

```
### Logins!

**Logins:**
| Perfil | Email | Senha |
|--------|-------|-------|
| **Admin** | `admin@beastcore.com` | `123456` |
| **Aluno** | `aluno@exemplo.com` | `123456` |

---

## 🛠️ Tecnologias Utilizadas

Esta projeto foi construído com:

| Tecnologia | Função |
|------------|--------|
| **PHP 8.1+** | linguagem de backend, processamento de lógica e banco de dados |
| **PostgreSQL** | banco de dados relacional para produção (Moba, Heroku, Render, VPS) |
| **SQLite** | banco de dados local em arquivo para desenvolvimento/testes |
| **PDO** | extensão PHP para conexão com múltiplos bancos de dados |
| **HTML5 + CSS3** | estrutura e estilização das páginas |
| **Git + GitHub** | versionamento e deploy automático |
| **Apache / Nginx** | servidores web para hospedagem |
| **Bootstrap / CSS Custom** | layout responsivo e design visual |

---

## 🛠️ Comandos úteis afterward

```bash
# Atualizar código no futuro (só isto!)
git pull origin main

# Recriar banco local do zero (se precisar)
php database/init_db.php
```
**Pronto! O professor tem o site funcionando com só clonar o repositório e configurar o .env.**
