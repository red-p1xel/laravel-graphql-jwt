<?php

declare(strict_types=1);

namespace App\GraphQL\Queries\Profile;

use App\GraphQL\JWTAuthorize;
use App\Models\Profile;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Illuminate\Support\Collection;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;

class ProfilesQuery extends Query
{
    use JWTAuthorize;

    protected $attributes = [
        'name' => 'profiles',
        'description' => 'A query'
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('profile'));
    }

    public function args(): array
    {
        return [

        ];
    }

    /**
     * @param mixed $root
     * @param mixed $args
     * @param mixed $context
     * @param ResolveInfo $resolveInfo
     * @param Closure $getSelectFields
     */
    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields): Collection
    {
        $fields = $getSelectFields();
        $with = $fields->getRelations();
        $profiles = Profile::with($with);

        return $profiles->get();
    }
}
