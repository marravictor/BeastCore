<?php
/**
 * Configuração de paths - detecta automaticamente /BeastCore ou raiz
 */

function getBasePath(): string {
    $scriptName = $_SERVER['SCRIPT_NAME'] ?? '';
    
    // Detecta pela URL acessada (funciona no navegador)
    if (strpos($scriptName, '/BeastCore/') !== false) {
        return '/BeastCore';
    }
    
    // Fallback: variável de ambiente (para VPS/Moba)
    return $_ENV['BASE_PATH'] ?? getenv('BASE_PATH') ?? '';
}

$BASE_PATH = getBasePath();

function url(string $path): string {
    global $BASE_PATH;
    $path = ltrim($path, '/');
    return $BASE_PATH ? "$BASE_PATH/$path" : "/$path";
}