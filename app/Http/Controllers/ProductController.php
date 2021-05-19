<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Products view
     */
    public function view()
    {
        $all_data = Product::latest()->get();
        return  view('admin.product.view_product', compact('all_data'));
    }
}
