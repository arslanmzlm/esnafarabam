<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateSettingsRequest;
use App\Services\SettingService;
use Inertia\Inertia;

class SettingController extends Controller
{
    public function __construct(private SettingService $settingService)
    {
    }

    public function edit()
    {
        return Inertia::render('Admin/Setting/Edit', [
            'settings' => $this->settingService->getAll(),
        ]);
    }

    public function update(UpdateSettingsRequest $request)
    {
        $this->settingService->updateAll($request->validated());

        $request->session()->flash('toast.success', trans('messages.setting.updated'));

        return to_route('admin.setting.edit');
    }
}
