FROM php:8.1-apache

COPY . /var/www/html

RUN apt-get update && apt-get install -y \
    git \
    unzip

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

RUN a2enmod rewrite

RUN docker-php-ext-install mysqli

RUN composer install

EXPOSE 80

CMD ["apache2-foreground"]