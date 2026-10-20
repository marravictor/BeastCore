<header>
    <h1><a href="/BeastCore/index.php">Beast<span>Core</span></a></h1>
    <nav>
        <a href="/BeastCore/index.php">Início</a>
        <a href="/BeastCore/pages/exercicios.php">Exercícios</a>
        <a href="/BeastCore/pages/unidades.php">Unidades</a>
        <a href="/BeastCore/pages/planos.php">Planos</a>
        <?php if (isset($_SESSION['id'])) { ?>
            <a href="/BeastCore/pages/treinos.php">Treinos</a>
            <a href="/BeastCore/pages/progresso.php">Progresso</a>
            <a href="/BeastCore/pages/mensagens.php">Mensagens</a>
            <?php if (isset($_SESSION['tipo']) && $_SESSION['tipo'] == "admin") { ?>
                <a href="/BeastCore/admin/usuarios.php">Usuários</a>
                <a href="/BeastCore/admin/professores.php">Professores</a>
                <a href="/BeastCore/admin/planos.php">Gerenciar Planos</a>
        <a href="/BeastCore/admin/unidades.php">Gerenciar Unidades</a>
            <?php } ?>
            <a href="/BeastCore/login/logout.php">Sair</a>
        <?php } else { ?>
            <a href="/BeastCore/login/login.php">Entrar</a>
            <a href="/BeastCore/login/cadastrar.php">Cadastre-se</a>
        <?php } ?>
    </nav>
</header>
