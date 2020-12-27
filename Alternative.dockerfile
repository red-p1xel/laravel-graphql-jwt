FROM php:8.0-fpm-alpine

# Install core extensions
RUN docker-php-ext-install mysqli pdo_mysql bcmath

RUN apk add --no-cache --virtual .build-deps $PHPIZE_DEPS \
    && pecl install redis xdebug \
    && docker-php-ext-enable redis \
    && docker-php-ext-enable xdebug \
    && apk del -f .build-deps

# Set working directory
WORKDIR /app

COPY ./dist /app

RUN chmod +x ./composer.phar \
    && ./composer.phar install --no-suggest

# Create code coverage rapart
#RUN ./vendor/bin/phpunit --coverage-text

# Prepare Laravel application
RUN echo 'APP_ENV=local' > .env \
    && php artisan optimize \
    && php artisan config:clear

EXPOSE 80

ENTRYPOINT ["sh", "-c"]

CMD ["php artisan serve --host=0.0.0.0 --port=80"]
