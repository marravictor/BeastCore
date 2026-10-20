<?php
require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../login/verifica_user.php';
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/BeastCore/style/style.css">
    <title>Meus Treinos - BeastCore</title>
</head>

<body>
    <?php include __DIR__ . '/../includes/header_treinos.php'; ?>
    <main>
        <h1>Meus Treinos</h1>

        <h3>Nova ficha de treino</h3>
        <form action="" method="post">
            <label for="nome">Nome do treino: </label>
            <input type="text" name="nome" id="nome" required>

            <label for="descricao">Descrição / séries: </label>
            <textarea name="descricao" id="descricao"></textarea>

            <input type="submit" value="Salvar treino">
        </form>

        <?php
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            cadastrar_treino($conexao, $_SESSION['id'], $_POST['nome'], $_POST['descricao']);
        }

        if (isset($_GET['del'])) {
            deletar_treino($conexao, (int) $_GET['del'], $_SESSION['id']);
        }

        $treinos = listar_treinos($conexao, $_SESSION['id']);
        ?>

        <table>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Descrição</th>
                <th>Ação</th>
            </tr>
            <?php foreach ($treinos as $t) { ?>
                <tr>
                    <td><?php echo $t['id']; ?></td>
                    <td><?php echo htmlspecialchars($t['nome']); ?></td>
                    <td><?php echo htmlspecialchars($t['descricao']); ?></td>
                    <td><a href="treinos.php?del=<?php echo $t['id']; ?>">Deletar</a></td>
                </tr>
            <?php } ?>
        </table>
        <?php if (empty($treinos)) { ?>
            <p class="vazio">Você ainda não cadastrou nenhum treino.</p>
        <?php } ?>
    </main>
    <?php include __DIR__ . '/../includes/footer.php'; ?>
</body>

</html>
