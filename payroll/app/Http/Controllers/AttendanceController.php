<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Attendance;
use Carbon\Carbon;


class AttendanceController extends Controller
{
    public function chartAttend()
    {
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
    }

    public function attendRecord(Request $request)
    {
        $id = Auth::user()->id;

        // Get the employee's check-in and check-out details from the request

        // Save the attendance record in the database
        $attendance = new Attendance();
        $attendance->reason = $request->input('reason');
        $attendance->check_in = $request->input('check_in');
        $attendance->check_out = $request->input('check_out');
        $attendance->save();

        return redirect()->route('attendList');

    }


    public function attendList()
    {
        // Retrieve all attendance records from the database    
        $attendances = Attendance::all();

        // Pass the records to a view for display
        return view('attendance.attendList', ['attendances' => $attendances]);
    }

    public function createAttend()
    {
        return view('attendance.attendRecord');
    }

    
}



