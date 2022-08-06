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
        $users = User::all();
        $themes = [
            'Kitchen',
            'Soft',
            'Repaiment',
            'Dachia'
        ];
foreach ($users as $user){
    Theme::create([
        'name' => array_rand($themes),
        'created_bu_user'=>$user->id,
    ]);
}

        array_map(
            fn($item) => Theme::create(['name' => $item]),
            $themes
        );
    }
}
