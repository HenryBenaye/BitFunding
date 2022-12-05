<?php

use App\Http\Controllers\DepositController;
use App\Http\Controllers\ProjectController;
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

Route::middleware(['auth', 'verified'])->group(function() {
    Route::get('/dashboard', [ProjectController::class, 'index'])
        ->name('dashboard');
    Route::resource('projects', ProjectController::class);
    Route::get('project/{project_id}', [ProjectController::class, 'showProject'])
        ->name('project.show');
    Route::get('deposit/{project_id}', [DepositController::class, 'deposit'])
        ->name('deposit');
    Route::post('deposit')
            ->name('deposit.store');
});
require __DIR__.'/auth.php';
