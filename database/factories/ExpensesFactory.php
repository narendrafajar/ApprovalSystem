<?php

namespace Database\Factories;

use App\Models\Expenses;
use Illuminate\Database\Eloquent\Factories\Factory;

class ExpensesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Expenses::class;
    public function definition()
    {
        return [
            'amount' => $this->faker->randomFloat(2, 100, 1000),
            'status_id' => 1,
            'description' => $this->faker->sentence
        ];
    }
}
