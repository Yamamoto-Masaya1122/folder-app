# php
FROM php:8.4-apache

# ドキュメントルートを変更する
ENV APACHE_DOCUMENT_ROOT='/var/www/html/public/'
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libpq-dev \
    libxml2-dev \
    libzip-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    && docker-php-ext-install pdo pdo_mysql xml dom \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install zip gd bcmath

# Apache の rewrite_module を有効化
RUN a2enmod rewrite

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
COPY ./src /var/www/html
# ストレージディレクトリのパーミッション設定を追加
RUN chown -R www-data:www-data /var/www/html/storage \
    && chmod -R 775 /var/www/html/storage

# workdir
WORKDIR /var/www/html

COPY ./infra/docker/php/php.ini /usr/local/etc/php/php.ini

# Node.js（最新系）を追加
RUN curl -fsSL https://deb.nodesource.com/setup_current.x | bash - \
    && apt-get install -y nodejs \
    && node -v && npm -v