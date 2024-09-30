<?php

use App\Http\Controllers\Api\AuthUser;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/register',[AuthUser::class, 'index']);