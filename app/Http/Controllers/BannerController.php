<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    /**
     * Banner view
     */
    public function view()
    {
        $all_data = Banner::all();
        return view('admin.banner.view_banner', compact('all_data'));
    }

    /**
     * Banner add
     */
    public function add()
    {
        return view('admin.banner.add_banner');
    }
}
