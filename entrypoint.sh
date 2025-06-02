#!/bin/sh

# Genera el archivo .env
cat > /var/www/.env <<EOF
APP_NAME=Laravel
APP_ENV=production
APP_KEY=${APP_KEY}
APP_DEBUG=false

DB_CONNECTION=mariadb
DB_HOST=mariadb-service.mysql-ns.svc.cluster.local
DB_DATABASE=laravel_db
DB_USERNAME=root
DB_PASSWORD=${DB_PASSWORD}

REDIS_HOST=redis-service
REDIS_PASSWORD=${REDIS_PASSWORD}

SESSION_DRIVER=redis
CACHE_DRIVER=redis
QUEUE_CONNECTION=redis

# Configuración de Mail (opcional)
# MAIL_MAILER=smtp
# MAIL_HOST=mailhog
# MAIL_PORT=1025
# MAIL_PASSWORD=${MAIL_PASSWORD:-}

# Otras variables...
EOF

# Instala dependencias de Composer (si no se hicieron en el Dockerfile)
# composer install --no-dev --optimize-autoloader

# Instala dependencias NPM y compila assets (si existe package.json)
if [ -f "package.json" ]; then
  npm install
  npm run build  # Usa 'dev' en desarrollo (no recomendado para producción)
fi

# Optimiza Laravel
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Ejecuta migraciones (opcional, solo si es necesario)
php artisan migrate --force

# optimize Laravel
php artisan optimize
# Configura permisos para el directorio de almacenamiento y caché
chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Inicia PHP-FPM
exec php-fpm