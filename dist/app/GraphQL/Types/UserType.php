<?php

declare(strict_types=1);

namespace App\GraphQL\Types;

use App\GraphQL\Fields\FormattableDate;
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
                'type' => Type::nonNull(Type::string()),
                'description' => 'Uuid of the user',
            ],
            'email' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The email of user',
            ],
            'name' => [
                'type' => Type::string(),
                'description' => 'The name of the user'
            ],
            'profile' => [
                'type' => GraphQL::type('profile'),
                'description' => 'User profile',
            ],
            'settings' => [
                'type' => Type::listOf(GraphQL::type('setting')),
                'description' => 'List of user settings',
                'alias' => 'settings'
            ],
            'updatedAt' => new FormattableDate([
                'alias' => 'updated_at',
            ])
        ];
    }

    /**
     * @param mixed $root
     * @param array $args
     * @return string
     */
    protected function resolveEmailField($root, array $args): string
    {
        return strtolower($root->email);
    }
}
