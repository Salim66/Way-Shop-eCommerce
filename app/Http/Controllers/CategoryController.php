<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Categories view page
     */
    public function view()
    {
        $categories = Category::where('status', 1)->get();
        return view('admin.category.view_category', compact('categories'));
    }

    /**
     * Categories add
     */
    public function add()
    {
        $categories = Category::where('status', 1)->get();
        return view('admin.category.add_category', compact('categories'));
    }

    /**
     * Categories store
     */
    public function store(Request $request)
    {
        return $request->all();
    }
}
