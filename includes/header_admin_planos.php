<header>
    <h1><a href="/index.php">Beast<span>Core</span></a> <em class="tag">Admin</em></h1>
    <nav>
        <a href="/index.php">Início</a>
        <a href="/admin/usuarios.php">Usuários</a>
        <a href="/admin/professores.php">Professores</a>
        <a href="/admin/planos.php">Gerenciar Planos</a>
        <a href="/admin/unidades.php">Gerenciar Unidades</a>
        <a href="/pages/exercicios.php">Exercícios</a>
        <a href="/pages/unidades.php">Unidades</a>
        <a href="/pages/planos.php">Planos</a>
    </nav>

    <p class="logado">Olá, <?php echo htmlspecialchars($_SESSION['nome']); ?> - <a href="/login/logout.php">Sair</a></p>
</header>
