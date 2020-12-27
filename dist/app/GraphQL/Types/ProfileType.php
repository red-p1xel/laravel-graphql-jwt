<?php

declare(strict_types=1);

namespace App\GraphQL\Types;

use App\Models\Profile;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Type as GraphQLType;

class ProfileType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Profile',
        'description' => 'A user profile type',
        'model' => Profile::class,
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'Id of a particular Profile',
            ],
            'filename' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Profile picture filename'
            ],
            'filepath' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Profile picture filepath'
            ],
            'user' => [
                'type' => GraphQL::type('user'),
                'description' => 'The user_id of reference',
            ]
        ];
    }
}
