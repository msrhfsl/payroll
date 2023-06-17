<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Staff;
use App\Models\Attendance;
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

    public function payrollAllowance(Request $request, $id)
    {
        $selectedMonth = $request->input('selected_month');

        // Retrieve the attendance count for the selected month and employee
        $attendanceCount = Attendance::where('userID', $id)
            ->whereDate('date', 'like', $selectedMonth . '%')
            ->count();


        // Retrieve the staff information and attendance count
        $staffDisplay = DB::table('users')
            ->join('staff', 'users.id', '=', 'staff.userId')
            ->join('attendance', 'attendance.userID', '=', 'users.id')
            ->select(
                'users.*',
                'staff.*',
                'attendance.*'
            )
            ->where('users.id', '=', $id)
            ->first();

        return view('payroll.payrollAllowance', compact('attendanceCount', 'staffDisplay'));
    }

    public function payrollGenerate($id)
    {
        $staffInfo = DB::table('users')
            ->join('staff', 'users.id', '=', 'staff.userId')
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

        return view('payroll.payrollGenerate', compact('staffInfo'));
    }

    public function payrollHistory()
    {
        return view('payroll.payrollHistory');
    }

    public function payslip()
    {
        return view('payroll.payslip');
    }

    public function countMonth(Request $request, $id)
    {
    }

    public function selectMonth(Request $request, $id)
    {


        // Pass the staff information and attendance count to the view
        return view('payroll.selectMonth');
    }
}
