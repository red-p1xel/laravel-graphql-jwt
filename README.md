Laravel 8.x: GraphQL JWT Auth 
=============================

RAD server-side Docker starter with `PHP 8`, `MySQL 8` `PHPCodeSniffer` software and
source code examples for implement `GraphQL` API with `JWT` auth issue.

## Documentation
+ Laravel 5 Repository https://github.com/andersao/l5-repository
+ JWT-Auth: https://jwt-auth.readthedocs.io/en/develop
+ GraphQL: https://github.com/rebing/graphql-laravel/blob/master/README.md
+ PHPUnit: https://github.com/sebastianbergmann/phpunit
+ Larastan: https://github.com/nunomaduro/larastan

## Deployment
```bash
# Starting containers
$ docker-compose up -d
$ docker exec -ti app php artisan config:clear
$ docker exec -ti app php artisan migrate
# Publish configuration for Laravel 5 Repositories
$ docker exec -ti app php artisan vendor:publish --provider "Prettus\Repository\Providers\RepositoryServiceProvider"
# Publish the config file for GraphQL
$ docker exec -ti app php artisan vendor:publish --provider="Rebing\GraphQL\GraphQLServiceProvider"
# Publish the config file for JWT
$ docker exec -ti app php artisan vendor:publish --provider="Tymon\JWTAuth\Providers\LaravelServiceProvider"
# Generate secret key for tokens
$ docker exec -ti app php artisan jwt:secret
# Start analyzing your code using the phpstan console command
$ docker exec -ti app ./vendor/bin/phpstan analyse
```
