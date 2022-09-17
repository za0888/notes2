<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
//use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class DataBaseTest extends TestCase
{
//use RefreshDatabase;

// command below  does the same as migrate fresh
use DatabaseMigrations;
//    GlobalScope things models
//    public function test_user_can_handle_only_team_resources()
//    {
//    }

    public function test_number_of_records_after_seed()
    {
//        $this->refreshDatabase();

        $this->seed();

        $this->assertDatabaseCount('teams', 4);
        $this->assertDatabaseCount('themes', 5);
        $this->assertDatabaseCount('categories', 13);
        $this->assertDatabaseCount('sub_categories', 36);
    }
}
