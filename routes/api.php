<?php

use App\Http\Controllers\Api\DataTableController;
use Illuminate\Support\Facades\Route;

Route::controller(DataTableController::class)->group(function()
{
    Route::get('brands',     'getBrands')->name('brands');
    Route::get('categories', 'getCategories')->name('categories');
    Route::get('members',    'getMembers')->name('members');
    Route::get('portfolio',  'getPortfolio')->name('portfolio');
    Route::get('positions',  'getPositions')->name('positions');
    Route::get('roles',      'getRoles')->name('roles');
    Route::get('settings',   'getSettings')->name('settings');
    Route::get('socials',    'getSocials')->name('socials');
    Route::get('users',      'getUsers')->name('users');
});
