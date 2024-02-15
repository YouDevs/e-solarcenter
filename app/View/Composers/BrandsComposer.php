<?php

namespace App\View\Composers;

use Illuminate\View\View;
use App\Enums\BrandsEnum;

class BrandsComposer
{
    public function __construct()
    {}

    public function compose(View $view)
    {
        $view->with('brands', BrandsEnum::cases());
    }
}