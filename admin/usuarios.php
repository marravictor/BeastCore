<?php
require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/verifica_admin.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_user'])) {
    $id = (int)$_POST['user_id'];
    deletar_usuario($conexao, $id);
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/BeastCore/style/style.css">
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
                <th>Ações</th>
            </tr>
            <?php foreach ($usuarios as $u) { ?>
                <tr>
                    <td><?php echo $u['id']; ?></td>
                    <td><?php echo htmlspecialchars($u['nome']); ?></td>
                    <td><?php echo htmlspecialchars($u['email']); ?></td>
                    <td><?php echo htmlspecialchars($u['data_nascimento']); ?></td>
                    <td><?php echo htmlspecialchars($u['tipo']); ?></td>
                    <td>
                        <form method="post" onsubmit="return confirm('Tem certeza que deseja excluir este usuário?');">
                            <input type="hidden" name="user_id" value="<?php echo $u['id']; ?>">
                            <button type="submit" name="delete_user" class="btn-del">Excluir</button>
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </table>
        <?php if (empty($usuarios)) { ?>
            <p class="vazio">Nenhum usuário cadastrado.</p>
        <?php } ?>

        <hr>
        <p><a href="/BeastCore/admin/planos.php">Gerenciar planos</a></p>
    </main>
    <?php include __DIR__ . '/../includes/footer.php'; ?>
</body>

</html>
