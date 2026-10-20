<?php
/**
 * Configuração de paths - detecta automaticamente /BeastCore ou raiz
 * Lê .env se existir (para VPS/Moba)
 */

// Carrega .env se existir (PHP não faz isso automático)
$envFile = __DIR__ . '/../.env';
if (file_exists($envFile) && is_readable($envFile)) {
    $lines = @file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    if ($lines !== false) {
        foreach ($lines as $line) {
            $line = trim($line);
            if ($line === '' || $line[0] === '#') continue;
            if (strpos($line, '=') !== false) {
                list($key, $value) = array_map('trim', explode('=', $line, 2));
                $_ENV[$key] = $value;
                putenv("$key=$value");
            }
        }
    }
}

function getBasePath(): string {
    // 1. Variável de ambiente BASE_PATH (do .env ou servidor)
    $basePath = $_ENV['BASE_PATH'] ?? getenv('BASE_PATH') ?? '';
    if ($basePath) return $basePath;
    
    // 2. Detecta pela URL acessada
    $scriptName = $_SERVER['SCRIPT_NAME'] ?? '';
    if (strpos($scriptName, '/BeastCore/') !== false) {
        return '/BeastCore';
    }
    
    // 3. Fallback: caminho do arquivo físico
    $scriptFile = $_SERVER['SCRIPT_FILENAME'] ?? '';
    if (strpos($scriptFile, '/BeastCore/') !== false) {
        return '/BeastCore';
    }
    
    return '';
}

$BASE_PATH = getBasePath();

function url(string $path): string {
    global $BASE_PATH;
    $path = ltrim($path, '/');
    return $BASE_PATH ? "$BASE_PATH/$path" : "/$path";
}