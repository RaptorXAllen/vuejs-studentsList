<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\AccountController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/students', [StudentController::class,'index']);
Route::prefix('/student')->group( function(){
        Route::post('/store',[StudentController::class,'store']);
        Route::put('/{id}',[StudentController::class,'update']);
        Route::delete('/{id}',[StudentController::class,'destroy']);
    }
);

Route::prefix('/account')->group( function(){
        Route::post('/login',[AccountController::class,'login']);
    }
);
