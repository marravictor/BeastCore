<?php
/**
 * BeastCore - Inicializador de Banco de Dados Universal
 * 
 * Uso: php database/init_db.php
 * 
 * Este script cria as tabelas e insere dados iniciais
 * Funciona tanto com SQLite (local) quanto PostgreSQL (produção)
 */

require_once __DIR__ . '/connect.php';

try {
    // Lê o arquivo SQL
    $sql = file_get_contents(__DIR__ . '/../beastcore_dump.sql');
    
    // Separa em statements individuais (remove comentários e divide por ;)
    $statements = array_filter(
        array_map('trim', explode(';', $sql)),
        function($stmt) {
            return !empty($stmt) && !str_starts_with($stmt, '--');
        }
    );
    
    foreach ($statements as $stmt) {
        if (trim($stmt) !== '') {
            $conexao->exec($stmt);
        }
    }
    
    // Ajusta sequences no PostgreSQL
    $driver = $conexao->getAttribute(PDO::ATTR_DRIVER_NAME);
    if ($driver === 'pgsql') {
        $tables = ['usuarios', 'unidades', 'planos', 'exercicios', 'treinos', 'progresso', 'mensagens'];
        foreach ($tables as $table) {
            $conexao->exec("SELECT setval('{$table}_id_seq', (SELECT MAX(id) FROM {$table}));");
        }
    }
    
    echo "✅ Banco de dados inicializado com sucesso!\n";
    echo "📋 Tabelas criadas: usuarios, unidades, planos, exercicios, treinos, progresso, mensagens\n";
    echo "👤 Login admin: admin@beastcore.com / 123456\n";
    echo "👤 Login aluno: aluno@exemplo.com / 123456\n";
    
} catch (PDOException $e) {
    echo "❌ Erro ao inicializar banco: " . $e->getMessage() . "\n";
    exit(1);
}