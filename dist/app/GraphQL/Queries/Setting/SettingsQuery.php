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

class SettingsQuery extends Query
{
    protected $attributes = [
        'name' => 'settings',
        'description' => 'A query'
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('setting'));
    }

    public function args():array
    {
        return [
            'limit' => [
                'name' => 'limit',
                'type' => Type::int()
            ],
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        if (isset($args['limit'])) {
            return Setting::limit($args['limit'])->get();
        }
        $fields = $getSelectFields();
        $with = $fields->getRelations();
        $books = Setting::with($with);

        return $books->get();
    }
}
