<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MedicamentosController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

route::post('/remedio', [MedicamentosController::class,'store']); 

route::get('/medicamentos', [MedicamentosController::class,'index']); 

route::get('/remedio/{id}', [MedicamentosController::class,'show']);

route::put('/remedio/{id}', [MedicamentosController::class,'update']);

route::delete('/remedio/{id}', [MedicamentosController::class,'destroy']);