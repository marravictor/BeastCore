<?php
require_once __DIR__ . '/../database/connect.php';
require_once __DIR__ . '/../includes/header.php';

$tabela = $_GET['t'] ?? 'exercicios';
$tabelasPermitidas = ['exercicios', 'unidades', 'planos'];

if (in_array($tabela, $tabelasPermitidas)) {
    $stmt = $conexao->query("SELECT * FROM {$tabela}");
    $dados = $stmt->fetchAll();
} else {
    $dados = [];
}
?>

<div class="card">
    <h2>Tabela: <code><?php echo htmlspecialchars($tabela); ?></code></h2>
    <div class="table-responsive">
        <table>
            <?php if (!empty($dados)): ?>
                <thead>
                    <tr>
                        <?php foreach (array_keys($dados[0]) as $col): ?>
                            <th><?php echo htmlspecialchars($col); ?></th>
                        <?php endforeach; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($dados as $row): ?>
                        <tr>
                            <?php foreach ($row as $val): ?>
                                <td><?php echo htmlspecialchars($val ?? '-'); ?></td>
                            <?php endforeach; ?>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            <?php else: ?>
                <p>Nenhum registro encontrado nesta tabela.</p>
            <?php endif; ?>
        </table>
    </div>
</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>