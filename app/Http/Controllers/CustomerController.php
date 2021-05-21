<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Customer login registation page
     */
    public function loginRegistationPage()
    {
        return view('wayshop.customer.login_registation_page');
    }
}
