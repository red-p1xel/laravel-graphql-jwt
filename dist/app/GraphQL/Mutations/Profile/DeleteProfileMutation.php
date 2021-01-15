<?php /** @noinspection PhpUnusedParameterInspection */
/** @noinspection PhpUnusedParameterInspection */
/** @noinspection PhpUnusedParameterInspection */
/** @noinspection PhpUnusedParameterInspection */

declare(strict_types=1);

namespace App\GraphQL\Mutations\Profile;

use App\GraphQL\JWTAuthorize;
use App\Models\Profile;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;

class DeleteProfileMutation extends Mutation
{
    use JWTAuthorize;

    /**
     * @var string[]
     */
    protected $attributes = [
        'name' => 'deleteProfile',
    ];

    /**
     * @return Type
     */
    public function type(): Type
    {
        return Type::boolean();
    }

    /**
     * @return array[]
     */
    public function args(): array
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::string(),
                'rules' => ['required']
            ]
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields): bool
    {
        $profile = Profile::findOrFail($args['id']);
        if (isset($profile->filePath)) {
            unlink($profile->filePath);
        }

        return $profile->delete() ? true : false;
    }
}
