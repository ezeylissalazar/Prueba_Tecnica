<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\TypeActivityController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use LaravelJsonApi\Laravel\Facades\JsonApiRoute;
use LaravelJsonApi\Laravel\Http\Controllers\JsonApiController;
use LaravelJsonApi\Laravel\Routing\ResourceRegistrar;

Route::middleware(['auth', 'web'])->post('/companies/register', [CompanyController::class, 'store'])->name('companies.store');
Route::middleware(['auth', 'web'])->put('/companies/{id}/activate', [CompanyController::class, 'activate'])->name('companies.activate');
Route::middleware(['auth', 'web'])->put('/companies/{id}/desactivate', [CompanyController::class, 'desactivate'])->name('companies.desactivate');
Route::middleware(['auth', 'web'])->post('/type-of-activities/register', [TypeActivityController::class, 'store'])->name('typeActivity.store');
Route::middleware(['auth', 'web'])->post('/type-of-activities/associate-activities-company/{id}', [TypeActivityController::class, 'associate_activity_store'])->name('typeActivity.associate.store');
Route::middleware(['auth', 'web'])->post('/users/update-role/{id}', [UserController::class, 'update_role_store'])->name('users.update.role');
