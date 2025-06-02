# Etapa de construcción
######## PHP COMPOSER #########
FROM composer:2.6 AS builder
WORKDIR /app
COPY composer.json composer.lock ./
# 1. Primero copia SOLO los archivos necesarios para composer
COPY composer.json composer.lock ./
# 2. Instala dependencias SIN ejecutar scripts
RUN composer install --no-dev --no-scripts --optimize-autoloader --ignore-platform-reqs
# 3. Copia el resto de los archivos (incluyendo artisan)
COPY . .
# 4. Ahora ejecuta los scripts de Laravel
RUN composer run-script post-autoload-dump
######### NODE.JS #########
# --- Nueva etapa para Node.js (compilación de assets) ---
FROM node:18 AS node
WORKDIR /app
COPY --from=builder /app .
# Copia solo lo necesario para npm (optimización)
COPY package.json package-lock.json vite.config.js ./
COPY resources ./resources
RUN npm install && npm run build
########## PHP FPM #########
# --- Etapa final de PHP FPM ---
# Utiliza la imagen base de PHP FPM
# Etapa final
FROM php:8.2-fpm-alpine
# Set working directory
WORKDIR /var/www
# Asegúrate de que los directorios destino existan
RUN mkdir -p vendor 
# public/build
# Copia dependencias de Composer desde la etapa de construcción
COPY --from=builder /app/vendor ./vendor
# Copia assets compilados desde la etapa Node.js
COPY --from=node /app/public/build ./public/build 
# user y grupo para evitar problemas de permisos
RUN chown -R www-data:www-data /var/www
USER www-data
# Primero copia todo con permisos correctos
COPY --chown=www-data:www-data . /var/www
# Luego copia el entrypoint
COPY --chown=www-data:www-data entrypoint.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/entrypoint.sh

# Instala dependencias principales (equivalente Alpine de tus paquetes Debian)
RUN apk add --no-cache \
  build-base \
  libpng-dev \
  libjpeg-turbo-dev \
  freetype-dev \
  oniguruma-dev \
  libxml2-dev \
  zip \
  unzip \
  git \
  nodejs \
  npm \
  curl
# Configura extensiones PHP (mucho más rápido que en Debian)
RUN docker-php-ext-configure gd --with-jpeg --with-freetype && \
  docker-php-ext-install -j$(nproc) \
  pdo_mysql \
  mbstring \
  exif \
  pcntl \
  bcmath \
  gd
# Limpieza (opcional pero recomendado)
RUN rm -rf /var/cache/apk/* && \
  docker-php-source delete

ENTRYPOINT ["entrypoint.sh"]
# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]
