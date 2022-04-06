<?php

use App\Http\Controllers\API\CartController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\MedicinesController;
use App\Http\Controllers\API\UsersController;
use App\Http\Controllers\API\CategoryMedicinesController;
use App\Http\Controllers\API\CommentsController;
use App\Http\Controllers\API\OrderController;

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

Route::post('/add-medicine', [MedicinesController::class, 'store']);

Route::get('/medicines', [MedicinesController::class, 'index']);

Route::delete('/deleteMedicines/{id}', [MedicinesController::class, 'delete']);

Route::get('/medicines/{id}', [MedicinesController::class, 'getMedicines']);

Route::put('/updateMedicines/{id}', [MedicinesController::class, 'updateMedicines']);

Route::get('/searchMedicines/{key}', [MedicinesController::class, 'search']);

Route::get('/categoryMedicines', [CategoryMedicinesController::class, 'index']);

Route::post('/add-categoryMedicine', [CategoryMedicinesController::class, 'store']);

Route::delete('/deleteCategory/{id}', [CategoryMedicinesController::class, 'delete']);

Route::get('/categoryMedicines/{id}', [CategoryMedicinesController::class, 'getCategory']);

Route::put('/updateCategory/{id}', [CategoryMedicinesController::class, 'updateCategory']);

Route::post('/login', [UsersController::class, 'login']);

Route::post('/loginAdmin', [UsersController::class, 'loginAdmin']);

Route::post('/register', [UsersController::class, 'store']);

Route::get('/user/{id}', [UsersController::class, 'getUser']);

Route::post('/add-cartMedicines', [CartController::class, 'store']);

Route::delete('/delete-cartMedicines/{id}', [CartController::class, 'delete']);

Route::get('/get-cartMedicines/{id}', [CartController::class, 'GetCartMedicines']);

Route::get('/get-order/{id}', [OrderController::class, 'index']);

Route::get('/get-orderDeitals/{id}', [OrderController::class, 'indexDetail']);

Route::post('/add-order', [OrderController::class, 'addOrder']);

Route::get('/search-order/{key}', [OrderController::class, 'search']);

Route::get('/similar-Medicines/{id}', [MedicinesController::class, 'similarMedicines']);

Route::get('/get-Comments/{id}', [CommentsController::class, 'index']);

Route::post('/add-Comments', [CommentsController::class, 'addComments']);

Route::get('/get-Pagination', [MedicinesController::class, 'Pagination']);

Route::put('/update-User/{id}', [UsersController::class, 'updateUser']);

Route::put('/change-Password/{id}', [UsersController::class, 'changePassword']);


// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
