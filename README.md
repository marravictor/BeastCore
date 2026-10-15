# BeastCore - Sistema de Academia

**Desenvolvido por Victor Marra da I1D35**

BeastCore é um site de academia desenvolvido em PHP básico e procedural, HTML5, CSS3, PostgreSQL com PDO e sessões PHP. Foi feito com foco em ser simples, funcional, seguro e fácil de entender — ideal para aprendizado e apresentação.

---

## 1. Objetivo

Este sistema tem como objetivo gerenciar informações de uma academia: alunos, professores, planos, exercícios, unidades, treinos, progresso e mensagens de contato.

---

## 2. Tecnologias Utilizadas

- PHP 
- HTML5
- CSS (moderno, responsivo e centralizado)
- PostgreSQL com PDO
- SQLite (fallback para visualização quando PostgreSQL não estiver acessível)
- Sessões PHP
- JavaScript não utilizado (apenas HTML+CSS+PHP básico)

---

## 3. Estrutura do Projeto

```
BeastCore/
├── admin/                # Área administrativa
│   ├── login.php         # Login do admin (hardcoded: beastcore/123456)
│   ├── planos.php        # Gerenciar planos (criar/editar/excluir)
│   ├── professores.php   # Cadastrar/excluir professores (tipo = professor)
│   ├── unidades.php       # Gerenciar unidades (cadastrar/editar/excluir)
│   ├── usuarios.php      # Listar usuários
│   └── verifica_admin.php# Proteção de rotas admin
├── app/                  # Arquivos auxiliares (não utilizados pelas páginas principais)
├── database/
│   ├── connect.php       # Conexão PG → fallback SQLite
│   └── demo.sqlite       # Banco de demonstração (apenas leitura quando PG offline)
├── includes/
│   ├── footer.php        # Rodapé padrão
│   ├── functions.php     # Funções reutilizáveis
│   ├── header_*.php      # Headers por página (padrão: um por página)
│   ├── header_professores.php
│   └── header_admin_unidades.php
├── login/
│   ├── cadastrar.php     # Cadastro de alunos
│   ├── login.php         # Login de usuários
│   ├── logout.php        # Encerramento de sessão
│   └── verifica_user.php # Proteção de rotas com login
├── pages/
│   ├── exercicios.php    # Exercícios (form só para admin)
│   ├── mensagens.php     # Fale conosco / mensagens
│   ├── planos.php        # Página pública de planos
│   ├── progresso.php     # Progresso do aluno
│   ├── treinos.php       # Treinos do aluno
│   └── unidades.php      # Unidades da academia
├── style/
│   └── style.css         # CSS unificado (preto + vermelho + responsivo)
├── index.php             # Página inicial (landing page)
└── README.md             # Documentação principal
```

---

## 4. Banco de Dados (PostgreSQL)

**Créditos:** O banco original não foi alterado. Apenas leitura e inserções seguras (com prepared statements). Professores são gravados na mesma tabela `usuarios`.

### Tabelas

| Tabela | Descrição |
|---|---|
| `usuarios` | Usuários do sistema. Campos: `id`, `nome`, `email`, `senha`, `data_nascimento`, `tipo` (valores: `aluno`, `admin`, `professor`). |
| `unidades` | Unidades da academia. |
| `planos` | Planos de assinatura (nome, preço, descrição). |
| `exercicios` | Biblioteca de exercícios. |
| `treinos` | Treinos por usuário. |
| `treino_exercicios` | Relação treino x exercícios. |
| `progresso` | Registro de progresso por usuário. |
| `mensagens` | Contatos recebidos. |

**Conexão:** `database/connect.php` tenta conectar ao PostgreSQL em `192.168.10.41:5432/db=beastcore` (usuário/senha: `beastcore`). Caso não consiga, usa `database/demo.sqlite` para demonstração.

---

## 5. Regras de Acesso

| Área | Condição |
|---|---|
| Público | `index.php`, `pages/exercicios.php`, `pages/unidades.php`, `pages/planos.php` |
| Exige login | `pages/treinos.php`, `pages/progresso.php`, `pages/mensagens.php` |
| Apenas Admin | `admin/usuarios.php`, `admin/planos.php`, `admin/professores.php` |
| Exercícios | Lista pública. **Apenas admins** podem cadastrar novos exercícios. Alunos só visualizam. |

---

## 6. Área Administrativa

Acesso via: `admin/login.php`

**Login padrão:**
- Usuário: `beastcore`
- Senha: `123456`

**Recursos:**
- `Usuários` – lista todos os usuários (ID, nome, e-mail, nascimento, tipo)
- `Professores` – cadastra/exclui professores (salvos com `tipo = 'professor'`). Campos: nome, e-mail, senha, data de nascimento. Senha com `password_hash`. E-mail único.
- `Gerenciar Planos` – criar, editar e excluir planos

---

## 7. Segurança

- `PDO::prepare` + `bindParam` em todas as consultas
- `password_hash` e `password_verify`
- `htmlspecialchars` para saída de dados
- Sessões para controle de acesso
- Proteção: `verifica_admin.php` (exige `tipo == 'admin'`) e `verifica_user.php` (exige login)
- Cabeçalhos por página e includes isolados

---

## 8. Layout e Visual

- Tema: preto (#000) + vermelho (#ef4444) para destaques
- Tipografia legível, títulos mais destacados
- Cards, botões com hover, sombras suaves
- Responsivo para PC, tablet e celular
- Estados vazios com mensagem elegante
- Logo clicável para voltar ao início
- Saudação ao usuário logado

---

## 9. Como Executar

### No Windows (ambiente atual)

Servidor embutido do PHP:

```powershell
cd C:\Users\I1D35\Documents\BeastCore
php -S localhost:8000
```
Abrir no navegador: `http://localhost:8000/`

---

## 11. Comentários no Código

Todo o código foi **comentado em português** para facilitar leitura e manutenção:
- `includes/functions.php` – funções agrupadas por módulo (Login, Treinos, Progresso, Mensagens, Exercícios, Planos, Unidades, Admin, Professores)
- Páginas admin – lógica clara e incremental
- Páginas públicas/privadas – fluxo simples e direto
- CSS organizado com variáveis CSS (`:root`)
---
## 13. Autoria

**Feito por Victor Marra da I1D35**  
Data: Outubro de 2026

Projeto desenvolvido sem frameworks. Código minimalista, didático e funcional.