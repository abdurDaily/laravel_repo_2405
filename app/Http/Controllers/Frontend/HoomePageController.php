<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category\Category;
use Illuminate\Http\Request;

class HoomePageController extends Controller
{
    public function index(){
        $categories = Category::where('parent_id',null)->with('child')->get();
        // dd($categories);
        return view('frontend.layout');
    }
}
