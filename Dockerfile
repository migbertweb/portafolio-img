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
FROM node:18 AS node
WORKDIR /app
COPY package.json package-lock.json ./
COPY resources ./resources
COPY public ./public  
# ¡Asegúrate de copiar la carpeta public con index.html!
RUN npm install && npm run build

# Etapa final
FROM php:8.2-fpm

# Set working directory
WORKDIR /var/www

# Asegúrate de que los directorios destino existan
RUN mkdir -p vendor public/build

# Copia dependencias y assets compilados
COPY --from=builder /app/vendor ./vendor
COPY --from=node /app/public/build ./public/build

# Copia el código de la aplicación
COPY . .

RUN chown -R www-data:www-data /var/www
# Install dependencies
RUN apt-get update && apt-get install -y \
  build-essential \
  libpng-dev \
  libjpeg62-turbo-dev \
  libfreetype6-dev \
  libonig-dev \
  libxml2-dev \
  locales \
  zip \
  jpegoptim optipng pngquant gifsicle \
  vim \
  unzip \
  git \
  nodejs \
  npm \
  ranger \
  curl

# Install extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd && docker-php-source delete

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Add user for laravel application
RUN groupadd -g 1000 www && useradd -u 1000 -ms /bin/bash -g www www

# Copy existing application directory permissions
COPY --chown=www:www . /var/www

# Change current user to www
USER www

# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]
