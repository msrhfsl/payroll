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
Route::get('/viewStaffList/{id}', [App\Http\Controllers\DashboardController::class, 'staffView'])->name('staffView');
Route::get('/viewStaffAttendance/{id}', [App\Http\Controllers\DashboardController::class, 'staffAttendance'])->name('staffAttendance');

Route::get('/staffList', [App\Http\Controllers\regStaffController::class, 'regStaff'])->name('staffrecord');
Route::get('/registerStaff', [App\Http\Controllers\regStaffController::class, 'newStaff'])->name('newUser');
Route::post('/insertNewStaff', [App\Http\Controllers\regStaffController::class, 'insertNewStaff'])->name('insertNewStaff');
Route::get('/incompleteStaff', [App\Http\Controllers\regStaffController::class, 'incompleteStaff'])->name('incompleteStaff');
Route::get('/staffAdd/{id}', [App\Http\Controllers\regStaffController::class, 'addStaff'])->name('staffdetails');
Route::post('/insertDetailStaff/{id}', [App\Http\Controllers\regStaffController::class, 'insertStaff'])->name('insertStaff');
Route::get('/viewStaff/{id}', [App\Http\Controllers\regStaffController::class, 'displayStaff'])->name('displayStaff');
Route::post('/updateStaff/{id}', [App\Http\Controllers\regStaffController::class, 'updateStaff'])->name('updateStaff');
Route::delete('/deleteStaff/{id}', [App\Http\Controllers\regStaffController::class, 'deleteStaff'])->name('deleteStaff');

Route::get('/payrollList', [App\Http\Controllers\PayrollController::class, 'payrollList'])->name('payrollList');
Route::get('/selectMonth/{id}', [App\Http\Controllers\PayrollController::class, 'selectMonth'])->name('selectMonth');
Route::post('/payrollAllowance/{id}', [App\Http\Controllers\PayrollController::class, 'payrollAllowance'])->name('payrollAllowance');
Route::get('/payrollGenerate/{id}', [App\Http\Controllers\PayrollController::class, 'payrollGenerate'])->name('payrollGenerate');
Route::get('/payrollHistory', [App\Http\Controllers\PayrollController::class, 'payrollHistory'])->name('payrollHistory');
Route::get('/countAttendance/{id}', [App\Http\Controllers\PayrollController::class, 'countMonth'])->name('countMonth');
Route::post('/insertPayroll/{id}', [App\Http\Controllers\PayrollController::class, 'insertPayroll'])->name('insertPayroll');
Route::get('/updatePayroll', [App\Http\Controllers\PayrollController::class, 'updatePayroll'])->name('updatePayroll');
Route::get('/payslip/{id}', [App\Http\Controllers\PayrollController::class, 'payslip'])->name('payslip');

Route::post('/checkIn', [App\Http\Controllers\AttendanceController::class, 'checkIn'])->name('checkIn');
Route::get('/checkOut/{id}', [App\Http\Controllers\AttendanceController::class, 'checkOut'])->name('checkOut');
Route::get('/attendList', [App\Http\Controllers\AttendanceController::class, 'attendList'])->name('attendList');
Route::get('/displayStaffAttendance/{id}', [App\Http\Controllers\AttendanceController::class, 'displayAttendStaff'])->name('displayAttendStaff');
Route::get('/createAttend', [App\Http\Controllers\AttendanceController::class, 'createAttend'])->name('createAttend');
Route::get('/chartAttend', [App\Http\Controllers\AttendanceController::class, 'chartAttend'])->name('chartAttend');

Route::get('/payrollReview/{id}', [App\Http\Controllers\SalaryController::class, 'payrollReview'])->name('payrollReview');

Route::get('/ListOfStaff', [App\Http\Controllers\AccountController::class, 'listProfile'])->name('listOfStaff');
Route::put('/UpdateProfile/{id}', [App\Http\Controllers\AccountController::class, 'updateProfile'])->name('updateProfile');
Route::get('/Profile/{id}', [App\Http\Controllers\AccountController::class, 'Profile'])->name('Profile');


