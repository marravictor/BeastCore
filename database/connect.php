<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$host   = "192.168.10.41";
$dbname = "beastcore";
$user   = "beastcore";
$pass   = "beastcore";

$conexao = null;
$erro = "";

// 1) Tenta o banco de verdade (PostgreSQL)
$servidor = @fsockopen($host, 5432, $codigo, $mensagem, 1.0);
if ($servidor) {
    fclose($servidor);
    try {
        $conexao = new PDO("pgsql:host=$host;dbname=$dbname", $user, $pass);
        $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        $erro = $e->getMessage();
        $conexao = null;
    }
}

// 2) Se o PostgreSQL estiver offline, usa o banco de demonstracao local (SQLite)
if ($conexao == null && extension_loaded("pdo_sqlite")) {
    $demo = __DIR__ . "/demo.sqlite";
    if (file_exists($demo)) {
        try {
            $conexao = new PDO("sqlite:" . $demo);
            $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            $conexao = null;
        }
    }
}

// 3) Sem nenhum banco disponivel
if ($conexao == null) {
    echo "Erro: " . $erro;
    echo "<br>Sem conexao com o banco de dados. Ligue o PostgreSQL (" . $host . ") e tente novamente.";
    exit();
}

return $conexao;
?>
