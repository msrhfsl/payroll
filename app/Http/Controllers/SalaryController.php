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
    public function payrollReview($id)
    {
        $staffInfo = DB::table('users')
            ->join('staff', 'users.id', '=', 'staff.userId')
            ->where('users.id', '=', $id)
            ->select(
                'users.id',
                'users.name',
                'staff.position',
                'staff.epfNo',
                'staff.socsoNo',
                'staff.basicPay',
                'staff.userId as sUserID',
            )
            ->first();

        return view('payroll.payrollReview', compact('staffInfo'));
    }
}
