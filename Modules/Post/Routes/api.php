<?php

use Modules\Post\Http\V1\Controllers\PostController;
use Modules\Post\Http\V1\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('users', [UserController::class, 'index']);

Route::apiResource('posts', PostController::class);
