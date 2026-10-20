# BeastCore

**Feito por:** Victor Marra (marravictor) - I1D35

Sistema de academia desenvolvido em PHP básico e procedural, HTML5, CSS3, PostgreSQL com PDO e sessões PHP. Simples, organizado e fácil de entender.

---

## 1. Pré-requisitos

Antes de começar, verifique se você tem instalado:

- [PHP](https://www.php.net/) (versão 8.x ou superior)
- [PostgreSQL](https://www.postgresql.org/)
- [Git](https://git-scm.com/)

---

## 2. Clonar o repositório

Abra o **Mobaxterm** (ou terminal) e execute:

```bash
git clone https://github.com/marravictor/BeastCore.git
```

Depois entre na pasta do projeto:

```bash
cd BeastCore
```

---

## 3. Criar o banco de dados no PostgreSQL

Abra o PostgreSQL com o usuário postgres:

```bash
psql -U postgres
```

Dentro do psql, crie o banco de dados:

```sql
CREATE DATABASE beastcore;
```

Saia do psql:

```sql
\q
```

---

## 4. Importar as tabelas e dados

Importe o arquivo `banco.sql` (que já está dentro do projeto) para o banco `beastcore`:

```bash
psql -U postgres -d beastcore -f banco.sql
```

Pronto! O banco vai ficar com todas as tabelas, usuários, planos, exercícios e a unidade já cadastrados.

---

## 5. Configurar a conexão com o banco

Abra o arquivo `database/connect.php` com um editor de texto.

**Caso esteja rodando na mesma máquina (localhost):**

Altere as linhas para:

```php
$host   = "localhost";
$dbname = "beastcore";
$user   = "postgres";
$pass   = "SUA_SENHA_DO_POSTGRES";
```

**Caso esteja rodando em servidor da sala (padrão):**

Pode deixar como está:

```php
$host   = "192.168.10.41";
$dbname = "beastcore";
$user   = "beastcore";
$pass   = "beastcore";
```

> Salve o arquivo após a alteração.

---

## 6. Rodar o servidor PHP

Dentro da pasta `BeastCore`, execute:

```bash
php -S 0.0.0.0:8000
```

Ou, se preferir localhost:

```bash
php -S localhost:8000
```

O servidor irá iniciar. Deixe o terminal aberto.

---

## 7. Acessar o site

Abra o navegador e digite:

```
http://localhost:8000
```

Ou:

```
http://127.0.0.1:8000
```

---

## 8. Logins para testar

### Área Administrativa (Admin)

**Login específico do Admin:**
- Usuário: `beastcore`
- Senha: `123456`

**Login comum (com tipo admin):**
- E-mail: `marravictor6@gmail.com`
- Senha: `admin123`

**Outro Admin:**
- E-mail: `admin@beastcore.com`
- Senha: `123456`

### Aluno

- E-mail: `aluno@exemplo.com`
- Senha: `123456`

---

## 9. Sobre o arquivo `database/demo.sqlite`

O arquivo `database/demo.sqlite` está na pasta `database/` e **serve apenas como banco de demonstração**.

- Se o **PostgreSQL estiver online e conseguir conectar**, o site **ignora** o `demo.sqlite` e usa o **PostgreSQL**.
- Se o **PostgreSQL estiver offline**, o site **usa automaticamente** o `demo.sqlite` para conseguir visualizar o site (modo demonstração).

**Não é necessário mexer nesse arquivo.** Basta deixá-lo na pasta.

---

## 10. Estrutura do Projeto

```
BeastCore/
├── admin/                # Área do administrador
├── database/             # Conexão com banco + demo.sqlite
├── includes/             # Funções e headers
├── login/                # Login, cadastro e logout
├── pages/                # Páginas públicas e privadas
├── style/                # CSS do site
├── index.php             # Página inicial
├── banco.sql             # SQL para importar no PostgreSQL
└── README.md             # Este arquivo
```

---

## 11. Observações

- Projeto feito em PHP **básico e procedural** (sem frameworks).
- Usa `PDO` com consultas preparadas para maior segurança.
- Senhas estão com `password_hash` no banco.
- O banco PostgreSQL **não é alterado automaticamente**. Tudo feito de forma segura e manual quando necessário.
- Feito por **Victor Marra (marravictor) - I1D35**.
