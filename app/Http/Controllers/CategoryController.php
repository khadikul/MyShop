<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Laravel\Ui\Presets\React;

class CategoryController extends Controller
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


    public function categoryPage(){
        
        $categoryItem = Category::latest()->get();

        return view('admin.category.category', compact('categoryItem'));
    }

    // ================category store database ===============
    public function saveCategory(Request $request){

        $request->validate([
            'category_name' => 'required|unique:categories,category_name',
        ]);

        $categoryName = $request->post('category_name');

        $saveCategory = new Category();
        $saveCategory->category_name = $categoryName;
        $saveCategory->save();

        return redirect()->back()->with('sucessMessage', 'Category Added Succesful');
    }

    // ====================category update ========================
    public function editCategory($id){

        $editCategory = Category::find($id);

        return view('admin.category.category-edit', compact('editCategory'));
    }

    public function updateCategory(Request $request){

        $request->validate([
            'updateCategory_name' => 'required',
        ]);

        $categoryID = $request->post('categoriesID');
        $categoryName = $request->post('updateCategory_name');
        $saveCategory = Category::find($categoryID);
        $saveCategory->category_name = $categoryName;
        $saveCategory->save();

        return redirect()->route('product.category')->with('updateSuccess', "Categorty ". $categoryName ." Success");
    }

    public function deleteCategory($id){
        $deleteCategory = Category::find($id);

        $deleteCategory->delete();

        return redirect()->back()->with('updateSuccess', 'Category Delete Success');
    }


}
