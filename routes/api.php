<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExpenseController;

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

Route::get('/expenses',[ExpenseController::class, 'show'])->name('expenses.show');
Route::post('/expenses/store',[ExpenseController::class, 'store']);
Route::patch('/expenses/{id}/approve',[ExpenseController::class, 'approve'])->name('expenses.approve');
Route::get('/expenses/{id}',[ExpenseController::class, 'show']);
