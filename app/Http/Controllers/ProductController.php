<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\ProductBrand;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function allProduct(){
        return view('admin.product.all-product');
    }

    public function addNew(){
        $category = Category::get();
        $brand = ProductBrand::get();
        return view('admin.product.addnew', compact('category', 'brand'));
    }
}
