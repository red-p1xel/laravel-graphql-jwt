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
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class CreateProfileMutation extends Mutation
{
    use JWTAuthorize;

    /**
     * @var string[]
     */
    protected $attributes = [
        'name' => 'uploadFile',
    ];

    /**
     * @return Type
     */
    public function type(): Type
    {
        return GraphQL::type('profile');
    }

    /**
     * @return array[]
     */
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
     * @param mixed $context
     * @param mixed $args
     * @param ResolveInfo $resolveInfo
     * @param Closure $getSelectFields
     * @return Profile
     */
    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields): Profile
    {
        $file = $args['profilePicture'][0];
        if(!strstr($file->getMimeType(),'image')) {
            throw new BadRequestException("You are allowed to upload only images");
        }
        $profileExists = Profile::where('user_id',$this->auth['id'])->first();
        if($profileExists) {
            throw new BadRequestException("You already have profile picture. If you want to change it please use upload mutation");
        }
        $imageName = $this->auth['id'].'-'.$file->getClientOriginalName();
        $filePath = $file->move(public_path('images'), $imageName);

        $profile = new Profile();
        $profile->filename = $imageName;
        $profile->user_id = $this->auth['id'];
        $profile->filePath = $filePath;
        $profile->save();

        return $profile;
    }
}
