<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
   public function definition(): array
{
    return [
        'title'       => $this->faker->sentence(4),
        'description' => $this->faker->paragraph(),
        'status'      => $this->faker->randomElement(['todo', 'in_progress', 'done']),
        'priority'    => $this->faker->randomElement(['low', 'medium', 'high']),
        'due_date'    => $this->faker->optional()->date(),
    ];
}
}
