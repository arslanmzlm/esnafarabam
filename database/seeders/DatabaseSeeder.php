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
        Role::factory()->isDefault()->create(['name' => 'User']);
        $rootRole = Role::factory()->isAdmin()->isRoot()->create(['name' => 'Root']);
        Role::factory()->isAdmin()->create(['name' => 'Admin']);

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
            'role_id' => $rootRole->id,
            'state' => UserState::ACTIVE
        ]);

        Profile::factory()->create([
            'user_id' => $user->id,
            'province_id' => $province->id,
            'district_id' => $district->id,
        ]);
    }
}
