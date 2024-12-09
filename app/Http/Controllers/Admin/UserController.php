<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use App\Services\ProvinceService;
use App\Services\UserService;
use Inertia\Inertia;

class UserController extends Controller
{
    public function __construct(private UserService $userService, private ProvinceService $provinceService)
    {
    }

    public function list()
    {
        return Inertia::render('Admin/User/List', [
            'users' => User::all()
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/User/Create', [
            'provinces' => $this->provinceService->getToDistrict(),
        ]);
    }

    public function store(StoreUserRequest $request)
    {
        $this->userService->store($request->validated());

        $request->session()->flash('toast.success', trans('messages.user.created'));

        return to_route('admin.user.list');
    }

    public function edit(User $user)
    {
        return Inertia::render('Admin/User/Edit', [
            'user' => $user,
            'provinces' => $this->provinceService->getToDistrict(),
        ]);
    }

    public function update(User $user, UpdateUserRequest $request)
    {
        $this->userService->update($user, $request->validated());

        $request->session()->flash('toast.success', trans('messages.user.updated'));

        return to_route('admin.user.list');
    }

    public function destroy(User $user)
    {
        $this->userService->delete($user);

        session()->flash('toast.success', trans('messages.user.deleted'));

        return to_route('admin.user.list');
    }
}
