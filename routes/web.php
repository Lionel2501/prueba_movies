<?php

use App\Http\Controllers\MovieController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/getMovies', [MovieController::class, 'fetchAndSaveMovies'])->name('getMovies');
Route::get('/showMovies', [MovieController::class, 'showMovies'])->name('showMovies');
Route::get('/editMovie/{id}', [MovieController::class, 'editMovie'])->name('editMovie');
Route::put('/updateMovie/{id}', [MovieController::class, 'updateMovie'])->name('updateMovie');
Route::delete('/deleteMovie/{id}', [MovieController::class, 'deleteMovie'])->name('deleteMovie');

