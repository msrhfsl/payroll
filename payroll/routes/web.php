<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


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

//do not want to display welcome page 
Route::get('/', function () {
    if ($user = Auth::user()) {
        //if login
        return redirect('/dashboard');
    } else {
        //if not login
        return redirect('login');
    }
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'loadDashboard'])->name('dashboard');
Route::get('/staffList', [App\Http\Controllers\regStaffController::class, 'regStaff'])->name('staffrecord');
Route::get('/registerStaff', [App\Http\Controllers\regStaffController::class, 'newStaff'])->name('newUser');
Route::post('/insertNewStaff', [App\Http\Controllers\regStaffController::class, 'insertNewStaff'])->name('insertNewStaff');
Route::get('/incompleteStaff', [App\Http\Controllers\regStaffController::class, 'incompleteStaff'])->name('incompleteStaff');
Route::get('/staffAdd/{id}', [App\Http\Controllers\regStaffController::class, 'addStaff'])->name('staffdetails');
Route::post('/insertDetailStaff/{id}', [App\Http\Controllers\regStaffController::class, 'insertStaff'])->name('insertStaff');
Route::get('/viewStaff/{id}', [App\Http\Controllers\regStaffController::class, 'displayStaff'])->name('displayStaff');
Route::post('updateStaff/{id}', [App\Http\Controllers\regStaffController::class, 'updateStaff'])->name('updateStaff');
Route::delete('deleteStaff/{id}', [App\Http\Controllers\regStaffController::class, 'deleteStaff'])->name('deleteStaff');
Route::get('/payrollList', [App\Http\Controllers\PayrollController::class, 'payrollList'])->name('payrollList');
Route::get('/payrollGenerate', [App\Http\Controllers\PayrollController::class, 'payrollGenerate'])->name('payrollGenerate');
Route::get('/payrollAllowance', [App\Http\Controllers\PayrollController::class, 'payrollAllowance'])->name('payrollAllowance');
Route::get('/payrollReview', [App\Http\Controllers\PayrollController::class, 'payrollReview'])->name('payrollReview');
Route::get('/payrollHistory', [App\Http\Controllers\PayrollController::class, 'payrollHistory'])->name('payrollHistory');
Route::get('/payslip', [App\Http\Controllers\PayrollController::class, 'payslip'])->name('payslip');
Route::get('/cashFlow', [App\Http\Controllers\PayrollController::class, 'cashFlow'])->name('cashFlow');
Route::post('/attendRecord', [App\Http\Controllers\AttendanceController::class, 'attendRecord'])->name('attendRecord');
Route::get('/attendList', [App\Http\Controllers\AttendanceController::class, 'attendList'])->name('attendList');
Route::get('/createAttend', [App\Http\Controllers\AttendanceController::class, 'createAttend'])->name('createAttend');
Route::get('/chartAttend', [App\Http\Controllers\AttendanceController::class, 'chartAttend'])->name('chartAttend');
Route::get('/ListOfStaff', [App\Http\Controllers\AccountController::class, 'listProfile'])->name('listOfStaff');
Route::put('/UpdateProfile/{id}', [App\Http\Controllers\AccountController::class, 'updateProfile'])->name('updateProfile');
Route::get('/Profile/{id}', [App\Http\Controllers\AccountController::class, 'Profile'])->name('Profile');


