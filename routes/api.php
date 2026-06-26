<?php

<<<<<<< HEAD
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MaterialController;

Route::get('/materiales', [MaterialController::class, 'index']);
=======
use App\Http\Controllers\MaterialController;
use Illuminate\Support\Facades\Route;

Route::post('/materiales', [MaterialController::class, 'store']);
Route::put('/materiales/{codigo}', [MaterialController::class, 'update']);
>>>>>>> 1cdd63a812214f83d7c1990c546eaa3868e2bd42
