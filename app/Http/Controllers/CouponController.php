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

    /**
     * Store coupon 
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'coupon_code' => 'required | unique:coupons,coupon_code',
            'amount'      => 'required',
            'amount_type' => 'required',
            'expiry_date' => 'required',
        ]);

        Coupon::create([
            'coupon_code' => $request->coupon_code,
            'amount' => $request->amount,
            'amount_type' => $request->amount_type,
            'expiry_date' => $request->expiry_date,
        ]);

        return redirect()->back()->with('success', 'Coupon added successfully ); ');
    }
}
