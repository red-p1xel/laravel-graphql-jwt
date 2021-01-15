<?php

declare(strict_types=1);

namespace App\GraphQL\Types;

use App\GraphQL\Fields\FormattableDate;
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
                'type' => Type::nonNull(Type::string()),
                'description' => 'Id of a particular Profile',
            ],
            'user' => [
                'type' => GraphQL::type('user'),
                'description' => 'The user_id of reference',
            ],
            'fileName' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Profile picture filename'
            ],
            'filePath' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Profile picture filepath'
            ],
            'createdAt' => new FormattableDate([
                'alias' => 'created_at',
            ]),
            'updatedAt' => new FormattableDate([
                'alias' => 'updated_at',
            ]),
        ];
    }
}
