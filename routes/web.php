<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/users/trashed', [UserController::class, 'trashed'])->name('users.trashed');
Route::put('/users/{id}/restore', [UserController::class, 'restore'])->name('users.restore');
Route::delete('/users/{id}/force-delete', [UserController::class, 'forceDelete'])->name('users.forceDelete');
Route::resource('users', UserController::class);
Route::get('/companies/trashed', [\App\Http\Controllers\CompanyController::class, 'trashed'])->name('companies.trashed');
Route::put('/companies/{id}/restore', [\App\Http\Controllers\CompanyController::class, 'restore'])->name('companies.restore');
Route::delete('/companies/{id}/force-delete', [\App\Http\Controllers\CompanyController::class, 'forceDelete'])->name('companies.forceDelete');
Route::resource('companies', \App\Http\Controllers\CompanyController::class);

