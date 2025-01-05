<?php

namespace App\Http\Controllers\Admin;

use App\Enums\BannerField;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBannerRequest;
use App\Http\Requests\UpdateBannerRequest;
use App\Models\Banner;
use App\Services\BannerService;
use Inertia\Inertia;

class BannerController extends Controller
{
    public function __construct(private BannerService $bannerService)
    {
    }

    public function list()
    {
        return Inertia::render('Admin/Banner/List', [
            'banners' => Banner::all()
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/Banner/Create', [
            'bannerFields' => BannerField::getAll()
        ]);
    }

    public function store(StoreBannerRequest $request)
    {
        $this->bannerService->store($request->validated());

        $request->session()->flash('toast.success', trans('messages.banner.created'));

        return to_route('admin.banner.list');
    }

    public function edit(Banner $banner)
    {
        return Inertia::render('Admin/Banner/Edit', [
            'banner' => $banner,
            'bannerFields' => BannerField::getAll()
        ]);
    }

    public function update(Banner $banner, UpdateBannerRequest $request)
    {
        $this->bannerService->update($banner, $request->validated());

        $request->session()->flash('toast.success', trans('messages.banner.updated'));

        return to_route('admin.banner.list');
    }

    public function destroy(Banner $banner)
    {
        $this->bannerService->delete($banner);

        session()->flash('toast.success', trans('messages.banner.deleted'));

        return to_route('admin.banner.list');
    }
}
