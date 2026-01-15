FROM php:8.3-apache

ENV APACHE_DOCUMENT_ROOT=/var/www/html/public \
    MOODLE_DATA=/var/www/moodledata

RUN apt-get update \
    && apt-get install -y --no-install-recommends \
        cron \
        git \
        libfreetype6-dev \
        libicu-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
        libwebp-dev \
        libxml2-dev \
        libzip-dev \
        mariadb-client \
        unzip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp \
    && docker-php-ext-install \
        bcmath \
        exif \
        gd \
        intl \
        mysqli \
        opcache \
        pcntl \
        pdo \
        pdo_mysql \
        soap \
        zip \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . .

RUN mkdir -p "$MOODLE_DATA" \
    && composer install --no-dev --prefer-dist --optimize-autoloader \
    && chown -R www-data:www-data /var/www/html "$MOODLE_DATA"

RUN sed -ri 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/000-default.conf /etc/apache2/apache2.conf

EXPOSE 80

CMD ["apache2-foreground"]
