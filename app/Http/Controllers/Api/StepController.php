<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\GetStepDataRequest;
use App\Services\StepService;

class StepController extends Controller
{
    public function __construct(private StepService $stepService)
    {
    }

    public function getStepData(GetStepDataRequest $request)
    {
        return $this->stepService->getStepData($request->validated());
    }
}
