<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Categories view page
     */
    public function view()
    {
        $categories = Category::latest()->get();
        return view('admin.category.view_category', compact('categories'));
    }

    /**
     * Categories add
     */
    public function add()
    {
        $categories = Category::latest()->get();
        return view('admin.category.add_category', compact('categories'));
    }

    /**
     * Categories store
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'        => 'required | unique:categories,name',
            'description' => 'required',
        ]);

        Category::create([
            'parent_id'   => $request->parent_id,
            'name'        => $request->name,
            'slug'        => Str::slug($request->name),
            'description' => $request->description,
        ]);

        return redirect()->back()->with('success', 'Category added successfully ): ');
    }

    /**
     * Categories status update
     */
    public function statusUpdate(Request $request)
    {
        Category::where('id', $request->id)->update([
            'status' => $request->status,
        ]);
        return redirect()->back();
    }

    /**
     * Categories delete
     */
    public function delete($id)
    {
        $data = Category::find($id);
        if ($data != NULL) {
            $data->delete();
        } else {
            return redirect()->back()->with('error', 'Sorry! do not found any data.');
        }
        return redirect()->back()->with('success', 'Category deleted successfully ):');
    }
}
