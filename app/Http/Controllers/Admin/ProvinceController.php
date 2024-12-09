<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProvinceRequest;
use App\Http\Requests\UpdateProvinceRequest;
use App\Models\Province;
use App\Services\ProvinceService;
use Inertia\Inertia;

class ProvinceController extends Controller
{
    public function __construct(private ProvinceService $provinceService)
    {
    }

    public function list()
    {
        return Inertia::render('Admin/Province/List', [
            'provinces' => Province::orderBy('code')->get()
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/Province/Create');
    }

    public function store(StoreProvinceRequest $request)
    {
        $this->provinceService->store($request->validated());

        $request->session()->flash('toast.success', trans('messages.province.created'));

        return to_route('admin.province.list');
    }

    public function edit(Province $province)
    {
        return Inertia::render('Admin/Province/Edit', [
            'province' => $province,
        ]);
    }

    public function update(Province $province, UpdateProvinceRequest $request)
    {
        $this->provinceService->update($province, $request->validated());

        $request->session()->flash('toast.success', trans('messages.province.updated'));

        return to_route('admin.province.list');
    }

    public function destroy(Province $province)
    {
        $this->provinceService->delete($province);

        session()->flash('toast.success', trans('messages.province.deleted'));

        return to_route('admin.province.list');
    }
}
