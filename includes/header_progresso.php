<header>
    <h1><a href="/index.php">Beast<span>Core</span></a></h1>
    <nav>
        <a href="/index.php">Início</a>
        <a href="/pages/treinos.php">Treinos</a>
        <a href="/pages/progresso.php">Progresso</a>
        <a href="/pages/mensagens.php">Mensagens</a>
        <a href="/pages/exercicios.php">Exercícios</a>
        <a href="/pages/unidades.php">Unidades</a>
        <a href="/pages/planos.php">Planos</a>
    </nav>

    <p class="logado">Olá, <?php echo htmlspecialchars($_SESSION['nome']); ?> - <a href="/login/logout.php">Sair</a></p>
</header>
