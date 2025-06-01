# Etapa de construcción
FROM composer:2.6 AS builder
WORKDIR /app
COPY . .
RUN composer install --no-dev --optimize-autoloader  # Instala dependencias

FROM node:18 AS node
WORKDIR /app
COPY package.json package-lock.json ./
COPY resources/ ./resources/
RUN npm install && npm run build

# Etapa final
FROM php:8.2-fpm

# Set working directory
WORKDIR /var/www


# Copia dependencias y assets compilados
COPY --from=composer /app/vendor ./vendor
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
