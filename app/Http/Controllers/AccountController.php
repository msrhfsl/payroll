<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Staff;


class AccountController extends Controller
{
    public function listProfile()
    {
        $profile = DB::table('users')
            ->select(
                'id',
                'name',
                'email',
                'image',
            )
            ->orderBy('name', 'asc')
            ->get();

        return view('staff.recordStaff', compact('profile'));
    }

    public function Profile($id)
    {

        $staffData = User::where('users.id', '=', $id)
            ->join('staff', 'users.id', '=', 'staff.userId')
            ->select(
                'users.id',
                'users.name',
                'users.email',
                'staff.phoneNum',
                'staff.homeAdd',
            )->first();
        return view('account.profile', compact('staffData'));
    }

    public function updateProfile(Request $request, $id)
    {
        $user = User::find($id);
        $staff = Staff::where('userId', '=', $id)->first();

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $staff->phoneNum = $request->input('phoneNum');
        $staff->homeAdd = $request->input('homeAdd');

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->move('assets', $filename);
            $user->image = $filename;
        }

        $user->save();
        $staff->save();

        return redirect()->back()->with('message', 'Your Profile Is Successfully Updated');
    }
}
