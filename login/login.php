<?php require_once __DIR__ . '/../includes/functions.php'; ?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/BeastCore/style/style.css">
    <title>Login - BeastCore</title>
</head>

<body>
    <?php include __DIR__ . '/../includes/header_login.php'; ?>
    <main>
        <h1>Faça Login</h1>
        <form action="" method="post">
            <label for="email">E-mail: </label>
            <input type="email" name="email" id="email" required>
            <label for="senha">Senha: </label>
            <input type="password" name="senha" id="senha" required>
            <input type="submit" value="Entrar">
        </form>
        <?php
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $usuario = consulta_user($conexao, $_POST['email']);

            if ($usuario && password_verify($_POST['senha'], $usuario['senha'])) {
                $_SESSION['id']    = $usuario['id'];
                $_SESSION['nome']  = $usuario['nome'];
                $_SESSION['email'] = $usuario['email'];
                $_SESSION['tipo']  = $usuario['tipo'];
                header("Location: /index.php");
                exit();
            } else {
                echo "<p class='erro'>Usuário ou senha inválidos.</p>";
            }
        }
        ?>
        <p>Ainda não é aluno? <a href="/BeastCore/login/cadastrar.php">Cadastre-se aqui</a>.</p>
    </main>
    <?php include __DIR__ . '/../includes/footer.php'; ?>
</body>

</html>
