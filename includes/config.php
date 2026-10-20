<?php
/**
 * Configuração de paths - detecta automaticamente /BeastCore ou raiz
 * Lê .env se existir (para VPS/Moba)
 */

// Carrega .env se existir (PHP não faz isso automático)
$envFile = __DIR__ . '/../.env';
if (file_exists($envFile)) {
    $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0) continue; // comentário
        if (strpos($line, '=') !== false) {
            list($key, $value) = explode('=', $line, 2);
            $key = trim($key);
            $value = trim($value);
            if (!array_key_exists($key, $_ENV)) {
                $_ENV[$key] = $value;
            }
            if (getenv($key) === false) {
                putenv("$key=$value");
            }
        }
    }
}

function getBasePath(): string {
    $scriptName = $_SERVER['SCRIPT_NAME'] ?? '';
    
    // 1. Detecta pela URL acessada (funciona no navegador)
    if (strpos($scriptName, '/BeastCore/') !== false) {
        return '/BeastCore';
    }
    
    // 2. Variável de ambiente BASE_PATH (do .env ou servidor)
    $basePath = $_ENV['BASE_PATH'] ?? getenv('BASE_PATH') ?? '';
    if ($basePath) return $basePath;
    
    // 3. Fallback: se o arquivo está em pasta BeastCore, assume /BeastCore
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