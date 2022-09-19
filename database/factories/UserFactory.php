<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Policies\Permissions;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

//        $confidants=Arr::random($users,random_int(1,2));
//        $confidants=json_encode($confidants);

        return [
            'name' => fake()->name(),
            'email' => fake()->safeEmail(),
            'email_verified_at' => now(),
//            'password' => 'password',
            'password' => Hash::make('password'),
//            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }

    public function permission($permission=null)
    {
        if (!$permission) {
            Throw new \Exception('NO PERMISSION !');
        }
        return $this->state(
            fn(array $attributes)=>['permissions'=>$permission]
        );
    }

    public function name($name='forgot to NAME dear User')
    {
        return $this->state(
            fn(array $attributes) =>['name'=>$name]
        );
    }
}
