<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Models\Ability;
use App\Models\Role;
use App\Services\RoleService;
use Inertia\Inertia;

class RoleController extends Controller
{
    public function __construct(private RoleService $roleService)
    {
    }

    public function list()
    {
        return Inertia::render('Admin/Role/List', [
            'roles' => Role::all()
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/Role/Create', [
            'abilities' => Ability::orderBy('title')->get()
        ]);
    }

    public function store(StoreRoleRequest $request)
    {
        $this->roleService->store($request->validated());

        $request->session()->flash('toast.success', trans('messages.role.created'));

        return to_route('admin.role.list');
    }

    public function edit(Role $role)
    {
        return Inertia::render('Admin/Role/Edit', [
            'role' => $role,
            'roleAbilities' => $role->abilities->pluck('id'),
            'abilities' => Ability::orderBy('title')->get()
        ]);
    }

    public function update(Role $role, UpdateRoleRequest $request)
    {
        $this->roleService->update($role, $request->validated());

        $request->session()->flash('toast.success', trans('messages.role.updated'));

        return to_route('admin.role.list');
    }

    public function destroy(Role $role)
    {
        $this->roleService->delete($role);

        session()->flash('toast.success', trans('messages.role.deleted'));

        return to_route('admin.role.list');
    }
}
