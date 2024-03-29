<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\OglasController;
use App\Http\Controllers\TipVozilaOglasController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserOglasController;
use Illuminate\Http\Request;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login'])->name("login");

Route::group(['middleware' => ['auth:sanctum']], function () {
    
    Route::get("users/{id}",[UserController::class,'show']);
    Route::get("users",[UserController::class,'index']);
    Route::resource('oglass',OglasController::class)->only(['index','show','destroy','store']);
    Route::resource('users.oglass', UserOglasController::class)->only(['index']);
    Route::resource('tipvozilas.oglass', TipVozilaOglasController::class)->only(['index']);
    Route::post('/logout', [AuthController::class, 'logout']);
});