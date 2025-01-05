<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\VehicleType;
use App\Services\AttributeService;
use App\Services\ItemService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ItemController extends Controller
{
    public function __construct(private AttributeService $attributeService, private ItemService $itemService)
    {
    }

    public function list(?VehicleType $vehicleType = null)
    {
        return view('item.list', [
            'items' => $this->itemService->getActiveByType($vehicleType, 10),
        ]);
    }

    public function search(Request $request)
    {
        return view('item.list', [
            'items' => $this->itemService->filter($request->query('search'), 10),
        ]);
    }

    public function detail(Item $item, ?string $slug = null)
    {
        if ($slug !== $item->slug) {
            return to_route('item.detail', ['item' => $item, 'slug' => $item->slug], Response::HTTP_MOVED_PERMANENTLY);
        }

        return view('item.detail', [
            'item' => $item,
            'attributeCategories' => $this->attributeService->getAttributesByItem($item),
        ]);
    }
}
