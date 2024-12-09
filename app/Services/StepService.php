<?php

namespace App\Services;

use App\Enums\StepType;
use App\Models\VehicleType;
use App\Repositories\StepRepository;

class StepService
{
    public function __construct(private StepRepository $stepRepository)
    {
    }

    public function getStepData(array $data): ?array
    {
        if (!empty($data) && isset($data['vehicle_type_id']) && is_numeric($data['vehicle_type_id'])) {
            $vehicleType = VehicleType::find($data['vehicle_type_id']);

            if ($vehicleType->step_type === StepType::YEAR) {
                return $this->generateResponseForYearStep($data);
            }

            if ($vehicleType->step_type === StepType::BRAND) {
                return $this->generateResponseForBrandStep($data);
            }
        }

        return null;
    }

    public function generateResponseForYearStep(array $data): ?array
    {
        if (isset($data['submodel']) && is_string($data['submodel'])) {
            return [
                'vehicles' => $this->stepRepository->getVehicles($data['vehicle_type_id'], $data['year'], $data['brand_id'], $data['series'], $data['model'], $data['submodel']),
            ];
        }

        if (isset($data['model']) && is_string($data['model'])) {
            return [
                'submodels' => $this->stepRepository->getSubModels($data['vehicle_type_id'], $data['year'], $data['brand_id'], $data['series'], $data['model'])
            ];
        }

        if (isset($data['series']) && is_string($data['series'])) {
            return [
                'models' => $this->stepRepository->getModels($data['vehicle_type_id'], $data['year'], $data['brand_id'], $data['series'])
            ];
        }

        if (isset($data['brand_id']) && is_numeric($data['brand_id'])) {
            return [
                'series' => $this->stepRepository->getSeries($data['vehicle_type_id'], $data['year'], $data['brand_id'])
            ];
        }

        if (isset($data['year']) && is_numeric($data['year'])) {
            return [
                'brands' => $this->stepRepository->getBrands($data['vehicle_type_id'], $data['year'])
            ];
        }

        if (isset($data['vehicle_type_id']) && is_numeric($data['vehicle_type_id'])) {
            return [
                'years' => $this->stepRepository->getYears($data['vehicle_type_id'])
            ];
        }

        return [
            'vehicleTypes' => $this->stepRepository->getTypes()
        ];
    }

    public function generateResponseForBrandStep(array $data): ?array
    {
        if (isset($data['model']) && is_string($data['model'])) {
            return [
                'vehicles' => $this->stepRepository->getVehiclesByModel($data['vehicle_type_id'], $data['brand_id'], $data['model'])
            ];
        }

        if (isset($data['brand_id']) && is_numeric($data['brand_id'])) {
            return [
                'models' => $this->stepRepository->getModelsByBrand($data['vehicle_type_id'], $data['brand_id'])
            ];
        }

        if (isset($data['vehicle_type_id']) && is_numeric($data['vehicle_type_id'])) {
            return [
                'brands' => $this->stepRepository->getBrandsByVehicleType($data['vehicle_type_id'])
            ];
        }

        return [
            'vehicleTypes' => $this->stepRepository->getTypes()
        ];
    }
}
