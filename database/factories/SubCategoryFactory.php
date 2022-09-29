<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SubCategory>
 */
class SubCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name'=>fake()->words(2,true)
        ];
    }
    public function team_id(int $team_id)
    {
        return $this->state(
            fn(array $attributes) =>['team_id'=>$team_id]
        );
    }
}
