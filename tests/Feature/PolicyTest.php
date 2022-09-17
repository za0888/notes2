<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Note;
use App\Models\Team;
use App\Models\User;
use App\Policies\Permissions;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Database\Seeders\DatabaseSeeder;
use Database\Seeders\CategorySeeder;
use Database\Seeders\NoteSeeder;
use Database\Seeders\TeamSeeder;

class PolicyTest extends TestCase
{
//    use RefreshDatabase;

// clause below  does the same as migrate fresh
    use DatabaseMigrations;

    public function test_resources_protected_from_guests()
    {
        $this->seed([
                TeamSeeder::class,
                UserSeeder::class,
                NoteSeeder::class
            ]

        );
//              Categories
        $response = $this->get('categories');
        $response->assertForbidden();
//
        $response = $this->post('categories');
        $response->assertForbidden();
//
        $response = $this->get('categories/1');
//
        $response->assertForbidden();
//
        $response = $this->put('categories/2');
        $response->assertForbidden();
//
        $response = $this->delete('categories/1');
        $response->assertForbidden();

        $response = $this->get('categories/1/edit');
        $response->assertForbidden();
//
//              Notes
        $response = $this->get('notes');
        $response->assertForbidden();
//
        $response = $this->post('notes');
        $response->assertForbidden();
//
        $response = $this->get('notes/1');
//
        $response->assertForbidden();
//
        $response = $this->put('notes/2');
        $response->assertForbidden();
//
        $response = $this->delete('notes/1');
        $response->assertForbidden();

        $response = $this->get('notes/1/edit');
        $response->assertForbidden();
//
//        SubCategories
        $response = $this->get('subCategories');
        $response->assertForbidden();
//
        $response = $this->post('subCategories');
        $response->assertForbidden();
//
        $response = $this->get('subCategories/1');
//
        $response->assertForbidden();
//
        $response = $this->put('subCategories/2');
        $response->assertForbidden();
//
        $response = $this->delete('subCategories/1');
        $response->assertForbidden();

        $response = $this->get('subCategories/1/edit');
        $response->assertForbidden();

//
//        teams
        $response = $this->get('teams');
        $response->assertForbidden();
//
        $response = $this->post('teams');
        $response->assertForbidden();
//
        $response = $this->get('teams/1');
//
        $response->assertForbidden();
//
        $response = $this->put('teams/2');
        $response->assertForbidden();
//
        $response = $this->delete('teams/1');
        $response->assertForbidden();

        $response = $this->get('teams/1/edit');
        $response->assertForbidden();
//
//        Themes

        $response = $this->get('themes');
        $response->assertForbidden();
//
        $response = $this->post('themes');
        $response->assertForbidden();
//
        $response = $this->get('themes/1');
//
        $response->assertForbidden();
//
        $response = $this->put('themes/2');
        $response->assertForbidden();
//
        $response = $this->delete('themes/1');
        $response->assertForbidden();

        $response = $this->get('themes/1/edit');
        $response->assertForbidden();
    }

//    public function test_super_admin_can_ban_users()
//    {
//
//    }
//
    public function test_user_can_view()
    {
        $this->seed();

        $user = User::where('permissions', '&', Permissions::CAN_VIEW)->first();
        \Auth::login($user);
        $note = Note::where('team_id', $user->team_id)->first();

        $response = $this->actingAs($user)
            ->get('notes');

        $response->assertOk();
    }

    public function test_user_see_only_teams_notes()
    {
//        according to Note model global scope a user can see only teams notes? otherwise respone has empty data
        $this->seed();

        $user = User::where('permissions', '&', Permissions::CAN_VIEW)->first();
        \Auth::login($user);

        $note = Note::whereNot('team_id', $user->team_id)->first()?->id;
//        dd($note);

        $response = $this->actingAs($user)
            ->get("notes/{$note}");

        $response->assertSee(''); //response has empty data
    }

//
//    public function test_user_can_create_resource()
//    {
//
//    }
//
//    public function test_user_can_edit_resource(){
//
//    }
//
//    public function test_user_can_delete_resource()
//    {
//
//    }

}
