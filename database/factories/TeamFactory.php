<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Team>
 */
class TeamFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name'=>fake()->words(3,true),
            'about'=>fake()->text
        ];
    }

    public function title(string $title): TeamFactory
    {
        return $this->state(fn(array $attributes)=>['title'=>$title]);
    }
}
