<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdatePasswordRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Http\Requests\UpdateUserInfoRequest;
use App\Services\ProvinceService;
use App\Services\UserService;

class UserController extends Controller
{
    public function __construct(private ProvinceService $provinceService, private UserService $userService)
    {
    }

    public function profile()
    {
        return view('user.profile', [
            'user' => auth()->user(),
            'provinces' => $this->provinceService->getToDistrict(),
        ]);
    }

    public function updateUser(UpdateUserInfoRequest $request)
    {
        $this->userService->update(auth()->user(), $request->validated());

        $request->session()->flash('toast.success', trans('messages.user.info_updated'));

        return to_route('user.profile');
    }

    public function updatePassword(UpdatePasswordRequest $request)
    {
        $this->userService->updatePassword(auth()->user(), $request->validated());

        $request->session()->flash('toast.success', trans('messages.user.password_updated'));

        return to_route('user.profile');
    }

    public function updateProfile(UpdateProfileRequest $request)
    {
        $this->userService->update(auth()->user(), $request->validated());

        $request->session()->flash('toast.success', trans('messages.user.profile_updated'));

        return to_route('user.profile');
    }
}
