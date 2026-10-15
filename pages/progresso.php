<?php
require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../login/verifica_user.php';
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/style/style.css">
    <title>Meu Progresso - BeastCore</title>
</head>

<body>
    <?php include __DIR__ . '/../includes/header_progresso.php'; ?>
    <main>
        <h1>Meu Progresso</h1>

        <h3>Registrar medição</h3>
        <form action="" method="post">
            <label for="peso">Peso (kg): </label>
            <input type="number" step="0.1" name="peso" id="peso" required>

            <label for="data_registro">Data: </label>
            <input type="date" name="data_registro" id="data_registro" value="<?php echo date('Y-m-d'); ?>" required>

            <label for="observacao">Observação: </label>
            <textarea name="observacao" id="observacao"></textarea>

            <input type="submit" value="Salvar medição">
        </form>

        <?php
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            cadastrar_progresso($conexao, $_SESSION['id'], $_POST['peso'], $_POST['data_registro'], $_POST['observacao']);
        }

        $historico = listar_progresso($conexao, $_SESSION['id']);
        ?>

        <table>
            <tr>
                <th>Data</th>
                <th>Peso</th>
                <th>Observação</th>
            </tr>
            <?php foreach ($historico as $h) { ?>
                <tr>
                    <td><?php echo date('d/m/Y', strtotime($h['data_registro'])); ?></td>
                    <td><?php echo number_format($h['peso'], 1, ',', '.'); ?> kg</td>
                    <td><?php echo htmlspecialchars($h['observacao']); ?></td>
                </tr>
            <?php } ?>
        </table>
        <?php if (empty($historico)) { ?>
            <p class="vazio">Nenhuma medição registrada ainda.</p>
        <?php } ?>
    </main>
    <?php include __DIR__ . '/../includes/footer.php'; ?>
</body>

</html>
