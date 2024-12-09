<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Profile>
 */
class ProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->firstName(),
            'surname' => $this->faker->lastName(),
            'company' => $this->faker->company(),
            'company_phone' => $this->faker->e164PhoneNumber(),
            'address' => $this->faker->address(),
            'tax_identity' => $this->faker->randomNumber(),
        ];
    }
}
