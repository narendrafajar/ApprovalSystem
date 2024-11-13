<?php

namespace Database\Factories;

use App\Models\Expenses;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ApprovalStagesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'approver_id' => 3
        ];
    }
}
