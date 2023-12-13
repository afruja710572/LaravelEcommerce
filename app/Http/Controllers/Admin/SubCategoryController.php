<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    public function index()
    {
        $allsubcategories = Subcategory::latest()->get();
        return view("admin.allSubCategory", compact('allsubcategories'));
    }
    public function AddSubCategory()
    {
        $categories = Category::latest() -> get();
        return view("admin.addSubCategory", compact('categories'));
    }
    public function StoreSubCategory(Request $request)
    {
        $request->validate([
            'subcategory_name' => 'required|unique:sub_categories','category_id'=>'required'
        ]);

        $category_id = $request->category_id;

        $category_name = category::where('id',$category_id)->value('category_name');

        Subcategory::insert([
            'subcategory_name' => $request->subcategory_name,
            'slug' => strtolower(str_replace(' ','-',$request->subcategory_name)),
            'category_id' => $category_id,
            'category_name' => $category_name
        ]);

        Category::where('id',$category_id)->increment('subcategory_count',1);

        return redirect()->route('allSubCategory')->with('message', 'Sub Category Added Successfully!');
    }
    public function Editsubcat($id)
    {
        $sub_category_info = Subcategory::findOrFail($id);
        $categories = Category::latest() -> get();
        return view('admin.editSubcategory', compact('sub_category_info','categories')) ;
    }
    public function UpdateSubCategory(Request $request)
    {
        $sub_category_id = $request->subcatid;
       
        $request->validate([
            'subcategory_name' => 'required|unique:sub_categories','category_id'=>'required'
        ]);

        $category_id = $request->category_id;

        $category_name = category::where('id',$category_id)->value('category_name');

        Subcategory::findOrFail($sub_category_id)->update([
            'subcategory_name' => $request->subcategory_name,
            'slug' => strtolower(str_replace(' ','-',$request->subcategory_name)),
            'category_id' => $category_id,
            'category_name' => $category_name
        ]);
        return redirect()->route('allSubCategory')->with('message', 'Sub Category Updated Successfully!');
    }
    public function Deletesubcat($id){
        $sub_category = Subcategory::findOrFail($id);
        $category_id = $sub_category->category_id;
        Category::where('id',$category_id)->decrement('subcategory_count',1);
        $sub_category->delete();
        return redirect()->route('allSubCategory')->with('message', 'Sub Category Deleted Successfully!');
    }
}
