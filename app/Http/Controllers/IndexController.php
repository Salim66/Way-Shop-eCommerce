<?php

namespace App\Http\Controllers;

use App\Models\Banner;
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
        $products = Product::where('status', 1)->latest()->paginate(6);
        $banners = Banner::all();
        return view('wayshop.index', compact('categories', 'products', 'banners'));
    }

    /**
     * Frontend single proudct
     */
    public function singleProduct($slug)
    {
        $data = Product::where('slug', $slug)->first();
        return view('wayshop.single_product', compact('data'));
    }

    /**
     * Product search
     */
    public function productSearch(Request $request)
    {
        $search = $request->search;
        $products = Product::where('name', 'LIKE', '%' . $search . '%')->paginate(6);
        $categories = Category::whereNULL('parent_id')->with(['categories' => function ($query) {
            $query->withCount('products');
        }])->get();
        $banners = Banner::all();
        return view('wayshop.search', compact('products', 'categories', 'banners'));
    }
    /**
     * Product search
     */
    public function productCategoryWiseSearch($slug)
    {
        $category = Category::where('slug', $slug)->first();
        $products = Product::where('category_id', $category->id)->paginate(6);
        $categories = Category::whereNULL('parent_id')->with(['categories' => function ($query) {
            $query->withCount('products');
        }])->get();
        $banners = Banner::all();
        return view('wayshop.category_wise_search', compact('products', 'categories', 'banners'));
    }
}
