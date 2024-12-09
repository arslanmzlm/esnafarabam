<?php

namespace App\Http\Controllers\Admin;

use App\Enums\StepType;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreVehicleTypeRequest;
use App\Http\Requests\UpdateVehicleTypeRequest;
use App\Models\VehicleType;
use App\Services\VehicleTypeService;
use Inertia\Inertia;

class VehicleTypeController extends Controller
{
    public function __construct(private VehicleTypeService $vehicleTypeService)
    {
    }

    public function list()
    {
        return Inertia::render('Admin/VehicleType/List', [
            'vehicleTypes' => VehicleType::orderBy('order')->get()
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/VehicleType/Create', [
            'stepTypes' => StepType::getAll(),
        ]);
    }

    public function store(StoreVehicleTypeRequest $request)
    {
        $this->vehicleTypeService->store($request->validated());

        $request->session()->flash('toast.success', trans('messages.vehicle.type.created'));

        return to_route('admin.vehicle.type.list');
    }

    public function edit(VehicleType $vehicleType)
    {
        return Inertia::render('Admin/VehicleType/Edit', [
            'vehicleType' => $vehicleType,
            'stepTypes' => StepType::getAll(),
        ]);
    }

    public function update(VehicleType $vehicleType, UpdateVehicleTypeRequest $request)
    {
        $this->vehicleTypeService->update($vehicleType, $request->validated());

        $request->session()->flash('toast.success', trans('messages.vehicle.type.updated'));

        return to_route('admin.vehicle.type.list');
    }

    public function destroy(VehicleType $vehicleType)
    {
        $this->vehicleTypeService->delete($vehicleType);

        session()->flash('toast.success', trans('messages.vehicle.type.deleted'));

        return to_route('admin.vehicle.type.list');
    }
}
