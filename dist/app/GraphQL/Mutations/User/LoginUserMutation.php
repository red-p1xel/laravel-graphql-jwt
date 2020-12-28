<?php

declare(strict_types=1);

namespace App\GraphQL\Mutations\User;

use Auth;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;
use Rebing\GraphQL\Support\SelectFields;

class LoginUserMutation extends Mutation
{
    protected $attributes = [
        'name' => 'loginUser',
    ];

    public function type(): Type
    {
        return Type::string();
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

    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        $credentials = ['email' => $args['email'], 'password' => $args['password']];
        // Generate a token for the user if the credentials are valid
        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }


        return $token;
    }
}

//"eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9sb2NhbGhvc3Q6ODAwMFwvZ3JhcGhxbCIsImlhdCI6MTYwOTExMjUyMSwiZXhwIjoxNjA5MTE2MTIxLCJuYmYiOjE2MDkxMTI1MjEsImp0aSI6Im5PaUxCN0dNNENLNFV5NWgiLCJzdWIiOjE0LCJwcnYiOiIyM2JkNWM4OTQ5ZjYwMGFkYjM5ZTcwMWM0MDA4NzJkYjdhNTk3NmY3In0.O0lpVSsUeLIohCabwop22NLiUsg5goeyA_DEtqG1X_Q"
