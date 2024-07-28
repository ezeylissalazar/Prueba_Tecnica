<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CurrencyConversionController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\RoleChangeController;
use App\Http\Controllers\TypeActivityController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();
Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('home');
    } else {
        return redirect()->route('login');
    }
});
Route::middleware(['auth'])->group(function () {

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::post('/request-role-change', [RoleChangeController::class, 'requestChange'])->name('request-role-change');
    Route::get('/requests', [RequestController::class, 'index'])->name('requests');
    Route::post('/requests/{id}/approve', [RequestController::class, 'approve'])->name('requests.approve');
    Route::post('/requests/{id}/decline', [RequestController::class, 'decline'])->name('requests.decline');
    Route::get('/users', [UserController::class, 'index'])->name('users');
    Route::get('/users/update-role/{id}', [UserController::class, 'update_role'])->name('users.update');
    Route::get('/companies', [CompanyController::class, 'index'])->name('companies');
    Route::get('/companies/register', [CompanyController::class, 'create'])->name('companies.create');
    Route::get('/type-of-activities', [TypeActivityController::class, 'index'])->name('typeActivity');
    Route::get('/type-of-activities/register', [TypeActivityController::class, 'create'])->name('typeActivity.create');
    Route::get('/type-of-activities/associate-activities-company/{id}', [TypeActivityController::class, 'associate_activity'])->name('typeActivity.associate');
    Route::get('/convert', [CurrencyConversionController::class, 'showForm'])->name('show_conversion_form');
    Route::get('/convert/process', [CurrencyConversionController::class, 'convert'])->name('convert');
});
