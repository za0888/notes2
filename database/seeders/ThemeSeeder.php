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
//        We have 5 users
        $users = User::all();
        $user_1=$users->find(1);
//        $themes = [
//            'Soft',
//            'House',
//            'Dachia'
//        ];
//
//foreach ($users as $user){
//    Theme::create([
//        'name' => array_rand($themes),
//        'created_by_user'=>$user->id,
//    ]);

//}

//        array_map(
//            fn($item) => Theme::create(['name' => $item]),
//            $themes
//        );
    }
}
