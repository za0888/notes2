<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Team;
use App\Models\Theme;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $teams = [
            "Little China" => [
                'SOFT' => [
                    'laravel' => ['test', 'eloquent', 'howto'],
                    'js' => ['array', 'functions', 'DOM'],
                    'php' => ['array', 'functions',]
                ],
                'Media' => [
                    'news' => [
                        'usa',
                        'europe',
                        'war',
                        'arts',
                        'people',
                        'science'
                    ],
                    'sciense' => [
                        'astronomy',
                        'chemistry'
                    ]
                ]
            ],

            "Planet Pluk" => [
                'HOUSE' => [
                    'electrica' => ['switch', 'tools', 'lights'],

                    'pets' => ['food', 'useful inf'],

                    'kitchen' => ['recepies', 'gadgets']
                ],
                'HOBBY' => [

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
            ],

            "Red Girls" => [
                'HOUSE' => [
                    'electrica' => ['switch', 'tools', 'lights'],
                    'pets' => ['food', 'useful inf'],
                    'kitchen' => ['recepies', 'gadgets']
                ],
            ],
        ];
        foreach ($teams as $teamName => $themes) {
//            Create the TEAM
            $team = Team::create([
                'name' => $teamName,
                'title' => fake()->text
            ]);
            foreach ($themes as $themeName => $categories) {
                $theme = Theme::create([
                    'name' => $themeName,
                ]);
                foreach ($categories as $categoryName => $subCategories) {
                    $category = Category::create(['name' => $categoryName]);

                    foreach ($subCategories as $subCategory) {

                    }
                }
            }
        }
    }
}
