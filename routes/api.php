<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TasktableController;


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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();




});

Route::group(['prefix' => 'tasks'],function () {
    Route::get('/index', [TasktableController::class, 'index']); 
    Route::post('/store', [TaskTableController::class, 'store']); 
    Route::get('/show/{id}', [TaskTableController::class, 'show']); 
    Route::put('/update/{id}', [TaskTableController::class, 'update']); 
    Route::delete('/destory/{id}', [TasktableController::class, 'destroy']); 
});

