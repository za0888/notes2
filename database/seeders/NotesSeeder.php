<?php

namespace Database\Seeders;

use App\Models\Note;
use App\Models\SubCategory;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NotesSeeder extends Seeder
{
//php artisan db:seed --class=NotesSeeder
    /**
     * Run the database seeds.
     *
     * @return void
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

                $subCategory = SubCategory::find($subCategory->id);
//                dd($subCategory);

                $notes = Note::factory()
                    ->count(random_int(1, 5))
                    ->for($subCategory)
                    ->for($user)
                    ->create();

            }
            \Auth::logout($user);
        }
    }
}
