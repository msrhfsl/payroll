<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Salary;
use App\Models\Staff;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class SalaryController extends Controller
{
    public function payrollReview(Request $request, $id)
    {
        $display = DB::table('users')
            ->join('staff', 'users.id', '=', 'staff.userId')
            ->join('salary', 'salary.userId', '=', 'users.id')
            ->select(
                'users.id',
                'users.name',
                'staff.position',
                'staff.epfNo',
                'staff.socsoNo',
                'staff.basicPay',
                'salary.allowancePay',
                'salary.deductions',
                'salary.grossPay',
                'salary.netPay',
                'salary.epfRate',
                'salary.socsoRate',

            )
            ->where('users.id', '=', $id)
            ->first();

        return view('payroll.payrollReview', compact('display'));
    }
}
