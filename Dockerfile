# Etapa de construcción
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

# Etapa de construcción de Node.js
# FROM node:18 AS node
# WORKDIR /app
# COPY package.json package-lock.json ./
# COPY resources ./resources
# COPY public ./public  
# # ¡Asegúrate de copiar la carpeta public con index.html!
# RUN npm install && npm run build

# Etapa final
FROM php:8.2-fpm-alpine

# Set working directory
WORKDIR /var/www

# Asegúrate de que los directorios destino existan
RUN mkdir -p vendor 
# public/build

# Copia dependencias y assets compilados
COPY --from=builder /app/vendor ./vendor
# COPY --from=node /app/public/build ./public/build

# Copia el código de la aplicación
COPY . .

RUN chown -R www-data:www-data /var/www

# Instala dependencias principales (equivalente Alpine de tus paquetes Debian)
RUN apk add --no-cache \
  build-base \
  libpng-dev \
  libjpeg-turbo-dev \
  freetype-dev \
  oniguruma-dev \
  libxml2-dev \
  zip \
  jpegoptim \
  optipng \
  pngquant \
  gifsicle \
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

# Limpiar cache de paquetes apk
RUN rm -rf /var/cache/apk/*

# Crear usuario y grupo www con UID y GID 1000
RUN addgroup -g 1000 www && adduser -u 1000 -D -s /bin/sh -G www www

# Copiar archivos con permisos de www:www
COPY --chown=www:www . /var/www

# Change current user to www
USER www

# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]
