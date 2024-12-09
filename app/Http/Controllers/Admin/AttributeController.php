<?php

namespace App\Http\Controllers\Admin;

use App\Enums\AttributeInput;
use App\Enums\AttributeType;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAttributeRequest;
use App\Http\Requests\UpdateAttributeRequest;
use App\Models\Attribute;
use App\Models\AttributeCategory;
use App\Models\VehicleType;
use App\Services\AttributeService;
use Inertia\Inertia;

class AttributeController extends Controller
{
    public function __construct(private AttributeService $attributeService)
    {
    }

    public function list()
    {
        return Inertia::render('Admin/Attribute/List', [
            'attributes' => Attribute::orderByDesc('id')->get()->load(['category', 'values'])
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/Attribute/Create', [
            'categories' => AttributeCategory::orderByDesc('order')->get(),
            'vehicleTypes' => VehicleType::orderBy('name')->get(),
            'types' => AttributeType::getAll(),
            'inputs' => AttributeInput::getAll(),
            'category_id' => request()->query->getInt('category_id'),
        ]);
    }

    public function store(StoreAttributeRequest $request)
    {
        $this->attributeService->store($request->validated());

        $request->session()->flash('toast.success', trans('messages.attribute.created'));

        return to_route('admin.attribute.category.items', ['attributeCategory' => $request->attribute_category_id]);
    }

    public function edit(Attribute $attribute)
    {
        return Inertia::render('Admin/Attribute/Edit', [
            'attribute' => $attribute->load('values'),
            'categories' => AttributeCategory::orderByDesc('order')->get(),
            'vehicleTypes' => VehicleType::orderBy('name')->get(),
            'types' => AttributeType::getAll(),
            'inputs' => AttributeInput::getAll()
        ]);
    }

    public function update(Attribute $attribute, UpdateAttributeRequest $request)
    {
        $this->attributeService->update($attribute, $request->validated());

        $request->session()->flash('toast.success', trans('messages.attribute.updated'));

        return to_route('admin.attribute.category.items', ['attributeCategory' => $attribute->attribute_category_id]);
    }

    public function destroy(Attribute $attribute)
    {
        $this->attributeService->delete($attribute);

        session()->flash('toast.success', trans('messages.attribute.deleted'));

        return to_route('admin.attribute.list');
    }
}
