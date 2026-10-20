<?php
/**
 * Configuração de paths - funciona tanto local (/BeastCore) quanto produção (/)
 */

// Detecta automaticamente o base path
// Se o script está em /var/www/html/BeastCore/... -> base = /BeastCore
// Se o script está em /var/www/html/... -> base = /
function getBasePath(): string {
    $scriptName = $_SERVER['SCRIPT_NAME'] ?? '';
    $docRoot = $_SERVER['DOCUMENT_ROOT'] ?? '';
    $scriptFile = $_SERVER['SCRIPT_FILENAME'] ?? '';
    
    // Tenta detectar pelo SCRIPT_NAME
    if (strpos($scriptName, '/BeastCore/') !== false) {
        return '/BeastCore';
    }
    
    // Tenta detectar pelo caminho físico do arquivo
    if (strpos($scriptFile, 'BeastCore') !== false && strpos($scriptFile, $docRoot) === 0) {
        $relative = substr($scriptFile, strlen($docRoot));
        if (preg_match('#^(.*/BeastCore)/#', $relative, $matches)) {
            return $matches[1];
        }
    }
    
    // Fallback: variável de ambiente ou vazio (raiz)
    return $_ENV['BASE_PATH'] ?? getenv('BASE_PATH') ?? '';
}

// Base path para usar em links/redirects
$BASE_PATH = getBasePath();

// Helper para gerar URLs corretas
function url(string $path): string {
    global $BASE_PATH;
    $path = ltrim($path, '/');
    return $BASE_PATH ? "$BASE_PATH/$path" : "/$path";
}