<?php
if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}

// ============================================================
// CONFIGURAÇÃO UNIVERSAL - Funciona em QUALQUER MÁQUINA
// ============================================================
// Produção (Moba/Heroku/Railway/Render): configure variáveis de ambiente
// Desenvolvimento local: usa SQLite automaticamente
// ============================================================

// Lê variáveis de ambiente (produção) ou usa padrões (local)
$host   = $_ENV['DB_HOST']   ?? getenv('DB_HOST')   ?? "192.168.10.41";
$dbname = $_ENV['DB_NAME']   ?? getenv('DB_NAME')   ?? "beastcore";
$user   = $_ENV['DB_USER']   ?? getenv('DB_USER')   ?? "beastcore";
$pass   = $_ENV['DB_PASS']   ?? getenv('DB_PASS')   ?? "beastcore";
$port   = $_ENV['DB_PORT']   ?? getenv('DB_PORT')   ?? "5432";

$conexao = null;
$erro = "";

// 1. Tenta PostgreSQL (produção - Moba, Heroku, Railway, Render, etc.)
// Verifica se há configuração de produção via env vars
$isProduction = isset($_ENV['DB_HOST']) || getenv('DB_HOST') !== false;

if ($isProduction || @fsockopen($host, $port, $c, $m, 1.0)) {
    if ($isProduction) {
        // Em produção, tenta conectar direto (host já vem das env vars)
        try {
            $dsn = "pgsql:host=$host;port=$port;dbname=$dbname";
            $conexao = new PDO($dsn, $user, $pass);
            $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            $erro = $e->getMessage();
        }
    } else {
        // Desenvolvimento: testa conexão local
        $s = @fsockopen($host, $port, $c, $m, 1.0);
        if ($s) {
            fclose($s);
            try {
                $conexao = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $user, $pass);
                $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                $erro = $e->getMessage();
            }
        }
    }
}

// 2. Fallback: SQLite (desenvolvimento local / demo)
if (!$conexao && extension_loaded("pdo_sqlite")) {
    $demo = __DIR__ . "/demo.sqlite";
    if (file_exists($demo)) {
        try {
            $conexao = new PDO("sqlite:" . $demo);
            $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
        }
    }
}

// 3. Último recurso: cria SQLite em memória se nada funcionar
if (!$conexao && extension_loaded("pdo_sqlite")) {
    try {
        $conexao = new PDO("sqlite::memory:");
        $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // Inicializa schema do arquivo .sql
        $sql = file_get_contents(__DIR__ . '/../beastcore_dump.sql');
        $statements = array_filter(
            array_map('trim', explode(';', $sql)),
            fn($stmt) => !empty($stmt) && !str_starts_with($stmt, '--')
        );
        foreach ($statements as $stmt) {
            if (trim($stmt) !== '') $conexao->exec($stmt);
        }
    } catch (PDOException $e) {
    }
}

if (!$conexao) {
    die("Erro ao conectar ao banco. Verifique configurações.");
}

return $conexao;
?>
