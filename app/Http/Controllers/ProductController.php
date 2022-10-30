<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductBrand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
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

    public function allProduct(){
        $product = Product::latest()->get();
        return view('admin.product.all-product', compact('product'));
    }

    public function addNew(){
        $category = Category::get();
        $brand = ProductBrand::get();
        return view('admin.product.addnew', compact('category', 'brand'));
    }

    /**
     * 
     * Product Insert Deatabase
     * 
     */

    public function addProduct(Request $request){
        $request->validate([
            'product_name'           => 'required',
            'product_descripton'     => 'required',
            'product_shortdes'       => 'required',
            'regular_price'          => 'required',
            'product_stock'          => 'required',
            'product_gallery_imgOne' => 'required|mimes:png,jpg,jpeg,webp,gif,svg',
            'product_gallery_imgTwo' => 'required|mimes:png,jpg,jpeg,webp,gif,svg',
            'product_gallery_imgThree' => 'mimes:png,jpg,jpeg,webp,gif,svg',
            'product_gallery_imgFour' => 'mimes:png,jpg,jpeg,webp,gif,svg',
            'productCategory'        => 'required',
            'future_image'           => 'required|mimes:png,jpg,jpeg,webp,gif,svg'
        ],[
            'product_shortdes.required'  => 'product short description required',
        ]);

        $productName = $request->post('product_name');
        $productDescription = $request->post('product_descripton');
        $productShortDescription = $request->post('product_shortdes');
        $productRegularPrice = $request->post('regular_price');
        $productSalePrice = $request->post('sale_price');
        $productSku = $request->post('product_sku');
        $productQuantity = $request->post('product_quantity');
        $productStock = $request->post('product_stock');
        $productCategory = $request->post('productCategory');
        $productBrand = $request->post('productBrand');

        //future image
        if($request->hasFile('future_image')){
            $futureImage = $request->file('future_image');
            $imageName = hexdec(uniqid()).'.'.$futureImage->getClientoriginalExtension();
            $futureImage->move('upload', $imageName);
        }

        //image gallery
        if($request->hasFile('product_gallery_imgOne')){
            $galleyImgOne = $request->file('product_gallery_imgOne');
            $galleryImgNameOne = hexdec(uniqid()).'.'.$galleyImgOne->getClientoriginalExtension();
            $galleyImgOne->move('upload', $galleryImgNameOne);
        }

        if($request->hasFile('product_gallery_imgTwo')){
            $galleyImgTwo = $request->file('product_gallery_imgTwo');
            $galleryImgNameTwo = hexdec(uniqid()).'.'.$galleyImgTwo->getClientoriginalExtension();
            $galleyImgTwo->move('upload', $galleryImgNameTwo);
        }

        if($request->hasFile('product_gallery_imgThree')){
            $galleyImgThree = $request->file('product_gallery_imgThree');
            $galleryImgNameThree = hexdec(uniqid()).'.'.$galleyImgThree->getClientoriginalExtension();
            $galleyImgThree->move('upload', $galleryImgNameThree);
        }else{
            $galleryImgNameThree = NULL;
        }

        if($request->hasFile('product_gallery_imgFour')){
            $galleyImgFour = $request->file('product_gallery_imgFour');
            $galleryImgNameFour = hexdec(uniqid()).'.'.$galleyImgFour->getClientoriginalExtension();
            $galleyImgFour->move('upload', $galleryImgNameFour);
        }else{
            $galleryImgNameFour = NULL;
        }

        $product = new Product();

        $product->product_name              = $productName;
        $product->product_slug              = str_replace(' ', '-', $productName);
        $product->product_description       = $productDescription;
        $product->product_short_tdescripton	= $productShortDescription;
        $product->product_category          = $productCategory;
        $product->category_brand            = $productBrand;
        $product->product_regular_price     = $productRegularPrice;
        $product->product_sale_price        = $productSalePrice;
        $product->product_sku               = $productSku;
        $product->product_quantity          = $productQuantity;
        $product->product_stock             = $productStock;
        $product->product_future_image      = $imageName;
        $product->product_gallery_img1      = $galleryImgNameOne;
        $product->product_gallery_img2      = $galleryImgNameTwo;
        $product->product_gallery_img3      = $galleryImgNameThree;
        $product->product_gallery_img4      = $galleryImgNameFour;

        if($request->has('publish')){
            $product->post_status = 'publish';
        }else{
            $product->post_status = 'Draft';
        }

        $product->save();

        return redirect()->back()->with('SuccessMessage', 'Product Added SuccessFul');

    }

    /**
     * 
     * 
     * Product Edit & Delete
     * 
     */

    public function productEdit($id){
        $product = Product::find($id);
        $category = Category::get();
        $brand = ProductBrand::get();
        return view('admin.product.edite', compact('product', 'category', 'brand'));
    }

    public function updateProduct(Request $request){

        $request->validate([
            'product_gallery_imgOne'    => 'mimes:png,jpg,jpeg,webp,gif,svg',
            'product_gallery_imgTwo'    => 'mimes:png,jpg,jpeg,webp,gif,svg',
            'product_gallery_imgThree'  => 'mimes:png,jpg,jpeg,webp,gif,svg',
            'product_gallery_imgFour'   => 'mimes:png,jpg,jpeg,webp,gif,svg',
            'future_image'              => 'mimes:png,jpg,jpeg,webp,gif,svg'
        ]);

        $productID = $request->post('productID');
        $productNameUpdate = $request->post('product_name_update');
        $productDescriptionUpdate = $request->post('product_descripton_update');
        $productShortDescriptionUpdate = $request->post('product_shortdes_update');
        $productRegularPriceUpdate = $request->post('regular_price_update');
        $productSalePriceUpdate = $request->post('sale_price_update');
        $productSkuUpdate = $request->post('product_sku_update');
        $productQuantityUpdate = $request->post('product_quantity_update');
        $productStockUpdate = $request->post('product_stock_update');
        $productCategoryUpdate = $request->post('productCategory_update');
        $productBrandUpdate = $request->post('productBrand_update');

        //old image
        $img1 = $request->post('old_image1');
        $img2 = $request->post('old_image2');
        $img3 = $request->post('old_image3');
        $img4 = $request->post('old_image4');
        $futureImg = $request->post('old_futureImg');

        //future image update
        if($request->hasFile('future_image_update')){
            
            $futureImgPath = 'upload/'.$futureImg;
            if(File::exists($futureImgPath)){
                File::delete($futureImgPath);
            }

            $updateFutureImage = $request->file('future_image_update');
            $updateFutureImgName = hexdec(uniqid()).'.'.$updateFutureImage->getClientoriginalExtension();
            $updateFutureImage->move('upload', $updateFutureImgName);
        }else{
            $updateFutureImgName = $futureImg;
        }

        // ======================Gallery Image Update ============

        if($request->hasFile('product_gallery_imgOne_update')){
            $galleryImgPath1 = 'upload/'.$img1;
            if(File::exists($galleryImgPath1)){
                File::delete($galleryImgPath1);
            }
            
            $galleryImgOneUpdate = $request->file('product_gallery_imgOne_update');
            $galleryImgNameOneUpdate = hexdec(uniqid()).'.'.$galleryImgOneUpdate->getClientoriginalExtension();
            $galleryImgOneUpdate->move('upload', $galleryImgNameOneUpdate);
        }else{
            $galleryImgNameOneUpdate = $img1;
        }

        if($request->hasFile('product_gallery_imgTwo_update')){
            
            $galleryImgPath2 = 'upload/'.$img2;
            if(File::exists($galleryImgPath2)){
                File::delete($galleryImgPath2);
            }
            
            $galleryImgTwoUpdate = $request->file('product_gallery_imgTwo_update');
            $galleryImgNameTwoUpdate = hexdec(uniqid()).'.'.$galleryImgTwoUpdate->getClientoriginalExtension();
            $galleryImgTwoUpdate->move('upload', $galleryImgNameTwoUpdate);
        }else{
            $galleryImgNameTwoUpdate = $img2;
        }

        if($request->hasFile('product_gallery_imgThree_update')){
            $galleryImgPath3 = 'upload/'.$img3;
            if(File::exists($galleryImgPath3)){
                File::delete($galleryImgPath3);
            }
            
            $galleryImgThreeUpdate = $request->file('product_gallery_imgThree_update');
            $galleryImgNameThreeUpdate = hexdec(uniqid()).'.'.$galleryImgThreeUpdate->getClientoriginalExtension();
            $galleryImgThreeUpdate->move('upload', $galleryImgNameThreeUpdate);
        }else{
            $galleryImgNameThreeUpdate = $img3;
        }

        if($request->hasFile('product_gallery_imgFour_update')){
            $galleryImgPath4 = 'upload/'.$img4;
            if(File::exists($galleryImgPath4)){
                File::delete($galleryImgPath4);
            }

            $galleryImgFourUpdate = $request->file('product_gallery_imgFour_update');
            $galleryImgNameFourUpdate = hexdec(uniqid()).'.'.$galleryImgFourUpdate->getClientoriginalExtension();
            $galleryImgFourUpdate->move('upload', $galleryImgNameFourUpdate);
        }else{
            $galleryImgNameFourUpdate = $img4;
        }

        $product = Product::find($productID);

        $product->product_name              = $productNameUpdate;
        $product->product_slug              = str_replace(' ', '-', $productNameUpdate);
        $product->product_description       = $productDescriptionUpdate;
        $product->product_short_tdescripton	= $productShortDescriptionUpdate;
        $product->product_category          = $productCategoryUpdate;
        $product->category_brand            = $productBrandUpdate;
        $product->product_regular_price     = $productRegularPriceUpdate;
        $product->product_sale_price        = $productSalePriceUpdate;
        $product->product_sku               = $productSkuUpdate;
        $product->product_quantity          = $productQuantityUpdate;
        $product->product_stock             = $productStockUpdate;
        $product->product_future_image      = $updateFutureImgName;
        $product->product_gallery_img1      = $galleryImgNameOneUpdate;
        $product->product_gallery_img2      = $galleryImgNameTwoUpdate;
        $product->product_gallery_img3      = $galleryImgNameThreeUpdate;
        $product->product_gallery_img4      = $galleryImgNameFourUpdate;

        if($request->has('publish')){
            $product->post_status = 'publish';
        }

        $product->save();

        return redirect()->route('admin.product')->with('updatesuccess', 'Product Update SuccessFull');
    }

    public function deleteProduct($id){
        $deleteProduct = Product::find($id);
        $image1 = $deleteProduct->product_future_image;
        $image2 = $deleteProduct->product_gallery_img1;
        $image3 = $deleteProduct->product_gallery_img2;
        $image4 = $deleteProduct->product_gallery_img3;
        $image5 = $deleteProduct->product_gallery_img4;
        $image1Path = 'upload/'.$image1;
        if(File::exists($image1Path)){
            File::delete($image1Path);
        }

        $image2Path = 'upload/'.$image2;
        if(File::exists($image2Path)){
            File::delete($image2Path);
        }

        $image3Path = 'upload/'.$image3;
        if(File::exists($image3Path)){
            File::delete($image3Path);
        }

        $image4Path = 'upload/'.$image4;
        if(File::exists($image4Path)){
            File::delete($image4Path);
        }

        $image5Path = 'upload/'.$image5;
        if(File::exists($image5Path)){
            File::delete($image5Path);
        }

        $deleteProduct->delete();

        return redirect()->back()->with('updatesuccess', 'Product Delete SuccessFull');
    }
}
