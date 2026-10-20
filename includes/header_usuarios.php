<header>
    <h1><a href="/BeastCore/index.php">Beast<span>Core</span></a> <em class="tag">Admin</em></h1>
    <nav>
        <a href="/BeastCore/index.php">Início</a>
        <a href="/BeastCore/admin/usuarios.php">Usuários</a>
        <a href="/BeastCore/admin/professores.php">Professores</a>
        <a href="/BeastCore/admin/planos.php">Gerenciar Planos</a>
        <a href="/BeastCore/admin/unidades.php">Gerenciar Unidades</a>
        <a href="/BeastCore/pages/exercicios.php">Exercícios</a>
        <a href="/BeastCore/pages/unidades.php">Unidades</a>
        <a href="/BeastCore/pages/planos.php">Planos</a>
    </nav>

    <p class="logado">Olá, <?php echo htmlspecialchars($_SESSION['nome']); ?> - <a href="/BeastCore/login/logout.php">Sair</a></p>
</header>
