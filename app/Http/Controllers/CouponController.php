<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    /**
     * View Coupons
     */
    public function view()
    {
        $all_data = Coupon::all();
        return view('admin.coupon.view_coupon', compact('all_data'));
    }

    /**
     * Add Coupons page
     */
    public function add()
    {
        return view('admin.coupon.add_coupon');
    }
}
