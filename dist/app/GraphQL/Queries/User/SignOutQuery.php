<?php

declare(strict_types=1);

namespace App\GraphQL\Queries\User;

use App\GraphQL\JWTAuthorize;
use App\Models\User;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Tymon\JWTAuth\Contracts\Providers\Auth;

class SignOutQuery extends Query
{
    use JWTAuthorize;

    protected $attributes = [
        'name' => 'signOut',
        'description' => 'Query for sign-out current authenticated user'
    ];

    public function type(): Type
    {
        return Type::listOf(Type::string());
    }

    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields): array
    {
        if (auth()->user()) {
            /** @var User $user */
            $user = auth()->user();
            auth()->invalidate();

            return [
                'message' => "User UID: $user->id signed out!",
            ];
        }

        return [
            'errors' => [
                'message' => 'Unauthorized',
            ],
        ];
    }
}
