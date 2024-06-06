<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $datetime1 = Carbon::create(fake()->date());
        $datetime2 = Carbon::create(fake()->date());

        if ($datetime1->gt($datetime2)) {
            $start = $datetime2;
            $end = $datetime1;
        } else {
            $start = $datetime1;
            $end = $datetime2;
        }

        return [
            'start' => $start->format('Y-m-d'),
            'end' => $end->format('Y-m-d'),
            'name' => fake()->name(),
            'description' => fake()->sentence(),
            'color' => fake()->colorName()
        ];
    }
}
