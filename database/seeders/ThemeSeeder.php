<?php

namespace Database\Seeders;

use App\Models\Theme;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ThemeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $themes = [

            'Soft' => [
                'laravel' => ['test', 'eloquent', 'how to'],
                'js' => ['array', 'functions', 'DOM'],
                'php' => ['array', 'functions',]
            ],

            'House' => [
                'electrica' => [''],
                'pets' => ['food', 'useful inf'],
                'kitchen' => ['recepies', 'gadgets']
            ],

            'Dachia' => [
                'plants' => [
                    'apple',
                    'grape',
                    'chery'
                ],
                'house' => ['maintenance'],
            ],

            'hobby' => [
                'languages' => [

                ],
                'maintenance' => [
                    'electronic',
                    'paperwals'
                ]
            ],

            'articles' => [
                'usa',
                'europe',
                'war',
                'arts',
                'people',
                'science'
            ]
        ];

//        We have 5 user
//        a user - one domain(themes,categories, subcategories)
//        user can have trusted users(see trusted model)
        $users = User::all();
        if ($users->count() === 5) {
            $user_1 = $users->find(1);
            $user_2 = $users->find(2);
            $user_3 = $users->find(3);
            $user_4 = $users->find(4);
            $user_5 = $users->find(5);
        } else {
            throw new \Exception('TOO FEW USERS');
        }
//first user
        \Auth::login($user_1);

        \Auth::logout($user_1);

//

    }
}
