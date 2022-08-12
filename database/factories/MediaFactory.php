<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Media>
 */
class MediaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            ['media_type'=>0]
        ];
    }

    public function video()
    {
        return $this->state(
            fn(array $attributes)=>['media_type'=>1]
        );
    }
}
