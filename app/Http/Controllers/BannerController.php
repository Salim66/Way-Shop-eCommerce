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

    /**
     * Banner store
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title'      => 'required',
            'sub_title'  => 'required',
            'text_style' => 'required',
            'sort_order' => 'required',
            'link'       => 'required',
        ]);

        // Upload banner image directory 
        $image_unique_name = '';
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_unique_name = rand(0000, 9999) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/banners/'), $image_unique_name);
        }

        Banner::create([
            'title'      => $request->title,
            'sub_title'  => $request->sub_title,
            'text_style' => $request->text_style,
            'sort_order' => $request->sort_order,
            'link'       => $request->link,
            'image'      => $image_unique_name,
        ]);

        return redirect()->back()->with('success', 'Banner added successfully ): ');
    }
}
