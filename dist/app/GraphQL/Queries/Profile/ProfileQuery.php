<?php

declare(strict_types=1);

namespace App\GraphQL\Queries\Profile;

use App\GraphQL\JWTAuthorize;
use App\Models\Profile;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;

class ProfileQuery extends Query
{
    use JWTAuthorize;

    protected $attributes = [
        'name' => 'profile'
    ];

    public function type(): Type
    {
        return GraphQL::type('profile');
    }

    public function args(): array
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::string(),
                'rules' => ['required']
            ],
        ];
    }

    /**
     * @param mixed $root
     * @param mixed $args
     * @param mixed $context
     * @param ResolveInfo $resolveInfo
     * @param Closure $getSelectFields
     * @return Profile
     */
    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields): Profile
    {
        return Profile::findOrFail($args['id']);
    }
}
