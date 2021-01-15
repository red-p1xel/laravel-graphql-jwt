<?php

declare(strict_types=1);

namespace App\GraphQL\Mutations\Profile;

use App\GraphQL\JWTAuthorize;
use App\Models\Profile;
use Closure;

use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;

class UpdateProfileMutation extends Mutation
{
    use JWTAuthorize;

    protected $attributes = [
        'name' => 'UpdateProfile',
        'description' => 'A mutation'
    ];

    public function type(): Type
    {
        return GraphQL::type('profile');
    }

    public function args(): array
    {
        return [
            'profilePicture' => [
                'name' => 'profilePicture',
                'type' => GraphQL::type('upload'),
                'rules' => ['required'],
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
        $profile = Profile::where('user_id',$this->auth['id'])->first();
        unlink($profile->filePath);
        $file = $args['profilePicture'][0];
        $imageName = $profile->user_id.'-'.$file->getClientOriginalName();
        $filePath = $file->move(public_path('images'), $imageName);
        $profile->filename = $imageName;
        $profile->filePath = $filePath;
        $profile->save();

        return $profile;
    }
}
