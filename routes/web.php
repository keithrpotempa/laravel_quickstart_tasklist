<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

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
require __DIR__.'/auth.php';

Route::middleware(['auth'])->group(function () {
    Route::get('/', [TaskController::class, 'index']);
    Route::get('/tasks', [TaskController::class, 'index'])->name('tasks');
    Route::post('/task', [TaskController::class, 'store']);
    Route::delete('/task/{id}', [TaskController::class, 'destroy']);
});
