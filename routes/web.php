<?php

use App\Http\Controllers\Admin\SearchController;
use App\Http\Controllers\BeneficiariesController;
use App\Http\Controllers\SponsersController;
use GuzzleHttp\Middleware;
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


Route::get('beneficiaries/create', [BeneficiariesController::class, 'create'])->name('beneficiary.create')->middleware('auth');

Route::group(['middleware' => 'auth'], function(){
    Route::resource('sponsers', SponsersController::class);
    Route::get('search', [SearchController::class, 'index'])->name('search.index');
    Route::get('search/results', [SearchController::class, 'searchSponsers'])->name('search.results');
    Route::get('/get_cities', [SponsersController::class, 'getCities']);


    Route::get('beneficiaries', [BeneficiariesController::class, 'index'])->name('beneficiary.index');
    Route::get('beneficiaries/{id}', [BeneficiariesController::class, 'show'])->name('beneficiary.show');
    Route::post('beneficiaries/store', [BeneficiariesController::class, 'store'])->name('beneficiary.store');
    Route::get('beneficiaries/{id}/edit', [BeneficiariesController::class, 'edit'])->name('beneficiary.edit');
    Route::put('beneficiaries/{id}/update', [BeneficiariesController::class, 'update'])->name('beneficiary.update');
    Route::delete('beneficiaries/{id}', [BeneficiariesController::class, 'destroy'])->name('beneficiary.destroy');
    Route::get('search/results', [SearchController::class, 'search'])->name('search.results');
});
