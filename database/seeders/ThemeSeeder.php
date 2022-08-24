<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Team;
use App\Models\Theme;
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
        // Themes with categories and SubCategories
        $themes = [

            'SOFT' => [
                'laravel' => ['test', 'eloquent', 'howto'],
                'js' => ['array', 'functions', 'DOM'],
                'php' => ['array', 'functions',]
            ],

            'HOUSE' => [
                'electrica' => ['switch', 'tools', 'lights'],

                'pets' => ['food', 'useful inf'],

                'kitchen' => ['recepies', 'gadgets']
            ],

            'DACHIA' => [
                'plants' => [
                    'apple',
                    'grape',
                    'chery'
                ],

                'house' => ['maintenance'],
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
        ];
        $teams = Team::all();
        $numberOfTeams = $teams->count();

        if (!$numberOfTeams) {
            throw  new \Exception("NO DOMAINS FOUND");
        }

        if (count($themes) < $numberOfTeams) {
            throw new \Exception("NUMBER OF THEMES HAS TO BE MORE OR EQUAL TO NUMBER OF Teams...Nick");
        }

        $currentTeam = 0;

        foreach ($teams as $team) {

            $team = Team::find($team->id);
            $currentTeam += 1;

            if ($currentTeam > 5) {
                break;
            }


            $themeName = array_keys($themes)[$currentTeam - 1];//SOFT, House, Dachia,...
// add array of cats to the theme
            $categoriesOfTheTheme = $this->catsForTheme($team, $themeName, array_keys($themes[$themeName]));


            //add array of subcats to the cat
            foreach ($categoriesOfTheTheme as $category) {

                $this->subCatsForCat($team, $category, $themes[$themeName][$category->name]);
            }

        }
    }

    //   create a theme and then add cats for the theme ; return $categories of the theme
    public function catsForTheme(Team $team, string $themeName, array $catNames): \Illuminate\Database\Eloquent\Collection
    {
        $theme = Theme::firstOrCreate(['name' => $themeName]);
//        dd($theme);
        $createManyArr = array();
        foreach ($catNames as $catName) {
            $createManyArr[] = ['name' => $catName];
        }
        $categories = $theme->categories()
            ->createMany($createManyArr);

        return $categories;
    }

//    take a category and adds subCategories from arr $catSubCats
    public function subCatsForCat(Team $team, Category $category, array $catSubCats): void
    {
        foreach ($catSubCats as $subCatName) {
            $createManyArr[] = ['name' => $subCatName];
        }
        $category->subCategories()->createMany($createManyArr);
    }


}
