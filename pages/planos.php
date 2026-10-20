<?php require_once __DIR__ . '/../includes/functions.php'; ?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/BeastCore/style/style.css">
    <title>Planos - BeastCore</title>
</head>

<body>
    <?php include __DIR__ . '/../includes/header_planos.php'; ?>
    <main>
        <h1>Planos de Assinatura</h1>
        <p>Escolha o plano ideal para os seus treinos.</p>

        <?php
        $planos = listar_planos($conexao);

        foreach ($planos as $p) {
        ?>
            <div class="item">
                <h3><?php echo htmlspecialchars($p['nome']); ?></h3>
                <p><strong>R$ <?php echo number_format($p['preco'], 2, ',', '.'); ?></strong> / mês</p>
                <p><?php echo htmlspecialchars($p['descricao']); ?></p>
            </div>
        <?php
        }
        ?>

        <?php if (empty($planos)) { ?>
            <p class="vazio">Nenhum plano cadastrado ainda.</p>
        <?php } ?>

        <hr>
        <p>Quer treinar com a gente? <a href="/BeastCore/login/cadastrar.php">Cadastre-se aqui</a>.</p>
    </main>
    <?php include __DIR__ . '/../includes/footer.php'; ?>
</body>

</html>
