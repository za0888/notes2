<?php

namespace Database\Seeders;

use App\Models\Team;
use App\Models\User;
use App\Policies\Permissions;
use Doctrine\DBAL\Query\QueryException;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
//    we have 5 users (user seeder
//php artisan db:seed --class=UserSeeder
    public function run()
    {
//        create 3 Domains :['Single','China','Hokkaido']


        $teams = Team::all();
        foreach ($teams as $team) {
            $team = Team::find($team->id);
            User::factory()
                ->for($team)
                ->permission(Permissions::IS_ADMIN)
                ->create();

            User::factory()
                ->for($team)
                ->permission(Permissions::CAN_VIEW)
                ->create();

            User::factory()
                ->count(2)
                ->for($team)
                ->permission(Permissions::CAN_VIEW |
                    Permissions::CAN_CREATE |
                    Permissions::CAN_UPDATE |
                    Permissions::CAN_DELETE)

                ->create();
        }

//      Domain  King
        $team = Team::create(['name' => 'King']);
        User::factory()
            ->for($team)
            ->permission(Permissions::IS_SUPER_ADMIN)
            ->create();
    }


}
//php artisan db:seed --class=UserSeeder
