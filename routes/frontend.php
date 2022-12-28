<?php

use App\Http\Controllers\Frontend\AboutController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\PortfolioController;
use Illuminate\Support\Facades\Route;

Route::get('',                     HomeController::class)->name('home');
Route::get('about',                AboutController::class)->name('about');
Route::get('contact',                    [ContactController::class,   'contactView'])->name('contact.view');
Route::post('contact',                   [ContactController::class,   'contact'])->name('contact');
Route::get('portfolio',                  [PortfolioController::class, 'index'])->name('portfolio');
Route::get('portfolio/{portfolio:slug}', [PortfolioController::class, 'show'])->name('portfolio.show');
