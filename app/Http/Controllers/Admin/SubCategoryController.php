<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    public function index()
    {
        return view("admin.allSubCategory");
    }
    public function AddSubCategory()
    {
        return view("admin.addSubCategory");
    }
}
