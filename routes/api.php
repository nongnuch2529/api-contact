<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\EmployeeController;


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

// Public route
Route::post('register', [AuthController::class , 'register']);
Route::post('login',    [AuthController::class , 'login']);
Route::get('employee',  [EmployeeController::class , 'index']);
Route::get('employee/{id}', [EmployeeController::class , 'show']);
Route::get('employee/search/{team}', [EmployeeController::class , 'search']);  


// Protected route
Route::group(['middleware' => 'auth:sanctum'], function(){

     // Route::resource('employee', EmployeeController::class); 
     Route::post('employee', [EmployeeController::class , 'store']);
     
     Route::put('employee/{id}',  [EmployeeController::class , 'update']);
     Route::delete('employee/{id}', [EmployeeController::class , 'destroy']);     
     // Route::get('employee/{id}', [EmployeeController::class , 'show']);     
     Route::post('logout', [AuthController::class , 'logout']);
});


// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::get('/user', function (Request $request) {
    // return $request->user();
    // });
