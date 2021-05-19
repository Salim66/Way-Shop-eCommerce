<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    /**
     * Frontend index page
     */
    public function index()
    {
        $categories = Category::withCount('products')->with('categories')->where('parent_id', null)->get();
        dd($categories->toArray());
        return view('wayshop.index', compact('categories'));
    }
}
