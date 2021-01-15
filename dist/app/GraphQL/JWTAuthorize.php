<?php


namespace App\GraphQL;

use Closure;
use Exception;
use GraphQL\Type\Definition\ResolveInfo;
use Tymon\JWTAuth\Facades\JWTAuth;

trait JWTAuthorize
{
    protected $auth;

    /**
     * @param mixed $root
     * @param array $args
     * @param mixed $ctx
     * @param ResolveInfo|null $resolveInfo
     * @param Closure|null $getSelectFields
     * @return bool
     */
    public function authorize($root, array $args, $ctx, ResolveInfo $resolveInfo = null, Closure $getSelectFields = null): bool {
        try {
            $this->auth = JWTAuth::parseToken()->authenticate();
        } catch(Exception $e) {
            $this->auth = null;
        }
        if (!$this->auth) {
            return false;
        }

        return true;
    }
}
