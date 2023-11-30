<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ExpenseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'summ' => $this->faker->randomNumber(3),
            'comment' => $this->faker->paragraph(3),
            'uuid' => $this->faker->uuid(),
        ];
    }
}
