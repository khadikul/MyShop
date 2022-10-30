<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Coupon;
// use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function addToCart(Request $request){

        $productID = $request->post('productID');
        $product_price = $request->post('product_price');
        $validetProductQuantity = Cart::where('product_id', $productID)->where('user_ip', request()->ip())->first();

        if($validetProductQuantity){
            Cart::where('product_id', $productID)->increment('product_quantity');
            return redirect()->back()->with('cartMessage', 'Card Added');
        }else{
            $addToCart = new Cart();
            $addToCart->product_id = $productID;
            $addToCart->product_quantity = 1;
            $addToCart->product_price = $product_price;
            $addToCart->user_ip = request()->ip();
            $addToCart->save();

            return redirect()->back()->with('cartMessage', 'Card Added');
        }
    }

    public function cartPage(){
        $cartProduct = Cart::where('user_ip', request()->ip())->latest()->get();
    
        $total = Cart::all()->where('user_ip', request()->ip())->sum(function($e){
            return $e->product_price * $e->product_quantity;
        });
        return view('user.template-parts.cart', compact('cartProduct', 'total'));
    }

    public function cartProductDelete($id){
        $delete = Cart::where('user_ip', request()->ip())->where('id', $id);
        $delete->delete();

        return redirect()->back()->with('cartDelete', 'Cart Delete Success');
    }

    public function cartQuantityIncrease(Request $request){
        if($request->ajax()){
            $cartData = $request->all();
        
            $cartUpdate = Cart::where('id', $cartData['cartID'])->where('user_ip', request()->ip())->update([
                'product_quantity' =>  $cartData['productQuantity']+1,
            ]);
    
            return response()->json(['status' => 'Product Quantity Updated']);
        }
    }

    public function cartQuantityDecrease(Request $request){
        if($request->ajax()){
            $cartData = $request->all();
        
            $cartUpdate = Cart::where('id', $cartData['cartID'])->where('user_ip', request()->ip())->update([
                'product_quantity' =>  $cartData['productQuantity']-1,
            ]);
    
            return response()->json(['status' => 'Product Quantity Updated']);
        }
    }

    public function applyCoupon(Request $request){

        $request->validate([
            'coupon_name' => 'required',
        ]);
        $couponName = $request->post('coupon_name');

        $coupon = Coupon::where('coupon_name', $couponName)->first();
        if($coupon){
            Session::put('couponDiscount',[
                'coupon_name' => $coupon->coupon_name,
                'coupon_discount' => $coupon->coupon_discount,
            ]);
            return redirect()->back()->with('couponApply', 'Coupon Apply Success');
        }else{
            return redirect()->back()->with('couponInvalid', 'Youre Coupon Invalid');
        }

    }
}
