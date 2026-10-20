<?php
require_once __DIR__ . '/../database/connect.php';

// ---------------- LOGIN ----------------

function email_existe($conexao, $email)
{
    $sql = "SELECT id FROM usuarios WHERE email = :email";

    $stmt = $conexao->prepare($sql);
    $stmt->bindParam(":email", $email);
    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function cadastrar_user($conexao, $nome, $email, $senha, $data_nascimento)
{
    $senha = password_hash($senha, PASSWORD_DEFAULT);

    $sql = "INSERT INTO usuarios (nome, email, senha, data_nascimento) VALUES (:nome, :email, :senha, :data_nascimento)";

    $stmt = $conexao->prepare($sql);
    $stmt->bindParam(":nome", $nome);
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":senha", $senha);
    $stmt->bindParam(":data_nascimento", $data_nascimento);

    $stmt->execute();
    echo "<p class='ok'>Usuário cadastrado com sucesso!</p>";
}

function consulta_user($conexao, $email)
{
    $sql = "SELECT id, nome, email, senha, tipo FROM usuarios WHERE email = :email";

    $stmt = $conexao->prepare($sql);
    $stmt->bindParam(":email", $email);
    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// ---------------- TREINOS ----------------

function cadastrar_treino($conexao, $usuario_id, $nome, $descricao)
{
    $sql = "INSERT INTO treinos (usuario_id, nome, descricao) VALUES (:usuario_id, :nome, :descricao)";

    $stmt = $conexao->prepare($sql);
    $stmt->bindParam(":usuario_id", $usuario_id);
    $stmt->bindParam(":nome", $nome);
    $stmt->bindParam(":descricao", $descricao);
    $stmt->execute();

    echo "<p class='ok'>Treino cadastrado com sucesso!</p>";
}

function listar_treinos($conexao, $usuario_id)
{
    $sql = "SELECT * FROM treinos WHERE usuario_id = :usuario_id ORDER BY id DESC";

    $stmt = $conexao->prepare($sql);
    $stmt->bindParam(":usuario_id", $usuario_id);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function deletar_treino($conexao, $id, $usuario_id)
{
    $sql = "DELETE FROM treinos WHERE id = :id AND usuario_id = :usuario_id";

    $stmt = $conexao->prepare($sql);
    $stmt->bindParam(":id", $id);
    $stmt->bindParam(":usuario_id", $usuario_id);
    $stmt->execute();

    echo "<p class='ok'>Treino $id deletado.</p>";
}

// ---------------- PROGRESSO ----------------

function cadastrar_progresso($conexao, $usuario_id, $peso, $data_registro, $observacao)
{
    $sql = "INSERT INTO progresso (usuario_id, peso, data_registro, observacao) VALUES (:usuario_id, :peso, :data_registro, :observacao)";

    $stmt = $conexao->prepare($sql);
    $stmt->bindParam(":usuario_id", $usuario_id);
    $stmt->bindParam(":peso", $peso);
    $stmt->bindParam(":data_registro", $data_registro);
    $stmt->bindParam(":observacao", $observacao);
    $stmt->execute();

    echo "<p class='ok'>Medição salva com sucesso!</p>";
}

function listar_progresso($conexao, $usuario_id)
{
    $sql = "SELECT * FROM progresso WHERE usuario_id = :usuario_id ORDER BY data_registro DESC, id DESC";

    $stmt = $conexao->prepare($sql);
    $stmt->bindParam(":usuario_id", $usuario_id);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// ---------------- MENSAGENS ----------------

function cadastrar_mensagem($conexao, $nome, $telefone, $email, $plano, $mensagem)
{
    $sql = "INSERT INTO mensagens (nome, telefone, email, plano, mensagem) VALUES (:nome, :telefone, :email, :plano, :mensagem)";

    $stmt = $conexao->prepare($sql);
    $stmt->bindParam(":nome", $nome);
    $stmt->bindParam(":telefone", $telefone);
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":plano", $plano);
    $stmt->bindParam(":mensagem", $mensagem);
    $stmt->execute();

    echo "<p class='ok'>Mensagem enviada com sucesso!</p>";
}

function listar_mensagens($conexao)
{
    $sql = "SELECT * FROM mensagens ORDER BY id DESC";

    $stmt = $conexao->prepare($sql);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// ---------------- EXERCICIOS ----------------

function cadastrar_exercicio($conexao, $nome, $grupo_muscular, $descricao)
{
    $sql = "INSERT INTO exercicios (nome, grupo_muscular, descricao) VALUES (:nome, :grupo_muscular, :descricao)";

    $stmt = $conexao->prepare($sql);
    $stmt->bindParam(":nome", $nome);
    $stmt->bindParam(":grupo_muscular", $grupo_muscular);
    $stmt->bindParam(":descricao", $descricao);
    $stmt->execute();

    echo "<p class='ok'>Exercício cadastrado com sucesso!</p>";
}

function listar_exercicios($conexao)
{
    $sql = "SELECT * FROM exercicios ORDER BY grupo_muscular ASC, nome ASC";

    $stmt = $conexao->prepare($sql);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// ---------------- PLANOS ----------------

function listar_planos($conexao)
{
    $sql = "SELECT * FROM planos ORDER BY preco ASC";

    $stmt = $conexao->prepare($sql);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// ---------------- UNIDADES ----------------

function listar_unidades($conexao)
{
    $sql = "SELECT * FROM unidades ORDER BY nome ASC";

    $stmt = $conexao->prepare($sql);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// ---------------- ADMIN ----------------

function listar_usuarios($conexao)
{
    $sql = "SELECT id, nome, email, data_nascimento, tipo FROM usuarios ORDER BY id";

    $stmt = $conexao->prepare($sql);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function cadastrar_plano($conexao, $nome, $preco, $descricao)
{
    $sql = "INSERT INTO planos (nome, preco, descricao) VALUES (:nome, :preco, :descricao)";

    $stmt = $conexao->prepare($sql);
    $stmt->bindParam(":nome", $nome);
    $stmt->bindParam(":preco", $preco);
    $stmt->bindParam(":descricao", $descricao);
    $stmt->execute();

    echo "<p class='ok'>Plano cadastrado com sucesso!</p>";
}

function atualizar_plano($conexao, $id, $nome, $preco, $descricao)
{
    $sql = "UPDATE planos SET nome = :nome, preco = :preco, descricao = :descricao WHERE id = :id";

    $stmt = $conexao->prepare($sql);
    $stmt->bindParam(":nome", $nome);
    $stmt->bindParam(":preco", $preco);
    $stmt->bindParam(":descricao", $descricao);
    $stmt->bindParam(":id", $id);
    $stmt->execute();

    echo "<p class='ok'>Plano atualizado com sucesso!</p>";
}

function deletar_plano($conexao, $id)
{
    $sql = "DELETE FROM planos WHERE id = :id";

    $stmt = $conexao->prepare($sql);
    $stmt->bindParam(":id", $id);
    $stmt->execute();

    echo "<p class='ok'>Plano $id deletado.</p>";
}

// ---------------- PROFESSORES ----------------

function cadastrar_professor($conexao, $nome, $email, $senha, $data_nascimento)
{
    $senha = password_hash($senha, PASSWORD_DEFAULT);
    $tipo = "professor";
    $sql = "INSERT INTO usuarios (nome, email, senha, data_nascimento, tipo) VALUES (:nome,:email,:senha,:data_nascimento,:tipo)";
    $stmt = $conexao->prepare($sql);
    $stmt->bindParam(":nome", $nome);
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":senha", $senha);
    $stmt->bindParam(":data_nascimento", $data_nascimento);
    $stmt->bindParam(":tipo", $tipo);
    $stmt->execute();
    echo "<p class='ok'>Professor cadastrado com sucesso!</p>";
}

function listar_professores($conexao)
{
    $sql = "SELECT id, nome, email, data_nascimento FROM usuarios WHERE tipo = :tipo ORDER BY nome ASC";

    $tipo = "professor";

    $stmt = $conexao->prepare($sql);
    $stmt->bindParam(":tipo", $tipo);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function deletar_professor($conexao, $id)
{
    $tipo = "professor";

    $sql = "DELETE FROM usuarios WHERE id = :id AND tipo = :tipo";

    $stmt = $conexao->prepare($sql);
    $stmt->bindParam(":id", $id);
    $stmt->bindParam(":tipo", $tipo);
    $stmt->execute();

    echo "<p class='ok'>Professor $id deletado.</p>";
}
?>
