<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Role>
 */
class RoleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => 'Role',
            'admin' => false,
        ];
    }

    public function isAdmin(): static
    {
        return $this->state(fn(array $attributes) => [
            'admin' => true,
        ]);
    }

    public function isDefault(): static
    {
        return $this->state(fn(array $attributes) => [
            'default' => true,
        ]);
    }

    public function isRoot(): static
    {
        return $this->state(fn(array $attributes) => [
            'root' => true,
        ]);
    }
}
