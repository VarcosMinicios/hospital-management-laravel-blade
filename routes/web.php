<?php

use App\Http\Controllers\PeopleController;
use App\Http\Controllers\ReceptionController;
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
    return view('app.people.index');
});

Route::prefix('people')
    ->controller(PeopleController::class)
    ->group(function () {
        Route::get('/', 'index')->name('people.index');
        Route::get('/search', 'search')->name('people.search');
        Route::get('/get-patient', 'getPatient')->name('people.getPatient');
        Route::get('/register', 'create')->name('people.create');
        Route::post('/register', 'store')->name('people.store');
        Route::get('/visualize/{id}', 'show')->name('people.show');
        Route::get('/edit/{id}', 'edit')->name('people.edit');
        Route::put('/update/{id}', 'update')->name('people.update');
        Route::delete('/destroy/{id}', 'destroy')->name('people.destroy');
});

Route::prefix('reception')
    ->controller(ReceptionController::class)
    ->group(function () {
        Route::get('/', 'index')->name('reception.index');
        Route::get('/search', 'search')->name('reception.search');
        Route::get('/get-patient', 'getPatient')->name('reception.getPatient');
        Route::get('/register', 'create')->name('reception.create');
        Route::post('/register', 'store')->name('reception.store');
        Route::get('/visualize/{id}', 'show')->name('reception.show');
        Route::get('/edit/{id}', 'edit')->name('reception.edit');
        Route::put('/update/{id}', 'update')->name('reception.update');
});
