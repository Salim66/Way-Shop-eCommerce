<?php

namespace App\Http\Controllers;

use App\Models\Pages;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PagesController extends Controller
{
    /**
     * Pages view
     */
    public function view()
    {
        $all_data = Pages::latest()->get();
        return view('admin.pages.view_pages', compact('all_data'));
    }

    /**
     * Pages add
     */
    public function add()
    {
        return view('admin.pages.add_pages');
    }

    /**
     * Pages store
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'page_name'        => 'required',
            'meta_title'       => 'required',
            'meta_keywords'    => 'required',
            'meta_description' => 'required',
            'short_content'    => 'required',
            'long_content'     => 'required',
        ]);

        // upload content image
        $content_image = '';
        if ($request->hasFile('content_image')) {
            $image = $request->file('content_image');
            $content_image = md5(time() . rand()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->save('uploads/contents/' . $content_image);
            $image->move(public_path('uploads/contents/'), $content_image);
        } else {
            $content_image = '';
        }

        // upload banner image
        $banner_image = '';
        if ($request->hasFile('banner_image')) {
            $image = $request->file('banner_image');
            $banner_image = md5(time() . rand()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->save('uploads/banners/' . $banner_image);
            $image->move(public_path('uploads/banners/'), $banner_image);
        } else {
            $banner_image = '';
        }

        Pages::create([
            'page_name'        => $request->page_name,
            'slug'             => Str::slug($request->page_name),
            'meta_title'       => $request->meta_title,
            'meta_keywords'    => $request->meta_keywords,
            'meta_description' => $request->meta_description,
            'short_content'    => $request->short_content,
            'long_content'     => $request->long_content,
            'content_image'    => $content_image,
            'banner_image'     => $banner_image,
        ]);

        return redirect()->back()->with('success', 'Pages added succesfully ): ');
    }
}
