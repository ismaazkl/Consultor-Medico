FROM php:8.3-apache

RUN a2enmod rewrite

RUN apt-get update && apt-get install -y \
    libpq-dev \
    libzip-dev \
    zip \
    unzip \
    git \
    curl \
    && docker-php-ext-install pdo pdo_mysql pdo_pgsql zip

RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY composer.json composer.lock package.json package-lock.json ./
RUN composer install --optimize-autoloader --no-dev --no-scripts
RUN npm install

COPY . .
RUN npm run build

COPY .env.example .env
RUN chown -R www-data:www-data storage bootstrap/cache public/build .env

EXPOSE 80

CMD ["apache2-foreground"]
