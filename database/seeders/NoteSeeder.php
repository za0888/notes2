<?php

namespace Database\Seeders;

use App\Models\Note;
use App\Models\SubCategory;
use App\Models\Team;
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
            $team = Team::findOrFail($user->team_id);
//            dd($team);

            $subCategories = SubCategory::where('team_id', $team->id)->get();
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
                    ->for($team)
                    ->create();
                $notes = Note::factory()
                    ->html_block()
                    ->count(random_int(1, 2))
                    ->for($subCategory)
                    ->for($user)
                    ->for($team)
                    ->create();
            }
        }
    }
}
//php artisan db:seed --class=NoteSeeder
