<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    /**
     * Frontend index page
     */
    public function index()
    {
        // $categories = Category::where('parent_id', null)->get();

        $categories = Category::whereNULL('parent_id')->with(['categories' => function ($query) {
            $query->withCount('products');
        }])->get();
        $products = Product::where('status', 1)->latest()->get();
        return view('wayshop.index', compact('categories', 'products'));
    }
}
