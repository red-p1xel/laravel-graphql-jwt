<?php

declare(strict_types=1);

namespace App\GraphQL\Queries\Setting;

use App\GraphQL\JWTAuthorize;
use App\Models\Setting;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;

class SettingQuery extends Query
{
    use JWTAuthorize;

    protected $attributes = [
        'name' => 'setting',
        'description' => 'A query'
    ];

    public function type(): Type
    {
        return GraphQL::type('setting');
    }

    public function args(): array
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::string(),
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
