<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AmountFormatter extends Component
{
    public $amount;

    public function __construct($amount)
    {
        $this->amount = $amount;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.amount-formatter');
    }
}
