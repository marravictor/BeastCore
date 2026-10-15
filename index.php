<?php require_once __DIR__ . '/includes/functions.php'; ?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/style/style.css">
    <title>BeastCore - Academia</title>
</head>

<body>
    <?php include __DIR__ . '/includes/header_index.php'; ?>

    <main>
        <?php if (isset($_SESSION['id'])) { ?>

            <section class="hero">
                <h1>Olá, <?php echo htmlspecialchars($_SESSION['nome']); ?>!</h1>
                <p>Que bom te ver de volta na <strong>BeastCore</strong>. Bora treinar?</p>
                <div class="hero-botoes">
                    <a class="btn" href="/pages/treinos.php">Meus Treinos</a>
                    <a class="btn btn-sec" href="/pages/progresso.php">Meu Progresso</a>
                    <a class="btn btn-sec" href="/pages/mensagens.php">Mensagens</a>
                </div>
            </section>

        <?php } else { ?>

            <section class="hero">
                <h1>Fique forte com a <span>BeastCore</span></h1>
                <p>Uma academia completa para quem quer ganhar força, saúde e disciplina.
                    Estrutura moderna, orientação de treino e um ambiente feito para evoluir.</p>
                <div class="hero-botoes">
                    <a class="btn" href="/login/cadastrar.php">Quero me cadastrar</a>
                    <a class="btn btn-sec" href="/login/login.php">Já sou aluno</a>
                </div>
            </section>

        <?php } ?>

        <section class="secao">
            <h2>A proposta da BeastCore</h2>
            <p>A BeastCore é mais do que uma academia: é um lugar para treinar sério. Reunimos
                estrutura, acompanhamento e um ambiente motivador para que cada aluno consiga
                evoluir com segurança e constância, do primeiro treino até as metas mais difíceis.</p>
        </section>

        <section class="secao">
            <h2>Por que treinar aqui</h2>
            <div class="grid">
                <div class="card">
                    <h3>Estrutura completa</h3>
                    <p>Máquinas modernas e pesos livres para treinar todos os grupos musculares.</p>
                </div>
                <div class="card">
                    <h3>Acompanhamento</h3>
                    <p>Monte suas fichas de treino e registre seu progresso direto no site.</p>
                </div>
                <div class="card">
                    <h3>Ambiente motivador</h3>
                    <p>Um espaço pensado para você manter o foco e a disciplina no dia a dia.</p>
                </div>
                <div class="card">
                    <h3>Planos flexíveis</h3>
                    <p>Opções de planos para diferentes objetivos e rotinas de treino.</p>
                </div>
            </div>
        </section>

        <section class="secao">
            <h2>Nossos planos</h2>
            <?php
            $planos = listar_planos($conexao);

            if (empty($planos)) {
            ?>
                <p class="vazio">Nossos planos serão exibidos aqui em breve.</p>
            <?php
            } else {
            ?>
                <div class="grid">
                    <?php foreach ($planos as $p) { ?>
                        <div class="card card-plano">
                            <h3><?php echo htmlspecialchars($p['nome']); ?></h3>
                            <p class="preco">R$ <?php echo number_format($p['preco'], 2, ',', '.'); ?><span> /mês</span></p>
                            <p><?php echo htmlspecialchars($p['descricao']); ?></p>
                        </div>
                    <?php } ?>
                </div>
            <?php
            }
            ?>
        </section>

        <section class="secao">
            <h2>Exercícios da nossa biblioteca</h2>
            <?php
            $exercicios = listar_exercicios($conexao);

            if (empty($exercicios)) {
            ?>
                <p class="vazio">Nenhum exercício cadastrado ainda.</p>
            <?php
            } else {
            ?>
                <div class="grid">
                    <?php
                    $contador = 0;
                    foreach ($exercicios as $ex) {
                        $contador++;
                        if ($contador > 6) {
                            break;
                        }
                    ?>
                        <div class="card">
                            <span class="etiqueta"><?php echo htmlspecialchars($ex['grupo_muscular']); ?></span>
                            <h3><?php echo htmlspecialchars($ex['nome']); ?></h3>
                            <p><?php echo htmlspecialchars($ex['descricao']); ?></p>
                        </div>
                    <?php } ?>
                </div>
                <p class="mais"><a href="/pages/exercicios.php">Ver a biblioteca completa</a></p>
            <?php
            }
            ?>
        </section>

        <?php if (!isset($_SESSION['id'])) { ?>
            <section class="secao cta">
                <h2>Pronto para começar?</h2>
                <p>Crie sua conta na BeastCore e comece a montar seus treinos hoje mesmo.</p>
                <div class="hero-botoes">
                    <a class="btn" href="/login/cadastrar.php">Criar minha conta</a>
                    <a class="btn btn-sec" href="/pages/planos.php">Ver planos</a>
                </div>
            </section>
        <?php } ?>
    </main>

    <?php include __DIR__ . '/includes/footer.php'; ?>
</body>

</html>
