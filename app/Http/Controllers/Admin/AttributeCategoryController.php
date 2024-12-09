<?php

namespace App\Http\Controllers\Admin;

use App\Enums\AttributeType;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAttributeCategoryRequest;
use App\Http\Requests\UpdateAttributeCategoryRequest;
use App\Models\AttributeCategory;
use App\Models\VehicleType;
use App\Services\AttributeCategoryService;
use Inertia\Inertia;

class AttributeCategoryController extends Controller
{
    public function __construct(private AttributeCategoryService $attributeCategoryService)
    {
    }

    public function list()
    {
        return Inertia::render('Admin/AttributeCategory/List', [
            'categories' => AttributeCategory::all()->load('vehicleType')->loadCount('attributes')
        ]);
    }

    public function items(AttributeCategory $attributeCategory)
    {
        return Inertia::render('Admin/AttributeCategory/Items', [
            'attributeCategory' => $attributeCategory->load('attributes.values'),
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/AttributeCategory/Create', [
            'types' => AttributeType::getAll(),
            'vehicleTypes' => VehicleType::where('active', 1)->orderBy('name')->get()
        ]);
    }

    public function store(StoreAttributeCategoryRequest $request)
    {
        $this->attributeCategoryService->store($request->validated());

        $request->session()->flash('toast.success', trans('messages.attribute.category.created'));

        return to_route('admin.attribute.category.list');
    }

    public function edit(AttributeCategory $attributeCategory)
    {
        return Inertia::render('Admin/AttributeCategory/Edit', [
            'category' => $attributeCategory,
            'types' => AttributeType::getAll(),
            'vehicleTypes' => VehicleType::where('active', 1)->orderBy('name')->get()
        ]);
    }

    public function update(AttributeCategory $attributeCategory, UpdateAttributeCategoryRequest $request)
    {
        $this->attributeCategoryService->update($attributeCategory, $request->validated());

        $request->session()->flash('toast.success', trans('messages.attribute.category.updated'));

        return to_route('admin.attribute.category.list');
    }

    public function destroy(AttributeCategory $attributeCategory)
    {
        $this->attributeCategoryService->delete($attributeCategory);

        session()->flash('toast.success', trans('messages.attribute.category.deleted'));

        return to_route('admin.attribute.category.list');
    }
}
