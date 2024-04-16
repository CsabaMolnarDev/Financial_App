<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FinanceController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\SpendingController;
use App\Http\Controllers\AdvancedStatisticsController;


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
/* This is the check for email*/
Route::post('/checkEmailTaken', [RegisterController::class, 'checkEmailIsTaken'])->name('email.check');

Route::post('/checkIfUserExists', [SettingsController::class, 'checkIfUserExists'])->name('checkIfUserExists');


//add routes to prevent directly written routes to the url
Route::middleware(['auth'])->group(function (){

});


Route::post('/calculate-entropy', [RegisterController::class, 'calculateEntropy'])->name('caculate-entropy');
/* Add category route */
Route::post('/add-category', [SpendingController::class, 'addCategory'])->name('addCategory');
Route::post('/add-IncomeCategory', [IncomeController::class, 'addIncomeCategory'])->name('addIncomeCategory');
/* This is the about us route */
Route::get('/about_us', [AboutUsController::class, 'index'])->name('about_us');

/* This is the creating a new finance */
Route::post('/finances', [FinanceController::class, 'store'])->name('finances.store');
/* This is the income route */
Route::get('/income', [IncomeController::class, 'index'])->name('income');
/* This is the income create */
Route::get('/incomeCreate', [IncomeController::class, 'create'])->name('incomeCreate');
/* This is the spending route */
Route::get('/spending', [SpendingController::class, 'index'])->name('spending');

Route::get('/advancedStatistics', [AdvancedStatisticsController::class, 'index'])->name('advancedStatistics')->middleware('auth');;
/* This is the spending create */
Route::get('/spendingCreate', [SpendingController::class, 'create'])->name('spendingCreate');
/* Edit finance */
Route::post('/editSpendingValue', [SpendingController::class, 'editSpendingValue'])->name('editSpendingValue');
Route::get('/deleteFinance/{id}', [SpendingController::class, 'deleteFinance'])->name('deleteFinance');
/* Settings route */
Route::get('/settings', [SettingsController::class, 'index'])->name('settings')->middleware('auth');
/* Change Fullname */
Route::post('/changeFullName', [SettingsController::class, 'changeFullName'])->name('changeFullName');
/* Change username */
Route::post('/changeUserName', [SettingsController::class, 'changeUserName'])->name('changeUserName');
/* Change email */
Route::post('/changeEmail', [SettingsController::class, 'changeEmail'])->name('changeEmail');
/* Change currency */
Route::post('/changeCurrency', [SettingsController::class, 'changeCurrency'])->name('changeCurrency');
/* Notifications */
Route::post('/enableNotification', [SettingsController::class, 'enableNotification'])->name('enableNotification');
/* Change Phone */
Route::post('/changePhone', [SettingsController::class, 'changePhone'])->name('changePhone');
/* Family system */
Route::post('/createFamily', [SettingsController::class, 'createFamily'])->name('createFamily');
Route::post('/deleteFamily', [SettingsController::class, 'deleteFamily'])->name('deleteFamily');
Route::get('/deleteFamilyMember/{id}', [SettingsController::class, 'deleteFamilyMember'])->name('deleteFamilyMember');
Route::post('/add-family-member', [SettingsController::class, 'addFamilyMember'])->name('addFamilyMember');
Route::post('/leaveFamily', [SettingsController::class, 'leaveFamily'])->name('leaveFamily');
/* accept invite */
Route::get('/accept-invitation/{token}', [FamilyController::class, 'acceptInvitation'])->name('family.acceptInvitation');


/* Download page */
Route::get('/download', [DownloadController::class, 'index'])->name('download')->middleware('auth');

/* Documentation page */
Route::get('/documentation', [DocumentationController::class, 'index'])->name('documentation')->middleware('auth');
//Forget password routes
Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post');
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');
