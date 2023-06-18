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
    $currID = Auth::user()->id;
    
    // Retrieve all attendance records from the database
    $attendances = Attendance::where('userID', $currID)->get();

    // Group the attendance records by month
    $attendanceByMonth = $attendances->groupBy(function ($attendance) {
        return Carbon::parse($attendance->check_in)->format('Y-m');
    })->map(function ($groupedAttendances) {
        return $groupedAttendances->count();
    }); 

    // Prepare the data for the chart
    $months = $attendanceByMonth->keys()->toArray();
    $attendancesCount = $attendanceByMonth->values()->toArray();

    // Pass the data to a view for display
    return view('attendance.attendanceChart', compact('months', 'attendancesCount'));
}



    public function checkIn()
    {
        // Get the authenticated user
        $user = Auth::user();

        // Check if the user has already checked in today
        $existingAttendance = DB::table('attendance')
            ->where('userID', $user->id)
            ->whereDate('date', Carbon::now()->toDateString())
            ->first();

        if ($existingAttendance) {
            return redirect()->back()->with('message', 'You have already checked in today.');
        }

        // Get the authenticated user
        $userID = Auth::user()->id;
        // Set the timezone to Kuala Lumpur
        $kl_timezone = 'Asia/Kuala_Lumpur';

        // Get today's date in Kuala Lumpur timezone
        $today_date = Carbon::now($kl_timezone)->toDateString();
        $checkinTime = Carbon::now($kl_timezone)->toTimeString();

        $data = array(
            'userID' => $userID,
            'date' => $today_date,
            'check_in' => $checkinTime,

        );

        // insert query
        DB::table('attendance')->insert($data);

        return redirect()->back()->with('message', 'Check-in successful');
    }

    public function checkOut($id)
    {


        // Set the timezone to Kuala Lumpur
        $kl_timezone = 'Asia/Kuala_Lumpur';

        // Get today's date in Kuala Lumpur timezone
        $today_date = Carbon::now($kl_timezone)->toDateString();
        $checkoutTime = Carbon::now($kl_timezone)->toTimeString();

        // Update the attendance record for the user with the checkout time
        DB::table('attendance')
            ->where('id', $id)
            ->update(['check_out' => $checkoutTime]);

        return redirect()->back()->with('message', 'Check-out successful');
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
        $currID = Auth::user()->id;
        $attendList = DB::table('attendance')
            ->where('userID', '=', $currID)
            ->get();
        return view('attendance.attendRecord', compact('attendList'));
    }
}
