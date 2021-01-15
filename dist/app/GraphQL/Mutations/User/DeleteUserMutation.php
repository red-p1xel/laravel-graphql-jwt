<?php

declare(strict_types=1);

namespace App\GraphQL\Mutations\User;

use App\GraphQL\JWTAuthorize;
use App\Models\User;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;

class DeleteUserMutation extends Mutation
{
    use JWTAuthorize;

    protected $attributes = [
        'name' => 'deleteUser',
    ];

    public function type(): Type
    {
        return Type::boolean();
    }

    public function args(): array
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::string(),
                'rules' => ['required']
            ]
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields): bool
    {
        $user = User::findOrFail($args['id']);

        return $user->delete() ? true : false;
    }
}
