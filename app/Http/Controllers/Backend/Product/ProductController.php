<?php

namespace App\Http\Controllers\Backend\Product;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use SweetAlert2\Laravel\Swal;
use App\Models\Product\Product;
use App\Models\Category\Category;
use App\Http\Controllers\Controller;
use App\Models\Images\Images;

class ProductController extends Controller
{
    //*INDEX
    public function index()
    {
        // dd('Product Controller');
        $categories = Category::get();
        return view('backend.product.index', compact('categories'));
    }

    //* PRODUCT IMAGES
    public function productImages()
    {
        $products = Product::get();
        return view('backend.product.images', compact('products'));
    }

    //* STORE PRODUCT IMAGES
    public function storeProductImages(Request $request)
    {

        $request->validate([
            'product_id' => 'required',
            'images' => 'required',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);


        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imageName = time() . '.' . $image->getClientOriginalName();
                $image->storeAs('uploads/product/', $imageName, 'public');
                Images::create([
                    'product_id' => $request->product_id,
                    'image' => $imageName,
                ]);
            }
        }

        return redirect()->route('')->with('success','');


    }

    //* ALL IMAGE SHOW
    public function productImagesShow(){
        $products = Product::with('images')->get();
        dd($products);
    }

    //* STORE PRODUCT 
    public function storeProduct(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'state' => 'required',
            'price' => 'required',
            'status' => 'required',
        ]);
        $product = new Product();
        $product->title = $request->title;
        $product->slug = time() . '-' . Str::slug($request->title);
        $product->category_id = $request->state;
        $product->price = $request->price;
        $product->discount_price = $request->discount_price;
        $product->status = $request->status;
        $product->description = $request->descriptions;
        $product->save();
        Swal::success([
            'title' => 'New Product Added Successfully!',
        ]);
        return redirect()->route('product.show');
    }


    //* SHOW 
    public function showProduct()
    {
        $products = Product::latest()->simplePaginate(10);
        // dd($products);
        return view('backend.product.showProduct', compact('products'));
    }
}
