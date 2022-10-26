<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'CAN_UPDATE'=>1,
            'CAN_DELETE' => 2,
            'CAN_RESTORE' => 4,
            'CAN_FORCE_DELETE' => 8,
            'CAN_CREATE' => 16,
            'CAN_VIEW' => 128,
            'IS_ADMIN' => 415,
            'IS_SUPER_ADMIN' => 447,
            'CAN_CONTROL_USER' => 256,
            'CAN_BAN_USER' => 32,
            'BANED_USER' => 0,
        ];

        foreach ($data as $name => $value) {
            Permission::create(
                [
                    'name' => $name,
                    'value' => $value]

            );
        }

    }
}


