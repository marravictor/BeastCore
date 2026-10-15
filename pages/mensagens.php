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
    <title>Mensagens - BeastCore</title>
</head>

<body>
    <?php include __DIR__ . '/../includes/header_mensagens.php'; ?>
    <main>
        <h1>Central de Mensagens</h1>

        <h3>Fale conosco</h3>
        <form action="" method="post">
            <label for="nome">Nome: </label>
            <input type="text" name="nome" id="nome" value="<?php echo htmlspecialchars($_SESSION['nome']); ?>" required>

            <label for="telefone">Telefone: </label>
            <input type="text" name="telefone" id="telefone">

            <label for="email">E-mail: </label>
            <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($_SESSION['email']); ?>">

            <label for="plano">Plano de interesse: </label>
            <input type="text" name="plano" id="plano">

            <label for="mensagem">Mensagem: </label>
            <textarea name="mensagem" id="mensagem" required></textarea>

            <input type="submit" value="Enviar mensagem">
        </form>

        <?php
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            cadastrar_mensagem($conexao, $_POST['nome'], $_POST['telefone'], $_POST['email'], $_POST['plano'], $_POST['mensagem']);
        }

        $mensagens = listar_mensagens($conexao);
        ?>

        <h3>Mensagens recebidas</h3>
        <?php foreach ($mensagens as $m) { ?>
            <div class="item">
                <p>
                    <strong><?php echo htmlspecialchars($m['nome']); ?></strong>
                    - <?php echo date('d/m/Y H:i', strtotime($m['data_envio'])); ?>
                </p>
                <p>
                    <?php echo htmlspecialchars($m['telefone']); ?> -
                    <?php echo htmlspecialchars($m['email']); ?><?php if (!empty($m['plano'])) { ?> - Plano: <?php echo htmlspecialchars($m['plano']); ?><?php } ?>
                </p>
                <p><?php echo nl2br(htmlspecialchars($m['mensagem'])); ?></p>
            </div>
        <?php } ?>
        <?php if (empty($mensagens)) { ?>
            <p class="vazio">Nenhuma mensagem recebida ainda.</p>
        <?php } ?>
    </main>
    <?php include __DIR__ . '/../includes/footer.php'; ?>
</body>

</html>
