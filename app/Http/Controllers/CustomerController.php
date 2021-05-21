<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use App\Mail\CustomerRegistationConfirmationMail;
use App\Mail\SuccessAccountActivatedMail;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    /**
     * Customer login registation page
     */
    public function loginRegistationPage()
    {
        return view('wayshop.customer.login_registation_page');
    }

    /**
     * Customer register store
     */
    public function customerRegisterStore(Request $request)
    {
        $this->validate($request, [
            'name'     => 'required',
            'email'    => 'required',
            'password' => 'required',
        ]);

        User::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => password_hash($request->password, PASSWORD_DEFAULT),
            'user_type' => 'Customer',
        ]);

        //data send by email
        $email_data = [
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => $request->password,
            'code'      => base64_encode($request->email)
        ];

        Mail::to($request->email)->send(new CustomerRegistationConfirmationMail($email_data));

        //if email confirmation is not activated then redirect back
        return redirect()->back()->with('error', 'Please confirm your email to activate your account!');

        //if email is varified then login and redirect to cart
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'user_type' => 'Customer'])) {
            //when customer is successfully login email put session
            Session::put('front_login_session', $request->email);
            return redirect()->route('cart')->with('success', 'Your are successfully login ): ');
        } else {

            return redirect()->back()->with('error', 'Credintial do not match!');
        }
    }

    /**
     * Customer registation email confirm account
     */
    public function customerRegistationEmailConfirm($code)
    {
        $user_email = base64_decode($code);
        $data = User::where('email', $user_email)->first();
        if ($data != NULL) {
            if ($data->status == 1) {
                return redirect()->back()->with('error', 'Your are account already activated! Please you simply login.');
            } else {
                //status update
                User::where('email', $user_email)->update(['status' => 1]);
                //congratulation message send by custome when account is successfully activated
                $email_data = [
                    'name' => $data->name,
                    'email' => $data->email,
                    'password' => $data->password,
                ];
                Mail::to($data->email)->send(new SuccessAccountActivatedMail($email_data));

                return redirect()->route('login.registation.page')->with('success', 'Congrats! your account is activated): ');
            }
        } else {
            return redirect()->route('login.registation.page')->with('error', 'Sorry! does not found any data!');
        }
    }

    /**
     * Customer login 
     */
    public function customerLogin(Request $request)
    {
        $this->validate($request, [
            'email'    => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'user_type' => 'Customer'])) {
            $data = User::where('email', $request->email)->first();
            //check status active or not
            if ($data->status == 0) {
                return redirect()->back()->with('error', 'Your account is not activated! Please confirm your email to active your account.');
            } else {
                //when customer is successfully login email put session
                Session::put('front_login_session', $request->email);
                return redirect()->route('cart')->with('success', 'You are successfully login ): ');
            }
        } else {
            return redirect()->back()->with('error', 'Your email and password does not match!');
        }
    }

    /**
     * Customer account
     */
    public function customerAccount()
    {
        return view('wayshop.customer.customer_account');
    }

    /**
     * Customer address edit page
     */
    public function customerAddressEdit()
    {
        $customer_email = Auth::user()->email;
        $data = User::where('email', $customer_email)->first();
        $countries = DB::table('countries')->get();
        return view('wayshop.customer.customer_address_edit', compact('data', 'countries'));
    }

    /**
     * Customer address update 
     */
    public function customerAddressUpdate(Request $request, $id)
    {
        $data = User::find($id);
        if ($data != NULL) {
            $this->validate($request, [
                'name'    => 'required',
                'address' => 'required',
                'city'    => 'required',
                'state'   => 'required',
                'country' => 'required',
                'pincode' => 'required',
                'mobile'  => 'required',
            ]);

            $data->name = $request->name;
            $data->address = $request->address;
            $data->city = $request->city;
            $data->state = $request->state;
            $data->country = $request->country;
            $data->pincode = $request->pincode;
            $data->mobile = $request->mobile;
            $data->update();

            return redirect()->route('customer.account')->with('success', 'Customer account updated successfully ): ');
        }
    }

    /**
     * Customer change password
     */
    public function customerChangePassword()
    {
        return view('wayshop.customer.customer_change_password');
    }

    /**
     * Customer password update
     */
    public function customerPasswordUpdate(Request $request)
    {
        $data = User::find(Auth::id());
        if (Auth::attempt(['email' => $data->email, 'password' => $request->old_password])) {
            $data->password = password_hash($request->new_password, PASSWORD_DEFAULT);
            $data->update();
            return redirect()->route('customer.account')->with('success', 'Customer password successfully updated ): ');
        } else {
            return redirect()->back()->with('error', 'Email and password does not match!');
        }
    }
}
