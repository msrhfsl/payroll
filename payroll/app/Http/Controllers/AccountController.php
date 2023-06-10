<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;


class AccountController extends Controller
{
    public function listProfile()
    {
        $profile = DB::table('users')
        ->select(
            'id',
            'name',
            'category',
        )
        ->orderBy('name', 'asc')
        ->get();
        
        return view('staff.recordStaff', compact('profile'));
    }
    public function Profile($id)
    {
        $profile = User::find($id);
        return view('account.profile', ['profile' => $profile]);
    }

    public function updateProfile(Request $request, $id)
    {
        // find the id from proposal
        $profile = User::find($id);

        // unlink the old proposal file from assets folder
        

        $profile->name = $request->input('name');
        $profile->email = $request->input('email');
        $profile->image = $request->file('image');

        // to rename the proposal file
        $filename = time() . '.' . $profile->image->getClientOriginalExtension();
        // to store the new file by moving to assets folder
        $request->image->move('assets', $filename);

        $profile->image = $filename;

        // upadate query in the database
        $profile->update();

        // display message box in the same page
        return redirect()->back()->with('message', 'Your Profile Is Successfully Updated');
    }
}
