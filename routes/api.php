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
Route::get('nmc',  [EmployeeController::class , 'getnmc']);
Route::get('nmc/team/{shift}',  [EmployeeController::class , 'getTeanNmc']);


Route::get('om',  [EmployeeController::class , 'getOM']);
Route::get('om/area/{area}',  [EmployeeController::class , 'getTeanOM']);
Route::get('om/area/{area}/search/{keyword}',  [EmployeeController::class , 'searchTeamOM']);
// Route::get('employee/{id}', [EmployeeController::class , 'show']);
Route::get('employee/search/{keyword}', [EmployeeController::class , 'search']);  

Route::get('employee/executive', [EmployeeController::class , 'getExecutive']); 

Route::get('department/{team}', [EmployeeController::class , 'getDepartment']); 
// Protected route
Route::group(['middleware' => 'auth:sanctum'], function(){

     // Route::resource('employee', EmployeeController::class); 
     Route::post('employee', [EmployeeController::class , 'store']);
     Route::put('employee/{id}',  [EmployeeController::class , 'update']);
     Route::delete('employee/{id}', [EmployeeController::class , 'destroy']);      
     Route::post('logout', [AuthController::class , 'logout']);
     Route::get('employee/{id}', [EmployeeController::class , 'show']);
});


// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::get('/user', function (Request $request) {
    // return $request->user();
    // });
