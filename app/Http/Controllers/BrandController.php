<?php

namespace App\Http\Controllers;

use App\Models\ProductBrand;
use Illuminate\Http\Request;
use Laravel\Ui\Presets\React;

class BrandController extends Controller
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

    public function productBrand(){
        $productBrand = ProductBrand::latest()->get();

        return view('admin.brand.product-brand', compact('productBrand'));
    }

    public function saveBrand(Request $request){
        $request->validate([
            'brandName' => 'required',
        ]);

        $brandName = $request->post('brandName');

        $brandDB = new ProductBrand();
        $brandDB->brand_name = $brandName;
        $brandDB->save();

        return redirect()->back()->with('successMessage', 'Brand Add Successfull');
    }

    public function editBrand($id){
        $editBrand = ProductBrand::find($id);
        return view('admin.brand.brand-edit', compact('editBrand'));
    }

    public function updateBrand(Request $request){
        $request->validate([
            'updateBrand_name' => 'required',
        ]);

        $brandName = $request->post('updateBrand_name');
        $brandID = $request->post('brandID');

        $brandDB = ProductBrand::find($brandID);
        $brandDB->brand_name = $brandName;
        $brandDB->save();

        return redirect()->route('product.brand')->with('updateSuccess', "Brand ". $brandName ." Success");
        
    }

    public function deleteBrand($id){
        $deleteBrand  = ProductBrand::find($id);
        $deleteBrand->delete();

        return redirect()->back()->with('updateSuccess', 'Product Delete Success');
    }
}
