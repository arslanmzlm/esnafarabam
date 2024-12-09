<?php

namespace App\Http\Controllers\Admin;

use App\Enums\AttributeType;
use App\Enums\Fuel;
use App\Enums\Gear;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreVehicleRequest;
use App\Http\Requests\UpdateVehicleRequest;
use App\Models\Brand;
use App\Models\Vehicle;
use App\Models\VehicleType;
use App\Services\AttributeService;
use App\Services\VehicleService;
use Inertia\Inertia;

class VehicleController extends Controller
{
    public function __construct(private VehicleService $vehicleService, private AttributeService $attributeService)
    {
    }

    public function list()
    {
        return Inertia::render('Admin/Vehicle/List', [
            'vehicles' => Vehicle::orderByDesc('id')->get()->load(['brand', 'type'])
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/Vehicle/Create', [
            'brands' => Brand::where('active', true)->get(),
            'vehicleTypes' => VehicleType::where('active', true)->get(),
            'gears' => Gear::getAll(),
            'fuels' => Fuel::getAll(),
        ]);
    }

    public function store(StoreVehicleRequest $request)
    {
        $this->vehicleService->store($request->validated());

        $request->session()->flash('toast.success', trans('messages.vehicle.created'));

        return to_route('admin.vehicle.list');
    }

    public function edit(Vehicle $vehicle)
    {
        return Inertia::render('Admin/Vehicle/Edit', [
            'vehicle' => $vehicle,
            'brands' => Brand::where('active', true)->get(),
            'vehicleTypes' => VehicleType::where('active', true)->get(),
            'gears' => Gear::getAll(),
            'fuels' => Fuel::getAll(),
            'attributeCategories' => $this->attributeService->getAttributes(AttributeType::getForVehicle(), $vehicle->vehicle_type_id),
            'attributeValues' => $this->attributeService->getAttributeValues($vehicle)
        ]);
    }

    public function update(Vehicle $vehicle, UpdateVehicleRequest $request)
    {
        $this->vehicleService->update($vehicle, $request->validated());

        $request->session()->flash('toast.success', trans('messages.vehicle.updated'));

        return to_route('admin.vehicle.list');
    }

    public function destroy(Vehicle $vehicle)
    {
        $this->vehicleService->delete($vehicle);

        session()->flash('toast.success', trans('messages.vehicle.deleted'));

        return to_route('admin.vehicle.list');
    }

    public function select()
    {
        return Inertia::render('Admin/Vehicle/Select', [
            'vehicleTypes' => VehicleType::where('active', true)->orderBy('order')->get()
        ]);
    }
}
