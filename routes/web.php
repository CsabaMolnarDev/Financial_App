<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FinanceController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\Auth\ForgotPasswordController;


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
/* This is the check for username*/
Route::post('/checkUsernameTaken', [RegisterController::class, 'checkNameIsTaken'])->name('username.check');


//add routes to prevent directly written routes to the url
Route::middleware(['auth'])->group(function (){

});

Route::post('/calculate-entropy', [RegisterController::class, 'calculateEntropy'])->name('caculate-entropy');
/* Add category route */
Route::post('/add-category', [SpendingController::class, 'addCategory'])->name('addCategory');
/* This is the about us route */
Route::get('/about_us', [AboutUsController::class, 'index'])->name('about_us');
/* This is the income route */
Route::get('/income', [IncomeController::class, 'index'])->name('income');
/* This is the income create */
Route::get('/incomeCreate', [IncomeController::class, 'create'])->name('incomeCreate');
/* This is the spending route */
Route::get('/spending', [SpendingController::class, 'index'])->name('spending');
/* This is the spending create */
Route::get('/spendingCreate', [SpendingController::class, 'create'])->name('spendingCreate');
/* Settings route */
Route::get('/settings', [SettingsController::class, 'show'])->name('settings')->middleware('auth');
Route::post('/changeUserName', [SettingsController::class, 'changeUserName'])->name('changeUserName');
Route::post('/changeEmail', [SettingsController::class, 'changeEmail'])->name('changeEmail');
Route::post('/changeCurrency', [SettingsController::class, 'changeCurrency'])->name('changeCurrency');
Route::post('/enableNotification', [SettingsController::class, 'enableNotification'])->name('enableNotification');

/* This is the creating a new finance */
Route::post('/finances', [FinanceController::class, 'store'])->name('finances.store');


//Forget password routes
Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post');
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');
