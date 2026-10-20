# BeastCore - Sistema para Academia

**Feito por Victor Marra da I1D35**

## 1. Clonar no Mobaxterm

Abra o Mobaxterm e cole este comando:

```bash
git clone https://github.com/marravictor/BeastCore.git
```

## 2. Criar o banco de dados

```bash
psql -U postgres
```

```sql
CREATE DATABASE beastcore;
\q
```

## 3. Importar o banco

```bash
psql -U postgres -d beastcore -f banco.sql
```

## 4. Configurar a conexao

Abra o arquivo `database/connect.php` e mude se for localhost:

```php
$host   = "localhost";
$dbname = "beastcore";
$user   = "postgres";
$pass   = "SUA_SENHA";
```

## 5. Rodar o site (fica rodando mesmo fechando o Mobaxterm)

```bash
cd BeastCore
nohup php -S 0.0.0.0:8000 > /dev/null 2>&1 &
```

## 6. Abrir o site no navegador

Pegue o IP do servidor:

```bash
ip a
```

Depois abra no navegador:

```text
http://SEU-IP:8000
```

Exemplo: `http://192.168.10.10:8000`

## 7. Estrutura das pastas

```text
BeastCore/
?
??? admin/
?   ??? login.php           -> Login do admin
?   ??? planos.php          -> Cadastrar/editar/excluir planos
?   ??? professores.php     -> Cadastrar/excluir professores
?   ??? unidades.php        -> Cadastrar/editar/excluir unidades
?   ??? usuarios.php        -> Ver todos os usuarios
?   ??? verifica_admin.php  -> Protege paginas do admin
?
??? database/
?   ??? connect.php         -> Conexao com PostgreSQL/SQLite
?   ??? demo.sqlite         -> Banco de teste (so quando PG esta offline)
?
??? includes/
?   ??? footer.php          -> Rodape
?   ??? functions.php       -> Funcoes
?   ??? header.php
?   ??? header_admin_planos.php
?   ??? header_admin_unidades.php
?   ??? header_cadastrar.php
?   ??? header_exercicios.php
?   ??? header_index.php    -> Header da pagina inicial
?   ??? header_login.php
?   ??? header_mensagens.php
?   ??? header_planos.php
?   ??? header_professores.php
?   ??? header_progresso.php
?   ??? header_treinos.php
?   ??? header_unidades.php
?   ??? header_usuarios.php
?
??? login/
?   ??? cadastrar.php       -> Cadastro de aluno
?   ??? login.php           -> Login de aluno/admin
?   ??? logout.php          -> Sair
?   ??? verifica_user.php   -> Protege paginas que precisam logar
?
??? pages/
?   ??? exercicios.php      -> Lista de exercicios
?   ??? mensagens.php       -> Enviar mensagem
?   ??? planos.php          -> Ver planos
?   ??? progresso.php       -> Progresso do aluno
?   ??? treinos.php         -> Treinos do aluno
?   ??? unidades.php        -> Ver unidades
?
??? style/
?   ??? style.css           -> Estilos CSS
?
??? banco.sql               -> Arquivo para importar no PostgreSQL
??? index.php               -> Pagina inicial
```

## 8. Logins

**Admin:** beastcore / 123456  
**Admin:** marravictor6@gmail.com / admin123  
**Admin:** admin@beastcore.com / 123456  
**Aluno:** aluno@exemplo.com / 123456
