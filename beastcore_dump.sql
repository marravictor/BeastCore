-- ============================================================
-- BeastCore - Database Dump Universal (SQLite + PostgreSQL)
-- Compatível com qualquer máquina/servidor
-- Data: 2026-10-20
-- ============================================================

-- ------------------------------------------------------------
-- ESTRUTURA DAS TABELAS
-- ------------------------------------------------------------

-- Tabela: usuarios
CREATE TABLE IF NOT EXISTS usuarios (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nome TEXT NOT NULL,
    email TEXT NOT NULL UNIQUE,
    senha TEXT NOT NULL,
    data_nascimento TEXT NOT NULL,
    tipo TEXT DEFAULT 'aluno'
);

-- Tabela: unidades
CREATE TABLE IF NOT EXISTS unidades (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nome TEXT NOT NULL,
    endereco TEXT NOT NULL,
    telefone TEXT,
    horario TEXT
);

-- Tabela: planos
CREATE TABLE IF NOT EXISTS planos (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nome TEXT NOT NULL,
    preco REAL NOT NULL,
    descricao TEXT
);

-- Tabela: exercicios
CREATE TABLE IF NOT EXISTS exercicios (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nome TEXT NOT NULL,
    grupo_muscular TEXT NOT NULL,
    descricao TEXT
);

-- Tabela: treinos
CREATE TABLE IF NOT EXISTS treinos (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nome TEXT NOT NULL,
    descricao TEXT,
    usuario_id INTEGER NOT NULL
);

-- Tabela: progresso
CREATE TABLE IF NOT EXISTS progresso (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    usuario_id INTEGER NOT NULL,
    peso REAL NOT NULL,
    data_registro TEXT NOT NULL,
    observacao TEXT
);

-- Tabela: mensagens
CREATE TABLE IF NOT EXISTS mensagens (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nome TEXT NOT NULL,
    telefone TEXT,
    email TEXT,
    plano TEXT,
    mensagem TEXT NOT NULL,
    lida INTEGER DEFAULT 0,
    data_envio TEXT DEFAULT CURRENT_TIMESTAMP
);

-- ------------------------------------------------------------
-- DADOS INICIAIS (SEED)
-- ------------------------------------------------------------

-- Usuários (senhas são hashes bcrypt - senha padrão: "123456")
INSERT INTO usuarios (id, nome, email, senha, data_nascimento, tipo) VALUES 
(1, 'Professor Beast', 'admin@beastcore.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '1990-05-10', 'admin'),
(2, 'Aluno Exemplo', 'aluno@exemplo.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '2000-01-20', 'aluno'),
(3, 'Mariana Souza', 'mariana@exemplo.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '1995-07-14', 'aluno'),
(4, 'João Pedro Lima', 'joao@exemplo.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '1998-03-02', 'aluno'),
(5, 'Carla Menezes', 'carla@exemplo.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '2001-11-30', 'aluno');

-- Unidades
INSERT INTO unidades (id, nome, endereco, telefone, horario) VALUES 
(1, 'BeastCore Centro', 'Av. Principal, 1000 - Centro', '(19) 3333-1111', 'Seg a Sab, 6h as 22h'),
(2, 'BeastCore Zona Sul', 'Rua das Palmeiras, 450 - Jd. Sul', '(19) 3333-2222', 'Seg a Sab, 6h as 23h');

-- Planos
INSERT INTO planos (id, nome, preco, descricao) VALUES 
(1, 'Plano Basic', 89.90, 'Acesso a musculacao em horario livre e armario individual.'),
(2, 'Plano Beast VIP', 149.90, 'Acesso ilimitado, aulas em grupo, acompanhamento de personal e nutricionista.'),
(3, 'Plano Anual Elite', 119.90, 'Todos os beneficios do VIP com 20% de desconto no plano anual.');

-- Exercícios
INSERT INTO exercicios (id, nome, grupo_muscular, descricao) VALUES 
(1, 'Supino Reto com Barra', 'Peitoral', 'Exercicio composto focado em peitoral maior, triceps e deltoide anterior.'),
(2, 'Agachamento Livre', 'Pernas', 'Exercicio fundamental para quadriceps, gluteos e core.'),
(3, 'Puxada Frontal', 'Costas', 'Trabalha latissimo do dorso e biceps.'),
(4, 'Desenvolvimento com Halteres', 'Ombros', 'Foco nos deltoides anterior e lateral.'),
(5, 'Rosca Direta', 'Biceps', 'Isolamento para biceps braquial.');

-- Treinos (vinculados ao aluno ID 2)
INSERT INTO treinos (id, nome, descricao, usuario_id) VALUES 
(1, 'Treino A - Peito e Triceps', 'Supino reto 4x10, supino inclinado 3x12, triceps corda 3x15.', 2),
(2, 'Treino B - Costas e Biceps', 'Puxada frontal 4x10, remada curvada 3x12, rosca direta 3x15.', 2);

-- Progresso (vinculado ao aluno ID 2)
INSERT INTO progresso (id, usuario_id, peso, data_registro, observacao) VALUES 
(1, 2, 82.5, '2026-09-01', 'Inicio do acompanhamento.'),
(2, 2, 80.2, '2026-10-01', 'Boa evolucao, aumentei as cargas.');

-- Mensagens de contato
INSERT INTO mensagens (id, nome, telefone, email, plano, mensagem, lida, data_envio) VALUES 
(1, 'Carlos Andrade', '(19) 98888-7777', 'carlos@email.com', 'Beast VIP', 'Gostaria de saber os horarios das aulas em grupo.', 0, '2026-10-15 17:19:43');

-- ------------------------------------------------------------
-- AJUSTES DE AUTO_INCREMENT / SEQUENCE (para PostgreSQL)
-- ------------------------------------------------------------
-- SQLite: AUTOINCREMENT cuida sozinho
-- PostgreSQL: execute após importar:
-- SELECT setval('usuarios_id_seq', (SELECT MAX(id) FROM usuarios));
-- SELECT setval('unidades_id_seq', (SELECT MAX(id) FROM unidades));
-- SELECT setval('planos_id_seq', (SELECT MAX(id) FROM planos));
-- SELECT setval('exercicios_id_seq', (SELECT MAX(id) FROM exercicios));
-- SELECT setval('treinos_id_seq', (SELECT MAX(id) FROM treinos));
-- SELECT setval('progresso_id_seq', (SELECT MAX(id) FROM progresso));
-- SELECT setval('mensagens_id_seq', (SELECT MAX(id) FROM mensagens));

-- ============================================================
-- INSTRUÇÕES DE USO
-- ============================================================
--
-- 1. SQLITE (desenvolvimento local):
--    sqlite3 database/demo.sqlite < beastcore_dump.sql
--    OU no PHP: $pdo->exec(file_get_contents('beastcore_dump.sql'));
--
-- 2. POSTGRESQL (produção - Moba/Heroku/Railway/Render):
--    psql -h HOST -U USER -d DATABASE -f beastcore_dump.sql
--    OU via painel do provedor (import SQL)
--    APÓS importar, execute os comandos de setval acima
--
-- 3. CONFIGURAÇÃO DO BANCO (database/connect.php):
--    O arquivo já detecta automaticamente PostgreSQL ou SQLite
--    Em produção (Moba), configure as variáveis de ambiente:
--    DB_HOST, DB_NAME, DB_USER, DB_PASS
--
-- 4. CREDENCIAIS DE ACESSO:
--    Admin: admin@beastcore.com / 123456
--    Aluno: aluno@exemplo.com / 123456
--
-- ============================================================