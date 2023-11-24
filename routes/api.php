<?php

use App\Http\Controllers\API\CustomUserController;
use App\Http\Controllers\API\DepartmentController;
use App\Http\Controllers\API\PositionController;
use App\Http\Controllers\CustomUsersController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::apiResource('customUsers', CustomUsersController::class)->except(['destroy']);
Route::delete('/customUsers/{customUser}', [CustomUsersController::class, 'destroy'])->name('customUsers.destroy');
Route::put('/customUsers/{customUser}/restore', [CustomUsersController::class, 'restore'])->name('customUsers.restore');
Route::patch('/customUsers/{customUser}/updateField', [CustomUsersController::class, 'updateField'])->name('customUsers.updateField');


Route::resource('departments', DepartmentController::class);
Route::resource('positions', PositionController::class);
Route::resource('customUser', CustomUserController::class);
