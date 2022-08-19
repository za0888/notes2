<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Note>
 */
class NoteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $user=\Auth::user();
        return [
            'title' => fake()->word(3),
            'content' => fake()->text(),
            'links' => [
                [
                    'description' => fake()->realText(),
                    'link' => fake()->url()
                ],
                [
                    'description' => fake()->realText(),
                    'link' => fake()->url()
                ],
                [
                    'description' => fake()->realText(),
                    'link' => fake()->url()
                ],
            ],
        ];
    }
}
//'title',
//        'content',
//        'blocks',
//        'links',
