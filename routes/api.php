<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImageController;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/file',[App\Http\Controllers\FileUploadController::class, 'index']);
Route::post('/file_save',[App\Http\Controllers\FileUploadController::class, 'store']);
Route::put('/file_update/{id}',[App\Http\Controllers\FileUploadController::class, 'update']);
Route::delete('/file_delete/{id}',[App\Http\Controllers\FileUploadController::class, 'destroy']);


Route::get('/product',[App\Http\Controllers\ProductController::class, 'index']);
Route::post('/product_save',[App\Http\Controllers\ProductController::class, 'store']);
Route::put('/product_update/{id}',[App\Http\Controllers\ProductController::class, 'update']);
Route::delete('/product_delete/{id}',[App\Http\Controllers\ProductController::class, 'destroy']);

Route::get('/employee',[App\Http\Controllers\EmployeeController::class, 'index']);
Route::post('/employee_save',[App\Http\Controllers\EmployeeController::class, 'store']);
Route::put('/employee_update/{id}',[App\Http\Controllers\EmployeeController::class, 'update']);
Route::delete('/employee_delete/{id}',[App\Http\Controllers\EmployeeController::class, 'destroy']);



Route::get('/images',[App\Http\Controllers\ImageController::class, 'index']);
Route::post('/images',[App\Http\Controllers\ImageController::class, 'store']);
Route::get('/images/{image}',[App\Http\Controllers\ImageController::class, 'show']);
Route::put('/images/{image}',[App\Http\Controllers\ImageController::class, 'update']);
Route::delete('/images/{image}',[App\Http\Controllers\ImageController::class, 'destroy']);
