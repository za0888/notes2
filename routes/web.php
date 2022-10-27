<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\NotesController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\SubCategoriesController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\ThemesController;
use App\Models\Note;
use App\Models\Team;
use App\Models\Theme;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function () {
    $teams = Team::whereNotNull('about')->get();
    return view('welcome', compact('teams'));
})->name('home');

Route::get('/main', function () {
    return view('layouts.main');
});


Route::get('/dashboard', function () {

    $team = Team::findOrNew(Auth::user()?->team_id);
    $themes = Theme::where('team_id', $team->id)->get();

    return view('dashboard', compact('team','themes'));


})->middleware(['auth'])->name('dashboard');

Route::resources([
    'notes' => NotesController::class,
    'media' => MediaController::class,
    'teams' => TeamController::class,
    'themes' => ThemesController::class,
    'categories' => CategoriesController::class,
    'subCategories' => SubCategoriesController::class
]);

Route::get('user', [RegisteredUserController::class, 'index']);
Route::get('user/{id}', [RegisteredUserController::class, 'show']);
Route::get('user/{id}/edit', [RegisteredUserController::class, 'edit']);
Route::put('user/{id}', [RegisteredUserController::class, 'update']);
Route::delete('user/{id}', [RegisteredUserController::class, 'delete']);

require __DIR__ . '/auth.php';
