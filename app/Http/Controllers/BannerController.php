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

    /**
     * Banner status update
     */
    public function statusUpdate(Request $request)
    {
        Banner::where('id', $request->id)->update([
            'status' => $request->status
        ]);
        return redirect()->back();
    }

    /**
     * Banner delete
     */
    public function delete($id)
    {
        $data = Banner::find($id);
        if ($data != NULL) {
            $data->delete();
            if (file_exists('uploads/banners/' . $data->image) && !empty($data->image)) {
                unlink('uploads/banners/' . $data->image);
            }
            return redirect()->back()->with('success', 'Banner deleted successfully ): ');
        } else {
            return redirect()->back()->with('error', 'Sorry! does not found any data');
        }
    }

    /**
     * Banner edit 
     */
    public function edit($id)
    {
        $data = Banner::find($id);
        return view('admin.banner.edit_banner', compact('data'));
    }

    /**
     * Banner update
     */
    public function update(Request $request, $id)
    {
        $data = Banner::find($id);
        if ($data != NULL) {
            $this->validate($request, [
                'title'      => 'required',
                'sub_title'  => 'required',
                'text_style' => 'required',
                'sort_order' => 'required',
                'link'       => 'required',
            ]);

            // Upload banner image 
            $image_unique_name = '';
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $image_unique_name = rand(0000, 9999) . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/banners/'), $image_unique_name);
                if (file_exists('uploads/banners/' . $data->image) && !empty($data->image)) {
                    unlink('uploads/banners/' . $data->image);
                }
            } else {
                $image_unique_name = $data->image;
            }

            $data->title      = $request->title;
            $data->sub_title  = $request->sub_title;
            $data->text_style = $request->text_style;
            $data->sort_order = $request->sort_order;
            $data->link       = $request->link;
            $data->image      = $image_unique_name;
            $data->update();

            return redirect()->route('banners.view')->with('success', 'Banner updated successfully ): ');
        }
    }
}
