<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Attendance;



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
                'users.id as currID',
                'users.name',
                'staff.position',
                'staff.epfNo',
                'staff.socsoNo',
                'staff.basicPay',
                'attendance.*'
            )
            ->where('users.id', '=', $id)
            ->first();

        return view('payroll.payrollAllowance', compact('attendanceCount', 'staffDisplay'));
    }

    public function payrollGenerate(Request $request, $id)
    {
        $selectedMonth = $request->query('selectedMonth');

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
            ->where('users.id', '=', $id)
            ->first();

        return view('payroll.payrollGenerate', compact('selectedMonth', 'staffInfo'));
    }

    public function insertPayroll(Request $request, $id)
    {
        $epfDeduction = $request->input('epfDeduction');
        $totalAllowance = $request->input('totalAllowance');
        $socsoDeduction = $request->input('socsoDeduction');
        $grossPay = $request->input('grossPay');
        $totalDeductions = $request->input('totalDeductions');
        $netPay = $request->input('netPay');
        $status = 'Completed';

        $data = array(
            'userId' => $id,
            'epfRate' => $epfDeduction,
            'allowancePay' => $totalAllowance,
            'socsoRate' => $socsoDeduction,
            'grossPay' => $grossPay,
            'deductions' => $totalDeductions,
            'netPay' => $netPay,
            'status' => $status,
            'created_at' => now(), // Current timestamp
            'updated_at' => now() // Current timestamp

        );

        // insert query
        DB::table('salary')->insert($data);
        return redirect()->route('updatePayroll');
    }


    public function updatePayroll()
    {
        $payList = DB::table('users')
            ->join('staff', 'users.id', '=', 'staff.userId')
            ->join('salary', 'salary.userId', '=', 'users.id')
            ->select(
                'users.id',
                'users.name',
                'users.email',
                'salary.status',
                'staff.userId as sUserID',
            )
            ->orderBy('users.id', 'desc')
            ->get();

        return view('payroll.updatePayroll', compact('payList'));
    }

    public function payrollHistory()
    {
        $payList = DB::table('users')
            ->join('salary', 'users.id', '=', 'salary.userId')
            ->select(
                'users.id',
                'salary.created_at',
            )
            ->orderBy('users.id', 'desc')
            ->get();

        return view('payroll.payrollHistory', compact('payList'));
    }

    public function payslip(Request $request, $id)
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

        return view('payroll.payslip', compact('display'));
    }


    public function selectMonth(Request $request, $id)
    {
        // Pass the staff information and attendance count to the view
        return view('payroll.selectMonth');
    }
}
