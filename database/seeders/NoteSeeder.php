<?php

namespace Database\Seeders;

use App\Models\Note;
use App\Models\SubCategory;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws \Exception
     */
    public function run()
    {
        $users = User::all();

        if (!$users) {
            throw  new \Exception("NO User found");
        }

        foreach ($users as $user) {
            \Auth::login($user);

            $subCategories = SubCategory::where('created_by_user', $user->id)->get();
//            dd($subCategories);
            if (!$subCategories) {
                throw  new \Exception("No SUBCATEGORIES");
            }

            foreach ($subCategories as $subCategory) {

//we have $categories as a collection but need a $category as a model so:
                $subCategory = SubCategory::findOrFail($subCategory->id);

                $notes = Note::factory()
                    ->count(random_int(1, 5))
                    ->for($subCategory)
                    ->for($user)
                    ->create();
                $notes = Note::factory()
                    ->html_blocks()
                    ->count(random_int(1, 2))
                    ->for($subCategory)
                    ->for($user)
                    ->create();
            }
            \Auth::logout($user);
        }
    }
}
//php artisan db:seed --class=NoteSeeder
