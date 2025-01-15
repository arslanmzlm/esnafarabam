<?php

namespace App\Http\Controllers\Admin;

use App\Enums\UserState;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use App\Services\ProvinceService;
use App\Services\RoleService;
use App\Services\UserService;
use Inertia\Inertia;

class UserController extends Controller
{
    public function __construct(private UserService $userService, private ProvinceService $provinceService, private RoleService $roleService)
    {
    }

    public function list()
    {
        return Inertia::render('Admin/User/List', [
            'users' => User::all()
        ]);
    }

    public function listPending()
    {
        return Inertia::render('Admin/User/PendingList', [
            'users' => User::where('state', UserState::PENDING)->get()->load(['profile.province', 'profile.district'])
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/User/Create', [
            'provinces' => $this->provinceService->getToDistrict(),
            'roles' => $this->roleService->getForUserCreate(),
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
            'roles' => $this->roleService->getForUserCreate(),
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

    public function approve(User $user)
    {
        $approve = $this->userService->approveUser($user);

        if ($approve) {
            session()->flash('toast.success', trans('messages.user.approved'));
        } else {
            session()->flash('toast.false', trans('messages.user.not_approved'));
        }

        return back();
    }
}
