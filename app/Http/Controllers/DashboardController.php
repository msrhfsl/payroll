<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Attendance;
use Carbon\Carbon;

class DashboardController extends Controller
{
    //authorize session from user type
    public function loadDashboard()
    {
        $category = Auth::user()->category;

        if ($category == 'Staff') {

            // Retrieve all attendance records from the database
            $attendances = Attendance::all();

            // Sort the attendance records by date
            $sortedAttendances = $attendances->sortBy(function ($attendance) {
                return Carbon::parse($attendance->check_in)->format('Y-m');
            });

            // Count the number of attendances for each month
            $attendanceByMonth = $sortedAttendances->groupBy(function ($attendance) {
                return Carbon::parse($attendance->check_in)->format('Y-m');
            })->map(function ($groupedAttendances) {
                return $groupedAttendances->count();
            });

            // Prepare the data for the chart
            $months = $attendanceByMonth->keys();
            $attendancesCount = $attendanceByMonth->values();

            // Pass the data to a view for display
            return view('attendance.attendanceChart', compact('months', 'attendancesCount'));
        } else {

            $staffView = DB::table('users')
                ->join('staff', 'users.id', '=', 'staff.userId')
                ->select(
                    'users.id',
                    'users.name',
                    'staff.position',
                )
                ->get();

            $count = DB::table('staff')
                ->count();

            $countTechnician = DB::table('staff')
                ->where('position', 'Technician')
                ->count();

            $countSales = DB::table('staff')
                ->where('position', 'Sales')
                ->count();

            return view('dashboard.admin', compact('count', 'countTechnician', 'countSales', 'staffView'));
        }
    }

    public function staffAttendance()
    {

        $staffAttendance = DB::table('users')
            ->join('attendance', 'users.id', '=', 'attendance.userID')
            ->select(
                'users.id',
                'users.name',
                'attendance.date',
                'attendance.check_in',
                'attendance.check_out',
            )
            ->get();
        return view('dashboard.viewAttendance', compact('staffAttendance'));
    }
}
