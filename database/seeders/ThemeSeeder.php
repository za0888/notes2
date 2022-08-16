<?php

namespace Database\Seeders;

use App\Models\Category;
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
                    'spanis',
                    'english',
                    'german',
                    'franch'
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
//        1
        $user = User::findOrFail(1);
        if (!$user) {
            throw  new \Exception("The User {{$user->id}} not FOUND");
        }

        \Auth::login($user);

        $theme = Theme::firstOrCreate(['name' => 'Soft', 'created_by_user' => $user->id]);

        $categories = $theme->categories()
            ->createMany(
                [
                    ['name' => 'LARAVEL', 'created_by_user' => $user->id],
                    ['name' => 'JS', 'created_by_user' => $user->id],
                    ['name' => 'PHP', 'created_by_user' => $user->id],
                ]);

        $laravel = Category::firstOrFail('name', 'LARAVEL');
        $laravel->subCategories()->createMany(
            [
                ['name' => 'Eloquent', 'created_by_user' => $user->id],
                ['name' => 'Tests', 'created_by_user' => $user->id],
                ['name' => 'Security', 'created_by_user' => $user->id]
            ]
        );

        $js = Category::firstOrFail('name', 'JS');
        $js->subCategories()->createMany(
            [
                ['name' => 'DOM', 'created_by_user' => $user->id],
                ['name' => 'Array', 'created_by_user' => $user->id],
                ['name' => 'Functions', 'created_by_user' => $user->id]
            ]
        );

        $php = Category::firstOrFail('name', 'PHP');
        $php->subCategories()->createMany(
            [
                ['name' => 'Traits', 'created_by_user' => $user->id],
                ['name' => 'Classes', 'created_by_user' => $user->id],
                ['name' => 'Sessions', 'created_by_user' => $user->id]
            ]
        );

        \Auth::logout($user);

//        2
        $user = User::findOrFail(2);
        if (!$user) {
            throw  new \Exception("The User {{$user->id}} not FOUND");
        }

        \Auth::login($user);
        $theme = Theme::create([['name' => 'House', 'created_by_user' => $user->id]]);
        $categories = $theme->categories()
            ->createMany(
                [
                    ['name' => 'ELECTRICA', 'created_by_user' => $user->id],
                    ['name' => 'PETS', 'created_by_user' => $user->id],
                    ['name' => 'KITCHEN', 'created_by_user' => $user->id],
                ]);

        $electrica = Category::firstOrFail('ELECTRICA');
        $electrica->subCategories()->createMany([
            ['name' => 'zakon OMA', 'created_by_user' => $user->id],
            ['name' => 'circuit', 'created_by_user' => $user->id],
            ['name' => 'switch', 'created_by_user' => $user->id]
        ]);


        $pets = Category::firstOrFail('PETS');
        $pets->subCategories()->createMany([
            ['name' => 'breed', 'created_by_user' => $user->id],
            ['name' => 'names', 'created_by_user' => $user->id],
            ['name' => 'diseases', 'created_by_user' => $user->id]
        ]);


        $kitchen = Category::firstOrFail('KITCHEN');
        $kitchen->subCategories()->createMany([
            ['name' => 'food', 'created_by_user' => $user->id],
            ['name' => 'gadgets', 'created_by_user' => $user->id],
            ['name' => 'tools', 'created_by_user' => $user->id]
        ]);

        \Auth::logout($user);


    }
}
