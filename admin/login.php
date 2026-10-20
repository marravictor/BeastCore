<?php
require_once __DIR__ . '/../includes/functions.php';
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/BeastCore/style/style.css">
    <title>Entrar no Admin - BeastCore</title>
</head>

<body>
    <?php include __DIR__ . '/../includes/header_login.php'; ?>
    <main>
        <h1>Entrar no Admin</h1>
        <form action="" method="post">
            <label for="user">Usuário: </label>
            <input type="text" name="user" id="user" required>

            <label for="senha">Senha: </label>
            <input type="password" name="senha" id="senha" required>

            <input type="submit" value="Entrar">
        </form>
        <?php
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            if ($_POST['user'] == "beastcore" && $_POST['senha'] == "123456") {
                $_SESSION['id']    = 0;
                $_SESSION['nome']  = "Administrador";
                $_SESSION['email'] = "beastcore";
                $_SESSION['tipo']  = "admin";

                header("Location: /admin/usuarios.php");
                exit();
            } else {
                echo "<p class='erro'>Usuário ou senha do admin inválidos.</p>";
            }
        }
        ?>
        <p><a href="/BeastCore/login/login.php">Entrar como aluno</a></p>
    </main>
    <?php include __DIR__ . '/../includes/footer.php'; ?>
</body>

</html>
