<?php

namespace App\Repositories;

use App\Models\Brand;
use App\Models\Vehicle;
use App\Models\VehicleType;
use Illuminate\Support\Collection;

class StepRepository
{
    public function getTypes(): Collection
    {
        return VehicleType::where('active', true)->orderBy('order')->get();
    }

    public function getYears(int $vehicle_type_id): Collection
    {
        return Vehicle::where('active', true)
            ->where('vehicle_type_id', $vehicle_type_id)
            ->whereNotNull('submodel')
            ->groupBy('year')
            ->orderByDesc('year')
            ->pluck('year');
    }

    public function getBrands(int $vehicle_type_id, int $year): Collection
    {
        $brandIdQuery = Vehicle::select('brand_id')
            ->where('active', true)
            ->where('vehicle_type_id', $vehicle_type_id)
            ->where('year', $year)
            ->whereNotNull('submodel')
            ->groupBy('brand_id');

        return Brand::whereIn('id', $brandIdQuery)
            ->select(['id', 'name'])
            ->orderBy('name')
            ->get();
    }

    public function getSeries(int $vehicle_type_id, int $year, int $brand_id): Collection
    {
        return Vehicle::where('active', true)
            ->where('vehicle_type_id', $vehicle_type_id)
            ->where('year', $year)
            ->where('brand_id', $brand_id)
            ->whereNotNull('submodel')
            ->groupBy('series')
            ->orderBy('series')
            ->pluck('series')
            ->sort();
    }

    public function getModels(int $vehicle_type_id, int $year, int $brand_id, string $series): Collection
    {
        return Vehicle::where('active', true)
            ->where('vehicle_type_id', $vehicle_type_id)
            ->where('year', $year)
            ->where('brand_id', $brand_id)
            ->where('series', $series)
            ->whereNotNull('submodel')
            ->groupBy('model')
            ->orderBy('model')
            ->pluck('model')
            ->sort();
    }

    public function getSubModels(int $vehicle_type_id, int $year, int $brand_id, string $series, string $model): Collection
    {
        return Vehicle::where('active', true)
            ->where('vehicle_type_id', $vehicle_type_id)
            ->where('year', $year)
            ->where('brand_id', $brand_id)
            ->where('series', $series)
            ->where('model', $model)
            ->whereNotNull('submodel')
            ->groupBy('submodel')
            ->orderBy('submodel')
            ->pluck('submodel')
            ->sort();
    }

    public function getVehicles(int $vehicle_type_id, int $year, int $brand_id, string $series, string $model, string $submodel): Collection
    {
        return Vehicle::where('active', true)
            ->where('vehicle_type_id', $vehicle_type_id)
            ->where('year', $year)
            ->where('brand_id', $brand_id)
            ->where('series', $series)
            ->where('model', $model)
            ->where('submodel', $submodel)
            ->get();
    }

    public function getBrandsByVehicleType(int $vehicle_type_id): Collection
    {
        $brandIdQuery = Vehicle::select('brand_id')
            ->where('active', true)
            ->where('vehicle_type_id', $vehicle_type_id)
            ->groupBy('brand_id');

        return Brand::whereIn('id', $brandIdQuery)
            ->select(['id', 'name'])
            ->orderBy('name')
            ->get();
    }

    public function getModelsByBrand(int $vehicle_type_id, int $brand_id): Collection
    {
        return Vehicle::where('active', true)
            ->where('vehicle_type_id', $vehicle_type_id)
            ->where('brand_id', $brand_id)
            ->groupBy('model')
            ->orderBy('model')
            ->pluck('model')
            ->sort();
    }

    public function getVehiclesByModel(int $vehicle_type_id, int $brand_id, string $model): Collection
    {
        return Vehicle::where('active', true)
            ->where('vehicle_type_id', $vehicle_type_id)
            ->where('brand_id', $brand_id)
            ->where('model', $model)
            ->get();
    }
}
