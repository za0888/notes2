<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Trusted>
 */
class TrustedFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'trusted_user' => random_int(1, 5)
        ];
    }

// just a thought
    public function userSelf(User $user)
    {
        if ($user) {
            return $this->state(fn($attributes) => ['trusted_user'=>$user->id]);
        }
    }

}
