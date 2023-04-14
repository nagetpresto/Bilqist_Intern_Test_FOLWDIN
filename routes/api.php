<?php

use App\Http\Controllers\api\EmployeeController;
use App\Http\Controllers\api\PositionsController;
use App\Http\Controllers\api\ContractsController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::apiResource('employee', EmployeeController::class);
Route::apiResource('positions', PositionsController::class);
Route::apiResource('contracts', ContractsController::class);