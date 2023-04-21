<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'firstname' => fake()->firstName(),
            'lastname' => fake()->lastName(),
            'title' => fake()->jobTitle(),
            'personal_email' => fake()->email(),
            'work_email' => fake()->companyEmail(),
            'ssn' => fake()->regexify('[0-9]{3}[-]{1}[0-9]{2}[-]{1}[0-9]{4}'),
            'schedule_start' => fake()->time(),
            'schedule_end' => fake()->time(),
            'salary' => fake()->numberBetween($min = 28000, $max=1000000),
            'hire_date' => fake()->date(),
            'termination_date' => fake()->optional($weight = 0.2)->date(),
            'termination_reason' => null
        ];
    }
}
