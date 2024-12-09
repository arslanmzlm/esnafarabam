<?php

namespace App\Http\Controllers\Admin;

use App\Enums\AttributeType;
use App\Enums\ItemState;
use App\Http\Controllers\Controller;
use App\Http\Requests\EvaluateItemRequest;
use App\Http\Requests\StoreItemRequest;
use App\Http\Requests\UpdateItemRequest;
use App\Models\Item;
use App\Models\Vehicle;
use App\Services\AttributeService;
use App\Services\ItemService;
use App\Services\ProvinceService;
use Inertia\Inertia;

class ItemController extends Controller
{
    public function __construct(private ItemService $itemService, private AttributeService $attributeService, private ProvinceService $provinceService)
    {
    }

    public function list()
    {
        return Inertia::render('Admin/Item/List', [
            'items' => Item::orderByDesc('id')->get()->load('vehicle')
        ]);
    }

    public function grid()
    {
        return Inertia::render('Admin/Item/Grid', [
            'items' => Item::orderByDesc('id')->get()->append('cover')->load(['vehicle', 'province'])
        ]);
    }

    public function show(Item $item)
    {
        return Inertia::render('Admin/Item/Show', [
            'item' => $item->load(['vehicle.brand', 'province', 'district', 'neighborhood', 'approvedPhotos']),
            'attributeCategories' => $this->attributeService->getAttributesByItem($item),
        ]);
    }

    public function create(Vehicle $vehicle)
    {
        return Inertia::render('Admin/Item/Create', [
            'vehicle' => $vehicle->load(['brand', 'type']),
            'attributeCategories' => $this->attributeService->getAttributes(AttributeType::getForItem(), $vehicle->vehicle_type_id),
            'provinces' => $this->provinceService->getAll()
        ]);
    }

    public function store(StoreItemRequest $request)
    {
        $item = $this->itemService->store($request->validated());

        $request->session()->flash('toast.success', trans('messages.item.created'));

        return to_route('admin.item.edit', $item);
    }

    public function edit(Item $item)
    {
        return Inertia::render('Admin/Item/Edit', [
            'item' => $item->load('photos'),
            'vehicle' => $item->vehicle->load(['brand', 'type']),
            'attributeCategories' => $this->attributeService->getAttributes(AttributeType::getForItem(), $item->vehicle->vehicle_type_id),
            'attributeValues' => $this->attributeService->getAttributeValues($item),
            'provinces' => $this->provinceService->getAll()
        ]);
    }

    public function update(Item $item, UpdateItemRequest $request)
    {
        $this->itemService->update($item, $request->validated());

        $request->session()->flash('toast.success', trans('messages.item.updated'));

        return to_route('admin.item.edit', $item);
    }

    public function control(Item $item)
    {
        return Inertia::render('Admin/Item/Control', [
            'item' => $item->load(['photos', 'province', 'district', 'neighborhood']),
            'states' => ItemState::getAll(),
            'vehicle' => $item->vehicle->load(['brand', 'type']),
            'attributeCategories' => $this->attributeService->getAttributes(AttributeType::getForItem(), $item->vehicle->vehicle_type_id),
            'attributeValues' => $this->attributeService->getAttributeValues($item),
        ]);
    }

    public function evaluate(Item $item, EvaluateItemRequest $request)
    {
        $this->itemService->evaluate($item, $request->validated());

        session()->flash('toast.success', trans('messages.item.evaluated'));

        return to_route('admin.item.control', $item);
    }

    public function destroy(Item $item)
    {
        $this->itemService->delete($item);

        session()->flash('toast.success', trans('messages.item.deleted'));

        return to_route('admin.item.list');
    }
}
