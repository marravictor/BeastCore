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
// Usa função auxiliar para compatibilidade com todas as plataformas
function getEnvVar($key, $default = '') {
    // 1. $_ENV (padrão PHP-FPM, alguns servidores)
    if (isset($_ENV[$key]) && $_ENV[$key] !== '') return $_ENV[$key];
    // 2. getenv() (Apache mod_php, alguns servidores)
    $val = getenv($key);
    if ($val !== false && $val !== '') return $val;
    // 3. $_SERVER (alguns servidores colocam env vars aqui)
    if (isset($_SERVER[$key]) && $_SERVER[$key] !== '') return $_SERVER[$key];
    return $default;
}

$host   = getEnvVar('DB_HOST', "192.168.10.41");
$dbname = getEnvVar('DB_NAME', "beastcore");
$user   = getEnvVar('DB_USER', "beastcore");
$pass   = getEnvVar('DB_PASS', "beastcore");
$port   = getEnvVar('DB_PORT', "5432");

// DEBUG: Log das variáveis (remova em produção se quiser)
// error_log("DB Config: host=$host, db=$dbname, user=$user, port=$port");

$conexao = null;
$erro = "";

// Detecta se está em produção: tem DB_HOST configurado E não é o IP local padrão
$isProduction = (
    (isset($_ENV['DB_HOST']) && $_ENV['DB_HOST'] !== '') ||
    (getenv('DB_HOST') !== false && getenv('DB_HOST') !== '') ||
    (isset($_SERVER['DB_HOST']) && $_SERVER['DB_HOST'] !== '')
) && $host !== "192.168.10.41";

// 1. Tenta PostgreSQL (produção - Moba, Heroku, Railway, Render, etc.)
if ($isProduction) {
    // Em produção, conecta direto (host vem das env vars)
    try {
        $dsn = "pgsql:host=$host;port=$port;dbname=$dbname";
        $conexao = new PDO($dsn, $user, $pass, [
            PDO::ATTR_TIMEOUT => 10,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        ]);
    } catch (PDOException $e) {
        $erro = "PostgreSQL: " . $e->getMessage();
    }
} else {
    // Desenvolvimento: testa conexão local PostgreSQL
    $s = @fsockopen($host, $port, $c, $m, 1.0);
    if ($s) {
        fclose($s);
        try {
            $conexao = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $user, $pass, [
                PDO::ATTR_TIMEOUT => 5,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            ]);
        } catch (PDOException $e) {
            $erro = "PostgreSQL local: " . $e->getMessage();
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
            $erro = "SQLite: " . $e->getMessage();
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
        $erro = "SQLite memory: " . $e->getMessage();
    }
}

if (!$conexao) {
    // Debug: mostra o que foi detectado
    $debug = [
        'isProduction' => $isProduction,
        'host' => $host,
        'dbname' => $dbname,
        'user' => $user,
        'port' => $port,
        'env_DB_HOST' => getEnvVar('DB_HOST', 'NOT_SET'),
        'getenv_DB_HOST' => getenv('DB_HOST') ?: 'NOT_SET',
        'server_DB_HOST' => $_SERVER['DB_HOST'] ?? 'NOT_SET',
        'pdo_drivers' => PDO::getAvailableDrivers(),
        'erro' => $erro,
    ];
    die("Erro ao conectar ao banco. Debug: " . json_encode($debug, JSON_PRETTY_PRINT));
}

return $conexao;
?>
