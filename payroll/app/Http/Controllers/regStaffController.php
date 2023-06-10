<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Staff;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class regStaffController extends Controller
{

    public function regStaff()
    {
        $id = Auth::user()->id;

        $staffList = DB::table('users')
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


        return view('record.staffrecord', compact('staffList'));
    }

    public function incompleteStaff()
    {
        $id = Auth::user()->id;


        $staffList = DB::table('users')
            ->leftJoin('staff', 'users.id', '=', 'staff.userId')
            ->select('users.*')
            ->whereNull('staff.userId')
            ->where ('category', 'Staff')
            ->get();

        return view('record.incompleteStaff', compact('staffList'));
    }

    public function newStaff()
    {
        $id = Auth::user()->id;

        return view('record.newUser');

    }

    public function insertNewStaff(Request $request)
    {
        
        $name = $request->input('name');
        $email = $request->input('email');
        $password = $request->input('password');

        $data = array(
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
            'category' => "Staff",
        
        );

        // insert query
        DB::table('users')->insert($data);
        return redirect()->route('staffrecord');
    }
    


    public function addStaff($id)
    {
        $staffID = DB::table('users')
            ->where('id', $id)
            ->first();
        
        return view('record.staffdetails', compact('staffID'));
    }
    

    public function insertStaff(Request $request, $id)
    {
        $phoneNum = $request->input('phoneNum');
        $homeAdd = $request->input('homeAdd');
        $gender = $request->input('gender');
        $position = $request->input('position');
        $bank = $request->input('bank');
        $accNum = $request->input('accNum');
        $epfNo = $request->input('epfNo');
        $socsoNo = $request->input('socsoNo');
        $basicPay = $request->input('basicPay');

        $data = array(
            'userID' => $id,
            'phoneNum' => $phoneNum,
            'homeAdd' => $homeAdd,
            'gender' => $gender,
            'position' => $position,
            'bank' => $bank,
            'accNum' => $accNum,
            'epfNo' => $epfNo,
            'socsoNo' => $socsoNo,
            'basicPay' => $basicPay,
        
        );

        // insert query
        DB::table('staff')->insert($data);
        return redirect()->route('staffrecord');
    }

    public function displayStaff(Request $request, $id)
    {

        $staffDisplay = DB::table('users')
            ->join('staff', 'users.id', '=', 'staff.userId')
            ->select(
            'users.id',
            'users.name',
            'users.email',
            'staff.phoneNum',
            'staff.homeAdd',
            'staff.gender',
            'staff.position',
            'staff.bank',
            'staff.accNum',
            'staff.epfNo',
            'staff.socsoNo',
            'staff.basicPay',
            'staff.userId as sUserID',
            )
            ->first();

        return view('record.displayStaff', compact('staffDisplay'));
    }

    public function updateStaff(Request $request, $id)
    {
        $staff = Staff::where('userId', $id)->first();
        $staff->phoneNum = $request->phoneNum;
        $staff->homeAdd = $request->homeAdd;
        $staff->gender = $request->gender;
        $staff->position = $request->position;
        $staff->bank = $request->bank;
        $staff->accNum = $request->accNum;
        $staff->epfNo = $request->epfNo;
        $staff->socsoNo = $request->socsoNo;
        $staff->basicPay = $request->basicPay;
        $staff->save();

        $user = User::find($request->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        return back()->with('success','Your profile is successfully updated!');
        
            
    }
    

    //to delete selected record
    public function deleteStaff(Request $request, $id)
    {
        if ($request->ajax()) {

            Staff::where('id', '=', $id)->delete();
            return response()->json(array('success' => true));
        }
    }
}
