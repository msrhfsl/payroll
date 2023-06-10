<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Staff;
use App\Models\User;



class PayrollController extends Controller
{
    public function payrollList()
    {
        $id = Auth::user()->id;

        $payList = DB::table('users')
            ->join('staff', 'users.id', '=', 'staff.userId')
            ->select(
            'users.id',
            'users.name',
            'users.email',
            'users.category',
            'staff.userId as sUserID',
            )
            ->where('users.category', '=', 'Staff')
            ->orderBy('id', 'desc')
            ->get();


        return view('payroll.payrollList', compact('payList'));
    }

    public function payrollGenerate()
    {
        return view('payroll.payrollGenerate');
    }

    public function payrollAllowance()
    {
        return view('payroll.payrollAllowance');
    }

    public function payrollReview()
    {
        return view('payroll.payrollReview');
    }

    public function payrollHistory()
    {
        return view('payroll.payrollHistory');
    }

    public function payslip()
    {
        return view('payroll.payslip');
    }

    public function cashFlow()
    {
        return view('payroll.cashFlow');
    }

}