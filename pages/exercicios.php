<?php require_once __DIR__ . '/../includes/functions.php'; ?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/style/style.css">
    <title>Exercícios - BeastCore</title>
</head>

<body>
    <?php include __DIR__ . '/../includes/header_exercicios.php'; ?>
    <main>
        <h1>Biblioteca de Exercícios</h1>

        <?php if (isset($_SESSION['tipo']) && $_SESSION['tipo'] == "admin") { ?>
            <h3>Cadastrar novo exercício</h3>
            <form action="" method="post">
                <label for="nome">Nome do exercício: </label>
                <input type="text" name="nome" id="nome" required>

                <label for="grupo_muscular">Grupo muscular: </label>
                <input type="text" name="grupo_muscular" id="grupo_muscular" required>

                <label for="descricao">Descrição: </label>
                <textarea name="descricao" id="descricao"></textarea>

                <input type="submit" value="Cadastrar exercício">
            </form>
        <?php } ?>

        <?php
        if (isset($_SESSION['tipo']) && $_SESSION['tipo'] == "admin" && $_SERVER['REQUEST_METHOD'] == "POST") {
            cadastrar_exercicio($conexao, $_POST['nome'], $_POST['grupo_muscular'], $_POST['descricao']);
        }

        $exercicios = listar_exercicios($conexao);
        ?>

        <table>
            <tr>
                <th>Exercício</th>
                <th>Grupo Muscular</th>
                <th>Descrição</th>
            </tr>
            <?php foreach ($exercicios as $ex) { ?>
                <tr>
                    <td><?php echo htmlspecialchars($ex['nome']); ?></td>
                    <td><?php echo htmlspecialchars($ex['grupo_muscular']); ?></td>
                    <td><?php echo htmlspecialchars($ex['descricao']); ?></td>
                </tr>
            <?php } ?>
        </table>
        <?php if (empty($exercicios)) { ?>
            <p class="vazio">Nenhum exercício cadastrado ainda.</p>
        <?php } ?>
    </main>
    <?php include __DIR__ . '/../includes/footer.php'; ?>
</body>

</html>
