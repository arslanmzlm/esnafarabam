<?php

namespace Database\Seeders;

use App\Enums\UserState;
use App\Models\Profile;
use App\Models\Province;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $adminRole = Role::factory()->isAdmin()->create(['name' => 'Admin']);
        Role::factory()->create(['name' => 'User']);

        $province = Province::create([
            'name' => 'Test Province',
            'code' => 1,
            'title' => 'Test Province',
            'slug' => 'test-province'
        ]);

        $district = $province->districts()->create([
            'name' => 'Test District',
            'title' => 'Test District',
            'slug' => 'test-district',
        ]);

        $district->neighborhoods()->create([
            'name' => 'Test Neighborhood',
            'title' => 'Test Neighborhood',
            'slug' => 'test-neighborhood',
        ]);

        $user = User::factory()->create([
            'username' => 'admin',
            'email' => 'admin@mail.com',
            'role_id' => $adminRole->id,
            'state' => UserState::ACTIVE
        ]);

        Profile::factory()->create([
            'user_id' => $user->id,
            'province_id' => $province->id,
            'district_id' => $district->id,
        ]);
    }
}
