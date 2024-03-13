<?php

use App\Http\Controllers\ExampleController;
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


Route::group(['as' => 'example.', 'prefix' => 'example'], function () {
    Route::get('/', [ExampleController::class, 'index'])->name('index');
    Route::post('/step1', [ExampleController::class, 'step1'])->name('step1');
    Route::post('/step2', [ExampleController::class, 'step2'])->name('step2');
    Route::post('/step3', [ExampleController::class, 'step3'])->name('step3');
    Route::post('/step4', [ExampleController::class, 'step4'])->name('step4');
});
