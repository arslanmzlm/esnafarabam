<?php

namespace App\Http\Controllers\Public;

use App\Enums\BannerField;
use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Services\BannerService;
use App\Services\ItemService;
use App\Services\VehicleTypeService;

class DefaultController extends Controller
{
    public function __construct(private ItemService $itemService, private VehicleTypeService $vehicleTypeService, private BannerService $bannerService)
    {
    }

    public function index()
    {
        return view('homepage', [
            'items' => $this->itemService->getActive(20),
            'vehicleTypes' => $this->vehicleTypeService->getActive(),
            'homePageSliders' => $this->bannerService->getByField(BannerField::HOME_SLIDER),
        ]);
    }

    public function page(Page $page)
    {
        return view('page.simple', [
            'page' => $page
        ]);
    }
}
