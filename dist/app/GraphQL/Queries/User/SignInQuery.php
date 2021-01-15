<?php

declare(strict_types=1);

namespace App\GraphQL\Queries\User;

use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;

class SignInQuery extends Query
{
    protected $attributes = [
        'name' => 'signIn',
        'description' => 'Query for authorize user in API'
    ];

    public function type(): Type
    {
        return Type::listOf(Type::string());
    }

    public function args(): array
    {
        return [
            'email' => [
                'name' => 'email',
                'type' => Type::nonNull(Type::string()),
                'rules' => ['email']
            ],
            'password' => [
                'name' => 'password',
                'type' => Type::nonNull(Type::string()),
            ],
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields): array
    {
        $credentials = ['email' => $args['email'], 'password' => $args['password']];
        // Generate a token for the user if the credentials are valid
        if (!$token = auth()->attempt($credentials)) {
            return [
                'status' => 401,
                'error' => 'Unauthorized'
            ];
        }

        return [
            'access_token' => $token
        ];
    }
}
