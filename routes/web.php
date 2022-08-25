<?php

use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\NotesController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\SubCategoriesController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\ThemesController;
use App\Models\Note;
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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::resources([
    'notes'=> NotesController::class,
    'teams'=> TeamController::class,
    'themes'=> ThemesController::class,
    'categories'=> CategoriesController::class,
    'subCategories'=> SubCategoriesController::class
]);
require __DIR__.'/auth.php';
