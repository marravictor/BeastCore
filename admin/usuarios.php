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
    <title>Usuários - Admin BeastCore</title>
</head>

<body>
    <?php include __DIR__ . '/../includes/header_usuarios.php'; ?>
    <main>
        <h1>Usuários do Sistema</h1>
        <p>Todas as pessoas cadastradas no banco de dados.</p>

        <?php $usuarios = listar_usuarios($conexao); ?>

        <table>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>E-mail</th>
                <th>Nascimento</th>
                <th>Tipo</th>
            </tr>
            <?php foreach ($usuarios as $u) { ?>
                <tr>
                    <td><?php echo $u['id']; ?></td>
                    <td><?php echo htmlspecialchars($u['nome']); ?></td>
                    <td><?php echo htmlspecialchars($u['email']); ?></td>
                    <td><?php echo htmlspecialchars($u['data_nascimento']); ?></td>
                    <td><?php echo htmlspecialchars($u['tipo']); ?></td>
                </tr>
            <?php } ?>
        </table>
        <?php if (empty($usuarios)) { ?>
            <p class="vazio">Nenhum usuário cadastrado.</p>
        <?php } ?>

        <hr>
        <p><a href="/admin/planos.php">Gerenciar planos</a></p>
    </main>
    <?php include __DIR__ . '/../includes/footer.php'; ?>
</body>

</html>
