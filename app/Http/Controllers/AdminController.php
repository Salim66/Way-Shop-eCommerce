<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Admin register page
     */
    public function register()
    {
        return view('admin.users.register');
    }

    /**
     * Admin login page
     */
    public function login()
    {
        return view('admin.users.login');
    }

    /**
     * Admin dashboard page
     */
    public function dashboard()
    {
        return view('admin.dashboard.dashboard');
    }
}
