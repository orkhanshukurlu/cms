<?php

use App\Http\Controllers\Backend\AuthController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\MemberController;
use App\Http\Controllers\Backend\PortfolioController;
use App\Http\Controllers\Backend\PositionController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\Backend\SocialController;
use App\Http\Controllers\Backend\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function ()
{
    Route::get('login',  [AuthController::class, 'loginView'])->name('login.view');
    Route::post('login', [AuthController::class, 'login'])->name('login');
});

Route::middleware('auth')->group(function ()
{
    Route::get('',    DashboardController::class)->name('dashboard');
    Route::delete('logout', [AuthController::class,    'logout'])->name('logout');
    Route::get('profile',   [ProfileController::class, 'profileView'])->name('profile.view');
    Route::patch('profile', [ProfileController::class, 'profile'])->name('profile');

    Route::resource('brands',     BrandController::class)->except('show');
    Route::resource('categories', CategoryController::class)->except('show');
    Route::resource('members',    MemberController::class)->except('show');
    Route::resource('portfolio',  PortfolioController::class);
    Route::resource('positions',  PositionController::class)->except('show');
    Route::resource('roles',      RoleController::class);
    Route::resource('settings',   SettingController::class);
    Route::resource('socials',    SocialController::class)->except('show');
    Route::resource('users',      UserController::class)->except('show');
});
