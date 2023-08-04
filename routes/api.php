<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\AuthenticationController;

Route::get('/items', [ItemController::class, 'index']);
Route::post('/items', [ItemController::class, 'store']);
Route::get('/items/{id}', [ItemController::class, 'detail']);
Route::patch('/items/{id}', [ItemController::class, 'update']);
Route::delete('/items/{id}', [ItemController::class, 'delete']);

Route::get('/categories', [CategoryController::class, 'index']);
Route::post('/categories', [CategoryController::class, 'store']);
Route::get('/categories/{id}', [CategoryController::class, 'item_by_category']);
Route::patch('/categories/{id}', [CategoryController::class, 'update']);
Route::delete('/categories/{id}', [CategoryController::class, 'delete']);

Route::get('/reservations', [ReservationController::class, 'index']);
Route::get('/tables/{id}/reservations', [ReservationController::class, 'detail']);
Route::get('/tables/{id}/reservations/{id_res}', [ReservationController::class, 'checkout']);
Route::get('/reservations/{id}/items', [ReservationController::class, 'detail_item_reservations']);
Route::get('/tables/{id}/reservations/register', [ReservationController::class, 'registration']);
Route::post('/tables/{id}/reservations', [ReservationController::class, 'generate']);
Route::get('/tables/{id}/reservations/login', [ReservationController::class, 'login']);
Route::post('/tables/reservations/{id}/login', [ReservationController::class, 'check_login']);

Route::post('/users/login', [AuthenticationController::class, 'login']);
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/users/logout', [AuthenticationController::class, 'logout']);
});

Route::patch('/order_items/{id}', [OrderController::class, 'update']);
Route::post('/order/store', [OrderController::class, 'store']);

Route::get('/tables', [TableController::class, 'index']);
Route::get('/tables/{id}/detail', [TableController::class, 'detail']);
Route::get('/tables/{id}/', [TableController::class, 'history_by_table']);
Route::get('/tables/{id}/items', [TableController::class, 'table_active']);
