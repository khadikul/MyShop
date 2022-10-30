<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function publicHome(){
        
        $products = Product::where('post_status', 'publish')->latest()->get();
        return view('user.home', compact('products'));
    }

    public function shopPage(){
        $saleProduct = Product::where('post_status', 'publish')->where('product_sale_price', '!=', '')->latest()->get();
        $products = Product::where('post_status', 'publish')->latest()->paginate(9);
        return view('user.template-parts.shop', compact('saleProduct', 'products'));
    }
}
