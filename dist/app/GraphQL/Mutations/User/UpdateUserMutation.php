<?php

declare(strict_types=1);

namespace App\GraphQL\Mutations\User;

use App\GraphQL\JWTAuthorize;
use App\Models\User;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;

class UpdateUserMutation extends Mutation
{
    use JWTAuthorize;

    protected $attributes = [
        'name' => 'updateUser',
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
                'type' => Type::nonNull(Type::string()),
            ],
            'name' => [
                'name' => 'name',
                'type' => Type::string(),
            ],
            'email' => [
                'name' => 'email',
                'type' => Type::string(),
                'rules' => ['email']
            ],
            'password' => [
                'name' => 'password',
                'type' => Type::string(),
            ],
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        $user = User::findOrFail($args['id']);
        if(isset($args['name'])) {
            $user->name = $args['name'];
        }
        if(isset($args['email'])) {
            $user->email = $args['email'];
        }
        if(isset($args['password'])) {
            $user->password = bcrypt($args['password']);
        }
        $user->save();

        return $user;
    }
}
