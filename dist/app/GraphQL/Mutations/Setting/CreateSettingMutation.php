<?php /** @noinspection ALL */
/** @noinspection ALL */
/** @noinspection ALL */
/** @noinspection ALL */

declare(strict_types=1);

namespace App\GraphQL\Mutations\Setting;

use App\GraphQL\JWTAuthorize;
use App\Models\Setting;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;
use Rebing\GraphQL\Support\Facades\GraphQL;

class CreateSettingMutation extends Mutation
{
    use JWTAuthorize;

    protected $attributes = [
        'name' => 'createSetting',
        'description' => 'A mutation'
    ];

    public function type(): Type
    {
        return GraphQL::type('setting');
    }

    public function args(): array
    {
        return [
            'title' => [
                'name' => 'title',
                'type' => Type::nonNull(Type::string())
            ],
            'description' => [
                'name' => 'description',
                'type' => Type::nonNull(Type::string()),
            ],
            'data' => [
                'name' => 'data',
                'type' => Type::nonNull(Type::string()),
            ],
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields): Setting
    {
        $setting = new Setting();
        $setting->user_id = $this->auth['id'];
        $setting->fill($args);
        $setting->save();

        return $setting;
    }
}
