<?php

namespace Database\Seeders;

use App\Models\Domain;
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

//      Domain  King
        Domain::factory()
            ->title('King Artur')
            ->has(
                User::factory()
                    ->permission(Permissions::IS_SUPER_ADMIN)
            )->create();

//      Domain  CHINA
        Domain::factory()
            ->title('Little China')
            ->has(
                User::factory()
                    ->permission(Permissions::IS_ADMIN)
            )
            ->has(User::factory()->permission(Permissions::CAN_VIEW))
            ->has(User::factory()->permission(
                Permissions::CAN_VIEW |
                Permissions::CAN_CREATE |
                Permissions::CAN_UPDATE |
                Permissions::CAN_DELETE
            )->count(5))
            ->create();
//
//        Domain Small
        Domain::factory()
            ->title('Ukatan')
            ->has(
                User::factory()
                    ->permission(Permissions::IS_ADMIN)
            )
            ->has(User::factory()->permission(
                Permissions::CAN_VIEW
                )
            )
            ->has(User::factory()->permission(
                Permissions::CAN_VIEW |
                Permissions::CAN_CREATE |
                Permissions::CAN_UPDATE|
                Permissions::CAN_DELETE
            )
                ->count(2)
            )
            ->create();

    }


}
//php artisan db:seed --class=UserSeeder
