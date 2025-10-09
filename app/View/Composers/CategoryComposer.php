<?php

namespace App\View\Composers;

use App\Models\Category\Category;
use Illuminate\Contracts\View\View;

class CategoryComposer
{
    public function compose(View $view): void
    {
        $categories = Category::whereNull('parent_id')
            ->with('child')
            ->get();

        $view->with('categories', $categories);
    }
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }
}
