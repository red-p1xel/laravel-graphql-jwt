<?php

namespace Database\Seeders;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info('[+] Seeding dummy data for users, profiles and settings tables...');
        try {
            User::factory()
                ->has(Profile::factory()->count(1), 'profile')
                ->hasSettings(5)
                ->count(25)
                ->create();
            $this->command->info('[+] Dummy data successfully provided from factories!');
        } catch (\Exception $exception) {
            return;
        }
    }
}
