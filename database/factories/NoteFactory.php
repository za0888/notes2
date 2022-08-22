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
        $user = \Auth::user();
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


    /**
     * @return NoteFactory
     */
    public function html_blocks()
    {
        $html_code = '   $numberOfUsers = User::all()->count();
        if (!$numberOfUsers) {
            throw  new \Exception("NO USERS FOUND");
        }

        if (count($themes) > $numberOfUsers) {
            throw new \Exception("NUMBER OF THEMES HAS TO BE MORE OR EQUAL TO NUMBER OF USERS...Nick");
        }';

        return $this->state(
            fn()=> [
                'html_block' => [
                    [
                        'block_header' => fake()->text,

                        'block_code_html' => $html_code,

                        'block_footer' => fake()->text
                    ],
                ],
            ]
        );
    }

}
//'title',
//        'content',
//        'blocks',
//        'links',
