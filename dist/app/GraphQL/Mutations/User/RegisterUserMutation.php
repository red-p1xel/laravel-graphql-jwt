<?php

declare(strict_types=1);

namespace App\GraphQL\Mutations\User;

use App\Services\UserManagerService;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;

class RegisterUserMutation extends Mutation
{
    protected $attributes = [
        'name' => 'registerUser',
        'description' => 'Create user account'
    ];

    private $userManagerService;

    public function __construct()
    {
        $this->userManagerService = new UserManagerService();
    }

    public function type(): Type
    {
        return GraphQL::type('user');
    }

    public function args(): array
    {
        return [
            'name' => [
                'type' => Type::nonNull(Type::string()),
                'rules' => ['max:255']
            ],
            'email' => [
                'type' => Type::nonNull(Type::string()),
                'rules' => ['email']
            ],
            'password' => [
                'type' => Type::nonNull(Type::string()),
                'rules' => ['min:6']
            ],
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        return $this->userManagerService->signUp($args);
    }
}
