<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ExpertiseController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ReferenceController;
use App\Http\Controllers\SkillController;
use Illuminate\Http\Request;
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

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('skills', SkillController::class)->only('index');
Route::resource('expertises', ExpertiseController::class)->only('index');
Route::resource('references', ReferenceController::class)->only('index');
Route::resource('posts', PostController::class)->only('index');
