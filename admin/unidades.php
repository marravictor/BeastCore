<?php
// Página de gerenciamento de unidades (apenas admin)
// Permite cadastrar, editar e excluir unidades

require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/verifica_admin.php';
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/BeastCore/style/style.css">
    <title>Gerenciar Unidades - Admin BeastCore</title>
</head>

<body>
    <?php include __DIR__ . '/../includes/header_admin_unidades.php'; ?>
    <main>
        <h1>Gerenciar Unidades</h1>
        <p>Aqui você pode cadastrar, alterar e excluir as unidades da academia.</p>

        <h3>Nova unidade</h3>
        <form action="" method="post">
            <label for="novo_nome">Nome: </label>
            <input type="text" name="nome" id="novo_nome" placeholder="Ex.: BeastCore Alvorada" required>

            <label for="novo_endereco">Endereço: </label>
            <input type="text" name="endereco" id="novo_endereco" placeholder="Rua Saturno, 186, Bairro Alvorada" required>

            <label for="novo_telefone">Telefone: </label>
            <input type="text" name="telefone" id="novo_telefone" placeholder="(XX) XXXXX-XXXX">

            <label for="novo_horario">Horário de funcionamento: </label>
            <input type="text" name="horario" id="novo_horario" placeholder="06:00 às 23:00">

            <input type="submit" value="Cadastrar unidade">
        </form>

        <?php
        // Cadastrar ou atualizar unidade
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            if (isset($_POST['id']) && $_POST['id'] != "") {
                // Atualizar unidade
                $sql = "UPDATE unidades SET nome = :nome, endereco = :endereco, telefone = :telefone, horario = :horario WHERE id = :id";
                $stmt = $conexao->prepare($sql);
                $stmt->bindParam(":nome", $_POST['nome']);
                $stmt->bindParam(":endereco", $_POST['endereco']);
                $stmt->bindParam(":telefone", $_POST['telefone']);
                $stmt->bindParam(":horario", $_POST['horario']);
                $stmt->bindParam(":id", $_POST['id']);
                $stmt->execute();
                echo "<p class='ok'>Unidade atualizada com sucesso!</p>";
            } else {
                // Cadastrar nova unidade
                $sql = "INSERT INTO unidades (nome, endereco, telefone, horario) VALUES (:nome, :endereco, :telefone, :horario)";
                $stmt = $conexao->prepare($sql);
                $stmt->bindParam(":nome", $_POST['nome']);
                $stmt->bindParam(":endereco", $_POST['endereco']);
                $stmt->bindParam(":telefone", $_POST['telefone']);
                $stmt->bindParam(":horario", $_POST['horario']);
                $stmt->execute();
                echo "<p class='ok'>Unidade cadastrada com sucesso!</p>";
            }
        }

        // Excluir unidade
        if (isset($_GET['del'])) {
            $id_del = (int) $_GET['del'];
            $stmt = $conexao->prepare("DELETE FROM unidades WHERE id = :id");
            $stmt->bindParam(":id", $id_del);
            $stmt->execute();
            echo "<p class='ok'>Unidade $id_del excluída.</p>";
        }

        // Listar unidades
        $unidades = $conexao->query("SELECT * FROM unidades ORDER BY id")->fetchAll(PDO::FETCH_ASSOC);
        ?>

        <h3>Unidades cadastradas</h3>

        <?php foreach ($unidades as $u) { ?>
            <form action="" method="post">
                <input type="hidden" name="id" value="<?php echo $u['id']; ?>">

                <label>Unidade #<?php echo $u['id']; ?> - Nome: </label>
                <input type="text" name="nome" value="<?php echo htmlspecialchars($u['nome']); ?>" required>

                <label>Endereço: </label>
                <input type="text" name="endereco" value="<?php echo htmlspecialchars($u['endereco']); ?>" required>

                <label>Telefone: </label>
                <input type="text" name="telefone" value="<?php echo htmlspecialchars($u['telefone']); ?>">

                <label>Horário: </label>
                <input type="text" name="horario" value="<?php echo htmlspecialchars($u['horario']); ?>">

                <input type="submit" value="Salvar alterações">
                <a href="unidades.php?del=<?php echo $u['id']; ?>">Excluir</a>
            </form>
        <?php } ?>

        <?php if (empty($unidades)) { ?>
            <p class="vazio">Nenhuma unidade cadastrada ainda.</p>
        <?php } ?>

        <hr>
        <p>
            <a href="/admin/usuarios.php">Ver usuários</a> |
            <a href="/admin/professores.php">Professores</a> |
            <a href="/admin/planos.php">Gerenciar planos</a>
        </p>
    </main>
    <?php include __DIR__ . '/../includes/footer.php'; ?>
</body>

</html>
