<?php

use App\Http\Controllers\PatientController;
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
    return view('app.patients.index');
});

Route::prefix('patients')
    ->controller(PatientController::class)
    ->group(function () {
        Route::get('/', 'index')->name('patients.index');
        Route::get('/search', 'search')->name('patients.search');
        Route::get('/pagination/{length?}', 'paginate')->name('patients.paginate');
        Route::get('/get-patient', 'getPatient')->name('patients.getPatient');
        Route::get('/register', 'create')->name('patients.create');
        Route::post('/register', 'store')->name('patients.store');
        Route::get('/visualize/{id}', 'show')->name('patients.show');
        Route::get('/edit/{id}', 'edit')->name('patients.edit');
        Route::put('/update/{id}', 'update')->name('patients.update');
        Route::delete('/destroy/{id}', 'destroy')->name('patients.destroy');
});

Route::prefix('receptions')
    ->controller(ReceptionController::class)
    ->group(function () {
        Route::get('/', 'index')->name('receptions.index');
        Route::get('/search', 'search')->name('receptions.search');
        Route::get('/get-patient', 'getPatient')->name('receptions.getPatient');
        Route::get('/pagination/{length?}', 'paginate')->name('receptions.paginate');
        Route::get('/register', 'create')->name('receptions.create');
        Route::post('/register', 'store')->name('receptions.store');
        Route::get('/visualize/{id}', 'show')->name('receptions.show');
        Route::get('/edit/{id}', 'edit')->name('receptions.edit');
        Route::put('/update/{id}', 'update')->name('receptions.update');
});
