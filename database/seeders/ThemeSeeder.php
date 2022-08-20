<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Theme;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use phpDocumentor\Reflection\Types\Collection;

class ThemeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() //php artisan db:seed --class=ThemeSeeder
    {
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

//        We have 5 user
//        a user is a domain domain(themes,categories, subcategories)(for seeding it has to be 'a theme- a user')
//        user can have trusted users(see trusted model)
//        1
        $numberOfUsers = User::all()->count();
        if (!$numberOfUsers) {
            throw  new \Exception("NO USERS FOUND");
        }

        if (count($themes) > $numberOfUsers) {
            throw new \Exception("NUMBER OF THEMES HAS TO BE MORE OR EQUAL TO NUMBER OF USERS...Nick");
        }

        $currentUser = 0;
        $users = User::all();

        foreach ($users as $user) {
            $currentUser += 1;
            $user = User::find($user->id);

            if (!$user) {
                throw  new \Exception("The User {{$user->id}} not FOUND");
            }
            \Auth::login($user);

            $themeName = array_keys($themes)[$currentUser - 1];//SOFT, House, Dachia,...
// add array of cats to the theme

            $categoriesOfTheTheme = $this->catsForTheme($user, $themeName, array_keys($themes[$themeName]));//add array of subcats to the cat


            foreach ($categoriesOfTheTheme as $category) {
                $this->subCatsForCat($user, $category, $themes[$themeName][$category->name]);
            }
            \Auth::logout($user);
        }
//        for ($currentUser = 1; $currentUser <= 5; $currentUser++) {
//
//
//        }
    }

//   createы a theme and then add cats for the theme ; return $categories of the theme
    public function catsForTheme(User $user, string $themeName, array $catNames): \Illuminate\Database\Eloquent\Collection
    {
        $theme = Theme::firstOrCreate(['name' => $themeName, 'created_by_user' => $user->id]);
//        dd($theme);
        $createManyArr = array();
        foreach ($catNames as $catName) {
            $createManyArr[] = ['name' => $catName, 'created_by_user' => $user->id];
        }
        $categories = $theme->categories()
            ->createMany($createManyArr);

        return $categories;
    }

//    take a category and adds subCategories from arr $catSubCats
    public function subCatsForCat(User $user, Category $category, array $catSubCats): void
    {
        foreach ($catSubCats as $subCatName) {
            $createManyArr[] = ['name' => $subCatName, 'created_by_user' => $user->id];
        }
        $category->subCategories()->createMany($createManyArr);
    }
}
