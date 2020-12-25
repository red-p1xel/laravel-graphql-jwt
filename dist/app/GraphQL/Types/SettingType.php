<?php

declare(strict_types=1);

namespace App\GraphQL\Types;

use App\Models\Setting;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;
use Rebing\GraphQL\Support\Facades\GraphQL;

class SettingType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Setting',
        'description' => 'A type'
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'Id of a particular setting'
            ],
            'title' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Setting title'
            ],
            'description' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Setting description'
            ],
            'data' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Setting JSON-DATA',
            ],
            'user' => [
                'type' => GraphQL::type('User'),
                'description' => 'user_id reference of the setting',
            ],
        ];
    }
}
