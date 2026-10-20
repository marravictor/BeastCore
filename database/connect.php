<?php
session_start();

$host   = "192.168.10.41";
$dbname = "beastcore";
$user   = "beastcore";
$pass   = "beastcore";

$conexao = null;
$erro = "";

// Tenta PostgreSQL
$s = @fsockopen($host, 5432, $c, $m, 1.0);
if ($s) {
    fclose($s);
    try {
        $conexao = new PDO("pgsql:host=$host;dbname=$dbname", $user, $pass);
        $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        $erro = $e->getMessage();
    }
}

// Se falhar, tenta SQLite demo
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

if (!$conexao) {
    die("Erro ao conectar ao banco.");
}

return $conexao;
?>
