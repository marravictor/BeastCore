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

## 🛠️ Comandos úteis afterward

```bash
# Atualizar código no futuro (só isto!)
git pull origin main

# Recriar banco local do zero (se precisar)
php database/init_db.php
```
**Pronto! O professor tem o site funcionando com só clonar o repositório e configurar o .env.**
