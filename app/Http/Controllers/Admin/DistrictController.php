<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDistrictRequest;
use App\Http\Requests\UpdateDistrictRequest;
use App\Models\District;
use App\Models\Province;
use App\Services\DistrictService;
use Inertia\Inertia;

class DistrictController extends Controller
{
    public function __construct(private DistrictService $districtService)
    {
    }

    public function list()
    {
        return Inertia::render('Admin/District/List', [
            'districts' => District::orderBy('province_id')->orderBy('name')->get()->load('province')
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/District/Create', [
            'provinces' => Province::orderBy('name')->get()
        ]);
    }

    public function store(StoreDistrictRequest $request)
    {
        $this->districtService->store($request->validated());

        $request->session()->flash('toast.success', trans('messages.district.created'));

        return to_route('admin.district.list');
    }

    public function edit(District $district)
    {
        return Inertia::render('Admin/District/Edit', [
            'district' => $district,
            'provinces' => Province::orderBy('name')->get()
        ]);
    }

    public function update(District $district, UpdateDistrictRequest $request)
    {
        $this->districtService->update($district, $request->validated());

        $request->session()->flash('toast.success', trans('messages.district.updated'));

        return to_route('admin.district.list');
    }

    public function destroy(District $district)
    {
        $this->districtService->delete($district);

        session()->flash('toast.success', trans('messages.district.deleted'));

        return to_route('admin.district.list');
    }
}
