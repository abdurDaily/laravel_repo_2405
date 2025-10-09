<?php

namespace App\Http\Controllers\Backend\Category;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use SweetAlert2\Laravel\Swal;
use App\Models\Category\Category;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    //*INDEX
    public function index()
    {
        $c_categories = Category::get();
        return view('backend.category.index', compact('c_categories'));
    }

    //* STORE
    public function store(Request $request)
    {
        // dd($request);
        $request->validate([
            'title' => 'required',
        ]);

        $storeCategory = new Category();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = 'category' . time() . '.' . $image->getClientOriginalName();
            // dd($imageName);
            $pathName = 'category/';
            if (!file_exists($pathName)) {
                mkdir($pathName, 0755, true);
            }
            $image->move($pathName, $imageName);
            $storeCategory->image = $imageName;
        }

        $storeCategory->category_title = $request->title;
        $storeCategory->slug = uniqid() . Str::slug($request->title);
        $storeCategory->status = $request->status;
        $storeCategory->image_alt = $request->image_alt;
        $storeCategory->meta_title = $request->meta_title;
        $storeCategory->meta_keywords = $request->meta_keyword;
        $storeCategory->meta_description = $request->meta_description;
        $storeCategory->parent_id = $request->parent_id;
        $storeCategory->save();
        Swal::success([
            'title' => 'New Category Added Successfully!',
        ]);
        return back();
    }

    //* SHOW
    public function show()
    {
        $categories = Category::with('child')->latest()->get();
        // dd($categories);
        return view('backend.category.show', compact('categories'));
    }

    //* EDIT
    public function edit($id)
    {
        $editCategory = Category::find($id);
        // dd($editCategory);
        $categories = Category::get();
        return view('backend.category.edit', compact('editCategory', 'categories'));
    }

    //* UPDATE
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
        ]);

        $storeCategory = Category::find($id);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = 'category' . time() . '.' . $image->getClientOriginalName();
            // dd($imageName);
            $pathName = 'category/';
            if (!file_exists($pathName)) {
                mkdir($pathName, 0755, true);
            }
            $image->move($pathName, $imageName);
            $storeCategory->image = $imageName;
        }

        $storeCategory->category_title = $request->title;
        $storeCategory->slug = uniqid() . Str::slug($request->title);
        $storeCategory->status = $request->status;
        $storeCategory->image_alt = $request->image_alt;
        $storeCategory->meta_title = $request->meta_title;
        $storeCategory->meta_keywords = $request->meta_keyword;
        $storeCategory->meta_description = $request->meta_description;
        $storeCategory->parent_id = $request->parent_id;
        $storeCategory->save();
        Swal::success([
            'title' => 'Category Updated Successfully!',
        ]);
        return redirect()->route('category.show');
    }

    //* DELETE
    public function delete($id)
    {
        $deleteCategory = Category::find($id);
        $deleteCategory->delete();
        // if ($deleteCategory) {
        //     $deleteCategory->delete();
        //     Swal::success([
        //         'title' => 'Category Deleted Successfully!',
        //     ]);
        // } else {
        //     Swal::error([
        //         'title' => 'No Category Found!',
        //     ]);
        // }
        return back();
    }
}
