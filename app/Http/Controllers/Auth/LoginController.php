<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(Request $request)
    {
        $this->validate($request, [
            'email'     => 'required',
            'password'  => 'required',
        ]);

        $email    = $request->email;
        $password = $request->password;

        $verify_email = User::where('email', $email)->first();
        $check_password = password_verify($password, $verify_email->password);
        //check email and password is not match
        if ($check_password == false) {
            return redirect()->back()->with('error', 'Email and password does not match!');
        }

        // if status is not active
        if ($verify_email->status == 0) {
            return redirect()->back()->with('error', 'Sorry! you do not verified yet.');
        }

        // if admin panel access unauthorised person 
        if ($verify_email->user_type == 'Customer') {
            return redirect()->back()->with('error', 'Sorry! you do not permission this panel! and do not try to be oversmart.');
        }

        // if email and password is match
        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            return redirect()->route('login')->with('success', 'Your are successfully login ): ');
        }
    }

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::ADMIN_DASH;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {
        //if user status is 0 then user logout the session
        if (Auth::user()->status == 0) {
            Auth::logout();
            return redirect()->back()->with('error', 'Sorry! Your acccount not varified!');
        }
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        if ($response = $this->loggedOut($request)) {
            return $response;
        }

        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect('/admin/login');
    }
}
