<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = category::latest()->get();
        return view("admin.allCategory",compact('categories'));
    }
    public function AddCategory()
    {
        return view("admin.addCategory");
    }
    public function StoreCategory(Request $request){
        $request->validate([
            'category_name' => 'required|unique:categories'
        ]);
        
        Category::insert([
            'category_name' => $request->category_name,
            'slug' => strtolower(str_replace(' ','-',$request->category_name))
        ]);
    
        return redirect()->route('allCategory')->with('message', 'Category Added Successfully!');
    }
}

