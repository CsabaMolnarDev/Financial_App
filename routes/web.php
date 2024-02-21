<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FinanceController;


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
/* This is the welcome route */
Route::get('/', function () {
    return view('welcome');
});
/* This is the auth route */
Auth::routes();
/* This is the home route */
Route::get('/home', [HomeController::class, 'index'])->name('home');
/* Add category route */
Route::post('/add-category', [SpendingController::class, 'addCategory'])->name('addCategory');
/* This is the about us route */
Route::get('/about_us', [AboutUs::class, 'index'])->name('about_us');
/* This is the income route */
Route::get('/income', [Income::class, 'index'])->name('income');
/* This is the income create */
Route::get('/incomeCreate', [Income::class, 'create'])->name('incomeCreate');
/* This is the spending route */
Route::get('/spending', [SpendingController::class, 'index'])->name('spending');
/* This is the spending create */
Route::get('/spendingCreate', [SpendingController::class, 'create'])->name('spendingCreate');
/* This is the creating a new finance */
Route::post('/finances', [FinanceController::class, 'store'])->name('finances.store');
