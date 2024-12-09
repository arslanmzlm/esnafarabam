<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBrandRequest;
use App\Http\Requests\UpdateBrandRequest;
use App\Models\Brand;
use App\Services\BrandService;
use Inertia\Inertia;

class BrandController extends Controller
{
    public function __construct(private BrandService $brandService)
    {
    }

    public function list()
    {
        return Inertia::render('Admin/Brand/List', [
            'brands' => Brand::orderByDesc('id')->get()->loadCount('vehicles')
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/Brand/Create');
    }

    public function store(StoreBrandRequest $request)
    {
        $this->brandService->store($request->validated());

        $request->session()->flash('toast.success', trans('messages.brand.created'));

        return to_route('admin.brand.list');
    }

    public function edit(Brand $brand)
    {
        return Inertia::render('Admin/Brand/Edit', ['brand' => $brand]);
    }

    public function update(Brand $brand, UpdateBrandRequest $request)
    {
        $this->brandService->update($brand, $request->validated());

        $request->session()->flash('toast.success', trans('messages.brand.updated'));

        return to_route('admin.brand.list');
    }

    public function destroy(Brand $brand)
    {
        $this->brandService->delete($brand);

        session()->flash('toast.success', trans('messages.brand.deleted'));

        return to_route('admin.brand.list');
    }
}
