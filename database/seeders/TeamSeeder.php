<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Team;
use App\Models\Theme;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use function PHPUnit\Framework\isEmpty;

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
                'BEAUTY' => [
                    'cosmetics' => ['paint', 'adour', 'makeup'],
                    'pets' => ['food', 'useful inf'],
                    'kitchen' => ['recepies', 'gadgets']
                ],
            ],
        ];
        foreach ($teams as $teamName => $themes) {
//            Create the TEAM
            $team = Team::create([
                'name' => $teamName,
                'about' => fake()->text
            ]);
            foreach ($themes as $themeName => $categories) {
//                create THEME
                try {
                    $theme = $team->themes()->create([
                        'name' => $themeName,
                    ]);
                } catch (\Exception $e) {
                    echo  $e->getMessage();
                }
//CATEGORY PROCESSING
                foreach ($categories as $categoryName => $subCategories) {

                    try {
                        $category = new Category(['name' => $categoryName]);
//                        hook category on the team & on the theme
                        $team->categories()->save($category);
                        $theme->categories()->save($category);

                    } catch (\Exception $e) {
                        echo $e->getMessage();
                    }

//                    SubCAtegory processing
                    foreach ($subCategories as $subCategory) {
//                        create SubCategory
                        try {
                            $subCategory = new SubCategory(['name' => $subCategory]);

                            //   hook subCategory on the category & on the team
                            $team->subCategories()->save($subCategory);
                            $category->subCategories()->save($subCategory);
                        } catch (\Exception $e) {
                            echo $e->getMessage();
                        }
                    }
                }
            }
        }
    }
}
