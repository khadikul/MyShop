<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
    * Create a new controller instance.
    *
    * @return void
    */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function adminHome(){
        return view('admin.main');
    }

    public function Coupon(){
        $coupon = Coupon::latest()->get();
        return view('admin.coupon.coupon', compact('coupon'));
    }

    public function couponSubmit(Request $request){
        $couponName = $request->post('coupon_name');
        $couppnDiscount = $request->post('coupon_discount');

        $request->validate([
            'coupon_name' => 'required',
            'coupon_discount' => 'required',
        ]);

        $coupon = new Coupon();
        $coupon->coupon_name = $couponName;
        $coupon->coupon_discount = $couppnDiscount;
        $coupon->save();

        return redirect()->back()->with('couponSuccess', 'Coupon Added Success');
    }

    public function couponDelete($id){
        $coupon =  Coupon::find($id);
        $coupon->delete();

        return redirect()->back()->with('couponDelete', 'Coupon Delete');
    }
}
