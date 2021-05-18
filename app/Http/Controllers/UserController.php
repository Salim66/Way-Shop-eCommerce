<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * All user view page
     */
    public function view()
    {
        $users = User::where('user_type', 'Admin')->orWhere('user_type', 'Author')->orWhere('user_type', 'Super Admin')->latest()->get();
        return view('admin.users.view', compact('users'));
    }

    /**
     * User add
     */
    public function add()
    {
        return view('admin.users.add');
    }

    /**
     * User store 
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'      => 'required',
            'email'      => 'required',
            'user_type' => 'required',
            'password'  => 'required | min:6 | max:10',
        ]);

        if ($request->password == $request->password_confirmation) {
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'user_type' => $request->user_type,
                'password' => password_hash($request->password, PASSWORD_DEFAULT),
            ]);
            return redirect()->route('admin.users')->with('success', 'Data added successfully ):');
        } else {
            return redirect()->back()->with('error', 'Password does not match!');
        }
    }

    /**
     * User status update
     */
    public function userStatusUpdate(Request $request)
    {
        User::where('id', $request->id)->update([
            'status' => $request->status,
        ]);
        return redirect()->back();
    }
}
