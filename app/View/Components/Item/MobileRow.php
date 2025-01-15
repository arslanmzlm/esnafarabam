<?php

namespace App\View\Components\Item;

use App\Models\Item;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class MobileRow extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public Item $item)
    {
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.item.mobile-row');
    }
}
