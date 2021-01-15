<?php /** @noinspection PhpPossiblePolymorphicInvocationInspection */

declare(strict_types=1);

namespace App\GraphQL\Queries\User;

use App\GraphQL\JWTAuthorize;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Tymon\JWTAuth\Facades\JWTAuth;

class RefreshTokenQuery extends Query
{
    use JWTAuthorize;

    protected $attributes = [
        'name' => 'refreshToken',
        'description' => 'Query for refresh access token for current authenticated user'
    ];

    public function type(): Type
    {
        return Type::listOf(Type::string());
    }

    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields): array
    {
        if (auth()->user()) {
            $refresh_token = auth()->refresh();

            return [
                'access_token' => $refresh_token,
            ];
        }

        return [
            'status' => 401,
            'error' => 'Unauthorized',
            'message' => 'Unable to refresh your token!'
        ];
    }
}
