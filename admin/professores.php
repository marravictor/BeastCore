<?php
require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/verifica_admin.php';
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/style/style.css">
    <title>Professores - Admin BeastCore</title>
</head>

<body>
    <?php include __DIR__ . '/../includes/header_professores.php'; ?>
    <main>
        <h1>Professores</h1>
        <p>Aqui você pode cadastrar os professores (personal trainers) da academia.</p>

        <h3>Novo professor</h3>
        <form action="" method="post">
            <label for="nome">Nome: </label>
            <input type="text" name="nome" id="nome" required>

            <label for="email">E-mail: </label>
            <input type="email" name="email" id="email" required>

            <label for="senha">Senha: </label>
            <input type="password" name="senha" id="senha" required>

            <label for="data_nascimento">Data de nascimento: </label>
            <input type="date" name="data_nascimento" id="data_nascimento" required>

            <input type="submit" value="Cadastrar professor">
        </form>

        <?php
        // Cadastrar professor
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $email = $_POST['email'];

            if (email_existe($conexao, $email)) {
                echo "<p class='erro'>Este e-mail já está cadastrado.</p>";
            } else {
                cadastrar_professor($conexao, $_POST['nome'], $email, $_POST['senha'], $_POST['data_nascimento']);
            }
        }

        // Excluir professor
        if (isset($_GET['del'])) {
            deletar_professor($conexao, (int) $_GET['del']);
        }

        $professores = listar_professores($conexao);
        ?>

        <h3>Professores cadastrados</h3>

        <table>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>E-mail</th>
                <th>Nascimento</th>
                <th>Ação</th>
            </tr>
            <?php foreach ($professores as $p) { ?>
                <tr>
                    <td><?php echo $p['id']; ?></td>
                    <td><?php echo htmlspecialchars($p['nome']); ?></td>
                    <td><?php echo htmlspecialchars($p['email']); ?></td>
                    <td><?php echo htmlspecialchars($p['data_nascimento']); ?></td>
                    <td><a href="professores.php?del=<?php echo $p['id']; ?>">Excluir</a></td>
                </tr>
            <?php } ?>
        </table>

        <?php if (empty($professores)) { ?>
            <p class="vazio">Nenhum professor cadastrado ainda.</p>
        <?php } ?>

        <hr>
        <p>
            <a href="/admin/usuarios.php">Ver usuários</a> |
            <a href="/admin/planos.php">Gerenciar planos</a>
        </p>
    </main>
    <?php include __DIR__ . '/../includes/footer.php'; ?>
</body>

</html>
