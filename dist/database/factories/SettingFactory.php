<?php

namespace Database\Factories;

use App\Models\Setting;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class SettingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Setting::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'title' => $this->faker->title,
            'description' => $this->faker->sentence(5),
            'data' => '{
                "theme_settings":[
                    { "name":"Light", "active":false },
                    { "name":"Dark", "active":true },
                    { "name":"System Default", "active":false }
                ]
            }',
        ];
    }
}
