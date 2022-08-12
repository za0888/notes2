<?php

namespace Database\Seeders;

use App\Models\Trusted;
use App\Models\User;
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
        $numberOfUsers = 5;
        $count = random_int(0, $numberOfUsers);

        User::factory()
            ->has(Trusted::factory()
                ->count(3))
            ->count(3)->create();

        User::factory()
            ->has(Trusted::factory()->count($count))
            ->count(2)
            ->isadmin()
            ->create();

        $trusteds = Trusted::all();

        foreach ($trusteds as $trusted) {
// process integrity violation  1062 PDO exception  Duplicate index
//            look migration  of trusteds (unique)
            try {
//                process link to oneself
                if ($trusted->user_id === $trusted->trusted_user) {
                    $trusted->delete();
                }
                    $trusted->save();
            } catch (\Exception $e) {
//                echo $e->getMessage();
                break;
            }

        }
        Trusted::onlyTrashed()->forceDelete();
    }

}
