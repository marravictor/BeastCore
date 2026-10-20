<?php
require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/verifica_admin.php';
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/BeastCore/style/style.css">
    <title>Gerenciar Planos - Admin BeastCore</title>
</head>

<body>
    <?php include __DIR__ . '/../includes/header_admin_planos.php'; ?>
    <main>
        <h1>Gerenciar Planos</h1>
        <p>Aqui você pode criar, alterar e excluir os planos da academia.</p>

        <h3>Novo plano</h3>
        <form action="" method="post">
            <label for="novo_nome">Nome: </label>
            <input type="text" name="nome" id="novo_nome" required>

            <label for="novo_preco">Preço (R$): </label>
            <input type="number" step="0.01" name="preco" id="novo_preco" required>

            <label for="novo_descricao">Descrição: </label>
            <textarea name="descricao" id="novo_descricao"></textarea>

            <input type="submit" value="Cadastrar plano">
        </form>

        <?php
        // Cadastra ou altera
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            if (isset($_POST['id']) && $_POST['id'] != "") {
                $sql = "UPDATE planos SET nome=:nome, preco=:preco, descricao=:descricao WHERE id=:id";
                $stmt = $conexao->prepare($sql);
                $stmt->bindParam(":nome", $_POST['nome']);
                $stmt->bindParam(":preco", $_POST['preco']);
                $stmt->bindParam(":descricao", $_POST['descricao']);
                $stmt->bindParam(":id", $_POST['id']);
                $stmt->execute();
                echo "<p class='ok'>Plano atualizado.</p>";
            } else {
                $sql = "INSERT INTO planos (nome, preco, descricao) VALUES (:nome,:preco,:descricao)";
                $stmt = $conexao->prepare($sql);
                $stmt->bindParam(":nome", $_POST['nome']);
                $stmt->bindParam(":preco", $_POST['preco']);
                $stmt->bindParam(":descricao", $_POST['descricao']);
                $stmt->execute();
                echo "<p class='ok'>Plano cadastrado.</p>";
            }
        }

        // Excluir
        if (isset($_GET['del'])) {
            $id = (int) $_GET['del'];
            $sql = "DELETE FROM planos WHERE id = :id";
            $stmt = $conexao->prepare($sql);
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            echo "<p class='ok'>Plano excluído.</p>";
        }

        $planos = listar_planos($conexao);
        ?>

        <h3>Planos cadastrados</h3>

        <?php foreach ($planos as $p) { ?>
            <form action="" method="post">
                <input type="hidden" name="id" value="<?php echo $p['id']; ?>">

                <label>Plano #<?php echo $p['id']; ?> - Nome: </label>
                <input type="text" name="nome" value="<?php echo htmlspecialchars($p['nome']); ?>" required>

                <label>Preço (R$): </label>
                <input type="number" step="0.01" name="preco" value="<?php echo $p['preco']; ?>" required>

                <label>Descrição: </label>
                <textarea name="descricao"><?php echo htmlspecialchars($p['descricao']); ?></textarea>

                <input type="submit" value="Salvar alterações">
                <a href="planos.php?del=<?php echo $p['id']; ?>">Excluir</a>
            </form>
        <?php } ?>

        <?php if (empty($planos)) { ?>
            <p class="vazio">Nenhum plano cadastrado ainda.</p>
        <?php } ?>

        <hr>
        <p><a href="/BeastCore/admin/usuarios.php">Ver usuários</a></p>
    </main>
    <?php include __DIR__ . '/../includes/footer.php'; ?>
</body>

</html>
