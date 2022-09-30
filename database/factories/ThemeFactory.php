<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Theme>
 */
class ThemeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name'=>fake()->word(),
//            'team_id'=>1
        ];
    }

    public function team_id(int $team_id)
    {
        return $this->state(
            fn(array $attributes) =>['team_id'=>$team_id]
        );
    }
}
