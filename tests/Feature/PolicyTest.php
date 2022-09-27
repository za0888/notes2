<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Note;
use App\Models\SubCategory;
use App\Models\Team;
use App\Models\User;
use App\Policies\Permissions;
use Database\Seeders\UserSeeder;
use Illuminate\Auth\Access\Response;
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

//        users
        //              users
        $response = $this->get('user');
        $response->assertForbidden();
//
//        $response = $this->post('user');
//        $response->assertForbidden();
//
        $response = $this->get('user/1');
        $response->assertForbidden();
//
        $response = $this->get('user/1/edit');
        $response->assertForbidden();
//        $response->dumpHeaders();
////////
        $response = $this->put('user/1');
        $response->assertForbidden();
////
        $response = $this->delete('user/1');
        $response->assertForbidden();

//        Media

        $response = $this->get('media');
        $response->assertForbidden();
//
        $response = $this->post('media');
        $response->assertForbidden();
//
        $response = $this->get('media/1');
//
        $response->assertForbidden();
//
        $response = $this->put('media/2');
        $response->assertForbidden();
//
        $response = $this->delete('media/1');
        $response->assertForbidden();

        $response = $this->get('media/1/edit');
        $response->assertForbidden();
    }


    public function test_user_can_view_note()
    {
        $this->seed();

        $user = User::where('permissions', '&', Permissions::CAN_VIEW)
            ->where(
                fn($query) => $query->whereNot('permissions', Permissions::IS_ADMIN)
            )
            ->first();

        $note = Note::where('user_id', $user->id)->first();
//        dd('user------', $user, 'note-------', $note);
        $response = $this->actingAs($user)
            ->get('notes');
        $response->assertOk();

        $response = $this->actingAs($user)
            ->get("notes/{$note->id}");
//        dd('note_id---',$note->id,$user);
        $response->assertOk();

    }

    public function test_notes_global_scope_works()
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
//        $response->assertNotFound()
    }

//
    public function test_user_can_create_note()
    {
        $this->seed();
//
        $user = User::where('permissions', '&', Permissions::CAN_CREATE)
            ->where(fn($query) => $query->whereNot('permissions', Permissions::IS_ADMIN))
            ->first();
        $team = Team::find($user->team_id);
//        dd($user,'team_id====',$team->id);
        $subCategory = SubCategory::where('team_id', $team->id)->first();

        $note = Note::factory()
            ->subCategory($subCategory)
            ->for($team)
            ->for($user)
            ->create();
//        dd($user,$note);
        $this->assertDatabaseHas(
            'notes',
            ['title' => $note->title]
        );
//dd($user);
        $response = $this->actingAs($user)->post('notes', $note->toArray());
//        $response->dumpHeaders();
        $response->assertOk();
    }

    public function test_user_can_not_create_note()
    {
        $this->seed();

        $user = User::whereNot('permissions', '&', Permissions::CAN_CREATE)->first();
        \Auth::login($user);

        $team = Team::where('id', $user->team_id)->first();
        $subCategory = SubCategory::where('team_id', $team->id)->first();

        $note = new Note([
            'title' => 'tiiiiiiiitle',
            'body' => 'Booooooooooooooooooody'
        ]);

        $note->user()->associate($user);
        $note->subCategory()->associate($subCategory);

        $response = $this->actingAs($user)->post('notes', $note->toArray());
//        $response->assertForbidden();
        $response->assertNotFound();
//   if use following code in NotePolicy -create method     return $canCreate
//            ? Response::allow()
//            : Response::denyAsNotFound('You cannot cretae a Note.');

    }

    public function test_method_before_note_policy_works()
    {
        $this->seed();
        $user = User::factory()
            ->name('diego')
            ->permission(Permissions::IS_SUPER_ADMIN)
            ->create();

        $team = Team::first();
        $user_other = User::where('team_id', $team->id)->first();

        $subCategory = SubCategory::where('team_id', $team->id)->first();

        $note = new Note([
            'title' => 'tiiiiiiiitle',
            'body' => 'Booooooooooooooooooody'
        ]);

        $note->user()->associate($user_other);
        $note->subCategory()->associate($subCategory);


        $response = $this->actingAs($user)->post('notes', $note->toArray());
        $response->assertOk();

    }

    public function test_alien_admin_can_not_work_with_notes()
    {
        $this->seed();

        $note = Note::first();
        $team = Team::find($note->team_id);

        $alienTeam = Team::whereNot('id', $team->id)->first();
        $alienAdminUser = User::factory()
            ->permission(Permissions::IS_ADMIN)
            ->name('Diego Padri')
            ->for($alienTeam)
            ->create();

//        dd($alienAdminUser, $alienTeam,$team,$note);

        $response = $this->actingAs($alienAdminUser)->get("notes/{$note->id}");
        $response->assertNotFound();

    }

//
    public function test_user_can_edit_oneself()
    {
        $user = User::factory()
            ->name("Diego Padri")
            ->permission(Permissions::CAN_UPDATE)
            ->create();

        $response=$this->actingAs($user)
            ->get("user/{$user->id}/edit");

        $response->assertOk();
    }

    public function test_super_admin_can_edit_user()
    {
        $userSuperAdmin = User::factory()
            ->name("m-r Super ADMIN")
            ->permission(Permissions::IS_SUPER_ADMIN)
            ->create();

        $user = User::factory()
            ->name("Diego Padri")
            ->permission(Permissions::CAN_VIEW)
            ->create();

        $response=$this->actingAs($userSuperAdmin)
            ->get("user/{$user->id}/edit");

        $response->assertOk();
    }


}
