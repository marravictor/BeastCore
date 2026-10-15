<?php require_once __DIR__ . '/../includes/functions.php'; ?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/style/style.css">
    <title>Cadastro - BeastCore</title>
</head>

<body>
    <?php include __DIR__ . '/../includes/header_cadastrar.php'; ?>
    <main>
        <h1>Cadastre-se</h1>
        <form action="" method="post">
            <label for="nome">Nome: </label>
            <input type="text" name="nome" id="nome" required>
            <label for="email">E-mail: </label>
            <input type="email" name="email" id="email" required>
            <label for="data_nascimento">Data de Nascimento: </label>
            <input type="date" name="data_nascimento" id="data_nascimento" required>
            <label for="senha">Senha: </label>
            <input type="password" name="senha" id="senha" required>
            <input type="submit" value="Cadastrar">
        </form>
        <?php
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            if (email_existe($conexao, $_POST['email'])) {
                echo "<p class='erro'>Este e-mail já está cadastrado.</p>";
            } else {
                cadastrar_user($conexao, $_POST['nome'], $_POST['email'], $_POST['senha'], $_POST['data_nascimento']);
            }
        }
        ?>
        <p>Já possui conta? <a href="/login/login.php">Fazer login</a>.</p>
    </main>
    <?php include __DIR__ . '/../includes/footer.php'; ?>
</body>

</html>
