<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
/* This is the welcome root */
Route::get('/', function () {
    return view('welcome');
});
/* This is the auth root */
Auth::routes();
/* This is the home root */
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


/* This is the about us root */
Route::get('/about_us', [App\Http\Controllers\AboutUs::class, 'index'])->name('about_us');
/* This is the income root */
Route::get('/income', [App\Http\Controllers\Income::class, 'index'])->name('income');
/* This is the spending root */
Route::get('/spending', [App\Http\Controllers\Spending::class, 'index'])->name('spending');
