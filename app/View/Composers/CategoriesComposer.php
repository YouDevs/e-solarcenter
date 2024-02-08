<?php

namespace App\View\Composers;

use Illuminate\View\View;
use App\Models\Category;

class CategoriesComposer
{
    public function __construct()
    {}

    public function compose(View $view)
    {
        $view->with('categories', Category::all());
    }
}