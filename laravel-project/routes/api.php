<?php

use App\Http\Controllers\Api\AuthUserController;
use App\Http\Controllers\TicketController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/users', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::post('register',[AuthUserController::class, 'register']);
Route::post('login',[AuthUserController::class,'login']);
Route::get('cinema/{id}',[AuthUserController::class,'cinema']);
Route::apiResource('ticket',TicketController::class);
Route::get('user/{id}', function ($id) {
    $user=User::find($id)->ticket->all();
    return response()->json($user,200);
});