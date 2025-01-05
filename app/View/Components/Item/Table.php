<?php

namespace App\View\Components\Item;

use App\Models\Item;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class Table extends Component
{
    /**
     * Create a new component instance.
     * @var Collection<Item>|Item[] $items
     */
    public function __construct(public Collection|array $items)
    {
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.item.table');
    }
}
