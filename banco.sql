-- BeastCore - SQL para criação das tabelas
-- Feito por: Victor Marra (marravictor) - I1D35

-- Tabela de usuários
CREATE TABLE IF NOT EXISTS usuarios (
    id SERIAL PRIMARY KEY,
    nome VARCHAR(150) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    data_nascimento DATE NOT NULL,
    tipo VARCHAR(50) NOT NULL DEFAULT 'aluno'
);

-- Tabela de unidades
CREATE TABLE IF NOT EXISTS unidades (
    id SERIAL PRIMARY KEY,
    nome VARCHAR(150) NOT NULL,
    endereco VARCHAR(255) NOT NULL,
    telefone VARCHAR(50),
    horario VARCHAR(100)
);

-- Tabela de planos
CREATE TABLE IF NOT EXISTS planos (
    id SERIAL PRIMARY KEY,
    nome VARCHAR(150) NOT NULL,
    preco NUMERIC(10,2) NOT NULL,
    descricao TEXT
);

-- Tabela de exercícios
CREATE TABLE IF NOT EXISTS exercicios (
    id SERIAL PRIMARY KEY,
    nome VARCHAR(150) NOT NULL,
    grupo_muscular VARCHAR(100) NOT NULL,
    descricao TEXT
);

-- Tabela de treinos
CREATE TABLE IF NOT EXISTS treinos (
    id SERIAL PRIMARY KEY,
    nome VARCHAR(150) NOT NULL,
    descricao TEXT,
    usuario_id INTEGER NOT NULL,
    CONSTRAINT fk_treinos_usuario FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE
);

-- Tabela de exercícios do treino
CREATE TABLE IF NOT EXISTS treino_exercicios (
    id SERIAL PRIMARY KEY,
    treino_id INTEGER NOT NULL,
    exercicio_id INTEGER NOT NULL,
    series INTEGER,
    repeticoes INTEGER,
    peso REAL,
    CONSTRAINT fk_te_treino FOREIGN KEY (treino_id) REFERENCES treinos(id) ON DELETE CASCADE,
    CONSTRAINT fk_te_exercicio FOREIGN KEY (exercicio_id) REFERENCES exercicios(id) ON DELETE CASCADE
);

-- Tabela de progresso
CREATE TABLE IF NOT EXISTS progresso (
    id SERIAL PRIMARY KEY,
    usuario_id INTEGER NOT NULL,
    peso REAL NOT NULL,
    data_registro DATE NOT NULL,
    observacao TEXT,
    CONSTRAINT fk_progresso_usuario FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE
);

-- Tabela de mensagens
CREATE TABLE IF NOT EXISTS mensagens (
    id SERIAL PRIMARY KEY,
    nome VARCHAR(150) NOT NULL,
    telefone VARCHAR(50),
    email VARCHAR(150),
    plano VARCHAR(150),
    mensagem TEXT NOT NULL,
    lida BOOLEAN DEFAULT FALSE,
    data_envio TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Usuários padrão
INSERT INTO usuarios (nome, email, senha, data_nascimento, tipo) VALUES
('Administrador', 'marravictor6@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '1990-01-01', 'admin'),
('Admin BeastCore', 'admin@beastcore.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '1990-01-01', 'admin'),
('BeastCore Admin', 'beastcore', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '1990-01-01', 'admin'),
('Aluno Exemplo', 'aluno@exemplo.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '2000-01-01', 'aluno');

-- Planos
INSERT INTO planos (nome, preco, descricao) VALUES
('Mensal', 99.90, 'Acesso à musculação e área cardio.'),
('Trimestral', 149.90, 'Acesso completo durante 3 meses.'),
('Anual', 199.90, 'Acesso completo durante 12 meses.');

-- Unidades
INSERT INTO unidades (nome, endereco, telefone, horario) VALUES
('BeastCore Alvorada', 'Rua Saturno, 186, Bairro Alvorada', '19 993244009', '06:00 às 23:00');

-- Exercícios
INSERT INTO exercicios (nome, grupo_muscular, descricao) VALUES
('Supino reto', 'Peito', 'Exercício para peitoral.'),
('Agachamento', 'Pernas', 'Exercício para membros inferiores.'),
('Rosca direta', 'Bíceps', 'Exercício para bíceps.'),
('Tríceps pulley', 'Tríceps', 'Exercício para tríceps.');
