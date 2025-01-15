<?php

namespace App\Services;

use App\Models\Role;
use Illuminate\Database\Eloquent\Collection;

class RoleService
{
    public static function defaultRole(): Role
    {
        return Role::where('default', true)->first() ?? Role::first();
    }

    public function store(array $data): ?Role
    {
        $role = new Role();
        return $this->assignAttributes($role, $data);
    }

    private function assignAttributes(Role $role, array $data): ?Role
    {
        $role->name = $data['name'] ?? $role->name;
        $role->admin = $data['admin'] ?? $role->admin ?? false;

        $role->save();

        if (!empty($data['abilities'])) $this->updateAbilities($role, $data['abilities']);

        return $role->fresh();
    }

    public function updateAbilities(Role $role, array $values): void
    {
        $role->abilities()->sync($values);
    }

    public function delete(Role $role): ?bool
    {
        return $role->delete();
    }

    public function update(Role $role, array $data): ?Role
    {
        return $this->assignAttributes($role, $data);
    }

    public function getForUserCreate(): Collection
    {
        return Role::orderBy('name')->get();
    }
}
