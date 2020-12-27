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
# Build backend application in 'development' mode
$ docker-compose -f development.yml build app
$ docker-compose -f development.yml up -d
# First installation steps
$ docker-compose -f development.yml exec app composer install
$ docker-compose -f development.yml exec app php artisan key:generate
$ docker-compose -f development.yml exec app php artisan config:clear
# Generate secret key for tokens
$ docker-compose -f development.yml exec app php artisan jwt:secret

# Apply migration and seeding fake data to database   
$ docker-compose -f development.yml exec app php artisan migrate --seed

# Publish the config file for GraphQL
$ docker-compose -f development.yml exec app php artisan vendor:publish --provider="Rebing\GraphQL\GraphQLServiceProvider"
# Publish the config file for JWT
$ docker-compose -f development.yml exec app php artisan vendor:publish --provider="Tymon\JWTAuth\Providers\LaravelServiceProvider"

# Start analyzing your code using the phpstan console command
$ docker-compose -f development.yml exec app ./vendor/bin/phpstan analyse --memory-limit=4G
```

### GraphQL Examples

#### Mutation `registerUser`
Create new user account

```graphql

    mutation {
      registerUser(name: "Ali Destro", email: "test1256@hot.net", password: "password7") {
        name
      }
    }

```

#### Mutation `loginUser`
Authenticate user to GraphQL and return Bearer `access_token` JWT

```graphql

mutation {
  loginUser(email: "penelope74@example.org", password: "userPassword3")
}

```
