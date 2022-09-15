<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Team;
use App\Models\User;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Database\Seeders\DatabaseSeeder;
use Database\Seeders\CategorySeeder;
use Database\Seeders\NoteSeeder;
use Database\Seeders\TeamSeeder;

class PolicyTest extends TestCase
{
    use RefreshDatabase;


    public function test_resources_protected_to_guests()
    {
        $this->seed([
                TeamSeeder::class,
                UserSeeder::class,
                NoteSeeder::class
            ]

        );
//
        $response = $this->get('categories');
        $response->assertStatus(403);
//
        $response = $this->post('categories');
        $response->assertStatus(403);
//
        $response = $this->get('categories/1');
//
        $response->assertStatus(403);
//
//        $response = $this->put('categories/2');
//        $response->assertStatus(403);
//
//        $response = $this->delete('categories/1');
//        $response->assertStatus(403);
//
//        $response = $this->get('categories/1/edit');
//        $response->assertStatus(403);

    }
}
