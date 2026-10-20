<?php require_once __DIR__ . '/../includes/functions.php'; ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/BeastCore/style/style.css">
    <title>Unidades - BeastCore</title>
</head>
<body>
    <?php include __DIR__ . '/../includes/header_unidades.php'; ?>
    <main>
        <h1>Nossas Unidades</h1>

        <?php
        $unidades = listar_unidades($conexao);

        foreach ($unidades as $u) {
        ?>
            <div class="item">
                <h3><?php echo htmlspecialchars($u['nome']); ?></h3>
                <p><strong>Endereço:</strong> <?php echo htmlspecialchars($u['endereco']); ?></p>
                <p><strong>Telefone:</strong> <?php echo htmlspecialchars($u['telefone']); ?></p>
                <p><strong>Horário:</strong> <?php echo htmlspecialchars($u['horario']); ?></p>
            </div>
        <?php
        }
        ?>

        <?php if (empty($unidades)) { ?>
            <p class="vazio">Nenhuma unidade cadastrada ainda.</p>
        <?php } ?>
    </main>
    <?php include __DIR__ . '/../includes/footer.php'; ?>
</body>

</html>
