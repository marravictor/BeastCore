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
        <?php } ?>
    </nav>

    <?php if (isset($_SESSION['id'])) { ?>
        <p class="logado">Olá, <?php echo htmlspecialchars($_SESSION['nome']); ?> - <a href="/login/logout.php">Sair</a></p>
    <?php } else { ?>
        <form class="entrar" action="/login/login.php" method="post">
            <input type="email" name="email" placeholder="E-mail" required>
            <input type="password" name="senha" placeholder="Senha" required>
            <input type="submit" value="Entrar">
        </form>
        <p class="logado">Novo por aqui? <a href="/login/cadastrar.php">Cadastre-se</a> | <a href="/admin/login.php">Admin</a></p>
    <?php } ?>
</header>
