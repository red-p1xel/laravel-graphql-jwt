<?php

declare(strict_types=1);

namespace App\GraphQL\Queries\Setting;

use App\Models\Setting;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\SelectFields;

class SettingQuery extends Query
{
    protected $attributes = [
        'name' => 'setting',
        'description' => 'A query'
    ];

    public function type(): Type
    {
        return GraphQL::type('Setting');
    }

    public function args(): array
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::int(),
                'rules' => ['required'],
            ]
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        return Setting::findOrFail($args['id']);
    }

    public function validationErrorMessages(array $args = []): array
    {
        return [
            'required' => 'Please enter an id',
        ];
    }
}
