<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreNeighborhoodRequest;
use App\Http\Requests\UpdateNeighborhoodRequest;
use App\Models\District;
use App\Models\Neighborhood;
use App\Services\NeighborhoodService;
use Inertia\Inertia;

class NeighborhoodController extends Controller
{
    public function __construct(private NeighborhoodService $neighborhoodService)
    {
    }

    public function list()
    {
        return Inertia::render('Admin/Neighborhood/List', [
            'neighborhoods' => Neighborhood::orderBy('district_id')->orderBy('name')->get()->load('district.province')
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/Neighborhood/Create', [
            'districts' => District::orderBy('province_id')->orderBy('name')->get()->load('province')
        ]);
    }

    public function store(StoreNeighborhoodRequest $request)
    {
        $this->neighborhoodService->store($request->validated());

        $request->session()->flash('toast.success', trans('messages.neighborhood.created'));

        return to_route('admin.neighborhood.list');
    }

    public function edit(Neighborhood $neighborhood)
    {
        return Inertia::render('Admin/Neighborhood/Edit', [
            'neighborhood' => $neighborhood,
            'districts' => District::orderBy('province_id')->orderBy('name')->get()->load('province')
        ]);
    }

    public function update(Neighborhood $neighborhood, UpdateNeighborhoodRequest $request)
    {
        $this->neighborhoodService->update($neighborhood, $request->validated());

        $request->session()->flash('toast.success', trans('messages.neighborhood.updated'));

        return to_route('admin.neighborhood.list');
    }

    public function destroy(Neighborhood $neighborhood)
    {
        $this->neighborhoodService->delete($neighborhood);

        session()->flash('toast.success', trans('messages.neighborhood.deleted'));

        return to_route('admin.neighborhood.list');
    }
}
