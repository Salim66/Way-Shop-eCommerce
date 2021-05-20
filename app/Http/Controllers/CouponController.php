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

    /**
     * Coupon status update
     */
    public function statusUpdate(Request $request)
    {
        Coupon::where('id', $request->id)->update([
            'status' => $request->status
        ]);

        return redirect()->back();
    }

    /**
     * Coupon delete
     */
    public function delete($id)
    {
        $data = Coupon::find($id);
        if ($data != NULL) {
            $data->delete();
            return redirect()->back()->with('success', 'Coupon deleted successfully ): ');
        }
    }

    /**
     * Coupon edit page
     */
    public function edit($id)
    {
        $data = Coupon::find($id);
        return view('admin.coupon.edit_coupon', compact('data'));
    }

    /**
     * Coupon update
     */
    public function update(Request $request, $id)
    {
        return $request->all();
    }
}
