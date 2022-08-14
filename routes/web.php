<?php

use App\Http\Controllers\Admin\SearchController;
use App\Http\Controllers\SponsersController;
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

require __DIR__.'/auth.php';


Route::resource('admin/sponsers', SponsersController::class)->middleware('auth');
Route::get('admin/search', [SearchController::class, 'index'])->middleware('auth')->name('search.index');
Route::get('admin/search/results', [SearchController::class, 'search'])->middleware('auth')->name('search.results');
Route::get('/get_cities', [SponsersController::class, 'getCities']);
