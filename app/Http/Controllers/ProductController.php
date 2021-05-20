<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\ProductAttribute;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use GuzzleHttp\Promise\Create;
use Intervention\Image\Facades\Image;

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

    /**
     * Product add 
     */
    public function add()
    {
        $categories = Category::where('status', 1)->where('parent_id', '!=', null)->latest()->get();
        return view('admin.product.add_product', compact('categories'));
    }

    /**
     * Product Store
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'category_id' => 'required',
            'name'        => 'required | unique:users,name',
            'code'        => 'required',
            'color'       => 'required',
            'description' => 'required',
            'price'       => 'required',
        ]);

        // product image upload directory and resize photo
        $image_unique_name = '';
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_unique_name = md5(time() . rand()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(260, 420)->save('uploads/products/' . $image_unique_name);
            $image->move(public_path('uploads/products/'), $image_unique_name);
        }

        Product::create([
            'category_id' => $request->category_id,
            'name'        => $request->name,
            'slug'        => Str::slug($request->name),
            'code'        => $request->code,
            'color'       => $request->color,
            'description' => $request->description,
            'price'       => $request->price,
            'image'       => $image_unique_name,
        ]);

        return redirect()->route('products.view')->with('success', 'Product added successfully ): ');
    }

    /**
     * Product status update
     */
    public function statusUpdate(Request $request)
    {
        Product::where('id', $request->id)->update([
            'status' => $request->status,
        ]);
        return redirect()->back();
    }

    /**
     * Featured product status update
     */
    public function featuredProductStatusUpdate(Request $request)
    {
        Product::where('id', $request->id)->update([
            'featured_product' => $request->status
        ]);
        return redirect()->back();
    }

    /**
     * Porudct delete
     */
    public function delete($id)
    {
        $data = Product::find($id);
        if ($data != NULL) {
            $data->delete();
            if (file_exists('uploads/products/' . $data->image) && !empty($data->image)) {
                unlink('uploads/products/' . $data->image);
            }
        } else {
            return redirect()->back()->with('error', 'Sorry! does not found any data.');
        }
        return redirect()->back()->with('success', 'Product deleted successfully ): ');
    }

    /**
     * Product edit
     */
    public function edit($id)
    {
        $data = Product::find($id);
        $categories = Category::all();
        return view('admin.product.edit_product', compact('data', 'categories'));
    }

    /**
     * Product update
     */
    public function update(Request $request, $id)
    {
        $data = Product::find($id);
        if ($data != NULL) {
            $this->validate($request, [
                'category_id' => 'required',
                'name'        => 'required | unique:users,name,' . $data->id,
                'code'        => 'required',
                'color'       => 'required',
                'description' => 'required',
                'price'       => 'required',
            ]);

            // Product upload directory and photo resize by imageintervention
            $image_unique_name = '';
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $image_unique_name = md5(time() . rand()) . '.' . $image->getClientOriginalExtension();
                Image::make($image)->resize(260, 420)->save('uploads/products/' . $image_unique_name);
                $image->move(public_path('uploads/products/'), $image_unique_name);
                if (file_exists('uploads/products/' . $data->image) && !empty($data->image)) {
                    unlink('uploads/products/' . $data->image);
                }
            } else {
                $image_unique_name = $data->image;
            }

            $data->category_id = $request->category_id;
            $data->name = $request->name;
            $data->slug = Str::slug($request->name);
            $data->code = $request->code;
            $data->color = $request->color;
            $data->description = $request->description;
            $data->price = $request->price;
            $data->image = $image_unique_name;
            $data->update();

            return redirect()->route('products.view')->with('success', 'Product updated successfully ): ');
        }
    }

    /**
     * Product attributes page
     */
    public function productAttributs($id)
    {
        $product = Product::find($id);
        $pro_attr = ProductAttribute::where('product_id', $product->id)->get();
        return view('admin.product.product_attribute', compact('product', 'pro_attr'));
    }

    /**
     * Product attributes store
     */
    public function productAttributsStore(Request $request)
    {
        $this->validate($request, [
            'product_id' => 'required',
            'sku'        => 'required',
            'size'       => 'required',
            'price'      => 'required',
            'stock'      => 'required',
        ]);

        $size_count = count($request->size);

        for ($i = 0; $i < $size_count; $i++) {
            if ($request->sku != NULL) {
                //check sku already exists or not
                $attrProSku = ProductAttribute::where('product_id', $request->product_id)->where('sku', $request->sku[$i])->count();
                if ($attrProSku > 0) {
                    return redirect()->back()->with('error', 'Sorry! ' . $request->sku[$i] . ' This product sku already has been taken, please insert another sku.');
                }

                //check size already exists or not
                $attrProSize = ProductAttribute::where('product_id', $request->product_id)->where('size', $request->size[$i])->count();
                if ($attrProSize > 0) {
                    return redirect()->back()->with('error', 'Sorry! ' . $request->size[$i] . ' This product size already has been taken, please insert another size.');
                }

                ProductAttribute::create([
                    'product_id' => $request->product_id,
                    'sku'        => $request->sku[$i],
                    'size'       => $request->size[$i],
                    'price'      => $request->price[$i],
                    'stock'      => $request->stock[$i],
                ]);
            }
        }
        return redirect()->back()->with('success', 'Product attributes added successfully ): ');
    }
}
