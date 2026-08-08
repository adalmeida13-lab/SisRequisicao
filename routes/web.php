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
Route::get('/departments/trashed', [\App\Http\Controllers\DepartmentController::class, 'trashed'])->name('departments.trashed');
Route::put('/departments/{id}/restore', [\App\Http\Controllers\DepartmentController::class, 'restore'])->name('departments.restore');
Route::delete('/departments/{id}/force-delete', [\App\Http\Controllers\DepartmentController::class, 'forceDelete'])->name('departments.forceDelete');
Route::resource('departments', \App\Http\Controllers\DepartmentController::class);
Route::get('/service_requests/trashed', [\App\Http\Controllers\ServiceRequestController::class, 'trashed'])->name('service_requests.trashed');
Route::put('/service_requests/{id}/restore', [\App\Http\Controllers\ServiceRequestController::class, 'restore'])->name('service_requests.restore');
Route::delete('/service_requests/{id}/force-delete', [\App\Http\Controllers\ServiceRequestController::class, 'forceDelete'])->name('service_requests.forceDelete');
Route::resource('servicerequest', \App\Http\Controllers\ServiceRequestController::class);



