<?php

declare(strict_types=1);

namespace App\GraphQL\Queries\User;

use App\GraphQL\JWTAuthorize;
use App\Models\Profile;
use App\Models\User;
use Closure;

use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Illuminate\Support\Collection;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;

class UserQuery extends Query
{
    use JWTAuthorize;

    protected $attributes = [
        'name' => 'user',
        'description' => 'Get user by ID'
    ];

    public function type(): Type
    {
        return GraphQL::type('user');
    }

    public function args(): array
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::string(),
                'rules' => ['required']
            ],
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields): User
    {
        return User::findOrFail($args['id']);
    }
}
