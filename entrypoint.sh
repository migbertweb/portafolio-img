#!/bin/sh

# Genera el archivo .env
cat > /var/www/.env <<EOF
APP_NAME="Migbert Yanez"
APP_ENV=production
APP_KEY=${APP_KEY}
APP_DEBUG=false
APP_TIMEZONE=America/Sao_Paulo
APP_URL=http://localhost

APP_LOCALE=pt
APP_FALLBACK_LOCALE=en
APP_FAKER_LOCALE=pt_BR

DB_CONNECTION=mariadb
DB_HOST=mariadb-service.mysql-ns.svc.cluster.local
DB_DATABASE=laravel_db
DB_USERNAME=root
DB_PASSWORD=${DB_PASSWORD}

REDIS_HOST=redis-service
REDIS_PASSWORD=${REDIS_PASSWORD}
REDIS_PORT=6379
REDIS_DB=0
REDIS_CACHE_DB=1

SESSION_DRIVER=redis
CACHE_DRIVER=redis
QUEUE_CONNECTION=redis

# Otras variables...
EOF

# Instala dependencias de Composer (si no se hicieron en el Dockerfile)
# composer install --no-dev --optimize-autoloader

# Instala dependencias NPM y compila assets (si existe package.json)
#if [ -f "package.json" ]; then
#  npm install
#  npm run build  # Usa 'dev' en desarrollo (no recomendado para producción)
#fi

# Optimiza Laravel
php artisan config:cache
php artisan route:cache
php artisan view:cache
# optimize Laravel
php artisan optimize
# Configura permisos para el directorio de almacenamiento y caché
# chown -R www-data:www-data .
# chgrp -R www-data storage bootstrap/cache
# chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache
# chmod -R 775 /var/www/storage

# Inicia PHP-FPM
exec php-fpm