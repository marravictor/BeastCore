#!/bin/bash
# ============================================
# Setup Nginx + PHP-FPM para BeastCore no Ubuntu
# Rode como root: sudo bash setup-nginx.sh
# ============================================

set -e

echo "🔧 Configurando Nginx para BeastCore..."

# 1. Detecta versão do PHP-FPM instalada
PHP_FPM_SOCK=$(ls /run/php/php*-fpm.sock 2>/dev/null | head -1)

if [ -z "$PHP_FPM_SOCK" ]; then
    echo "❌ PHP-FPM não encontrado. Instalando php8.3-fpm..."
    apt update && apt install -y php8.3-fpm php8.3-pgsql php8.3-sqlite3 php8.3-mbstring php8.3-xml php8.3-curl
    PHP_FPM_SOCK="/run/php/php8.3-fpm.sock"
else
    echo "✅ PHP-FPM encontrado: $PHP_FPM_SOCK"
fi

# 2. Cria config do site
cat > /etc/nginx/sites-available/beastcore <<EOF
server {
    listen 80;
    server_name _;

    root /var/www/html/BeastCore;
    index index.php;

    access_log /var/log/nginx/beastcore_access.log;
    error_log /var/log/nginx/beastcore_error.log;

    # Estáticos
    location ~* \.(css|js|png|jpg|jpeg|gif|ico|svg|woff|woff2)$ {
        expires 1y;
        add_header Cache-Control "public, no-transform";
        try_files \$uri =404;
    }

    # PHP - PRINCIPAL
    location ~ \.php$ {
        try_files \$uri =404;
        fastcgi_split_path_info ^(.+\.php)(/.+)$;
        fastcgi_pass unix:$PHP_FPM_SOCK;
        fastcgi_index index.php;
        include fastcgi_params;
        fastcgi_param SCRIPT_FILENAME \$document_root\$fastcgi_script_name;
        fastcgi_param PATH_INFO \$fastcgi_path_info;
        fastcgi_param HTTP_PROXY "";
    }

    # Rewrite para index.php
    location / {
        try_files \$uri \$uri/ /index.php?\$query_string;
    }

    # Segurança
    location ~ /\.(env|git|sql)$ { deny all; }
    location ~ /database/ { deny all; }
    location ~ /includes/ { deny all; }
}
EOF

# 3. Ativa site
ln -sf /etc/nginx/sites-available/beastcore /etc/nginx/sites-enabled/
rm -f /etc/nginx/sites-enabled/default

# 4. Testa e recarrega
nginx -t && systemctl reload nginx

echo "✅ Nginx configurado!"
echo "📁 Root: /var/www/html/BeastCore"
echo "🔌 PHP-FPM: $PHP_FPM_SOCK"
echo ""
echo "🌐 Teste: http://SEU_IP/"