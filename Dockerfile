FROM php:8.0-fpm-alpine

RUN docker-php-ext-install bcmath mysqli pdo_mysql

RUN apk add --no-cache --virtual .build-deps $PHPIZE_DEPS \
    && pecl install redis xdebug \
    && docker-php-ext-enable redis \
    && docker-php-ext-enable xdebug \
    && apk del -f .build-deps

COPY ./dist /app

RUN chmod +x ./composer.phar \
    && ./composer.phar install --no-suggest

RUN ./vendor/bin/phpunit --coverage-text

RUN echo 'APP_ENV=local' > .env \
    && php artisan optimize \
    && php artisan config:clear

WORKDIR /app

ENTRYPOINT ["sh", "-c"]

EXPOSE 80

CMD ["php artisan serve --host=0.0.0.0 --port=80"]