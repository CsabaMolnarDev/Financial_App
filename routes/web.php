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
/* This is the welcome rout */
Route::get('/', function () {
    return view('welcome');
});
/* This is the auth rout */
Auth::routes();
/* This is the home rout */
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
/* Add category route */
Route::post('/add-category', 'SpendingController@addCategory')->name('addCategory');
/* This is the about us rout */
Route::get('/about_us', [App\Http\Controllers\AboutUs::class, 'index'])->name('about_us');
/* This is the income rout */
Route::get('/income', [App\Http\Controllers\Income::class, 'index'])->name('income');
/* This is the spending rout */
Route::get('/spending', [App\Http\Controllers\SpendingController::class, 'index'])->name('spending');
