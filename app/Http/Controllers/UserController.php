<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

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
            'email'      => "required | unique:users,email",
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

    /**
     * User delete
     */
    public function userDelete($id)
    {
        $user = User::find($id);
        if ($user != NULL) {
            if (file_exists('uploads/users/' . $user->photo) && !empty($user->photo)) {
                unlink('uploads/users/' . $user->photo);
            }
            $user->delete();
        } else {
            return redirect()->back()->with('error', 'Sorry! User is not found! ');
        }
        return redirect()->back()->with('success', 'User deleted successfully ): ');
    }

    /**
     * User edit
     */
    public function userEdit($id)
    {
        $data = User::find($id);
        return view('admin.users.edit', compact('data'));
    }

    /**
     * User update
     */
    public function userUpdate(Request $request, $id)
    {
        $data = User::find($id);
        if ($data != NULL) {
            $this->validate($request, [
                'name'      => 'required',
                'email'     => 'required | unique:users,email,' . $data->id,
                'user_type' => 'required',
            ]);

            $data->name = $request->name;
            $data->email = $request->email;
            $data->user_type = $request->user_type;
            $data->update();

            return redirect()->route('admin.users')->with('success', 'Data updated successfully ): ');
        } else {
            return redirect()->back()->with('error', 'Sorry! data not found. ');
        }
    }

    /**
     * User Profile View
     */
    public function profileView()
    {
        $user_id = Auth::id();
        $data = User::find($user_id);
        return view('admin.users.user_profile', compact('data'));
    }

    /**
     * User profile edit
     */
    public function profileEdit($id)
    {
        $data = User::find($id);
        return view('admin.users.user_profile_edit', compact('data'));
    }

    /**
     * User profile update
     */
    public function profileUpdate(Request $request, $id)
    {
        $data = User::find($id);
        if ($data != NULL) {
            $this->validate($request, [
                'name'    => 'required',
                'email'   => 'required | unique:users,email,' . $data->id,
                'mobile'  => 'required',
                'address' => 'required',
                'city'    => 'required',
                'state'   => 'required',
                'country' => 'required',
                'pincode' => 'required',
            ]);

            $unique_image_name = '';
            //photo unique name and  upload directory
            if ($request->hasFile('photo')) {
                $image = $request->file('photo');
                $unique_image_name = md5(time() . rand()) . '.' . $image->getClientOriginalExtension();
                Image::make($image)->save('uploads/users/' . $unique_image_name);
                $image->move(public_path('uploads/users/'), $unique_image_name);
                if (file_exists('uploads/users/' . $request->photo) && !empty($data->photo)) {
                    unlink('uploads/users/' . $request->photo);
                }
            } else {
                $unique_image_name = $data->photo;
            }

            $data->name = $request->name;
            $data->email = $request->email;
            $data->mobile = $request->mobile;
            $data->address = $request->address;
            $data->city = $request->city;
            $data->state = $request->state;
            $data->country = $request->country;
            $data->pincode = $request->pincode;
            $data->photo = $unique_image_name;
            $data->update();

            return redirect()->back()->with('success', 'User profile updated successfully ): ');
        }
    }
}
