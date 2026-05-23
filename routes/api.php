<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::post('/user/create', [UserController::class, 'store'])->name('user.create');
