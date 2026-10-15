<header>
    <h1><a href="/index.php">Beast<span>Core</span></a></h1>
    <nav>
        <a href="/index.php">Início</a>
        <a href="/pages/exercicios.php">Exercícios</a>
        <a href="/pages/unidades.php">Unidades</a>
        <a href="/pages/planos.php">Planos</a>
        <?php if (isset($_SESSION['id'])) { ?>
            <a href="/pages/treinos.php">Treinos</a>
            <a href="/pages/progresso.php">Progresso</a>
            <a href="/pages/mensagens.php">Mensagens</a>
            <?php if (isset($_SESSION['tipo']) && $_SESSION['tipo'] == "admin") { ?>
                <a href="/admin/usuarios.php">Usuários</a>
                <a href="/admin/professores.php">Professores</a>
                <a href="/admin/planos.php">Gerenciar Planos</a>
        <a href="/admin/unidades.php">Gerenciar Unidades</a>
            <?php } ?>
            <a href="/login/logout.php">Sair</a>
        <?php } else { ?>
            <a href="/login/login.php">Entrar</a>
            <a href="/login/cadastrar.php">Cadastre-se</a>
        <?php } ?>
    </nav>
</header>
