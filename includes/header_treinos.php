<header>
    <h1><a href="/BeastCore/index.php">Beast<span>Core</span></a></h1>
    <nav>
        <a href="/BeastCore/index.php">Início</a>
        <a href="/BeastCore/pages/treinos.php">Treinos</a>
        <a href="/BeastCore/pages/progresso.php">Progresso</a>
        <a href="/BeastCore/pages/mensagens.php">Mensagens</a>
        <a href="/BeastCore/pages/exercicios.php">Exercícios</a>
        <a href="/BeastCore/pages/unidades.php">Unidades</a>
        <a href="/BeastCore/pages/planos.php">Planos</a>
    </nav>

    <p class="logado">Olá, <?php echo htmlspecialchars($_SESSION['nome']); ?> - <a href="/BeastCore/login/logout.php">Sair</a></p>
</header>
