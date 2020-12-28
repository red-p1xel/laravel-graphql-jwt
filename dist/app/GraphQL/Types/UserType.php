<?php

declare(strict_types=1);

namespace App\GraphQL\Types;

use App\Models\User;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Type as GraphQLType;

class UserType extends GraphQLType
{
    protected $attributes = [
        'name' => 'user',
        'description' => 'A user account',
        'model' => User::class,
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'The id of the user',
            ],
            'email' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The email of user',
            ],
            'name' => [
                'type' => Type::string(),
                'description' => 'The name of the user'
            ],
            'settings' => [
                'type' => Type::listOf(GraphQL::type('setting')),
                'description' => 'User settings',
                'alias' => 'settings'
            ],
            'updated' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Last user login date',
                'alias' => 'updated_at'
            ]
        ];
    }

    /**
     * @param $root
     * @param array $args
     * @return string
     */
    protected function resolveEmailField($root, array $args): string
    {
        return strtolower($root->email);
    }
}
